<?php get_header( 'buddypress' ); ?>

<?php 
echo"Php data fil";
?>

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


$locationValg = array();
setVerdier();


if(isset($_POST['action']) && !empty($_POST['action'])) {
    $action = $_POST['action'];
     switch($action) {
        case 'test' : setEcho();break;
        case 'post' : setEcho();break;

        // ...etc...
    }
setVerdier();
 }

function setEcho(){
	echo"trykket på knapp";
}

function setVerdier(){

global $locationValg;

/*$locationValg[] = "Oslo";
$locationValg[] = "Telemark";
$locationValg[] = "sd";
echo $locationValg[1]; */
lagListe();
}

/**
 * Fires before the display of the members loop.
 *
 * @since BuddyPress (1.2.0)
 */
function lagListe(){ 
		
global $locationValg;

do_action( 'bp_before_members_loop' ); ?>

<?php if ( bp_get_current_member_type() ) : ?>
	<p class="current-member-type"><?php //bp_current_member_type_message() ?></p>
<?php endif; ?>

<?php if ( bp_has_members( bp_ajax_querystring( 'members' ) ) ) : ?>

	<div id="pag-top" class="pagination">

		<div class="pag-count" id="member-dir-count-top">

			<?php //bp_members_pagination_count(); ?>

		</div>
		<input type="button" value="Last side" id="lastsideBtn"/>
		<div id="sorteringsvalg"> 
		<h2> Sorter artister</h2>
		<ul>
		<label for="oslo">Oslo</label>
		<li><input type="checkbox" id="oslo" name="Oslo" value="Oslo"/></li>
		</ul>
		<div id="phpdiv"> </div>
		</div>
		<div class="pagination-links" id="member-dir-pag-top">

			<?php //bp_members_pagination_links(); ?>

		</div>

	</div>

	<?php

	/**
	 * Fires before the display of the members list.
	 *
	 * @since BuddyPress (1.1.0)
	 */
	do_action( 'bp_before_directory_members_list' ); ?>

	<ul id="members-list" class="item-list"> 

<?php
$numbersOfLocationsChecked = count($locationValg);

 while ( bp_members() ) : bp_the_member(); ?>
	
	<?php //$brukerType = bp_member_profile_data('field=Type');;

//	echo 'brukertype:' . $brukerType;	

$user = new WP_User( bp_get_member_user_id() );
$userLocation = bp_get_member_profile_data('field=Område'); 
//dele opp basert på komma
$ordSomSkalDeles = $userLocation;
$oppdeltOrd = explode(',', $ordSomSkalDeles);
$antallOppdelteOrd = count($oppdeltOrd);
//echo("Lengde" . $numbersOfLocationsChecked);
//echo "Arrayinnhold: " .  $locationValg[1];
//echo "Lokasjon fra profil: " . $userLocation;

//This will check if the users hasent cheked anything, and prints all data
if($numbersOfLocationsChecked == 0){
	//print alt
	//I know, this is not good coding with the same lines copy pasted
if ( $user->roles[0] == 'subscriber' ){ ?>
		<li <?php bp_member_class(); ?>>
			<div class="item-avatar">
			<a href="<?php bp_member_permalink(); ?>"><?php bp_member_avatar('type=full&width=100%&height=180'); ?></a>
		</div>
			<div class="item">
				<div class="item-title">
					<a href="<?php bp_member_permalink(); ?>"><?php bp_member_name(); ?></a>
				</div>
					<div class="item-title">
					<a href="<?php bp_member_permalink(); ?>"><?php bp_get_member_type($user_id); ?></a>
				</div>
				<div class="musikertype">
					<span><?php bp_member_profile_data('field=Type'); ?></span>
				</div>
				<div class="musikerlokasjon">
					<span><?php bp_member_profile_data('field=Område'); ?></span>
				</div>
				<div class="musikerprissjikte">
					<span><?php bp_member_profile_data('field=Prissjikte'); ?></span>
				</div>

				<?php
				/**
				 * Fires inside the display of a directory member item.
				 *
				 * @since BuddyPress (1.1.0)
				 */
				do_action( 'bp_directory_members_item' ); ?>

				<?php
				//bp_member_profile_data('field=Type');
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
<?php } 
	//Ferdig med å printe ut alt
}else{
	//print kun field med riktig område
	for($i = 0;$i< $numbersOfLocationsChecked;$i++){
		for($x = 0;$x < $antallOppdelteOrd;$x++){ 
		//echo("oppdelte ord før løkke " . $oppdeltOrd[0] );
		$omrade = str_replace(' ', '', $oppdeltOrd[$x]);
		//echo("oppdelte ord før løkke område " . $omrade . " SLUTT");
		$omradeFraValgt = str_replace(' ', '', $locationValg[$i]);	
		$printet = false;	
		if($omrade===$omradeFraValgt){
		//	echo("oppdelte ord fra løkke " . $oppdeltOrd[$x] );
			//printing only data where the lcoation is selected
			if ( $user->roles[0] == 'subscriber' ){ ?>
		<li <?php bp_member_class(); ?>>
			<div class="item-avatar">
			<a href="<?php bp_member_permalink(); ?>"><?php bp_member_avatar('type=full&width=100%&height=180'); ?></a>
		</div>
			<div class="item">
				<div class="item-title">
					<a href="<?php bp_member_permalink(); ?>"><?php bp_member_name(); ?></a>
				</div>
					<div class="item-title">
					<a href="<?php bp_member_permalink(); ?>"><?php bp_get_member_type($user_id); ?></a>
				</div>
				<div class="musikertype">
					<span><?php bp_member_profile_data('field=Type'); ?></span>
				</div>
				<div class="musikerlokasjon">
					<span><?php bp_member_profile_data('field=Område'); ?></span>
				</div>
				<div class="musikerprissjikte">
					<span><?php bp_member_profile_data('field=Prissjikte'); ?></span>
				</div>

				<?php
				/**
				 * Fires inside the display of a directory member item.
				 *
				 * @since BuddyPress (1.1.0)
				 */
				do_action( 'bp_directory_members_item' ); ?>

				<?php
				//bp_member_profile_data('field=Type');
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
<?php } 

		$printet = true;
		//slutt på løkka som skal sjekke profil ord
		} else{

			//echo $omrade . " og " . $omradeFraValgt . " er ulike";
		}
			//Stopper løkka dersom den printes ut siden det kan være flere med samme lokasjon
			if($printet == true){
				break;
			}


		}
	}

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
		<div class="pagination-links" id="member-dir-pag-bottom">
			<?php //bp_members_pagination_links(); ?>
		</div>
	</div>

<?php else: ?>

	<div id="message" class="info">
		<p><?php _e( "beklager, ingen funnet", 'buddypress' ); ?></p>
	</div>

<?php endif; ?>

<?php

/**
 * Fires after the display of the members loop.
 *
 * @since BuddyPress (1.2.0)
 */
do_action( 'bp_after_members_loop' );



} ?>



<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script type="text/javascript">


var testBtnClick = function()
{
/* $.ajax({
            //url: '_inc/ajax.php',
            success: function(data) {
              alert("fikk til");
            }
        }); */

/*$.ajax({ 
	url: '/members-loop.php',
         data: {action: 'test'},
         type: 'post',
         success: function(output) {
                      alert("Gått gjennom");
                  }
		}); */

              /*   $.ajax({
                       type: "GET",
                       url: "../funksjonerfiler.php",
                       //data: "test",
                       success: function(msg){
                       	alert("suksess");
                        document.getElementById("#phpdiv").innerHTML = msg                         }
                     }) */

                 $.get( "../phpdata.php", function( data ) {
  				//$( "body" ).html( data );
  
              $('#phpdiv').empty().append(data);              

  alert( "Load was performed." );
});
          

}



document.getElementById('lastsideBtn').onclick = testBtnClick;

</script>

<?php get_footer( 'buddypress' ); ?>