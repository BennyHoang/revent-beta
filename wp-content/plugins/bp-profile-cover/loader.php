<?php
/*
Plugin Name: BP Profile Cover
Plugin URI: http://www.VibeThemes.com
Description: Add Profile covers to Member and Group PRofiles (BuddyPress 2.3+)
Version: 1.1
Requires at least: WP 3.8, BuddyPress 2.3
Tested up to: 2.0.1
License: GPLv2
Contributors:Mr.Vibe,vibethemes

Author URI: http://www.VibeThemes.com
Network: true
*/

/* Only load the component if BuddyPress is loaded and initialized. */
function bp_profile_cover_init() {
	// Because our loader file uses BP_Attachment API, it requires BP 2.3 or greater.
	if ( version_compare( BP_VERSION, '2.3', '>' ) ){
		require( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'includes/class.php' );
		require( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'includes/functions.php' );
		
	}
}
add_action( 'bp_include', 'bp_profile_cover_init' );