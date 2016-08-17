<?php
/*################################################
* Formular ausgabe
#################################################*/
add_shortcode( 'sponsoring', 'sponsor_formular' ); 
function  sponsor_formular() {
	ob_start();
	$options = get_option('sponsor_opt');

	if($options): 
	?>
  <div class="sponsor-container">
  	<div id="sponsor-alert"></div>
  	<form method="post" id="sponsorForm">
  		<div class="sponsor-formular">
	  		<label for="firma">Sponsor / Firmenname <span>*</span></label>
	  		<input type="text" name="firma" id="sponsor-input-firma">

	  		<label for="adresse1">Sponsorenadresse <span>*</span></label>
	  		<textarea rows="3" name="adresse1" id="sponsor-input-adresse1"></textarea>

	  		<label for="adresse2">Rechnungsadresse</label>
	  		<textarea rows="3" name="adresse2" id="sponsor-input-adresse2"></textarea>

	  		<label for="tel">Telefon <span>*</span></label>
	  		<input type="text" name="tel" id="sponsor-input-telefon">

	  		<label for="mail">E-Mail <span>*</span></label>
	  		<input type="email" name="mail" id="sponsor-input-mail">

	  		<label for="bemerkung">Bemerkung</label>
	  		<textarea rows="7" name="bemerkung" id="sponsor-input-bemerkung"></textarea>

	  		<label for="vertreter">Kontaktperson VBC Aeschi</label>
	  		<input type="text" name="vertreter" id="sponsor-input-vertreter">
  		</div>
	  	<div class="sponsor-pakete">
	  		<div class="sponsor-row">
	  			<div><input type="checkbox" name="sponsor-kontakt" value="1"> <b>Bitte kontaktieren Sie mich / uns für ein persönliches Gespräch</b></div>
	  		</div>
	  		<?php
		  	$posts = get_posts( array( 
		      'numberposts'  =>  30, 
		      'post_type' => 'sponsor',
		      'orderby'	=>	'menu_order'
		    ) );
		    foreach($posts as $index => $value){
		    	echo '<div class="sponsor-row">';
		      echo '<div><input type="checkbox" name="sponsor-checkbox[]" value="'.$value->ID.'"> '.$value->post_title.'</div>';
		      if(empty(get_post_meta($value->ID, '_price', true))){
		      	echo '<div><input type="text" class="sponsor-input sponsor-price"  name="'.$value->ID.'" post="'.$value->ID.'"></div>';
		      } else {
		      	echo '<div><input type="hidden" name="'.$value->ID.'" class="sponsor-price" value="'.get_post_meta($value->ID, '_price', true).'" post="'.$value->ID.'">';
		      	echo get_post_meta($value->ID, '_price', true).'.-</div>';
		      }
		      echo '</div>';
		    }
				?>
				
	  	</div>
	  	
	  	<div class="sponsor-info">
	  		<div id="sponsor-sponsoringStufe">noch <?php echo $options['bronzesponsor']; ?>.- bis Bronzesponsor</div>
				<div><span id="sponsor-sponsoringTotal">0</span>.-</div>

	  	</div>
			<br>
			<div>
				<input type="checkbox" id="agb" name="agb"> <span class="agb"><?php echo $options['agb']; ?></span>
				<button class="sponsor-btn" id="sponsor-btn-senden" type="submit" disabled>Formular Senden</button>
			</div>
		</form>
  </div>
  <?php
  else:
  	echo'<a href="'.get_site_url().'/wp-admin/options-general.php?page=sponsor_opt"><h2>Plugin Einstellungen jetzt eintragen! (Klicken)</h2></a>';
  endif;
  $output = ob_get_clean();
  return $output;
}
?>