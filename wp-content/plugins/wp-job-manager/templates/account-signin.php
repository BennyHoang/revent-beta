<?php if (is_user_logged_in()) : ?>

    <div>
        <div class="field account-sign-in col-xs-12">
            <div clasS="col-xs-12">
                <h2>
                    <?php
                    $user = wp_get_current_user();
                    $kundeSittNavn = $user->first_name;

                    if(empty($kundeSittNavn)){
                        $kundeSittNavn = $user->display_name;
                    }

                    printf(__('Velkommen! <strong>%s</strong>.'), $kundeSittNavn);
                    ?>
                </h2>
            </div>
        </div>
    </div>

<?php else :

    $account_required = job_manager_user_requires_account();
    $registration_enabled = job_manager_enable_registration();
    $generate_username_from_email = job_manager_generate_username_from_email();
    ?>
    <div>


        <div class="text-center">
            <p>Eksisterende kunde?</p>
        </div>
        <!-- Trigger the modal with a button -->
        <button type="button" class="btn action-button" data-toggle="modal" data-target="#myModal">LOGG INN</button>


        <?php
        if (is_user_logged_in()) {
            echo 'Welcome, registered user!';
        } else {
            echo '
                <div class="text-center">
                 <p>Ny kunde?</p>
                 </div>
                ';
        }
        ?>

        <div class="field account-sign-in">
            <!-- <a class="button" href="http://revent.no/logg-inn/"><?php // _e('Sign in', 'wp-job-manager');
            ?></a> -->


            <?php if ($registration_enabled) : ?>

                <?php //printf(__('If you don&rsquo;t have an account you can %screate one below by entering your email address/username. A password will be automatically emailed to you.', 'wp-job-manager'), $account_required ? '' : __('optionally', 'wp-job-manager') . ' '); ?>


            <?php elseif ($account_required) : ?>

                <?php echo apply_filters('submit_job_form_login_required_message', __('You must sign in to create a new listing.', 'wp-job-manager')); ?>

            <?php endif; ?>
        </div>
    </div>
    <?php if ($registration_enabled) : ?>
    <?php if (!$generate_username_from_email) : ?>
        <div>
            <label><?php _e('Username', 'wp-job-manager'); ?><?php echo apply_filters('submit_job_form_required_label', (!$account_required) ? ' <small>' . __('(optional)', 'wp-job-manager') . '</small>' : ''); ?></label>

            <div class="field">
                <input type="text" class="input-text" name="create_account_username" id="account_username"
                       value="<?php if (!empty($_POST['create_account_username'])) echo sanitize_text_field(stripslashes($_POST['create_account_username'])); ?>"/>
            </div>
        </div>
    <?php endif; ?>
    <div id="kundemailkonto">
        <label><?php _e('Your email', 'wp-job-manager'); ?><?php echo apply_filters('submit_job_form_required_label', (!$account_required) ? ' <small>' . __('(optional)', 'wp-job-manager') . '</small>' : ''); ?></label>

        <div class="field">
            <input type="email" class="input-text" name="create_account_email" id="account_email"
                   placeholder="<?php esc_attr_e('you@yourdomain.com', 'wp-job-manager'); ?>"
                   value="<?php if (!empty($_POST['create_account_email'])) echo sanitize_text_field(stripslashes($_POST['create_account_email'])); ?>"/>
        </div>


    </div>


    <?php do_action('job_manager_register_form'); ?>
<?php endif; ?>

<?php endif; ?>



