<?php
/**
 * Part Name: Logo In Menu
 */
?>

<?php

$oppdragIdArray = array();



?>


<?php

//brukernavn i menyen

if(is_user_logged_in())
{
	$user=wp_get_current_user();
	$name=$user->user_firstname;

	if($name != ''){
		$navnstreng = 'Hei, ' .  $name.'.';

	}
}else{
	$navnstreng="";

}


?>
<!--
<div id="topBarmin">
<span id="topnbarBrker"><?php //echo $navnstreng; ?></span>
<span id="topCatioonTekst">NORGES STØRSTE UTVALG AV LIVE UNDERHOLDNING</span>
<a href="https://www.facebook.com/Livemusictoparty?fref=ts" alt="revent på facebook"><img id="topbarBilde" src="<?php //bloginfo('template_directory'); ?>/facebook.png" alt="Revent på facebook"/></a>
</div> -->
<header id="masthead" class="site-header masthead-logo-in-menu" role="banner">

	<?php get_template_part( 'parts/menu', apply_filters( 'vantage_menu_type', siteorigin_setting( 'layout_menu' ) ) ); ?>
	<!--<span id="shiftnav-toggle-main-button" class="shiftnav-toggle shiftnav-toggle-shiftnav-main shiftnav-toggle-burger" data-shiftnav-target="shiftnav-main"><i class="fa fa-bars"></i></span>-->
	<span id="shiftnav-toggle-main-button" class="shiftnav-toggle shiftnav-toggle-shiftnav-main shiftnav-toggle-burger" data-shiftnav-target="shiftnav-main"><i class="fa fa-bars"></i></span>
</header><!-- #masthead .site-header -->
<!-- Inkludere Bootstrap -->

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"
	  xmlns="http://www.w3.org/1999/html">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<!-- Modal -->
<div id="logginnmodal" class="modal" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<p><section class="aa_loginForm">

						<?php global $user_login;
						echo'<div id="logginnBeskrivelse"><h1>Vennligst logg inn </h1>';
						wp_login_form($args);
						$args = array(
								'echo'           => true,
								'form_id'        => 'loginform',
								'label_username' => __( '' ),
								'label_password' => __( '' ),
								'label_remember' => __( 'Remember Me' ),
								'label_log_in'   => __( 'Log In' ),
								'id_username'    => 'user_login',
								'id_password'    => 'user_pass',
								'id_remember'    => 'rememberme',
								'id_submit'      => 'wp-submit',
								'remember'       => true,
								'value_username' => NULL,
								'value_remember' => true
						);
						?>
						<a id="glemtPassordLink" href="http://revent.no/glemt-passord" title="Hittegodskontor for passord">Mistet passordet ditt?</a>
					</section>
				</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Avbryt</button>
			</div>
		</div>

	</div>
</div>



