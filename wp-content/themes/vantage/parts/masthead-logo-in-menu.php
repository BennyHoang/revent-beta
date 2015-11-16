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