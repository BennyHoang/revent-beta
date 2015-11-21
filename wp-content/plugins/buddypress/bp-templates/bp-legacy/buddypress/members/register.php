<style>

    #main {

        background-image: url("//revent.no/wp-content/opplastninger/foresporsel.jpg");

        -webkit-background-size: cover;

        backround-size: cover;

    }



    .field_kategori .checkbox label input, .field_kan-medbringe-eget-utstyr .checkbox label input {
        -webkit-appearance: radio !important;
        -moz-appearance: radio !important;
        -ms-appearance: radio !important;
    }


    .field_pris, .field_maks-antall-timer-pr-spillejobb, .field_spotify, .field_soundcloud, .field_apple-music, .field_kan-medbringe-eget-utstyr, .field_youtube {

        display: none;

    }

    .standard-form #basic-details-section #pass-strength-result {

        width: 36%;

        margin-left: 233px;

    }

    .standard-form label {

        padding-left: 0 !important;

        font-size: 20px !important;

    }

    #field_1, #field_2 {

        width: 100% !important;

    }

    .error {

        color: #f04040 !important;

    }

    .confirm-wrapper {

        margin-left: 15%;

        margin-top: 4%;

    }


</style>


<div id="buddypress">


    <?php



    /**
     * Fires at the top of the BuddyPress member registration page template.
     *
     * @since BuddyPress (1.1.0)
     */

    do_action('bp_before_register_page'); ?>


    <!-- Inkludere Bootstrap -->


    <!-- Latest compiled and minified CSS -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">


    <!-- Optional theme -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">


    <!-- Latest compiled and minified JavaScript -->

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


    <div class="page" id="register-page">


        <form id="msform" action="" name="signup_form" id="signup_form" class="standard-form" method="post"

              enctype="multipart/form-data">

            <ul id="progressbar">

                <li id="account-setup" class="active">Opprett profil</li>

                <li id="social-profile">Detaljer</li>

                <li id="personal-details">Bekreft epost</li>

            </ul>

            <!--

            <fieldset>

                test 1



                <input type="button" name="next" class="next action-button" value="Next"/>

            </fieldset>

            <fieldset>

                 test 2

                <input type="button" name="previous" class="previous action-button" value="Previous"/>

                <input type="button" name="next" class="next action-button" value="Next"/>

            </fieldset>

            <fieldset>

                test 3

                <input type="button" name="previous" class="previous action-button" value="Previous"/>

                <div class="submit">

                    <input type="submit" name="signup_submit" id="signup_submit"

                           "/>

                </div>

            </fieldset>

