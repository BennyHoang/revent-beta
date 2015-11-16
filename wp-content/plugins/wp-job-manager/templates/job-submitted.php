<?php
global $wp_post_types;





/*Sjekker om denne var til en spesiell artist, dersom det er tilfelle sendes det ut en mail*/
$privatpost = get_post_meta( $job->ID, '_direkte_artist', true );

?>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

	<div class="container">

		<?php




		switch ( $job->post_status ) :
			case 'publish' :


				if(!empty($privatpost)){
					//denne er til en spesiell artist
					$user_info = get_userdata($privatpost);

					$underholderEpost = $user_info->user_email;
					$underHoldrnavn = $user_info->display_name;
					echo ('<h1>Oppdraget er registrert</h1><p>Takk for at du valgte Rêvent. '.$underHoldrnavn.' vil nå få muligheten til å komme med sitt tilbud på oppdraget, og du står helt fritt til å godta tilbudet fra underholderen/artisten. For å vise oppdraget du postet vennligst gå til din  <a href="//revent.no/oppdragsoversikt/">oppdragsoversikt</a>.</p>');


				}else if(empty($privatpost)){
					//echo'<h1>Denne er for alle sammen, gogogogo </h1>';
					echo ('<h1>Oppdraget er registrert</h1><p>Takk for at du valgte Rêvent. Artister og underholdere vil nå få muligheten til å komme med sine tilbud på oppdraget, og du står helt fritt til å velge blant tilbudene som kommer inn. For å vise oppdraget du postet vennligst gå til din  <a href="//revent.no/oppdragsoversikt/">oppdragsoversikt</a>.</p>');


				}


				break;
			case 'pending' :
				printf( __( '%s submitted successfully. Your listing will be visible once approved.', 'wp-job-manager' ), $wp_post_types['job_listing']->labels->singular_name, get_permalink( $job->ID ) );
				break;
			default :
				do_action( 'job_manager_job_submitted_content_' . str_replace( '-', '_', sanitize_title( $job->post_status ) ), $job );
				break;
		endswitch;
		?>

	</div>


<?php
$user_ID = get_current_user_id();
$navn = $kontaktpersonen;
update_user_meta($user_ID, 'first_name', $navn);
$kontaktpersonen = get_post_meta( $job->ID, '_kontaktperson', true );

//echo 'kontaktperson' .  $kontaktpersonen;

do_action( 'job_manager_job_submitted_content_after', sanitize_title( $job->post_status ), $job );




/*echo'<p class="form-username">
        <label for="first-name"><?php _e('First Name', 'profile'); ?></label>
<input class="text-input" name="first-name" type="text" id="first-name" value="<?php the_author_meta( 'first_name', $current_user->ID ); ?>" />
</p><!-- .form-username -->';
*/

/*Lagre brukernavn*/



if(!empty($privatpost)){
	//denne er til en spesiell artist

	$melding = "Hei " .$underHoldrnavn."!
	Du har mottatt en personlig foresp&oslash;rsel.
	  Logg deg inn på www.revent.no for &aring; se foresp&oslash;rselen

	  Med vennlig hilsen Rêvent" ;

	wp_mail($underholderEpost, 'Personlig forespørsel på Rêvent', $melding);


	/*Mailscrip ferdig*/


}else if(empty($privatpost)){
	//echo'<h1>Denne er for alle sammen, gogogogo </h1>';
}
