<!-- Inkludere Bootstrap -->

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<style>
    .member-search-bottom{
        margin-top:15%;
    }
    #buddypress div.item-list-tabs#subnav {
        margin:0 0!important;
        padding-bottom: 10px;
    }
    #buddypress div.item-list-tabs#subnav ul li.last{
        margin-top: 0px !important;
    }

    #buddypress{
        width: 100%;
        max-width: 960px;
        margin: auto;

    }
    #grabartoppen{
        width: 100%;
        height:100px;
        position: relative;
        background: #F4F4F4;
    }

    div.full-container {
        width: 100% !important;
        margin: 0;
        padding: 0;
        max-width: 100% !important;
    }
    .top-wrap{
        margin:auto;
        max-width:960px;
    }
    .entry-content ul li{
        list-style:none;
    }
    button, button:active, button:focus{
        padding:0;
        border:0;
        box-shadow:none;
        background:none;
    }
    #search-members-form, #members-order-by{
        margin-top:30px !important;
    }
    .label{
        color:#000;
        font-size:24px;
        text-align:left;
        padding:0;
    }
    .checkbox label:first-child{
        color: #888;
        font-weight:300!important;
    }
    .field_4 .checkbox{
        height: 200px;
        overflow-y: scroll;
    }
    #bps_directory593 .submit{
        display:none;
    }
    nav.site-navigation.main-navigation.primary{max-width:960px; margin:auto;}
    @media (max-width:600px){
        .members #page-wrapper #main{
            padding-right:0 !important;
        }
        .item-list-tabs ul{
            margin:0;
            padding:0;
        }
        .item-list-tabs ul li{
            margin-left:0;
        }
    }
</style>
<?php

/**
 * Fires at the top of the members directory template file.
 *
 * @since BuddyPress (1.5.0)
 */

do_action('bp_before_directory_members_page'); ?>
<div id="grabartoppen">
    <div class="top-wrap">
        <div id="members-dir-search" class="dir-search" role="search">
            <?php bp_directory_members_search_form(); ?>
            <div class="item-list-tabs" id="subnav" role="navigation">
                <ul>
                    <?php

                    /**
                     * Fires inside the members directory member sub-types.
                     *
                     * @since BuddyPress (1.5.0)
                     */
                    do_action('bp_members_directory_member_sub_types'); ?>

                    <li id="members-order-select" class="last filter">
                        <!-- <label for="members-order-by"><//?php _e('Order By:', 'buddypress'); ?></label> -->
                        <select id="members-order-by">
                            <?php if (bp_is_active('xprofile')) : ?>
                                <option value="newest"><?php _e('Nyeste registrerte', 'buddypress'); ?></option>
                            <?php endif; ?>
                            <option value="alphabetical"><?php  _e('Alphabetical', 'buddypress'); ?></option>
                            <option value="random"><?php  _e('Random', 'buddypress'); ?></option>
                            <?php

                            /**
                             * Fires inside the members directory member order options.
                             *
                             * @since BuddyPress (1.2.0)
                             */
                            do_action('bp_members_directory_order_options'); ?>
                        </select>
                    </li>

                </ul>
            </div>

        </div>
        <!-- #members-dir-search -->
        <div  id="statiskFiltrer">
            <button class="btn btn-default dropdown-toggle dropdown-members-btn" type="button" id="filtrerartisterBtn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <i class="fa fa-sliders"></i>
                Filtrer utvalg
            </button>

        </div>
    </div>
</div>

