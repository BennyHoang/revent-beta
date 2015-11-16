
<!-- Inkludere Bootstrap -->

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<style>
	#main{
		background-color:#F5F8FA;
	}
</style>
<?php
$postid = 0;
$postidArray = array();
//kalle på buddypress
global $bp;
?>
<div id="job-manager-job-dashboard">
	<input id="visBrukersJobber" type="button" value="Vis dine oppdrag">

	<div id="brukersJobberJobdashbaord">
		<p><?php _e( 'Dine utlyste oppdrag vises nedenfor, og blir automatisk fjernet 30 dager etter utløpsdato.', 'wp-job-manager' ); ?></p>
		<table class="job-manager-jobs">
			<thead>
			<tr>
				<?php foreach ( $job_dashboard_columns as $key => $column ) : ?>
					<th class="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $column ); ?></th>
				<?php endforeach; ?>
				<th class="thid"> Jobb ID</th>
			</tr>
			</thead>
			<tbody>
			<?php if ( ! $jobs ) : ?>
				<tr>
					<td colspan="6"><?php "Du har for tiden ingen aktive oppdrag."//_e( 'You do not have any active listings.', 'wp-job-manager' ); ?></td>
				</tr>
			<?php else : ?>
				<?php foreach ( $jobs as $job ) : ?>
					<tr>
						<?php foreach ( $job_dashboard_columns as $key => $column ) : ?>

							<td class="<?php echo esc_attr( $key ); ?>">
								<?php if ('job_title' === $key ) : ?>
									<?php if ( $job->post_status == 'publish' ) : ?>
										<a href="<?php echo get_permalink( $job->ID ); ?>"><?php echo $job->post_title; ?></a>
									<?php else : ?>
										<?php echo $job->post_title; ?> <small>(<?php the_job_status( $job ); ?>)</small>
									<?php endif; ?>
									<ul class="job-dashboard-actions">
										<?php
										$actions = array();

										switch ( $job->post_status ) {
											case 'publish' :
												$actions['edit'] = array( 'label' => __( 'Edit', 'wp-job-manager' ), 'nonce' => false );

												if ( is_position_filled( $job ) ) {
													$actions['mark_not_filled'] = array( 'label' => __( 'Mark not filled', 'wp-job-manager' ), 'nonce' => true );
												} else {
													$actions['mark_filled'] = array( 'label' => __( 'Mark filled', 'wp-job-manager' ), 'nonce' => true );
												}
												break;
											case 'expired' :
												if ( job_manager_get_permalink( 'submit_job_form' ) ) {
													$actions['relist'] = array( 'label' => __( 'Relist', 'wp-job-manager' ), 'nonce' => true );
												}
												break;
											case 'pending_payment' :
											case 'pending' :
												if ( job_manager_user_can_edit_pending_submissions() ) {
													$actions['edit'] = array( 'label' => __( 'Edit', 'wp-job-manager' ), 'nonce' => false );
												}
												break;
										}

										$actions['delete'] = array( 'label' => __( 'Delete', 'wp-job-manager' ), 'nonce' => true );
										$actions           = apply_filters( 'job_manager_my_job_actions', $actions, $job );

										foreach ( $actions as $action => $value ) {
											$action_url = add_query_arg( array( 'action' => $action, 'job_id' => $job->ID ) );
											if ( $value['nonce'] ) {
												$action_url = wp_nonce_url( $action_url, 'job_manager_my_job_actions' );
											}
											echo '<li><a href="' . esc_url( $action_url ) . '" class="job-dashboard-action-' . esc_attr( $action ) . '">' . esc_html( $value['label'] ) . '</a></li>';
										}
										?>
									</ul>
								<?php elseif ('date' === $key ) : ?>
									<?php echo date_i18n( get_option( 'date_format' ), strtotime( $job->post_date ) ); ?>



									<?php $postid =  ($job->ID);
									$postidArray[] = $postid;
									?>

								<?php elseif ('expires' === $key ) : ?>
									<?php echo $job->_job_expires ? date_i18n( get_option( 'date_format' ), strtotime( $job->_job_expires ) ) : '&ndash;'; ?>
								<?php elseif ('filled' === $key ) : ?>
									<?php echo is_position_filled( $job ) ? '&#10004;' : '&ndash;'; ?>
								<?php else : ?>

									<?php do_action( 'job_manager_job_dashboard_column_' . $key, $job ); ?>

								<?php endif; ?>

							</td>




						<?php endforeach; ?>
						<?php
						/*echo do_shortcode('[cfdb-table form="Søk på arrangement" show="Artist navn,Telefonnummer,Hvilken pris ønsker du/dere?,Informasjon,Listing ID" filter="Listing ID='. $postid .'" ]
                            ');
                                */?>
						<td class="expires"><?php echo $postid; ?></td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
			</tbody>
		</table>
		<?php get_job_manager_template( 'pagination.php', array( 'max_num_pages' => $max_num_pages ) ); ?>

	</div>


	<?php/*

		DETTE FELTET VISER SVAR FRA ARTISTER

		 */ ?>

	<?php
	$lengde = count($postidArray);
	//echo "Lengden er";
	//echo  $lengde;
	$nummerPrintesUt;

	if($lengde == 1 || $lengde == 0){
		$nummerPrintesUt = "Listing ID=". $postid;
		//echo "nummer er mindre en 1";
	}if($lengde >= 2){
		for($i = 0;$i < $lengde;$i++){
			//echo $postidArray[$i];
			//echo "nummer er større en 2";

			$nummerPrintesUt .= "Listing ID=". $postidArray[$i];
			if(($lengde - $i) >= 1){
				$nummerPrintesUt .= "||";
			}

		}
	}
	$postpris = 88;

	echo "<h3 id='jobbdashbordOverskrift'><strong>Tilbud fra underholdere vises nedenfor</strong></h3>";

	//echo do_shortcode('[cfdb-table form="Søk på arrangement" show="Tittel på arrangement,Artist navn,Telefonnummer,Hvilken pris ønsker du/dere?,Informasjon,Listing ID,submit_time,Tilbudsvarighet"  filter="'. $nummerPrintesUt.'" ]');

	//				echo " skriver ut ekoen av nummerPrintesUt " . $nummerPrintesUt;


	//dagensdato for å legge gutløpe tilbud et annet sted
	$dagensDato = date("d/m/Y");
	//echo $dagensDato;
	$randomTallArray = array();
	$randomTall = 0;
	$prisFraRow = 0;
	//tilbud som ikke har utløpt
	require_once(ABSPATH . 'wp-content/plugins/contact-form-7-to-database-extension/CFDBFormIterator.php');
	$exp = new CFDBFormIterator();
	$exp->export($atts['Søk på arrangement'], $atts);
	while ($row = $exp->nextRow()) {
	for($i = 0;$i < $lengde;$i++){
	if($postidArray[$i] == $row['Listing ID']){
	//sjekke om tilbud har utløpt
	if($dagensDato <= $row['Tilbudsvarighet']){
	/*FÅ ut brukeravtar*/



	$brukernavnFraPost = $row['Artistnavn'];
	$brukerIdfrapost = $row['brukerid'];
	$member_id = $brukerIdfrapost;
	?>
	<?php

	$prisFelt = $row['Pris'];
	$prisFelt = preg_replace('/[^0-9\.]/ui','',$prisFelt);
	$prisFelt = preg_replace('/\s+/', '', $prisFelt);

	$kravOgOnsker = $row['Krav og ønsker'];


	$navnArtist = $brukernavnFraPost;
	//echo $navnArtist;
	$antallBokstaverINavn = strlen($navnArtist);

	$artistNavnPrintes = ''.$navnArtist.'';
	$maxOrd = 17;
	$maxOrdLengre = 21;

	$MaxOrdklasse = "";

	if($antallBokstaverINavn >= $maxOrd){
		if($antallBokstaverINavn >= $maxOrdLengre ){
			$MaxOrdklasse = 'langtNavnMedlemOverTjue';
		}else{
			$MaxOrdklasse = 'langtNavnMedlem';
		}
	}




	echo '<div class="dashboardTilbudDiv row">';
	?><div class="avatarJobbDasboardDiv col-md-2"><span class="avtarbildeJobbDashboard"><a href="<?php echo bp_core_get_user_domain( $member_id ) ?>" title="<?php echo bp_core_get_user_displayname( $brukernavnFraPost ) ?>"><?php echo bp_core_fetch_avatar ( array( 'item_id' => $member_id, 'type' => 'full' ) ) ?></a></span>
		<?php
		echo '<span class="adminnavn '.$MaxOrdklasse.'">' . $brukernavnFraPost. '</span></div>';
		echo '<div  class="col-xs-12 col-md-8 tilbud-info-wrap"><p id="tilbudheader">Oppdrag: <b>' . $row['Tittel på arrangement'].'</b><br> utløpsdato: <b>' . $row['Tilbudsvarighet'] .'</b></p>';
		echo '<p id="tilbudinfo"><strong>melding</strong>:' .  $row['Informasjon'] . '</p>';
		if (!empty($kravOgOnsker)){
			echo '<p id="tilbudinfo"><strong>Krav og &oslash;nsker</strong>: ' . $kravOgOnsker . '</p>';
		}
		echo'</div>';
		echo '<p class="col-xs-6" id="tilbudpris">Pris:' .  $prisFelt. 'kr</p>';
		//echo'<a href="../betaling/?key1=' . $row['Hvilken pris ønsker du/dere?'] . '&key2=' . $row['Artist navn'] . '&key3=' . $row['Tittel på arrangement'] . '">Bekreft dette tilbudet</a>';

		//lage produkt
		//$randomTall = mt_rand(100000000000,99999999999999);




		$submitTid = $row['submit_time'];
		$submitBruker = $row['Artistnavn'];
		$sku = $submitBruker . $submitTid;


		//sku regnes ut fra parimeter basert på brukernavn og postettid
		echo do_shortcode('[product sku="'.$sku.'"]');
		echo '</div>';

		}
		}
		}
		}






		echo "<h1>Dersom du har tilbud som har utløpt kan de vises nedenfor</h1>";
		echo  "<input type='button' id='skjulBtn' value='Vis/skjul'/> ";

		echo "<div id='skjul' style='display:none'>";
		//tilbud som  har utløpt
		require_once(ABSPATH . 'wp-content/plugins/contact-form-7-to-database-extension/CFDBFormIterator.php');
		$exp = new CFDBFormIterator();
		$exp->export($atts['Søk på arrangement'], $atts);
		while ($row = $exp->nextRow()) {
			for($i = 0;$i < $lengde;$i++){
				if($postidArray[$i] == $row['Listing ID']){
					//sjekke om tilbud har utløpt
					if($dagensDato <= $row['Tilbudsvarighet']){

					}else{


						$prisFelt = $row['Pris'];
						$prisFelt = preg_replace('/[^0-9\.]/ui','',$prisFelt);
						$prisFelt = preg_replace('/\s+/', '', $prisFelt);

						echo '<div class="dashboardTilbudDiv"><h2>' . $row['Artistnavn'] . ' har gitt deg tilbud på din utlysning ' . $row['Tittel på arrangement'].'</h2>';
						echo '<p>Info:' .  $row['Informasjon'] . '</p>';
						echo '<p>Pris:' .  $prisFelt . ' Dette tilbudet utløper ' . $row['Tilbudsvarighet'].'</p>';
						echo'<h4> Dette tilbud har utløpt</h4></div>';

					}

				}
			}
		}
		echo "</div>";


		?>
		<?PHP

		/*
         * SLUTT PÅ FORESPØRSLER FREA ARTISTER NÅ BEGYNNER BRUKERS INNSENDTE OPDPRAG
         *
         * */
		?>




	</div>

	<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.2.min.js"></script>

	<script type="text/javascript">

		$("#visBrukersJobber").click(function(){
			$('#brukersJobberJobdashbaord').toggle();
		});


		$("#skjulBtn").click(function(){
			$("#skjul").toggle();
		});

	</script>





