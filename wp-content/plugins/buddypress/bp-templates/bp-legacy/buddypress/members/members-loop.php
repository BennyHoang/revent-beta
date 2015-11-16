<?php

/**
 * BuddyPress - Members Loop
 *
 * Querystring is set via AJAX in _inc/ajax.php - bp_legacy_theme_object_filter()
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<?php

/**
 * Fires before the display of the members loop.
 *
 * @since BuddyPress (1.2.0)
 */
/* Querystring is set via AJAX in _inc/ajax.php - bp_dtheme_object_filter() */ ?>
<?php do_action( 'bp_before_members_loop' ) ?>

<?php
if ( bp_ajax_querystring( 'members' ) ==""){
	$queryString = "type=alphabetical&per_page=25";
}else if(bp_ajax_querystring('members') == 'newest'){
	$queryString = "type=newest&per_page=25";
}else {$queryString = bp_ajax_querystring( 'members' ).'&per_page=25';}
?>


<?php if ( bp_get_current_member_type() ) : ?>
	<p class="current-member-type"><?php bp_current_member_type_message() ?></p>
<?php endif; ?>
<?php if ( bp_has_members( $queryString) ) : ?>
<div id="pag-top" class="pagination">

	<div class="pag-count" id="member-dir-count-top">

		<?php bp_members_pagination_count(); ?>

	</div>

	<div class="pagination-links" id="member-dir-pag-top">

		<?php bp_members_pagination_links(); ?>

	</div>

</div>

<?php

/**
 * Fires before the display of the members list.
 *
 * @since BuddyPress (1.1.0)
 */
do_action( 'bp_before_directory_members_list' ); ?>