-->

            <fieldset id="field1">

                <?php if ('registration-disabled' == bp_get_current_signup_step()) : ?>

                    <?php


                    /** This action is documented in bp-templates/bp-legacy/buddypress/activity/index.php */

                    do_action('template_notices'); ?>

                    <?php


                    /**
                     * Fires before the display of the registration disabled message.
                     *
                     * @since BuddyPress (1.5.0)
                     */

                    do_action('bp_before_registration_disabled'); ?>


                    <p><?php _e('User registration is currently not allowed.', 'buddypress'); ?></p>


                    <?php


                    /**
                     * Fires after the display of the registration disabled message.
                     *
                     * @since BuddyPress (1.5.0)
                     */

                    do_action('bp_after_registration_disabled'); ?>

                <?php endif; // registration-disabled signup step ?>



                <?php if ('request-details' == bp_get_current_signup_step()) : ?>



                <?php


                /** This action is documented in bp-templates/bp-legacy/buddypress/activity/index.php */

                do_action('template_notices'); ?>


                <h3 class="text-center">Opprett Profil</h3>
                <hr>


                <?php


                /**
                 * Fires before the display of member registration account details fields.
                 *
                 * @since BuddyPress (1.1.0)
                 */

                do_action('bp_before_account_details_fields'); ?>


                <div class="register-section" id="basic-details-section">

                    <?php /***** Basic Account Details ******/ ?>


                    <label

                        for="signup_username"><?php _e('Username', 'buddypress'); ?></label>

                    <?php


                    /**
                     * Fires and displays any member registration username errors.
                     *
                     * @since BuddyPress (1.1.0)
                     */

                    //do_action('bp_signup_username_errors'); ?>

                    <input type="text" name="signup_username" id="signup_username"

                           value="<?php bp_signup_username_value(); ?>" <?php bp_form_field_attributes('username'); ?>/>


                    <label

                        for="signup_email"><?php _e('Email Address', 'buddypress'); ?></label>

                    <?php


                    /**
                     * Fires and displays any member registration email errors.
                     *
                     * @since BuddyPress (1.1.0)
                     */

                    do_action('bp_signup_email_errors'); ?>

                    <input type="email" name="signup_email" id="signup_email"

                           value="<?php bp_signup_email_value(); ?>" <?php bp_form_field_attributes('email'); ?>/>

                  <label for="phone">Telefon </label>
                    <input type="text" name="phone" id="phone" value="" class="regular-text" />

                    <label

                        for="signup_password"><?php _e('Choose a Password', 'buddypress'); ?></label>

                    <?php


                    /**
                     * Fires and displays any member registration password errors.
                     *
                     * @since BuddyPress (1.1.0)
                     */

                    do_action('bp_signup_password_errors'); ?>

                    <input type="password" name="signup_password" id="signup_password" value=""

                           class="password-entry" <?php bp_form_field_attributes('password'); ?>/>


                    <div id="pass-strength-result"></div>


                    <label

                        for="signup_password_confirm"><?php _e('Confirm Password', 'buddypress'); ?></label>

                    <?php


                    /**
                     * Fires and displays any member registration password confirmation errors.
                     *
                     * @since BuddyPress (1.1.0)
                     */

                    do_action('bp_signup_password_confirm_errors'); ?>

                    <input type="password" name="signup_password_confirm" id="signup_password_confirm" value=""

                           class="password-entry-confirm" <?php bp_form_field_attributes('password'); ?>/>



                    <?php


                    /**
                     * Fires and displays any extra member registration details fields.
                     *
                     * @since BuddyPress (1.9.0)
                     */

                    do_action('bp_account_details_fields'); ?>

                    <div class="btn-registration-wrap">

                        <input type="button" name="next" id="next_to_field2" class="next action-button" value="NESTE"/>

                    </div>


                </div>

                <div class="register-section" id="profile-details-section">


                    <!-- #basic-details-section -->

            </fieldset>

            <fieldset id="field2">
                <h3 class="text-center">Detaljer</h3>
                <hr>

                <?php


                /**
                 * Fires after the display of member registration account details fields.
                 *
                 * @since BuddyPress (1.1.0)
                 */

                do_action('bp_after_account_details_fields'); ?>



                <?php /***** Extra Profile Details ******/ ?>



                <?php if (bp_is_active('xprofile')) : ?>



                <?php


                /**
                 * Fires before the display of member registration xprofile fields.
                 *
                 * @since BuddyPress (1.2.4)
                 */

                do_action('bp_before_signup_profile_fields'); ?>



                <?php /* Use the profile field loop to render input fields for the 'base' profile field group */ ?>

                <?php if (bp_is_active('xprofile')) : if (bp_has_profile(array('profile_group_id' => 1, 'fetch_field_data' => false))) : while (bp_profile_groups()) : bp_the_profile_group(); ?>


                    <?php while (bp_profile_fields()) : bp_the_profile_field(); ?>


                        <div<?php bp_field_css_class('editfield'); ?>>


                            <?php

                            $field_type = bp_xprofile_create_field_type(bp_get_the_profile_field_type());

                            $field_type->edit_field_html();


                            /**
                             * Fires before the display of the visibility options for xprofile fields.
                             *
                             * @since BuddyPress (1.7.0)
                             */

                            do_action('bp_custom_profile_edit_fields_pre_visibility');


                            if (bp_current_user_can('bp_xprofile_change_field_visibility')) : ?>


                                <p class="field-visibility-settings-toggle"

                                   id="field-visibility-settings-toggle-<?php bp_the_profile_field_id() ?>">

                                    <?php printf(__('This field can be seen by: <span class="current-visibility-level">%s</span>', 'buddypress'), bp_get_the_profile_field_visibility_level_label()) ?>

                                    <a href="#"

                                       class="visibility-toggle-link"><?php _ex('Change', 'Change profile field visibility level', 'buddypress'); ?></a>

                                </p>


                                <div class="field-visibility-settings"

                                     id="field-visibility-settings-<?php bp_the_profile_field_id() ?>">

                                    <fieldset>

                                        <legend><?php _e('Who can see this field?', 'buddypress') ?></legend>


                                        <?php bp_profile_visibility_radio_buttons() ?>


                                    </fieldset>

                                    <a class="field-visibility-settings-close"

                                       href="#"><?php _e('Close', 'buddypress') ?></a>


                                </div>

                            <?php else : ?>

                                <p class="field-visibility-settings-notoggle"

                                   id="field-visibility-settings-toggle-<?php bp_the_profile_field_id() ?>">

                                    <?php printf(__('This field can be seen by: <span class="current-visibility-level">%s</span>', 'buddypress'), bp_get_the_profile_field_visibility_level_label()) ?>

                                </p>

                            <?php endif ?>



                            <?php


                            /**
                             * Fires after the display of the visibility options for xprofile fields.
                             *
                             * @since BuddyPress (1.1.0)
                             */

                            do_action('bp_custom_profile_edit_fields'); ?>


                            <p class="description"><?php bp_the_profile_field_description(); ?></p>


                        </div>


                    <?php endwhile; ?>


                    <div class="btn-registration-wrap">

                        <input type="hidden" name="signup_profile_field_ids" id="signup_profile_field_ids"

                               value="<?php bp_the_profile_field_ids(); ?>"/>

                        <input type="button" id="previous_to_field1" name="previous" class="previous action-button"

                               value="TILBAKE"/>


                        <input class="next action-button submit-action" type="submit" name="signup_submit"

                               id="signup_submit"

                               value="UTFØR REGISTRERING"/>

                    </div>

                <?php endwhile; endif; endif; ?>



                <?php


                /**
                 * Fires and displays any extra member registration xprofile fields.
                 *
                 * @since BuddyPress (1.9.0)
                 */

                do_action('bp_signup_profile_fields'); ?>


    </div>

    <!-- #profile-details-section -->


    <?php



    /**
     * Fires after the display of member registration xprofile fields.
     *
     * @since BuddyPress (1.1.0)
     */

    do_action('bp_after_signup_profile_fields'); ?>


    <?php endif; ?>


    <?php if (bp_get_blog_signup_allowed()) : ?>

    <fieldset>

        <?php


        /**
         * Fires before the display of member registration blog details fields.
         *
         * @since BuddyPress (1.1.0)
         */

        do_action('bp_before_blog_details_fields'); ?>



        <?php /***** Blog Creation Details ******/ ?>


        <div class="register-section" id="blog-details-section">


            <h4><?php _e('Blog Details', 'buddypress'); ?></h4>


            <p><input type="checkbox" name="signup_with_blog" id="signup_with_blog"

                      value="1"<?php if ((int)bp_get_signup_with_blog_value()) : ?> checked="checked"<?php endif; ?> /> <?php _e('Yes, I\'d like to create a new site', 'buddypress'); ?>

            </p>


            <div id="blog-details"

                 <?php if ((int)bp_get_signup_with_blog_value()) : ?>class="show"<?php endif; ?>>


                <label

                    for="signup_blog_url"><?php _e('Blog URL', 'buddypress'); ?></label>

                <?php


                /**
                 * Fires and displays any member registration blog URL errors.
                 *
                 * @since BuddyPress (1.1.0)
                 */

                do_action('bp_signup_blog_url_errors'); ?>



                <?php if (is_subdomain_install()) : ?>

                    http:// <input type="text" name="signup_blog_url" id="signup_blog_url"

                                   value="<?php bp_signup_blog_url_value(); ?>"/> .<?php bp_signup_subdomain_base(); ?>

                <?php else : ?>

                    <?php echo home_url('/'); ?> <input type="text" name="signup_blog_url"

                                                        id="signup_blog_url"

                                                        value="<?php bp_signup_blog_url_value(); ?>"/>

                <?php endif; ?>


                <label

                    for="signup_blog_title"><?php _e('Site Title', 'buddypress'); ?></label>

                <?php


                /**
                 * Fires and displays any member registration blog title errors.
                 *
                 * @since BuddyPress (1.1.0)
                 */

                do_action('bp_signup_blog_title_errors'); ?>

                <input type="text" name="signup_blog_title" id="signup_blog_title"

                       value="<?php bp_signup_blog_title_value(); ?>"/>



                            <span

                                class="label"><?php _e('I would like my site to appear in search engines, and in public listings around this network.', 'buddypress'); ?></span>

                <?php


                /**
                 * Fires and displays any member registration blog privacy errors.
                 *
                 * @since BuddyPress (1.1.0)
                 */

                do_action('bp_signup_blog_privacy_errors'); ?>


                <label><input type="radio" name="signup_blog_privacy" id="signup_blog_privacy_public"

                              value="public"<?php if ('public' == bp_get_signup_blog_privacy_value() || !bp_get_signup_blog_privacy_value()) : ?> checked="checked"<?php endif; ?> /> <?php _e('Yes', 'buddypress'); ?>

                </label>

                <label><input type="radio" name="signup_blog_privacy" id="signup_blog_privacy_private"

                              value="private"<?php if ('private' == bp_get_signup_blog_privacy_value()) : ?> checked="checked"<?php endif; ?> /> <?php _e('No', 'buddypress'); ?>

                </label>


                <?php


                /**
                 * Fires and displays any extra member registration blog details fields.
                 *
                 * @since BuddyPress (1.9.0)
                 */

                do_action('bp_blog_details_fields'); ?>


            </div>


        </div>

        <!-- #blog-details-section -->

    </fieldset>

    <fieldset id="field3">

        <?php


        /**
         * Fires after the display of member registration blog details fields.
         *
         * @since BuddyPress (1.1.0)
         */

        do_action('bp_after_blog_details_fields'); ?>



        <?php endif; ?>



        <?php


        /**
         * Fires before the display of the registration submit buttons.
         *
         * @since BuddyPress (1.1.0)
         */

        do_action('bp_before_registration_submit_buttons'); ?>







        <?php


        /**
         * Fires after the display of the registration submit buttons.
         *
         * @since BuddyPress (1.1.0)
         */

        do_action('bp_after_registration_submit_buttons'); ?>



        <?php wp_nonce_field('bp_new_signup'); ?>



        <?php endif; // request-details signup step ?>





        <?php if ('completed-confirmation' == bp_get_current_signup_step()) : ?>


            <?php


            /** This action is documented in bp-templates/bp-legacy/buddypress/activity/index.php */

            do_action('template_notices'); ?>

            <?php


            /**
             * Fires before the display of the registration confirmed messages.
             *
             * @since BuddyPress (1.5.0)
             */

            do_action('bp_before_registration_confirmed'); ?>


            <?php if (bp_registration_needs_activation()) : ?>

                <h2 class="text-center">

                    <i class="fa-4x fa fa-thumbs-o-up"></i>

                </h2>

                <div class="confirm-wrapper">

                    <p class="register-confirmed">

                        <i class="fa fa-check"></i>

                        N&aring;r du har opprettet profil vil du motta uforpliktende tilbud om oppdrag fra kunder

                    </p>


                    <p>

                        <i class="fa fa-check"></i>

                        R&#233;vent s&oslash;rger for at du mottar betaling for gjennomf&oslash;rte oppdrag</p>


                    <p>

                        <i class="fa fa-check"></i>

                        Skap din egen profil hos R&#233;vent og del den p&aring; sosiale medier</p>
                    <p>

                        <i class="fa fa-check"></i>

                        Bekreft link sendt på epost, og logg deg deretter inn med brukernavn og passord</p>
                </div>

            <?php else : ?>

                <p><?php _e('You have successfully created your account! Please log in using the username and password you have just created.', 'buddypress'); ?></p>

            <?php endif; ?>


            <?php


            /**
             * Fires after the display of the registration confirmed messages.
             *
             * @since BuddyPress (1.5.0)
             */

            do_action('bp_after_registration_confirmed'); ?>


        <?php endif; // completed-confirmation signup step ?>



        <?php


        /**
         * Fires and displays any custom signup steps.
         *
         * @since BuddyPress (1.1.0)
         */

        do_action('bp_custom_signup_steps'); ?>

    </fieldset>


    </form>


