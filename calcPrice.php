<?php
add_action( 'wp_ajax_sponsor_calcPrice', 'sponsor_calcPrice' );
add_action( 'wp_ajax_nopriv_sponsor_calcPrice', 'sponsor_calcPrice' );
function sponsor_calcPrice() {

	$return = array();
	$options = get_option('sponsor_opt');
	$gold = $options['goldsponsor'];;
	$silber = $options['silbersponsor'];;
	$bronze = $options['bronzesponsor'];;


	foreach($_POST['sponsor-checkbox'] as $index => $value){
		$post = get_post($value);
		$price = $_POST[$post->ID];
		if(!empty($price)){
			$return["total"] = $return["total"] + $price;
		}
		
	}
	if( $return["total"] >= $gold ){
			$return["typ"] = '<span class="sponsor-gold">Goldspondsor</span>';
	} elseif( $return["total"] >= $silber ){
			$rest = $gold - $return["total"];
			$return["typ"] = '<span class="sponsor-silber">Silbersponsor</span> noch '.$rest.'.- bis Goldsponsor';
	} elseif( $return["total"] >= $bronze ){
			$rest = $silber - $return["total"];
			$return["typ"] = '<span class="sponsor-bronze">Bronzesponsor</span> noch '.$rest.'.- bis Silbersponsor';
	} else{
			$rest = $bronze - $return["total"];
			$return["typ"] = 'noch '.$rest.'.- bis Bronzesponsor';
	}
	if(!isset($_POST['sponsor-checkbox'])){$return["typ"] = 'noch '.$bronze.'.- bis Bronzesponsor'; $return["total"] = 0;}
	$return = json_encode($return);
	echo $return;
	die();
}

?>