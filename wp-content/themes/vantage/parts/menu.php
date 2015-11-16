<?php
/**
 * Part Name: Default Menu
 */

$ubermenu_active = function_exists( 'ubermenu' );
$nav_classes = array( 'site-navigation' );
if ( ! $ubermenu_active ) {
	$nav_classes[] = 'main-navigation';
}
$nav_classes[] = 'primary';

if ( siteorigin_setting( 'navigation_use_sticky_menu' ) ) {
	$nav_classes[] = 'use-sticky-menu';
}

if ( siteorigin_setting( 'navigation_mobile_navigation' ) ) {
	$nav_classes[] = 'mobile-navigation';
}
$logo_in_menu = siteorigin_setting( 'layout_masthead' ) == 'logo-in-menu';
?>

<nav role="navigation" class="<?php echo implode( ' ', $nav_classes) ?>">

	<div class="full-container">
		<?php if($logo_in_menu) : ?>
			<a href="https://www.revent.no" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" class="logo"><?php vantage_display_logo(); ?></a>
		<?php endif; ?>
		<?php if( siteorigin_setting('navigation_menu_search') ) : ?>
			<div id="search-icon">
				<div id="search-icon-icon"><div class="vantage-icon-search"></div></div>
				<?php get_search_form() ?>
			</div>
		<?php endif; ?>

		<?php if( $ubermenu_active ): ?>
			<?php ubermenu( 'main' , array( 'menu' => 2 ) ); ?>
		<?php else: ?>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'link_before' => '<span class="icon"></span>' ) ); ?>
		<?php endif; ?>
	</div>
</nav><!-- .site-navigation .main-navigation -->

<?php
if ( current_user_can( 'subscriber' ) ) {
	/*

    Gjemmer send forespørsel siden for artisten

    */
	echo '
<style>
#menu-item-547{
display:none;}
</style>';

}
/*
skal limes inn på register siden

if ( current_user_can( 'subscriber' ) ) {

	wp_redirect( 'http://revent.no/', 301 ); exit;
}
*/

?>