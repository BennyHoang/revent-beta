<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *Template Name: glemtPassord
 * @package vantage
 * @since vantage 1.0
 * @license GPL 2.0
 */


get_header(); ?>

    <div id="primary" class="content-area">
        <div id="content" class="site-content" role="main">

         <?php
         global $wpdb;

            $error = '';
            $success = '';

            // check if we're in reset form
            if( isset( $_POST['action'] ) && 'reset' == $_POST['action'] )
            {
            $email = trim($_POST['user_login']);

            if( empty( $email ) ) {
            $error = 'Skriv inn en epostadresse';
            } else if( ! is_email( $email )) {
            $error = 'Ugyldig epostadresse';
            } else if( ! email_exists($email) ) {
            $error = 'Det er ingen brukere med den adressen registrert. ';
            } else {

            // lets generate our new password
            $random_password = wp_generate_password( 12, false );

            // Get user data by field and data, other field are ID, slug, slug and login
            $user = get_user_by( 'email', $email );

            $update_user = wp_update_user( array (
            'ID' => $user->ID,
            'user_pass' => $random_password
            )
            );

            // if  update user return true then lets send user an email containing the new password
            if( $update_user ) {
            $to = $email;
            $subject = 'Ditt nye passord hos RÊVENT';
            $sender = get_option('name');

            $message = 'Ditt nye passord er: '.$random_password;

            $headers[] = 'MIME-Version: 1.0' . "\r\n";
            $headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers[] = "X-Mailer: PHP \r\n";
            $headers[] = 'From: '.$sender.' < '.$email.'>' . "\r\n";

            $mail = wp_mail( $to, $subject, $message, $headers );
            if( $mail )
            $success = 'Mail er sendt.';

            } else {
            $error = 'Noe gikk galt..';
            }

            }

            if( ! empty( $error ) )
            echo '<div class="error_login"><strong>ERROR:</strong> '. $error .'</div>';

            if( ! empty( $success ) )
            echo '<div class="updated"> '. $success .'</div>';
            }
           ?>

    <form method="post">
        <fieldset>
            <p>Skriv inn epostadressen du registrerte deg med. Deretter vil du motta nytt passord p&aring;  epost. </p>
            <p><label for="user_login">Epostadresse:</label>
                <?php $user_login = isset( $_POST['user_login'] ) ? $_POST['user_login'] : ''; ?>
                <input type="text" name="user_login" id="user_login"  value="<?php echo $user_login; ?>" /></p>
            <p>
                <input type="hidden" name="action" value="reset" />
                <input type="submit" value="F&aring; nytt passord" class="button" id="submit" />
            </p>
        </fieldset>
    </form>



    </div><!-- #content .site-content -->
</div><!-- #primary .content-area -->



<?php get_sidebar(); ?>
<?php get_footer(); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript">
    $('#user_login').attr( 'placeholder', 'dinmail@eksempel.no' );
$('#user_pass').attr( 'placeholder', 'Passord' );
</script>





