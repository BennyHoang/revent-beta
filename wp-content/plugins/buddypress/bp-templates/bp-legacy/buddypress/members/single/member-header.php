<?php

/**
 * BuddyPress - Users Header
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<!-- Inkludere Bootstrap -->

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<style>



	body.responsive.layout-full #page-wrapper .full-container,.layout-full #page-wrapper .full-container{
		max-width: 100%!important;

	}
	nav.site-navigation.main-navigation.primary{

		max-width: 960px !important;
		margin: auto;
	}

	.rtmedia-container ul.rtmedia-list li.rtmedia-list-item div.rtmedia-item-thumbnail {
		line-height: 150px;
		width: 80px;
		height: 80px;
	}
	.rtmedia-container .rtmedia-list .rtmedia-list-item {
		width: 78px;
	}
	li.rtmedia-list-item div.rtmedia-item-thumbnail img {
		max-width: 80px;
	}
	.rtmedia-container ul.rtmedia-list li.rtmedia-list-item div.rtmedia-item-thumbnail img{
		max-width:80px;
		border-radius:3px;
	}


	body.responsive.layout-full #page-wrapper .full-container{
		max-width: 100%!important;
	}
	#item-header-avatar, #item-header-content,#item-body{
		/*width:100%;
		margin-left:200px;
		margin-top:143px;*/
		margin:auto!important;
		max-width: 960px;
		position: relative;
	}
	#item-header-avatar img.avatar{
		width: 162px;
		height: 162px;
		border-radius: 3px;
		border:4px solid #FFF;
		-webkit-box-shadow: 0px 19px 12px -17px rgba(153,151,153,1);
		-moz-box-shadow: 0px 19px 12px -17px rgba(153,151,153,1);
		box-shadow: 0px 19px 12px -17px rgba(153,151,153,1);
	}
	#buddypress #item-nav{
		margin-top:-47px;
		-webkit-box-shadow: 0px -200px 300px -7px rgba(0,0,0,1);
		-moz-box-shadow: 0px -200px 300px -7px rgba(0,0,0,1);
		box-shadow: 0px -200px 300px -7px rgba(0,0,0,1);
	}
	.entry-content, #item-body{
		background-color:#f5f8fa;
	}
	#item-header-avatar{
		top:320px;
	}
	.rating-top {
		float: left;
		width: 372px;
		padding-bottom: 5px;
		position: relative;
		height: 25px;
		top: 350px;
		color:white;
	}

	#item-header-content{
		top:350px
	}
	#item-header-content h2{
		color:white;
		font-weight: bold;
		text-shadow: 0px 0px 3px rgba(0, 0, 0, 0.8);
	}

	#object-nav{
		max-width: 960px;
		margin: auto;
	}
	.bp-user #buddypress{
		padding:0px !important;
	}

	.field_omrade{
		width:100%;
	}

	.media-beskrivelse-wrap .media-field{
		background-color: white !important;
		padding: 20px !important;
		margin-left: 11px !important;
		border-radius: 3px !important;
		border: 1px solid #E1E8ED !important;
		margin-right:0px !important;
	}
	.media-beskrivelse-wrap .media-field:hover {
		background-color:#F5F8FA !important;
	}



	/*HIDDEN & RESETS*/
	#item-header-content{
		float: none !important;
	}
	#profilInformasjonsFelter .field_applemusic{
		display:none;
	}
	.generic-button{
		display:none;
	}

	.bp-user #buddypress #item-header{
		-webkit-background-size: cover !important;
		background-size: cover !important;
	}

	@media (max-width: 600px) {


		#item-header-content{
			top:315px;
			font-size: 150%;;
		}
		.rating-top {
			260px;
			font-size: 0px;
			width: 100px;
			float: right;
		}


	}
	@media (max-width: 450px) {



		.rating-top {
			top: 260px;
		}



	}

</style>
<?php

/**
 * Fires before the display of a member's header.
 *
 * @since BuddyPress (1.2.0)
 */
do_action( 'bp_before_member_header' ); ?>

<div id="item-header-avatar">
	<a href="<?php bp_displayed_user_link(); ?>">

		<?php bp_displayed_user_avatar( 'type=full' ); ?>

	</a>
</div><!-- #item-header-avatar -->

<div id="item-header-content">

	<?php
	$brukerID = bp_displayed_user_id();
	echo "<h2>" .bp_core_get_user_displayname($brukerID). "</h2>";


	?>

	<span class="activity"><?php bp_last_activity( bp_displayed_user_id() ); ?></span>

	<?php

	/**
	 * Fires before the display of the member's header meta.
	 *
	 * @since BuddyPress (1.2.0)
	 */
	do_action( 'bp_before_member_header_meta' ); ?>

	<div id="item-meta">

		<?php if ( bp_is_active( 'activity' ) ) : ?>

			<div id="latest-update">

				<?php bp_activity_latest_update( bp_displayed_user_id() ); ?>

			</div>

		<?php endif; ?>

		<div id="item-buttons">

			<?php

			/**
			 * Fires in the member header actions section.
			 *
			 * @since BuddyPress (1.2.6)
			 */
			do_action( 'bp_member_header_actions' ); ?>

		</div><!-- #item-buttons -->

		<?php

		 /**
		  * Fires after the group header actions section.
		  *
		  * If you'd like to show specific profile fields here use:
		  * bp_member_profile_data( 'field=About Me' ); -- Pass the name of the field
		  *
		  * @since BuddyPress (1.2.0)
		  */
		 do_action( 'bp_profile_header_meta' );

		 ?>

	</div><!-- #item-meta -->

</div><!-- #item-header-content -->

<?php

/**
 * Fires after the display of a member's header.
 *
 * @since BuddyPress (1.2.0)
 */
do_action( 'bp_after_member_header' ); ?>

<?php

/** This action is documented in bp-templates/bp-legacy/buddypress/activity/index.php */
do_action( 'template_notices' ); ?>


