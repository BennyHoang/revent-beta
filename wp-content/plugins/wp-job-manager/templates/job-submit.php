<!-- Inkludere Bootstrap -->

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"
      xmlns="http://www.w3.org/1999/html">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<style>
    #main{
        background-image: url("//revent.no/wp-content/opplastninger/foresporsel.jpg");
        background-size:cover;
        -webkit-background-size:cover;
    }
    
    #masthead{
        display: none;
    }

    .btn-registration-wrap{
        margin-top:5%;
    }
    #progressbar{
        width: 99%;
        margin-bottom: 30px;
        margin-left: -1px;
        overflow: hidden;
        counter-reset: step;
    }
    .fieldset-job_type{
        display: none;
    }
</style>
<?php
/**
 * Job Submission Form
 */
if (!defined('ABSPATH')) exit;
global $job_manager;
?>


<?php /*I tilfelle en artist har lurt seg inn p� siden. :) */
if ( current_user_can( 'subscriber' ) ) {
    wp_redirect( 'http://revent.no/', 301 ); exit;
}
?>
<!-- Modal -->
<div id="myModal" class="modal" role="dialog">
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


<form id="msform" action="<?php echo esc_url($action); ?>" method="post" id="submit-job-form" class="job-manager-form"
      enctype="multipart/form-data">

    <ul id="progressbar">
        <li id="account-setup" class="active">LOGG INN</li>
        <li id="social-profile">FORESP&Oslash;RSEL</li>
        <li id="personal-details">KONTAKTINFO</li>
    </ul>

    <fieldset id="field1">
        <div class="row">

            <?php
            $direktetilartist = $_GET['direkte'];
            $direktetilartistID = $_GET['did'];

            if(!empty($direktetilartistID)){

                $direkteArtsitNavn = bp_core_get_user_displayname($direktetilartistID);
                echo'  <h1>Foresp&oslash;rsel direkte til '. $direkteArtsitNavn .'</h1>';
                echo '<span id="direktetilartistIDspan">'. $direktetilartistID.' </span>';

            }else{
                echo '<span id="direktetilartistIDspan"></span>';
            }
            ?>
 
            <div class=" col-xs-12 text-center">
                <?php if (apply_filters('submit_job_form_show_signin', true)) : ?>

                    <?php get_job_manager_template('account-signin.php'); ?>


                <?php endif; ?>
            </div>
        </div>

        <?php if (job_manager_user_can_post_job()) : ?>

        <div class="col-xs-12 text-center">
            <input type="button" name="next" id="next_to_field2" class="next action-button" value="NESTE"/>
        </div>
    </fieldset>

    <fieldset id="field2">
        <!-- Job Information Fields -->
        <?php do_action('submit_job_form_job_fields_start'); ?>

        <?php foreach ($job_fields as $key => $field) : ?>
            <div class="fieldset-<?php esc_attr_e($key); ?>">
                <div class="row job-information">
                    <div class="col-md-3 label-col">
                        <label class="job-form-label"
                               for="<?php esc_attr_e($key); ?>"><?php echo $field['label'] . apply_filters('submit_job_form_required_label', $field['required'] ? '' : ' <small>' . __('(optional)', 'wp-job-manager') . '</small>', $field); ?></label>
                    </div>
                    <div class="col-md-9">
                        <div class="field <?php echo $field['required'] ? 'required-field' : ''; ?>">
                            <?php get_job_manager_template('form-fields/' . $field['type'] . '-field.php', array('key' => $key, 'field' => $field)); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <?php do_action('submit_job_form_job_fields_end'); ?>
        <div class="btn-registration-wrap col-xs-12 text-center">
            <input type="button" id="previous_to_field1" name="previous" class="previous action-button"
                   value="TILBAKE"/>

            <input class="next action-button" type="button" name="signup_submit"
                   id="signup_submit"
                   value="NESTE"/>
        </div>
    </fieldset>

    <fieldset id="field3">
        <!-- Company Information Fields -->
        <?php if ($company_fields) : ?>
            <h2 id="detaljerLittmerinfo"><?php _e('Company Details', 'wp-job-manager'); ?></h2>

            <?php do_action('submit_job_form_company_fields_start'); ?>

            <?php foreach ($company_fields as $key => $field) : ?>
                <div class="fieldset-<?php esc_attr_e($key); ?>">
                    <div class="col-md-3 label-col">
                        <label class="job-form-label"
                               for="<?php esc_attr_e($key); ?>"><?php echo $field['label'] . apply_filters('submit_job_form_required_label', $field['required'] ? '' : ' <small>' . __('(optional)', 'wp-job-manager') . '</small>', $field); ?></label>
                    </div>
                    <div class="col-md-9">
                        <div class="field <?php echo $field['required'] ? 'required-field' : ''; ?>">
                            <?php get_job_manager_template('form-fields/' . $field['type'] . '-field.php', array('key' => $key, 'field' => $field)); ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <?php do_action('submit_job_form_company_fields_end'); ?>
        <?php endif; ?>
        <div class="btn-registration-wrap col-xs-12 text-center">
            <input type="hidden" name="job_manager_form" value="<?php echo $form; ?>"/>
            <input type="hidden" name="job_id" value="<?php echo esc_attr($job_id); ?>"/>
            <input type="hidden" name="step" value="<?php echo esc_attr($step); ?>"/>
            <input type="button" id="previous_to_field2" name="previous" class="previous action-button"
                   value="TILBAKE"/>
            <input type="submit" name="submit_job" class="previous action-button action-submit"
                   value="FORH&Aring;NDSVIS"/>

        </div>
    </fieldset>
    <?php else : ?>

        <?php do_action('submit_job_form_disabled'); ?>

    <?php endif; ?>
</form>


<script src="jquery-1.11.3.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        //you can now use $ as your jQuery object.
        $(function () {
            //$("input[name='job_title']").addClass('form-control');
            $(".antalltimerslider").slider({
                range: "min",
                value: 1,
                step: 1,
                min: 0,
                max: 24,
                slide: function (event, ui) {
                    $("#anntalltimer").val(ui.value);
                }
            });
        });
        var body = $('body');
    });
</script>

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
                $("#social-profile").addClass("active");
                var valtArtistId = $('#direktetilartistIDspan').text();
                $('#direkte_artist').val(valtArtistId);
                $(navarendeField).fadeOut(1000).hide();
                $("#field2").fadeIn(1000).show();
            });
            $("body").on('click', '#previous_to_field1', function () {
                var navarendeField = "#field2"
                $("#social-profile").removeClass("active");
                $(navarendeField).fadeOut(1000).hide();
                $("#field1").fadeIn(1000).show();
            });
            $("body").on('click', '#previous_to_field2', function () {
                var navarendeField = "#field3"
                $("#personal-details").removeClass("active");
                $(navarendeField).fadeOut(1000).hide();
                $("#field2").fadeIn(1000).show();
            });
            $("body").on('click', '#signup_submit', function () {
                var navarendeField = "#field2";
                $("#personal-details").addClass("active");
                $("#social-profile").addClass("active");
                $(navarendeField).fadeOut(1000).hide();
                $("#field3").fadeIn(1000).show();
                /*aktiveres n�r man trykker neste*/
                if($('#kundemailkonto .field input').length){
                    var kundeepostadresse = $('.field #application').val();
                    $('#kundemailkonto .field input').val(kundeepostadresse);
                }
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