</div>


<?php


/**
 * Fires at the bottom of the BuddyPress member registration page template.
 *
 * @since BuddyPress (1.1.0)
 */

do_action('bp_after_register_page'); ?>


</div><!-- #buddypress -->


<!-- jQuery -->

<script src="http://thecodeplayer.com/uploads/js/jquery-1.9.1.min.js" type="text/javascript"></script>

<!-- jQuery easing plugin -->

<script src="http://thecodeplayer.com/uploads/js/jquery.easing.min.js" type="text/javascript"></script>

<script>

    $(function () {

        function settEvents() {

            //jQuery time

            //fieldsett id

            /*TIL BENNY!!! LA DENNE ST?, MEGET VIKTIG*/

            /*Denne er for ? ikke la brukeren sjekke flere en en checkbox*/

            $('.field_kategori .checkbox label input').on('change', function () {

                $('.field_kategori .checkbox label input').not(this).prop('checked', false);

            });

            $('.field_les-og-godta-vare-vilkar .checkbox label a').attr('target', '_blank');

            $('.field_navn input').attr("placeholder", "Navn, artistnavn, bandnavn");

            $('.field_beskrivelse textarea').attr("placeholder", "skriv litt om deg/dere");


            var field = 'field';

            var klikk = 1;


            $("body").on('click', '#next_to_field2', function () {

                var navarendeField = "#" + field + klikk;

                //alert('klikk');

                var next_fs = "#field" + klikk;

                //alert(field);


                /*Legge til epost som brukernavn*/




                $("#social-profile").addClass("active");



                $(navarendeField).fadeOut(1000).hide();

                $("#field2").fadeIn(2000).show();

            });

            $("body").on('click', '#previous_to_field1', function () {

                var navarendeField = "#field2"


                $("#social-profile").removeClass("active");

                $(navarendeField).fadeOut(1000).hide();

                $("#field1").fadeIn(2000).show();


            });

            $("body").on('click', '#signup_submit', function () {

                var navarendeField = "#field2";

                /*aktiveres n�r man trykker neste*/
                if($('.field_navn #field_1').length){

                    var tilfeldigTall = Math.floor(Math.random() * 99999) + 1;

                    var artistepostadresse = $('.field_navn #field_1').val();
                    artistepostadresse = artistepostadresse.replace(/[^a-zA-Z 0-9]+/g, '');
                    artistepostadresse = artistepostadresse.replace(/\s+/g, '');


                    $('#signup_username').val(tilfeldigTall+""+artistepostadresse);

                }
                $("#personal-details").addClass("active");

                $("#social-profile").addClass("active");

                $(navarendeField).fadeOut(1000).hide();

                $("#field3").fadeIn(2000).show();

            });

            if ($('.register-confirmed').length) {

                $("#personal-details").addClass("active");

                $("#social-profile").addClass("active");

            }

            ;

            /*







             var current_fs, next_fs, previous_fs; //fieldsets

             var left, opacity, scale; //fieldset properties which we will animate

             var animating; //flag to prevent quick multi-click glitches



             $(".next").click(function () {

             if (animating) return false;

             animating = true;



             current_fs = $(this).parent();

             next_fs = $(this).parent().next();



             //activate next step on progressbar using the index of next_fs

             $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");



             //show the next fieldset

             next_fs.show();

             //hide the current fieldset with style

             current_fs.animate({opacity: 0}, {

             step: function (now, mx) {

             //as the opacity of current_fs reduces to 0 - stored in "now"

             //1. scale current_fs down to 80%

             scale = 1 - (1 - now) * 0.2;

             //2. bring next_fs from the right(50%)

             left = (now * 50) + "%";

             //3. increase opacity of next_fs to 1 as it moves in

             opacity = 1 - now;

             current_fs.css({'transform': 'scale(' + scale + ')'});

             next_fs.css({'left': left, 'opacity': opacity});

             },

             duration: 800,

             complete: function () {

             current_fs.hide();

             animating = false;

             },

             //this comes from the custom easing plugin

             easing: 'easeInOutBack'

             });

             });



             */


            /*



             $(".previous").click(function () {

             if (animating) return false;

             animating = true;



             current_fs = $(this).parent();

             previous_fs = $(this).parent().prev();



             //de-activate current step on progressbar

             $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");



             //show the previous fieldset

             previous_fs.show();

             //hide the current fieldset with style

             current_fs.animate({opacity: 0}, {

             step: function (now, mx) {

             //as the opacity of current_fs reduces to 0 - stored in "now"

             //1. scale previous_fs from 80% to 100%

             scale = 0.8 + (1 - now) * 0.2;

             //2. take current_fs to the right(50%) - from 0%

             left = ((1 - now) * 50) + "%";

             //3. increase opacity of previous_fs to 1 as it moves in

             opacity = 1 - now;

             current_fs.css({'left': left});

             previous_fs.css({'transform': 'scale(' + scale + ')', 'opacity': opacity});

             },

             duration: 800,

             complete: function () {

             current_fs.hide();

             animating = false;

             },

             //this comes from the custom easing plugin

             easing: 'easeInOutBack'

             });

             });

             */

        }


        var init = function () {

            settEvents();

        }();


    });

</script>