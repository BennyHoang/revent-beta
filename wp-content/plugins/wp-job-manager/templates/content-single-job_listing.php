<style>
    .entry-title, li.location, li.date-posted {
        display: none;
    }
    #main{
        background:#F5F8FA;
    }

    .single_job_listing .meta{
        background: none;
    }
    .entry-content h2 {
        margin-top: 20px;
        margin-bottom: 20px;
        font-size: 28px;
    }

    .job-listing-cover-image {
        width: 100%;
        height: 300px;
        background-size: cover;

    }


    .job-manager-single-alert-link{
        display: none;
    }

    .company{
        width: 200px;
    }

</style>

<?php global $post; ?>
<?php
$jobTittel = esc_attr($post->post_title);

//sjekke ut hva slags event dette er og bytte bakgrundsbilde

/*

Skal fikses :D

*/
$bryllup = 'Bryllup';


$bakgrunnsLink = "";//"http://www.revent.no/wp-content/opplastninger/Konsert_Livlig_Live_underholdning_fest_Event_bryllup_norskmusikk.png_fest-1080x600.jpg";

$tittelSomSkalSjekkes = strtolower(trim($jobTittel));

$BryllupUrl = "//revent.no/wp-content/opplastninger/wideLive-musikk-til-bryllup-fest-svart-copy.jpg";
$festUrl = "//revent.no/wp-content/opplastninger/Wide_Livlig_Live_underholdning_fest_Event_bryllup_norskmusikk.png_fest1.jpg";
$nyttar = "http://www.thehoundhaus.com/wp-content/uploads/2015/09/fireworks2.jpg";
$jul = "http://zontadistrict24.org/wp-content/uploads/2015/08/christmas-party1.jpg";
$annetUrl = "//revent.no/wp-content/opplastninger/wideLive-underholdning-til-event-arrangement-utested-konsert-copy-copy.jpg";


$defualtBilde = $annetUrl;

$ordSomSkaSjekkes = array(
    array("Bryllup",$BryllupUrl),
    array("Jul",$jul),
    array("Nyttår",$nyttar),
    array("Fest",$festUrl),
    array("annet",$annetUrl)
);

$antallBilder = count($ordSomSkaSjekkes);

for($i = 0;$i <= $antallBilder;$i++){
    $navarendeOrd = $ordSomSkaSjekkes[$i][0];

    if (strpos(strtolower(trim($tittelSomSkalSjekkes)), strtolower(trim($navarendeOrd))) !== false) {
        $bakgrunnsLink = $ordSomSkaSjekkes[$i][1];
        break;
    }else{
        $bakgrunnsLink = $defualtBilde;
    }

}




/*

if(strtolower(trim($jobTittel)) === strtolower(trim($bryllup))){
    $bakgrunnsLink = '"http://i.huffpost.com/gen/1948778/images/o-WEDDING-facebook.jpg"' ;
   // echo "bilde er bryllup";
}else{
    //echo 'bakgrunn ikke satt';
}
*/


?>
<style>
    .job-listing-cover-image {

        background-image: url(<?php echo $bakgrunnsLink; ?>);
    }

</style>