<div id="buddypress">

    <?php

    /**
     * Fires before the display of the members.
     *
     * @since BuddyPress (1.1.0)
     */
    do_action('bp_before_directory_members'); ?>

    <?php

    /**
     * Fires before the display of the members content.
     *
     * @since BuddyPress (1.1.0)
     */

    do_action('bp_before_directory_members_content'); ?>
    <?php

    /**
     * Fires before the display of the members list tabs.
     *
     * @since BuddyPress (1.8.0)
     */
    do_action('bp_before_directory_members_tabs'); ?>

    <form action="" method="post" id="members-directory-form" class="dir-form">

        <div class="item-list-tabs" role="navigation">
            <ul>
                <!--<li class="selected" id="members-all"><a href="<?php //bp_members_directory_permalink(); ?>"><?php //printf( __( 'All Members <span>%s</span>', 'buddypress' ), bp_get_total_member_count() ); ?></a></li>-->

                <?php if (is_user_logged_in() && bp_is_active('friends') && bp_get_total_friend_count(bp_loggedin_user_id())) : ?>
                    <li id="members-personal"><a
                            href="<?php echo bp_loggedin_user_domain() . bp_get_friends_slug() . '/my-friends/'; ?>"><?php printf(__('My Friends <span>%s</span>', 'buddypress'), bp_get_total_friend_count(bp_loggedin_user_id())); ?></a>
                    </li>
                <?php endif; ?>

                <?php

                /**
                 * Fires inside the members directory member types.
                 *
                 * @since BuddyPress (1.2.0)
                 */
                do_action('bp_members_directory_member_types'); ?>

            </ul>
        </div>
        <!-- .item-list-tabs -->


        <div id="members-dir-list" class="members dir-list">
            <?php bp_get_template_part('members/members-loop'); ?>
        </div>
        <!-- #members-dir-list -->

        <?php

        /**
         * Fires and displays the members content.
         *
         * @since BuddyPress (1.1.0)
         */
        do_action('bp_directory_members_content'); ?>

        <?php wp_nonce_field('directory_members', '_wpnonce-member-filter'); ?>

        <?php

        /**
         * Fires after the display of the members content.
         *
         * @since BuddyPress (1.1.0)
         */
        do_action('bp_after_directory_members_content'); ?>

    </form>
    <!-- #members-directory-form -->

    <?php

    /**
     * Fires after the display of the members.
     *
     * @since BuddyPress (1.1.0)
     */
    do_action('bp_after_directory_members'); ?>

</div><!-- #buddypress -->
<!--<div class="row ">
    <div class="col-xs-12 text-center member-search-bottom">
        <hr>
        <h2>&Oslash;NSKER DU UNDERHOLDNING?</h2>
        <a href="http://revent.no/foresporsel/" class="btn btn-default">Send foresp&oslash;rsel!</a>
        <hr>
    </div>
</div> -->



<?php

/**
 * Fires at the bottom of the members directory template file.
 *
 * @since BuddyPress (1.5.0)
 */
do_action('bp_after_directory_members_page');


?>

<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script type="text/javascript">


    var expanda = false;

    function visValg() {

        if (expanda == false) {
            $('#bps_directory593').css('display', 'block');
            $('#subnav').css('display', 'block');
            $('#search-members-form').css('display', 'block');
            $('#members-dir-search').css('display', 'block');


            expanda = true;

        } else {
            $('#bps_directory593').css('display', 'none');
            $('#subnav').css('display', 'none');

            expanda = false;
        }


    }

    $("#filtrerartisterBtn").on("click", function () {
        visValg();
    });


    /*Legge til ikoner i sorteringsmenyen*/
    var djIkon = '<span class="katicon-dj"></span>';
    var bandIkon = '<span class="katicon-band"></span>';
    var artistIkon = '<span class="katicon-artist"></span>';
    var danserIkon = '<span class="katicon-danser"></span>';
    var komikerIkon = '<span class="katicon-komiker"></span>';
    var foredragsholderIkon = '<span class="katicon-foredragsholder"></span>';
    var musikerIkon = '<span class="katicon-musiker"></span>';


    /*
     *
     * 	$djIkon = '<span class="katicon-dj"></span>';
     $bandIkon = '<span class="katicon-band"></span>';
     $artistIkon = '<span class="katicon-artist"></span>';
     $danserIkon = '<span class="katicon-danser"></span>';
     $komikerIkon = '<span class="katicon-komiker"></span>';
     $foredragsholderIkon = '<span class="katicon-foredragsholder"></span>';
     $musikerIkon = '<span class="katicon-musiker"></span>';
     *
     * */

    $('<span class="ikonSorteringBokser">' + djIkon + '</span>').insertAfter("input[value='DJ']");
    $('<span class="ikonSorteringBokser">' + bandIkon + '</span>').insertAfter("input[value='Band']");
    $('<span class="ikonSorteringBokser">' + artistIkon + '</span>').insertAfter("input[value='Artist']");
    $('<span class="ikonSorteringBokser">' + danserIkon + '</span>').insertAfter("input[value='Danser']");
    $('<span class="ikonSorteringBokser">' + komikerIkon + '</span>').insertAfter("input[value='Komiker']");
    $('<span class="ikonSorteringBokser">' + foredragsholderIkon + '</span>').insertAfter("input[value='Foredragsholder']");
    $('<span class="ikonSorteringBokser">' + musikerIkon + '</span>').insertAfter("input[value='Musiker']");







</script>

