<?php

/** This action is documented in bp-templates/bp-legacy/buddypress/members/single/profile/profile-wp.php */
do_action('bp_before_profile_loop_content'); ?>

<?php if (bp_has_profile()) : ?>


    <?php
    /*Dersom denne brukeren ikke er en subscriber så sendes han tilbake til medlemsoversikten, men som et lite easteregg kan admins lage profiler :D		*/
    $brukerID = bp_displayed_user_id();

    $navarendeBruker = $brukerID;
    if (!user_can($navarendeBruker, "subscriber")) {
        if (user_can($navarendeBruker, "administrator")) {
        } else {
            wp_redirect('http://revent.no/utvalg/');
            exit;

        }

    }

    ?>


    <?php while (bp_profile_groups()) : bp_the_profile_group(); ?>

        <?php if (bp_profile_group_has_fields()) : ?>

            <?php

            /** This action is documented in bp-templates/bp-legacy/buddypress/members/single/profile/profile-wp.php */
            do_action('bp_before_profile_field_content'); ?>


            <?php
            $profil = bp_get_displayed_user_username();
            $profilNavn = bp_get_displayed_user_fullname();
            $profilID = bp_displayed_user_id();

            ?>

            <div id="profilInformasjonsFelter" class="bp-widget <?php bp_the_profile_group_slug(); ?>">
                <span class="data"><?php echo 'Her er stjernene '; ?></span>
                    <?php
                    prorevs_add_star_loop(1);
                    prorevs_add_star_loop_content();
                    prorevs_add_star_loop($profilID);
                    echo do_shortcode("[prorevs_users_by_rating limit=10])");
                    ?>
                <h4><?php bp_the_profile_group_name(); ?></h4>

                <table class="profile-fields">
                    <div class="col-md-12">
                        <?php //regne ut ikon til type artist


                        $djIkon = '<span class="katicon-dj"></span>';
                        $bandIkon = '<span class="katicon-band"></span>';
                        $artistIkon = '<span class="katicon-artist"></span>';
                        $danserIkon = '<span class="katicon-danser"></span>';
                        $komikerIkon = '<span class="katicon-komiker"></span>';
                        $foredragsholderIkon = '<span class="katicon-foredragsholder"></span>';
                        $musikerIkon = '<span class="katicon-musiker"></span>';


                        $navarendeKategori = bp_get_member_profile_data('field=Kategori');
                        $sattKategori = '';//$navarendeKategori;
                        $artist = 'Artist';
                        $dj = 'DJ';
                        $band = 'BAND';
                        $liveband = 'LIVEBAND';
                        $danser = 'Danser';
                        $komiker = 'Komiker';
                        $foredragsholder = 'Foredragsholder';
                        $musiker = 'Musiker';

                        $foredragsHolderSatt = false;

                        if (strtolower(trim($navarendeKategori)) === strtolower(trim($dj))) {
                            $sattKategori = $djIkon;
                        } else if (strtolower(trim($navarendeKategori)) === strtolower(trim($band)) || strtolower(trim($navarendeKategori)) === strtolower(trim($liveband))) {
                            $sattKategori = $bandIkon;
                        } else if (strtolower(trim($navarendeKategori)) === strtolower(trim($danser))) {
                            $sattKategori = $danserIkon;
                        } else if (strtolower(trim($navarendeKategori)) === strtolower(trim($komiker))) {
                            $sattKategori = $komikerIkon;
                        } else if (strtolower(trim($navarendeKategori)) === strtolower(trim($foredragsholder))) {
                            $sattKategori = $foredragsholderIkon;
                            $foredragsHolderSatt = true;
                        } else if (strtolower(trim($navarendeKategori)) === strtolower(trim($musiker))) {
                            $sattKategori = $musikerIkon;
                        } else if (strtolower(trim($navarendeKategori)) === strtolower(trim($artist))) {
                            $sattKategori = $artistIkon;
                        } else {
                            $sattKategori = $navarendeKategori;
                        }


                        if ($foredragsHolderSatt === true){
                            $artistkategoriogIkon = $sattKategori . ' <span id="foredragsholderFontStr">' . $navarendeKategori . '</span>';

                        }else{
                            $artistkategoriogIkon = $sattKategori . ' ' . $navarendeKategori;

                        }


                        /*Utregning ferdig*/

                        echo '<span id="kategoriBeskrivelseFeltGratt">' . $artistkategoriogIkon . '</span>';

                        ?>
                    </div>
                    <?php /*while (bp_profile_fields()) : bp_the_profile_field(); ?>

                        <?php if (bp_field_has_data()) : ?>

                            <div<?php bp_field_css_class(); ?>>

                                <span class="label"><?php bp_the_profile_field_name(); ?></span>

                                <span class="data"><?php bp_the_profile_field_value(); ?></span>

                            </div>

                        <?php endif; */ ?>

                    <?php

                    /**
                     * Fires after the display of a field table row for profile data.
                     *
                     * @since BuddyPress (1.1.0)
                     */
                    do_action('bp_profile_field_item'); ?>

                    <?php //endwhile; ?>

                    <div class="col-md-12 profil-beskrivelse-box">
                        <?php echo'<i class="fa fa-map-marker"></i> ' . bp_get_member_profile_data('field=Område') ?>
                    </div>
                    <!--  <div class="col-md-12">
                        <?php //echo'<i class="fa fa-hourglass-1"></i> Maks antall spilletimer: '. bp_get_member_profile_data('field=Maks antall timer pr oppdrag') ?>
                    </div>
                    <div class="col-md-12">
                        <?php //echo'<i class="fa fa-briefcase"></i> Kan medbringe eget utstyr: '. bp_get_member_profile_data('field=Kan medbringe eget utstyr') ?>

                    </div>-->


                    <?php
                    //hente inn nåværende link
                    echo'<div class="col-md-12"><a  href="../../foresporsel/?direkte=' . $profil . '&did='.$profilID.'"><button id="sendforesporseldirektefraprofil">SEND FORESP&Oslash;RSEL</button></a></div>';


                    $navarendeSideLink = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                    $linktilutspytt = '<a href="'.$navarendeSideLink.'media" alt="link til media bruker">Vis samling</a>';
                    ?>

                    <div class="profil-beskrivelse-box">
                        <div class="profile-media-wrapper margin-top">
                            <div class="col-md-12">
                                <span class="link"><i class="fa fa-camera" ></i><span id="mediagallerLinkibeskrivelse"><?php echo  ' '. $linktilutspytt; ?></span></span>
                            </div>
                            <?php
                            $navarendeBruker = get_current_user_id();
                            if($brukerID == $navarendeBruker){
                                echo do_shortcode('[rtmedia_uploader]');
                            }
                            echo do_shortcode('[rtmedia_gallery  global=true media_author='.$brukerID.' per_page=9]');
                            ?>
                        </div>
                    </div>
                </table>
            </div>

            <div id="beskrivelseFelt">
                <?php
                $brukerID = bp_displayed_user_id();
                echo "<h2>" .bp_core_get_user_displayname($brukerID). "</h2>";
                echo bp_get_member_profile_data('field=Beskrivelse') ?>



            </div>
            <div class="media-beskrivelse-wrap">
                <div class="col-md-4 media-field field_spotify">
                    <span class="data"><?php echo bp_get_member_profile_data('field=Spotify') ?></span>
                </div>
                <div class="col-md-4 media-field field_soundcloud">
                    <span class="data"><?php echo bp_get_member_profile_data('field=SoundCloud') ?></span>
                </div>
                <div class="col-md-4 media-field field_applemusic">
                    <span class="data"> <?php echo bp_get_member_profile_data('field=Apple Music') ?></span>
                </div>
                <div class="col-md-4 media-field field_youtube">
                    <span class="data"> <?php echo bp_get_member_profile_data('field=YouTube') ?></span>
                </div>

            </div>

            <?php

            /** This action is documented in bp-templates/bp-legacy/buddypress/members/single/profile/profile-wp.php */
            do_action('bp_after_profile_field_content'); ?>

        <?php endif; ?>

    <?php endwhile; ?>

    <?php

    /** This action is documented in bp-templates/bp-legacy/buddypress/members/single/profile/profile-wp.php */
    do_action('bp_profile_field_buttons'); ?>