<div class="single_job_listing" itemscope itemtype="http://schema.org/JobPosting">


    <div class="job-listing-cover-image">


        <?php
        /**
         * single_job_listing_start hook
         *
         * @hooked job_listing_meta_display - 20
         * @hooked job_listing_company_display - 30
         */
        do_action('single_job_listing_start');

        ?>
        <?php if (get_option('job_manager_hide_expired_content', 1) && 'expired' === $post->post_status) : ?>
            <div class="job-manager-info"><?php _e('This listing has expired.', 'wp-job-manager'); ?></div>
        <?php else : ?>
    </div>




    <meta itemprop="title" content="<?php echo $jobTittel;  ?>"/>
    <h2><?php the_title(); ?></h2>



    <?php $object_terms = wp_get_object_terms( $post->ID,'job_listing_category', array( 'fields' => 'names' ) );
    if ( $object_terms ) { ?>

        <?php echo "<p id='kategoriSingleJobListing'>Ser etter: ".implode( '/', $object_terms ); ?><?php } ?> </p>

    <?php  $spilletimer = get_post_meta( $post->ID, '_anntalltimer', true );

    if ( $spilletimer ) {
        echo '<span id="kategoriSingleJobListing">' . 'Antall spilletimer: ' . esc_html( $spilletimer ) . '</span>';
    } ?>

    <?php


    $adresse = get_post_meta( $post->ID, '_job_location', true );

    if ( $adresse ) {
        echo '<p id="addresseSingleJobListing">' . __( 'Adresse: ' ) . esc_html( $adresse ) . '</p>';
    }

    ?>







    <div class="location">


        <?php $lokasjonOmrade = get_the_job_location(false);
        echo strip_tags($lokasjonOmrade);

        ?>,
        <?php

        //jeg m� sjekke n�r datoen er og om artisten skal jobbe over flere dager


        $datostreng = "ikke satt";
        $datostart = get_post_meta($post->ID, '_jobbdatostart', true);
        $datoslutt = get_post_meta($post->ID, '_datoslutt ', true);

        //BLIR EN FEIL P� NOEN POSTER S� KOMMENTERT UT INNTIL VIDERE
        /*
        $datoFraDb = strtotime($datostart);
        $datostart = date('d/m/Y', $datoFraDb);
        */
        if ($datoslutt) {
            //Dersom en sluttdato er satt s� gj�r jeg om den datoen til bedre format
            /*	$datoFraDbslutt = strtotime($datoslutt);
                $datoslutt = date('d/m/Y', $datoFraDbslutt);*/
            $datostreng = esc_attr($datostart) . ' til ' . esc_attr($datoslutt);
        } else {
            //m� sjekke kontaktperson siden dette ikke er bedrift
            $datostreng = esc_attr($datostart);
        }

        //$datostreng2 = $datostreng->format('d/m/Y');
        echo($datostreng);

        ?>
    </div>


    <div class="job_description" itemprop="description">

        <!-- Her kommer job_category -->
        <?php echo apply_filters('the_job_description', get_the_content()); ?>


        <?php  $makspris = get_post_meta( $post->ID, '__maksbudsjett', true );

        if ( $makspris ) {
            echo '<span id="prisSingleJobListing">' . '<b>Makspris</b> ' . esc_html( $makspris ) . 'kr</span>';
        } ?>
    </div>

    <?php if (candidates_can_apply()) : ?>
        <?php get_job_manager_template('job-application.php'); ?>
    <?php endif; ?>

    <?php
    /**
     * single_job_listing_end hook
     */
    do_action('single_job_listing_end');
    ?>

    <?php endif; ?>

    <?php
    //Ordne s� kun artister, og personen som algde oppdraget skal kunne se oppdraget
    $current_user = wp_get_current_user();
    $navarendeBruker = $current_user->ID;
    $oppdragsLager = $post->post_author;

    echo 'artistid'. $oppdragsLager;

    //echo('sjekk av brukertype, brukerid' . $navarendeBruker . ' dette oppdraget er laget av' . $oppdragsLager);
    if (user_can($navarendeBruker, "subscriber")) {
        //echo 'Brukeren er artist';

    }  else {
        //Hvis brukeren ikke er artist m� det sjekkes om det er han som lagde oppdraget, eller om det er en admin
        if (user_can($navarendeBruker, "administrator")) {
            echo('Som administrator kan du forh&aring;ndsvise denne siden');
        } else if ($navarendeBruker === $oppdragsLager) {
            	echo("ditt oppdrag, du kan forh�ndsvise dette oppdraget");
        } else {
            echo 'brukeren er ikke artist';
            if(is_user_logged_in()){
                echo 'ikke autorisert, forvises bort';
               // wp_redirect('//revent.no/');
                exit;
            }else{

            }

        }
    }


    ?>


</div>

