<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *Template Name: Få id ved post av form
 * @package vantage
 * @since vantage 1.0
 * @license GPL 2.0
 */


get_header(); ?>


<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<div id="primary" class="content-area">
	<div id="content" class="site-content" role="main">

        <div class="container">
<?php
$postid = 0;
$postidArray = array();


	echo "<h1>Nedenfor ser du ett sammendrag av ditt tilbud.</h1>";
	echo "<p>Det er nå opp til kunden å godta tilbudet ditt, dersom det gjøres vil du få beskjed</p>";

	//echo do_shortcode('[cfdb-table form="Søk på arrangement" show="Tittel på arrangement,Artist navn,Telefonnummer,Pris,Informasjon,Listing ID,submit_time,Tilbudsvarighet"  filter="'. $nummerPrintesUt.'" ]');

//				echo " skriver ut ekoen av nummerPrintesUt " . $nummerPrintesUt;


//dagensdato for å legge gutløpe tilbud et annet sted
$dagensDato = date("d/m/Y");
//echo $dagensDato;
$randomTallArray = array();
$randomTall = 0;
$prisFraRow = 0;
$innholdITilbud = "";

//hente brukerinfo
 global $current_user;
$user_id = $current_user->ID;
      get_currentuserinfo();
//tilbud som ikke har utløpt
require_once(ABSPATH . 'wp-content/plugins/contact-form-7-to-database-extension/CFDBFormIterator.php');
$exp = new CFDBFormIterator();
$exp->export($atts['Søk på arrangement'], $atts);
while ($row = $exp->nextRow()) {

//	echo $current_user->ID ;
  	if($user_id  == $row['brukerid']){
  			//sjekke om tilbud har utløpt
  		$submitDato = $row['submit_time'];
  		$unixtime_to_date = date('Y-m-d H:i:s', $submitDato);
  		//echo 'omgjort tid ' . $unixtime_to_date ;
  		//$date = date('Y-m-d H:i:s', time());
  		//echo 'dagens tid ' .  $date;


//denne sjekker om brukeren lagde en post for mindre en ett minutt siden

$newTime = strtotime('-1 minutes');
$dagenstidMinusEttMin = date('Y-m-d H:i:s', $newTime);
//echo 'datgens tid minus 15 min ' . $dagenstidMinusEttMin;


  		if($unixtime_to_date >= $dagenstidMinusEttMin){

            $innholdITilbud = $row['Informasjon'];

  			//echo 'dagensdato er mindre en post dato';
  		echo '<div class="dashboardTilbudDiv"><h2>' . $row['Artistnavn'] . ' har lagt inn tilbud til ' . $row['Tittel på arrangement'].'</h2>';
  		echo '<p>Info:' .  $row['Informasjon'] . '</p>';
  		//echo $row['submit_time'];
  		//echo $row['Submitted Login'];
      echo '<p>Kontaktinfo: <br/>Fult navn: '.$row['Fornavn'] . ' ' .$row['Etternavn'] .
       '<br/>Epostadresse: ' . $row['Epostadresse'] . '</br>Telefon: ' . $row['Telefon'] . '<br/>Alternativ kontaktperson: ' . $row['Alternativ kontaktperson'] .'</p>';
  		echo '<p>Pris:' .  $row['Pris'] . ' Dette tilbudet utløper ' . $row['Tilbudsvarighet'] . '<br/> Krav og ønsker: ' . $row['Krav og ønsker'] . '</p>';
		//echo'<a href="../betaling/?key1=' . $row['Pris'] . '&key2=' . $row['Artist navn'] . '&key3=' . $row['Tittel på arrangement'] . '">Bekreft dette tilbudet</a></div>';

           //lager en cookie for å sjekke om mailen alt er sendt, og om produktet alt er laget slik at det ikek blir noen dupliakter her
            if (!isset($_COOKIE["BAAAAAAA5467AAA96789678AAAAAA67969AA123123123AMGGGA1231212AAAAM87231231311"])) {
//lage produkt
//$randomTall = mt_rand(100000000000,99999999999999);
$submitTid = $row['submit_time'];
$submitBruker = $row['Artistnavn'];
$sku = $submitBruker . $submitTid;



	  $post = array(
     'post_author' => $user_id,
     'post_content' => $row['Informasjon'],
     'post_status' => "publish",
     'post_title' =>  $row['Artistnavn'],
    'post_parent' => '',
     'post_type' => "product",

     );
      //Create post
     $post_id = wp_insert_post( $post, $wp_error );
     if($post_id){
     $attach_id = get_post_meta($product->parent_id, "_thumbnail_id", true);
     add_post_meta($post_id, '_thumbnail_id', $attach_id);
    }
    wp_set_object_terms( $post_id, 'Spillejobb', 'product_cat' );
     wp_set_object_terms($post_id, 'simple', 'product_type');


     update_post_meta( $post_id, 'arrtittel', $row['Tittel på arrangement'] );
     update_post_meta( $post_id, '_visibility', 'visible' );
     update_post_meta( $post_id, '_stock_status', 'instock');
     update_post_meta( $post_id, 'total_sales', '0');
     update_post_meta( $post_id, '_downloadable', 'yes');
     update_post_meta( $post_id, '_virtual', 'yes');
     update_post_meta( $post_id, '_regular_price', $row['Pris'] );
     update_post_meta( $post_id, '_sale_price', $row['Pris'] );
     update_post_meta( $post_id, '_purchase_note', 'Tusen takk for at du valgt Rêvent. Nedenfor finner du kontaktinformasjonen til din valgte artist. Ta kontakt med artist så fort mulig for å avtale prosessen videre. <br/> '. $row['Kontaktinfo'] . '<br/>' .
     	'Kontaktinformasjon<br/> Fult navn: '
     	 .$row['Fornavn'] . ' ' .$row['Etternavn'] . '<br/>Epostadresse: '.
     	 $row['Epostadresse'] . '</br>Telefon: ' . $row['Telefon'] . '<br/>Alternativ kontaktperson: ' . $row['Alternativ kontaktperson'] . '<br/> Krav og ønsker: ' . $row['Krav og ønsker']
		);

     update_post_meta( $post_id, '_featured', "no" );
     update_post_meta( $post_id, '_weight', "" );
     update_post_meta( $post_id, '_length', "" );
     update_post_meta( $post_id, '_width', "" );
     update_post_meta( $post_id, '_height', "" );
     update_post_meta($post_id, '_sku', $sku);
     update_post_meta( $post_id, '_product_attributes', array());
     update_post_meta( $post_id, '_sale_price_dates_from', "" );
     update_post_meta( $post_id, '_sale_price_dates_to', "" );
     update_post_meta( $post_id, '_price', $row['Pris'] );
     update_post_meta( $post_id, '_sold_individually', "" );
     update_post_meta( $post_id, '_manage_stock', "no" );
     update_post_meta( $post_id, '_backorders', "no" );
     update_post_meta( $post_id, '_stock', "" );

     // file paths will be stored in an array keyed off md5(file path)
    $downdloadArray =array('name'=>"Test", 'file' => $uploadDIR['baseurl']."/video/".$video);

    $file_path =md5($uploadDIR['baseurl']."/video/".$video);


    $_file_paths[  $file_path  ] = $downdloadArray;
    // grant permission to any newly added files on any existing orders for this product
    //do_action( 'woocommerce_process_product_file_download_paths', $post_id, 0, $downdloadArray );
    update_post_meta( $post_id, '_downloadable_files ', $_file_paths);
    update_post_meta( $post_id, '_download_limit', '');
    update_post_meta( $post_id, '_download_expiry', '');
    update_post_meta( $post_id, '_download_type', '');
    update_post_meta( $post_id, '_product_image_gallery', '');
//produkt ferdig

/*Til slutt for å avslutte tidenes lengste funksjon...*/

//echo do_shortcode('[product sku="'.$sku.'"]');
                //Oppdatere brukeren sitt tlf nummer

              $tlfFraPost = $row['Telefon'];
                $tlfFraProfil = get_user_meta($user_id, 'phone', true);
                if(!empty(trim($tlfFraPost)))
                {
                    if($tlfFraPost === $tlfFraProfil){
                        //echo('Ingenedirnger tlf gammelt:' . $tlfFraProfil . "nytt" . $tlfFraPost);
                    }else{
                        //echo'oppdaterer tlf gammel' . $tlfFraProfil . "nytt" . $tlfFraPost;
                        update_user_meta($user_id, 'phone', $tlfFraPost);
                    }

                }


                /*Lager en cookie som sjekker om mailen er sendt, den slettes igjen når brukeren går for å lage et nytt tilbud



                */


/*Send mail til han som la ut spillejoben*/
    $postKunde = $row['Listing ID'];
     $post_author_id = get_post_field( 'post_author', $postKunde );
    $mailadresse = get_the_author_meta('user_email', $post_author_id);
    $kundenavn =  get_the_author_meta('first_name', $post_author_id);

   $melding = "
   Hei ".$kundenavn.",".
   $row['Artistnavn'] . ' har gitt deg et tilbud på ' . $row['Tittel på arrangement'] .". Logg deg inn på RÊVENT for å lese og godta tilbudet.";

   wp_mail($mailadresse, 'Nytt tilbud på RÊVENT', $melding);
    setcookie("mailsendt", "sent", time()+31536000,'/');

    /*Mailscrip ferdig*/

    //&echo'cookie satt og mail sent';

                //Vi må sjekke om mailen inneholder ikke lovlige ord


                $inneholdUlovlig = false;
                $ulovligordarray = ["@",".no",".com","www","http"];
                $antUlvORd = count($ulovligordarray);

                echo 'ant ulovleig ord' . $antUlvORd;

                for ($i = 0;$i < $antUlvORd;$i++){
                    echo 'i for løkka';

                    $ord = $ulovligordarray[$i];
                    if (strpos($innholdITilbud,$ord) !== false) {
                        echo "inneholder " . $ord;
                        $inneholdUlovlig = true;
                    }
                }





}


}

  	}
}






//echo "<h1>Dersom du har tilbud som har utløpt kan de vises nedenfor</h1>";
//echo  "<input type='button' id='skjulBtn' value='Vis/skjul'/> ";

//echo "<div id='skjul' style='display:none'>";
	//tilbud som  har utløpt


	?>


	<?php get_job_manager_template( 'pagination.php', array( 'max_num_pages' => $max_num_pages ) ); ?>



</div>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.2.min.js"></script>

<script type="text/javascript">


$("#skjulBtn").click(function(){
    $("#skjul").toggle();
});

</script>



<?php
//lage produktet




?>
















		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'page' ); ?>

			<?php if ( comments_open() || '0' != get_comments_number() ) : ?>
				<?php comments_template( '', true ); ?>
			<?php endif; ?>

		<?php endwhile; // end of the loop. ?>
</div>
	</div><!-- #content .site-content -->
</div><!-- #primary .content-area -->



<?php get_sidebar(); ?>
<?php get_footer(); ?>