<?php endif; ?>

<?php

/** This action is documented in bp-templates/bp-legacy/buddypress/members/single/profile/profile-wp.php */
do_action('bp_after_profile_loop_content'); ?>


<script src="jquery-1.11.3.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function ($) {

        $(function () {
            lagMusikkIkoner();



            function lagMusikkIkoner() {
//spotify
                var spotifyLink = $('.field_spotify .data a').attr('href');

                var spotifyIkon = '<span id="spotifyIkonProfilSide" class="fa fa-spotify fa-4"></span>'
                var nySpotify = $('<a class="media-field"></a>').attr('href', spotifyLink).html(spotifyIkon);
                //soundcloud
                var soundcloudLink = $('.field_soundcloud .data a').attr('href');
                var soundcloudIkon = '<span id="soundcloudikonProfilSide" class="fa fa-soundcloud fa-4"></span>'
                var nysoundcloud = $('<a class="media-field"></a>').attr('href', soundcloudLink).html(soundcloudIkon);
                //itunes
                var itunesLink = $('.field_applemusic .data a').attr('href');
                var itunesIkon = '<span id="itunesIkonProfilSide" class="fa fa-apple fa-4"></span>'
                var nyitunes = $('<a class="media-field"></a>').attr('href', itunesLink).html(itunesIkon);
                //youtube
                var youtubeLink = $('.field_youtube .data a').attr('href');
                var youtubeIkon = '<span id="youtubeIkonProfilSide" class="fa fa-youtube fa-4"></span>'
                var nyYoutube = $('<a class="media-field"></a>').attr('href', youtubeLink).html(youtubeIkon);

                var profilerArray = [nySpotify, nysoundcloud, nyitunes, nyYoutube];
                var antallProfiler = profilerArray.length;

                for (var i = 0; i <= antallProfiler - 1; i++) {
                    if (profilerArray[i].attr('href') != undefined) {
                        $('.media-beskrivelse-wrap').append(profilerArray[i]);

                    }
                }

                /*  $('#musikkprofiler').append(nySpotify );
                 $('#musikkprofiler').append(nysoundcloud );
                 $('#musikkprofiler').append(nyitunes );*/
                $('.media-beskrivelse-wrap').css('display', 'block');


            }
        });

        var body = $('body');
    });


</script>

