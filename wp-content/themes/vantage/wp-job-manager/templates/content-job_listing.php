<?php global $post; ?>
<li <?php job_listing_class(); ?> data-longitude="<?php echo esc_attr( $post->geolocation_lat ); ?>" data-latitude="<?php echo esc_attr( $post->geolocation_long ); ?>">
	<a id="joboversiktlink" href="<?php the_job_permalink(); ?>">
		<div id="jobOversiktBilde"><?php the_company_logo(); ?></div>
		<div class="position">
			<h3><?php the_title(); ?></h3>
			<div class="location">
			<?php the_job_location( false ); ?>
			</div>
			<div class="jobbdato location">
			<?php 

//jeg må sjekke når datoen er og om artisten skal jobbe over flere dager

			 

	$datostreng = "ikke satt";
   $datostart = get_post_meta( $post->ID, '_jobbdatostart', true );
   $datoslutt = get_post_meta( $post->ID, '_datoslutt ', true );
if ($datoslutt){
	$datostreng = esc_attr($datostart) . ' til ' . esc_attr($datoslutt);
}else{
	//må sjekke kontaktperson siden dette ikke er bedrift
	$datostreng = esc_attr($datostart);
}

echo($datostreng);

			?>
			</div>
			
<?php $Beskrivelse = get_post_meta( $post->ID, '_job_description', true );
  if ( $Beskrivelse ) {
    echo '<p id="jobbbeskrivelseoversikt">' .strip_tags($Beskrivelse) . '</p>';
  }
?>
			<div class="company">
				<?php the_company_name( '<strong>', '</strong> ' ); ?>
				<?php the_company_tagline( '<span class="tagline">', '</span>' ); ?>
			</div>
		</div>
	
		<ul class="meta">
			<?php do_action( 'job_listing_meta_start' ); ?>

<?php 
	$navn = "";
   $bedriftNavn = get_post_meta( $post->ID, '_company_name', true );
if ($bedriftNavn){
	$navn = $bedriftNavn;
}else{
	//må sjekke kontaktperson siden dette ikke er bedrift
	$personnavn = get_post_meta( $post->ID, '_kontaktperson', true );
	$navn = $personnavn;
}

?>

			<li class="job-type <?php echo get_the_job_type() ? sanitize_title( get_the_job_type()->slug ) : ''; ?>"><?php the_job_type(); ?></li>
			<li class="date">Publisert for <date><?php printf( __( '%s siden', 'wp-job-manager' ), human_time_diff( get_post_time( 'U' ), current_time( 'timestamp' ) ) ); ?></date> av <?php echo( '<strong>' . $navn . '</strong> ' ); ?>
</li>
			<?php do_action( 'job_listing_meta_end' ); ?>
		</ul>
	</a>
</li>

