<?php 
$postid = 0;
$postidArray = array();

?>
<div id="job-manager-job-dashboard">
	<p><?php _e( 'Dine utlyste jobber vises nedenfor, og blir automatisk fjernet 30 dager etter utløpsdato.', 'wp-job-manager' ); ?></p>
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
					<td colspan="6"><?php "Du har for tiden ingen aktive utlysninger."//_e( 'You do not have any active listings.', 'wp-job-manager' ); ?></td>
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

	echo "<h4 id='jobbdashbordOverskrift'>Artister som ønsker å ta denne jobben vises nedenfor</h4>";

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

  		echo '<div class="dashboardTilbudDiv"><h2 id="tilbudheader">' . $row['Artist navn'] . ' har gitt deg tilbud på din utlysning ' . $row['Tittel på arrangement'].'</h2>';
  		echo '<p id="tilbudutloper">Tilbudet utløper:' . $row['Tilbudsvarighet'] . '</p>';
  		echo '<p id="tilbudinfo">Info:' .  $row['Informasjon'] . '</p>';
  		echo '<p id="tilbudpris">Pris:' .  $row['Hvilken pris ønsker du/dere?'] . '</p>';
		//echo'<a href="../betaling/?key1=' . $row['Hvilken pris ønsker du/dere?'] . '&key2=' . $row['Artist navn'] . '&key3=' . $row['Tittel på arrangement'] . '">Bekreft dette tilbudet</a>';

//lage produkt
//$randomTall = mt_rand(100000000000,99999999999999);




$submitTid = $row['submit_time'];
$submitBruker = $row['Artist navn'];
$sku = $submitBruker . $submitTid;
		

//sku regnes ut fra parimeter basert på brukernavn og postettid
echo do_shortcode('[product sku="'.$sku.'"]'); 

echo '</div>';


//denne gjøres noe på siden etter at brukeren har søkt
/*		
	  $post = array(
     'post_author' => $user_id,
     'post_content' => $row['Informasjon'],
     'post_status' => "publish",
     'post_title' =>  $row['Artist navn'],
    'post_parent' => '',
     'post_type' => "product",

     );
      //Create post
     $post_id = wp_insert_post( $post, $wp_error );
     if($post_id){
     $attach_id = get_post_meta($product->parent_id, "_thumbnail_id", true);
     add_post_meta($post_id, '_thumbnail_id', $attach_id);
    }
    wp_set_object_terms( $post_id, 'Spillejobb', 'product_cat' );
     wp_set_object_terms($post_id, 'simple', 'product_type');



     update_post_meta( $post_id, '_visibility', 'visible' );
     update_post_meta( $post_id, '_stock_status', 'instock');
     update_post_meta( $post_id, 'total_sales', '0');
     update_post_meta( $post_id, '_downloadable', 'yes');
     update_post_meta( $post_id, '_virtual', 'yes');
     update_post_meta( $post_id, '_regular_price', $row['Hvilken pris ønsker du/dere?'] );
     update_post_meta( $post_id, '_sale_price', $row['Hvilken pris ønsker du/dere?'] );
     update_post_meta( $post_id, '_purchase_note', "" );
     update_post_meta( $post_id, '_featured', "no" );
     update_post_meta( $post_id, '_weight', "" );
     update_post_meta( $post_id, '_length', "" );
     update_post_meta( $post_id, '_width', "" );
     update_post_meta( $post_id, '_height', "" );
     update_post_meta($post_id, '_sku', $sku);
     update_post_meta( $post_id, '_product_attributes', array());
     update_post_meta( $post_id, '_sale_price_dates_from', "" );
     update_post_meta( $post_id, '_sale_price_dates_to', "" );
     update_post_meta( $post_id, '_price', $row['Hvilken pris ønsker du/dere?'] );
     update_post_meta( $post_id, '_sold_individually', "" );
     update_post_meta( $post_id, '_manage_stock', "no" );
     update_post_meta( $post_id, '_backorders', "no" );
     update_post_meta( $post_id, '_stock', "" );

     // file paths will be stored in an array keyed off md5(file path)
    $downdloadArray =array('name'=>"Test", 'file' => $uploadDIR['baseurl']."/video/".$video);

    $file_path =md5($uploadDIR['baseurl']."/video/".$video);


    $_file_paths[  $file_path  ] = $downdloadArray;
    // grant permission to any newly added files on any existing orders for this product
    //do_action( 'woocommerce_process_product_file_download_paths', $post_id, 0, $downdloadArray );
    update_post_meta( $post_id, '_downloadable_files ', $_file_paths);
    update_post_meta( $post_id, '_download_limit', '');
    update_post_meta( $post_id, '_download_expiry', '');
    update_post_meta( $post_id, '_download_type', '');
    update_post_meta( $post_id, '_product_image_gallery', '');
//produkt ferdig
*/


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

		echo '<div class="dashboardTilbudDiv"><h2>' . $row['Artist navn'] . ' har gitt deg tilbud på din utlysning ' . $row['Tittel på arrangement'].'</h2>';
  		echo '<p>Info:' .  $row['Informasjon'] . '</p>';
  		echo '<p>Pris:' .  $row['Hvilken pris ønsker du/dere?'] . ' Dette tilbudet utløper ' . $row['Tilbudsvarighet'].'</p>';
		echo'<h4> Dette tilbud har utløpt</h4></div>';

  		}

  		}
  	}
}
echo "</div>";
	

	?>


	<?php get_job_manager_template( 'pagination.php', array( 'max_num_pages' => $max_num_pages ) ); ?>



</div>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.2.min.js"></script>

<script type="text/javascript">


$("#skjulBtn").click(function(){
    $("#skjul").toggle();
});

</script>



<?php 
//lage produktet




?>