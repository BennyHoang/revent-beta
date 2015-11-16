
<?php global $post; ?>


<?php
$privatpost = get_post_meta( $post->ID, '_direkte_artist', true );
$user_ID = get_current_user_id();

//array_push($oppdragIdArray, $post->ID);

//print_r(array_values($oppdragIdArray));


//Denne sjekker om privatpost er tom, dersom den ikke er tom skal den sjekke om innlogget bruker er valgt artist
/*if(!empty($privatpost)){
	if($privatpost == $user_ID){
		echo'<h1>Dette oppdraget er kun til deg :D</h1>';
	}else{
		echo'<h1>Denne er for brukeren med id '.$privatpost.'</h1>';
	}
}else if(empty($privatpost)){
	echo'<h1>Denne er for alle sammen, gogogogo </h1>';
} */

?>


<?php
if($privatpost == $user_ID){
	?>


	<span class="navarendeArtist"><li  <?php job_listing_class(); ?>  class="navarendeArtist" data-longitude="<?php echo esc_attr($post->geolocation_lat); ?>"
																	  data-latitude="<?php echo esc_attr($post->geolocation_long); ?>">
			<a id="joboversiktlink" href="<?php the_job_permalink(); ?>">
				<div id="jobOversiktBilde"><?php the_company_logo(); ?></div>
				<div class="position">
					<h3><?php the_title(); ?></h3>

					<div class="location">
						<?php the_job_location(false); ?>
					</div>
					<div class="jobbdato location"><span>,</span>
						<?php

						//jeg må sjekke når datoen er og om artisten skal jobbe over flere dager


						$datostreng = "ikke satt";
						$datostart = get_post_meta($post->ID, '_jobbdatostart', true);
						$datoslutt = get_post_meta($post->ID, '_datoslutt ', true);

						//BLIR EN FEIL PÅ NOEN POSTER SÅ KOMMENTERT UT INNTIL VIDERE
						/*
                        $datoFraDb = strtotime($datostart);
                        $datostart = date('d/m/Y', $datoFraDb);
                        */
						if ($datoslutt) {
							//Dersom en sluttdato er satt så gjør jeg om den datoen til bedre format
							/*	$datoFraDbslutt = strtotime($datoslutt);
                                $datoslutt = date('d/m/Y', $datoFraDbslutt);*/
							$datostreng = esc_attr($datostart) . ' til ' . esc_attr($datoslutt);
						} else {
							//må sjekke kontaktperson siden dette ikke er bedrift
							$datostreng = esc_attr($datostart);
						}

						//$datostreng2 = $datostreng->format('d/m/Y');
						echo($datostreng);

						?>
					</div>

					<?php $Beskrivelse = get_post_meta($post->ID, '_job_description', true);
					if ($Beskrivelse) {
						echo '<p id="jobbbeskrivelseoversikt">' . strip_tags($Beskrivelse) . '</p>';
					}
					?>
					<div class="company">
						<?php the_company_name('<strong>', '</strong> '); ?>
						<?php the_company_tagline('<span class="tagline">', '</span>'); ?>
					</div>
				</div>

				<ul class="meta">
					<?php do_action('job_listing_meta_start'); ?>

					<?php
					$navn = "";
					$bedriftNavn = get_post_meta($post->ID, '_company_name', true);
					if ($bedriftNavn) {
						$navn = $bedriftNavn;
					} else {
						//må sjekke kontaktperson siden dette ikke er bedrift
						$personnavn = get_post_meta($post->ID, '_kontaktperson', true);
						$navn = $personnavn;
					}

					?>

					<li class="job-type <?php echo get_the_job_type() ? sanitize_title(get_the_job_type()->slug) : ''; ?>"><?php the_job_type(); ?></li>
					<li class="date">Publisert for
						<date><?php printf(__('%s siden', 'wp-job-manager'), human_time_diff(get_post_time('U'), current_time('timestamp'))); ?></date>
						av <?php echo('<strong>' . $navn . '</strong> '); ?>
					</li>
					<?php do_action('job_listing_meta_end'); ?>
				</ul>
			</a>
		</li> </span>
	<?php
} else if(empty($privatpost)){

	?>


	<span class="alleArtist"><li <?php job_listing_class(); ?> data-longitude="<?php echo esc_attr($post->geolocation_lat); ?>"
															   data-latitude="<?php echo esc_attr($post->geolocation_long); ?>">
			<a id="joboversiktlink" href="<?php the_job_permalink(); ?>">
				<div id="jobOversiktBilde"><?php the_company_logo(); ?></div>
				<div class="position">
					<h3><?php the_title(); ?></h3>

					<div class="location">
						<?php the_job_location(false); ?>
					</div>
					<div class="jobbdato location"><span>,</span>
						<?php

						//jeg må sjekke når datoen er og om artisten skal jobbe over flere dager


						$datostreng = "ikke satt";
						$datostart = get_post_meta($post->ID, '_jobbdatostart', true);
						$datoslutt = get_post_meta($post->ID, '_datoslutt ', true);

						//BLIR EN FEIL PÅ NOEN POSTER SÅ KOMMENTERT UT INNTIL VIDERE
						/*
                        $datoFraDb = strtotime($datostart);
                        $datostart = date('d/m/Y', $datoFraDb);
                        */
						if ($datoslutt) {
							//Dersom en sluttdato er satt så gjør jeg om den datoen til bedre format
							/*	$datoFraDbslutt = strtotime($datoslutt);
                                $datoslutt = date('d/m/Y', $datoFraDbslutt);*/
							$datostreng = esc_attr($datostart) . ' til ' . esc_attr($datoslutt);
						} else {
							//må sjekke kontaktperson siden dette ikke er bedrift
							$datostreng = esc_attr($datostart);
						}

						//$datostreng2 = $datostreng->format('d/m/Y');
						echo($datostreng);

						?>
					</div>

					<?php $Beskrivelse = get_post_meta($post->ID, '_job_description', true);
					if ($Beskrivelse) {
						echo '<p id="jobbbeskrivelseoversikt">' . strip_tags($Beskrivelse) . '</p>';
					}
					?>
					<div class="company">
						<?php the_company_name('<strong>', '</strong> '); ?>
						<?php the_company_tagline('<span class="tagline">', '</span>'); ?>
					</div>
				</div>

				<ul class="meta">
					<?php do_action('job_listing_meta_start'); ?>

					<?php
					$navn = "";
					$bedriftNavn = get_post_meta($post->ID, '_company_name', true);
					if ($bedriftNavn) {
						$navn = $bedriftNavn;
					} else {
						//må sjekke kontaktperson siden dette ikke er bedrift
						$personnavn = get_post_meta($post->ID, '_kontaktperson', true);
						$navn = $personnavn;
					}

					?>

					<li class="job-type <?php echo get_the_job_type() ? sanitize_title(get_the_job_type()->slug) : ''; ?>"><?php the_job_type(); ?></li>
					<li class="date">Publisert for
						<date><?php printf(__('%s siden', 'wp-job-manager'), human_time_diff(get_post_time('U'), current_time('timestamp'))); ?></date>
						av <?php echo('<strong>' . $navn . '</strong> '); ?>
					</li>
					<?php do_action('job_listing_meta_end'); ?>
				</ul>
			</a>
		</li></span>
	<?php

}
?>


<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script type="text/javascript">
	$( document ).ready(function() {
		waitForElement(".job_listing",function(){
			console.log("done");
			//$("#artistprivjobber ul").empty();

			$("#artistprivjobber .alleArtist").remove();
			$("#visalleoppdragDiv .navarendeArtist").remove();

			/*	var navarendeID = $(this).attr("class").match("post-");
			 if($("#artistprivjobber #" + navarendeID).length == 0) {
			 //alert("id finnes ikke");
			 $(".navarendeArtist .job_listing").appendTo("#artistprivjobber ul");

			 }else{
			 alert("finnes allerede");
			 }

			 $("#visalleoppdragDiv .navarendeArtist").remove();
			 */
			$("#artistprivjobber").css("display", "block");

		});

		function waitForElement(elementPath, callBack){
			window.setTimeout(function(){
				if($(elementPath).length){
					callBack(elementPath, $(elementPath));
				}else{
					waitForElement(elementPath, callBack);
				}
			},500)
		}


	});
</script>

