<h4><?php _e( 'Endre profilbilde.', 'buddypress' ); ?></h4>

<?php

/**
 * Fires before the display of profile avatar upload content.
 *
 * @since BuddyPress (1.1.0)
 */
do_action( 'bp_before_profile_avatar_upload_content' ); ?>

<?php if ( !(int)bp_get_option( 'bp-disable-avatar-uploads' ) ) : ?>

	<p><?php echo' Profilbilde vil v&aelig;re synlig for alle som bes&oslash;ker nettsiden. '; ?></p>

	<form action="" method="post" id="avatar-upload-form" class="standard-form" enctype="multipart/form-data">

		<?php if ( 'upload-image' == bp_get_avatar_admin_step() ) : ?>

			<?php wp_nonce_field( 'bp_avatar_upload' ); ?>
			<p><?php echo( 'Klikk nedenfor for &aring; laste opp et bilde i .jpg eller .png format ' ); ?></p>

			<p id="avatar-upload">
				<input type="file" name="file" id="file" />
				<input type="submit" name="upload" id="upload" value="<?php esc_attr_e( 'Last opp', 'buddypress' ); ?>" />
				<input type="hidden" name="action" id="action" value="bp_avatar_upload" />
			</p>

			<?php if ( bp_get_user_has_avatar() ) : ?>
				<p><?php echo "&Oslash;nsker du &aring; slette profilbildet uten &aring; laste opp et nytt? Klikk p&aring; slett knappen nedefor."; ?></p>
				<p><a class="button edit" href="<?php bp_avatar_delete_link(); ?>" title="<?php echo'Slett'; ?>"><?php echo 'Slett mitt profilbilde'; ?></a></p>
			<?php endif; ?>

		<?php endif; ?>

		<?php if ( 'crop-image' == bp_get_avatar_admin_step() ) : ?>

			<h5><?php _e( 'Tilpass bilde', 'buddypress' ); ?></h5>

			<img src="<?php bp_avatar_to_crop(); ?>" id="avatar-to-crop" class="avatar" alt="<?php esc_attr_e( 'Bilde &aring; tilpasse', 'buddypress' ); ?>" />

			<div id="avatar-crop-pane">
				<img src="<?php bp_avatar_to_crop(); ?>" id="avatar-crop-preview" class="avatar" alt="<?php esc_attr_e( 'Forh&aring;ndsvisning', 'buddypress' ); ?>" />
			</div>

			<input type="submit" name="avatar-crop-submit" id="avatar-crop-submit" value="<?php esc_attr_e( 'Tilpass bilde', 'buddypress' ); ?>" />

			<input type="hidden" name="image_src" id="image_src" value="<?php bp_avatar_to_crop_src(); ?>" />
			<input type="hidden" id="x" name="x" />
			<input type="hidden" id="y" name="y" />
			<input type="hidden" id="w" name="w" />
			<input type="hidden" id="h" name="h" />

			<?php wp_nonce_field( 'bp_avatar_cropstore' ); ?>

		<?php endif; ?>

	</form>

	<?php
	/**
	 * Load the Avatar UI templates
	 *
	 * @since  BuddyPress (2.3.0)
	 */
	bp_avatar_get_templates(); ?>

<?php else : ?>

	<p><?php //_e( 'Your profile photo will be used on your profile and throughout the site. To change your profile photo, please create an account with <a href="http://gravatar.com">Gravatar</a> using the same email address as you used to register with this site.', 'buddypress' ); ?></p>

<?php endif; ?>

<?php

/**
 * Fires after the display of profile avatar upload content.
 *
 * @since BuddyPress (1.1.0)
 */
do_action( 'bp_after_profile_avatar_upload_content' ); ?>
