<?php
add_action('wp_ajax_sponsor_sendmail', 'sponsor_sendmail');
add_action('wp_ajax_nopriv_sponsor_sendmail', 'sponsor_sendmail');
function sponsor_sendmail() {

	$return = array();
	$options = get_option('sponsor_opt');
	if(
		!empty($_POST['firma']) && 
		!empty($_POST['adresse1']) && 
		!empty($_POST['tel']) && 
		!empty($_POST['mail']) &&
		filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)
	):
		$mailcontent = file_get_contents(__DIR__."/mailcontent.php");
		$mailcontent = str_replace("{FIRMA}", $_POST['firma'], $mailcontent);
		$mailcontent = str_replace("{ADRESSE1}", $_POST['adresse1'], $mailcontent);
		$mailcontent = str_replace("{ADRESSE2}", $_POST['adresse2'], $mailcontent);
		$mailcontent = str_replace("{MAIL}", $_POST['mail'], $mailcontent);
		$mailcontent = str_replace("{TELEFON}", $_POST['tel'], $mailcontent);
		$mailcontent = str_replace("{VBCPERSON}", $_POST['vertreter'], $mailcontent);
		$mailcontent = str_replace("{BEMERKUNG}", $_POST['bemerkung'], $mailcontent);

		$pakete = "";
		$total = "";
		$gold = $options['goldsponsor'];
		$silber = $options['silbersponsor'];
		$bronze = $options['bronzesponsor'];

		foreach($_POST['sponsor-checkbox'] as $index => $value){
			$i++;
			$post = get_post($value);
			$price = $_POST[$post->ID];
			$total = $total + $price;
			if($i % 2 != 0){ $pakete .= '<tr><td class="bezeichnung">'.$post->post_title.'</td><td class="preis">'.$price.'.-</td></tr>'; }
			else{ $pakete .= '<tr class="ungerade"><td class="bezeichnung">'.$post->post_title.'</td><td class="preis">'.$price.'.-</td></tr>'; }
			
		}
		$mailcontent = str_replace("{PAKETE}", $pakete, $mailcontent);
		$mailcontent = str_replace("{TOTAL}", $total, $mailcontent);

		switch($total){
			case $total >= $gold:
				$mailcontent = str_replace('{SPONSORTYP}', '<td class="goldsponsor">Goldsponsor</td>', $mailcontent);
				break;
			case $total >= $silber:
				$mailcontent = str_replace('{SPONSORTYP}', '<td class="silbersponsor">Silbersponsor</td>', $mailcontent);
				break;
			case $total >= $bronze:
				$mailcontent = str_replace('{SPONSORTYP}', '<td class="bronzesponsor">Bronzesponsor</td>', $mailcontent);
				break;
			default:
				$mailcontent = str_replace('{SPONSORTYP}', '<td></td>', $mailcontent);
		}

		if($_POST['sponsor-kontakt'] == 1){$mailcontent = str_replace("{KONTAKT}", '<br><b>Bitte nehmen Sie mit mir Kontakt auf.</b>', $mailcontent);}
		else{$mailcontent = str_replace("{KONTAKT}", '', $mailcontent);}


		add_filter('wp_mail_content_type',create_function('', 'return "text/html"; '));
		wp_mail($options['email'], $options['betreff'], $mailcontent);
		$return['status'] = 1;
		$return['meldung'] = $options['success'];
	else:
		$return['meldung'] = $options['error'];
		$return['status'] = 0;
		
		if(!empty($_POST['firma'])){ $return['firma'] = 1; }
		if(!empty($_POST['adresse1'])){ $return['adresse1'] = 1; }
		if(!empty($_POST['tel'])){ $return['tel'] = 1; }
		if(!empty($_POST['mail']) && filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){ $return['mail'] = 1; }
	endif;

	$return = json_encode($return);
	echo $return;
	die();
}

?>