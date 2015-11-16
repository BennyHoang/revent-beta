<?php

/*

Plugin Name: BP List Newest members

Plugin URI: http://cityflavourmagazine.com

Description: Show photos and names of the newest members in the widget area 

Version: 1.5.8

Requires at least: Wordpress 3.0 and BuddyPress 1.5

Tested up to: Wordpress 3.9.2 and BuddyPress 2.0.2

License: GNU/GPL 2

Author URI: http://cityflavourmagazine.com/

Author:Prince Abiola Ogundipe

*/









/*************Make sure BuddyPress is loaded ********************************/

if ( !function_exists( 'bp_core_install' ) ) {

	require_once( ABSPATH . '/wp-admin/includes/plugin.php' );

	if ( is_plugin_active( 'buddypress/bp-loader.php' ) )

		require_once ( WP_PLUGIN_DIR . '/buddypress/bp-loader.php' );

	else

		return;

}

/*******************************************************************/





/**

 * bp_list_newest_members_register_widgets

 * register widget.

 */



function bp_list_newest_members_register_widgets() {

	add_action('widgets_init', create_function('', 'return register_widget("Bp_List_Newest_Members_Widget");') );

}

add_action( 'plugins_loaded','bp_list_newest_members_register_widgets' );



class Bp_List_Newest_Members_Widget extends WP_Widget {

	

	function bp_list_newest_members_widget() {

		$widget_ops = array('classname' => 'widget_list_newest_members', 'description' => __( "List Photos And Names Of The Newest Registered Members", "bp-list-newest-members") );

		

  

  parent::WP_Widget( false, __('Vis artister på forsiden Widget','bp-list-newest-members'), $widget_ops);   

	}



function widget($args, $instance) {

		global $bp;

		$antalmedlemmerSomSkalVises = 10;
		$antalmedlemmerPrintet = 0;
		extract( $args );



		echo $before_widget;

		echo  '<span id="forsideMedlemmerTittel">' . $before_title 

		   .$instance['title']

                   . $after_title . '</span>';  ?>



<?php if ( bp_has_members( 'user_id=0&roles=subscriber&type=newest&populate_extras=0&per_page=99999"' ) ) : ?>
<div id="medlemmerSliderWrapper">
<input type="button" class="forsideScrollMedlemmerKnapp" id="forrigeMedlemKnapp"></input>
<div id="scrolleMedlemmerForsiden">
<ul id="members-list" class="item-list">

	 <?php while ( bp_members() ) : bp_the_member(); ?>

<?php 
$user = new WP_User( bp_get_member_user_id() );
if ( $user->roles[0] == 'subscriber' ){ ?>

         <li>
         <div class="item-avatar">
         <a href="<?php bp_member_permalink() ?>"><?php bp_member_avatar('type=full&width=200&height=200') ?></a>
         </div>
         <div class="item">
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
				<?php	$navnArtist = bp_get_member_name();
					//echo $navnArtist;
					$antallBokstaverINavn = strlen($navnArtist);

					$artistNavnPrintes = ''.$navnArtist.'';
					$maxOrd = 17;
					$maxOrdLengre = 21;
					$maxOrdTjueFem = 25;

					$MaxOrdklasse = "";

					if($antallBokstaverINavn >= $maxOrd){
						if($antallBokstaverINavn >= $maxOrdLengre ){
							if($antallBokstaverINavn >= $maxOrdTjueFem ){
								$MaxOrdklasse = 'langtNavnMedlemOverTjueFem';
							}else{
								$MaxOrdklasse = 'langtNavnMedlemOverTjue';
							}


						}else{
							$MaxOrdklasse = 'langtNavnMedlem';
						}
					}

					?>
					<a class="<?php echo$MaxOrdklasse; ?>" href="<?php bp_member_permalink(); ?>"><?php echo $artistNavnPrintes  ?></a>
         </div>

	<?php
	$antalmedlemmerPrintet++;
}

if($antalmedlemmerSomSkalVises === $antalmedlemmerPrintet){
	break;
}
	 endwhile;
	 ?>
	</li>
         </div>



	<?php else: ?>



	<div class="widget-error">

	<?php _e( 'Beklager ingen nye medlemmer enda.. ', 'bp-list-newest-members' ) ?>

	</ul>

	</div>



	<?php endif; ?>
	<input type="button" class="forsideScrollMedlemmerKnapp" id="nesteMedlemKnapp"/>

</div>

<!-- Slutt på medlemmer slider wrapper-->
		</div>

<?php echo $after_widget; ?>

<script>
function klart( jQuery ) {
function scrollHoyre() {

            $('#scrolleMedlemmerForsiden').animate({
                scrollLeft: "+=" + 250 + "px"
            });
        }
function scrollVenstre(){
   $('#scrolleMedlemmerForsiden').animate({
                scrollLeft: "+=" + -250 + "px"
            });
}

$('#nesteMedlemKnapp').click(function(){
scrollHoyre();
});
$('#forrigeMedlemKnapp').click(function(){
scrollVenstre();
});}

$( document ).ready( klart );


</script>

<?php

	}



function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );

                $instance['max_num'] = strip_tags( $new_instance['max_num'] );



		return $instance;

	}



	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array( 'max_num' => 5 ) );

		$title = strip_tags( $instance['title'] );

                $max_num = strip_tags( $instance['max_num'] );

		?>

		



<p><label for="bp-list-newest-members-widget-title"><?php _e( 'Overskrift' , 'bp-list-newest-members'); ?>

 <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" class="widefat" value="<?php echo esc_attr( $title ); ?>"style="width: 100%"/></label></p>



<!--<p><label for="bp-list-newest-members-widget-max-num"><?php //_e( 'Antall medlemmer som skal vises endres i koden.','bp-list-newest-members' ); ?> <input class="widefat" id="<?php //echo $this->get_field_id( 'max_num' ); ?>" name="<?php //echo $this->get_field_name( 'max_num' ); ?>" type="text" value="<?php //echo attribute_escape( $max_num ); ?>" style="width: 30%" /></label></p>-->





		

	<?php

	}

}

?>