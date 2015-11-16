<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *Template Name: pageLoggInn
 * @package vantage
 * @since vantage 1.0
 * @license GPL 2.0
 */


get_header(); ?>

<div id="primary" class="content-area">
    <div id="content" class="site-content" role="main">


        <?php /*Redirecter hvis brukeren er loggett inn

        */

        if (is_user_logged_in() ) {
        wp_redirect(home_url()); exit;
        }
        ?>

 <section class="aa_loginForm">

        <?php global $user_login;
        if(isset($_GET['login']) && $_GET['login'] == 'failed')
        {
            ?>
              <div class="aa_error">
                <p>Feil: ´Prøv igjen!</p>
              </div>
            <?php
        }
            if (is_user_logged_in()) {
                echo '<div class="aa_logout"> Hei, <div class="aa_logout_user">', $user_login, '.</div><!--<a id="wp-submit" href="',/* wp_logout_url(), */ '" title="Logout">Logg ut</a>--></div>';
            } else {
                echo'<div id="logginnBeskrivelse"><h1>Vennligst logg inn </h1>';
                echo'<p>For å logge inn må du ha opprettet profil eller være eksisterende kunde. <a href="http://revent.no/foresporsel/" alt="Bli kunde norges største utvalg av live underholdning">Send forespørsel</a> for å bli kunde.<p></div>';
                 wp_login_form($args);
                      $args = array(
                                'echo'           => true,
                                'redirect'       => home_url('/wp-admin/'), 
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
            }
        ?>
     <a id="glemtPassordLink" href="http://revent.no/glemt-passord" title="Hittegodskontor for passord">Mistet passordet ditt?</a>
  </section>


    </div><!-- #content .site-content -->
</div><!-- #primary .content-area -->



<?php get_sidebar(); ?>
<?php get_footer(); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript">
$('#user_login').attr( 'placeholder', 'epostadresse' );
$('#user_pass').attr( 'placeholder', 'Passord' );
</script>