<div id="arbeider"><img id="jobbebilde" alt='jobber' src='../spinner.gif'/> </div>
<div id="phpdiv">
	<ul id="members-list" class="item-list">

		<?php while ( bp_members() ) : bp_the_member();

			$user = new WP_User( bp_get_member_user_id() );

			/*

            DJ  -> <i class="fa fa-headphones fa-3"></i>
            BAND -> <i class="fa fa-users fa-3"></i>
            ARTIST -> <i class="fa fa-user fa-3"></i>
            DANSER -> <i class="fa fa-umbrella fa-3"></i>
            KOMIKER -> <i class="fa fa-hand-scissors-o fa-3"></i>
            FOREDRAGSHOLDER -> <i class="fa fa-commenting fa-3"></i>


            */

			if ( $user->roles[0] == 'subscriber' ){ ?>
				<li <?php bp_member_class();
				$user_id = bp_get_member_user_id();

				?>>
					<div class="member-filter"></div>
					<div class="item-avatar">
						<a href="<?php bp_member_permalink(); ?>"><?php bp_member_avatar('type=full&width=100%&height=180'); ?></a>
					</div>
					<div class="item-title brukernavnmeldemsiden">
						<?php
						//regne ut ikon til type artist


						$djIkon = '<span class="katicon-dj"></span>';
						$bandIkon = '<span class="katicon-band"></span>';
						$artistIkon = '<span class="katicon-artist"></span>';
						$danserIkon = '<span class="katicon-danser"></span>';
						$komikerIkon = '<span class="katicon-komiker"></span>';
						$foredragsholderIkon = '<span class="katicon-foredragsholder"></span>';
						$musikerIkon = '<span class="katicon-musiker"></span>';

						?>
						<div class="musikertype">
					<span><?php
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

						if(strtolower(trim($navarendeKategori)) === strtolower(trim($dj))){
							$sattKategori = $djIkon;
						}else if(strtolower(trim($navarendeKategori)) === strtolower(trim($band)) || strtolower(trim($navarendeKategori)) === strtolower(trim($liveband))){
							$sattKategori = $bandIkon;
						}else if(strtolower(trim($navarendeKategori)) === strtolower(trim($danser))){
							$sattKategori = $danserIkon;
						}else if(strtolower(trim($navarendeKategori)) === strtolower(trim($komiker))){
							$sattKategori = $komikerIkon;
						}else if(strtolower(trim($navarendeKategori)) === strtolower(trim($foredragsholder))){
							$sattKategori = $foredragsholderIkon;
						}else if(strtolower(trim($navarendeKategori)) === strtolower(trim($musiker))){
							$sattKategori = $musikerIkon;
						}else if(strtolower(trim($navarendeKategori)) === strtolower(trim($artist))){
							$sattKategori = $artistIkon;
						}else{
							$sattKategori = $navarendeKategori;
						}

						echo $sattKategori; ?></span>
						</div>
<?php
$profil = "";
$profilID = $user_id;
						echo'<a  href="../foresporsel/?direkte=' . $profil . '&did='.$profilID.'"><button class="utvalg-sendforesporsel">SEND FORESP&Oslash;RSEL</button></a>';

?>
						<?php
						$navnArtist = bp_get_member_name();
						//echo $navnArtist;
						$antallBokstaverINavn = strlen($navnArtist);

						$artistNavnPrintes = ''.$navnArtist.'';
						$maxOrd = 17;
						$maxOrdLengre = 21;

						$MaxOrdklasse = "";

						if($antallBokstaverINavn >= $maxOrd){
							if($antallBokstaverINavn >= $maxOrdLengre ){
								$MaxOrdklasse = 'langtNavnMedlemOverTjue';
							}else{
								$MaxOrdklasse = 'langtNavnMedlem';
							}
						}

						?>


						<a class="<?php echo$MaxOrdklasse; ?>" href="<?php bp_member_permalink(); ?>"><?php echo $artistNavnPrintes  ?></a>
					</div>
					<div class="item">

						<div class="item-title ">
							<a href="<?php bp_member_permalink(); ?>"><?php bp_get_member_type($user_id); ?></a>
						</div>
						<div id="stjerner">
							<?php
							prorevs_add_star_loop($user_id);
							?>
						</div>


						<div class="musikerlokasjon">
							<!--	<span><b>Område:</b> <?php //bp_member_profile_data('field=Område'); ?></span> -->
						</div>
						<!--		<div class="musikerprissjikte">
					<span><b>Pris:</b> <?php //bp_member_profile_data('field=Prissjikte'); ?></span>
				</div> -->
						<div id="lagfinhvitkanmembers"></div>

						<?php

						/**
						 * Fires inside the display of a directory member item.
						 *
						 * @since BuddyPress (1.1.0)
						 */
						do_action( 'bp_directory_members_item' ); ?>

						<?php
						/***
						 * If you want to show specific profile fields here you can,
						 * but it'll add an extra query for each member in the loop
						 * (only one regardless of the number of fields you show):
						 *
						 * bp_member_profile_data( 'field=the field name' );
						 */
						?>
					</div>

					<div class="action">

						<?php

						/**
						 * Fires inside the members action HTML markup to display actions.
						 *
						 * @since BuddyPress (1.1.0)
						 */
						do_action( 'bp_directory_members_actions' ); ?>

					</div>

					<div class="clear"></div>
				</li>

				<?php

			}
		endwhile; ?>

	</ul>

	<?php

	/**
	 * Fires after the display of the members list.
	 *
	 * @since BuddyPress (1.1.0)
	 */
	do_action( 'bp_after_directory_members_list' ); ?>

	<?php bp_member_hidden_fields(); ?>

	<div id="pag-bottom" class="pagination">

		<div class="pag-count" id="member-dir-count-bottom">

			<?php bp_members_pagination_count(); ?>

		</div>

		<div class="pagination-links" id="member-dir-pag-bottom">

			<?php bp_members_pagination_links(); ?>

		</div>

	</div>

	<?php else: ?>

		<div id="message" class="info">
			<p><?php //_e( "Sorry, no members were found.", 'buddypress' ); ?>Beklager, det du ser etter ble ikke funnet.</p>
		</div>

	<?php endif; ?>

	<?php

	/**
	 * Fires after the display of the members loop.
	 *
	 * @since BuddyPress (1.2.0)
	 */
	do_action( 'bp_after_members_loop' ); ?>



	<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
	<script type="text/javascript">

		function vedCheckboxValg(){

			$('#jobbebilde').css('display','block');


			$.ajax({

				url: '../utvalg/',
				type: 'post',
				data: $("#bps_directory593").serialize(),
				success: function(data) {
					//	alert('funka');
					var result = $(data).find('#members-list');
					var result2 = $(data).find('#pag-bottom');

					$( "#phpdiv" ).empty().append(result);
					$( "#phpdiv" ).append(result2);
					$('#jobbebilde').css('display','none');

				}
			});


//alert("sjekkboks");
//$('form#bps_directory593').submit();


		}

		$( "input" ).on( "click", function() {
			//$( "#phpdiv" ).empty().append( $( "input:checked" ).val() + " resultater vises" );
			vedCheckboxValg();
		});
	</script>

