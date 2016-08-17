<?php
add_action('admin_init', 'sponsor_opt_init');
add_action('admin_menu', 'sponsor_opt_page');

function sponsor_opt_init(){
	register_setting('sponsor_opt_options', 'sponsor_opt', 'sponsor_opt_validate');
}
function sponsor_opt_page(){
	add_options_page('Sponsor (Optionen)', 'Sponsoring', 'manage_options', 'sponsor_opt', 'sponsor_opt_initpage');
}
function sponsor_opt_initpage(){
	?>
	<div class="wrap">
		<h2>Einstellungen &rsaquo; Sponsoring</h2>
		<form method="post" action="options.php">
			<?php settings_fields('sponsor_opt_options'); ?>
			<?php $options = get_option('sponsor_opt'); ?>
			<h2 class="title">Allgemein</h2>
			<table class="form-table">
				<tr>
					<th>Sende Bestätigung</th>
					<td><input type="text" name="sponsor_opt[agb]" value="<?php echo $options['agb']; ?>" class="large-text" required></td>
				</tr>
			</table>
			<h2 class="title">E-Mail</h2>
			<table class="form-table">
				<tr>
					<th>Empfänger</th>
					<td><input type="email" name="sponsor_opt[email]" value="<?php echo $options['email']; ?>" required></td>
				</tr>
				<tr>
					<th>Betreff</th>
					<td><input type="text" name="sponsor_opt[betreff]" value="<?php echo $options['betreff']; ?>" required></td>
				</tr>
			</table>
			<h2 class="title">Sponsoringstufen</h2>
			<table class="form-table">
				<tr>
					<th>Goldsponsor</th>
					<td>CHF <input type="text" name="sponsor_opt[goldsponsor]" value="<?php echo $options['goldsponsor']; ?>" required></td>
				</tr>
				<tr>
					<th>Silbersponsor</th>
					<td>CHF <input type="text" name="sponsor_opt[silbersponsor]" value="<?php echo $options['silbersponsor']; ?>" required></td>
				</tr>
				<tr>
					<th>Bronzesponsor</th>
					<td>CHF <input type="text" name="sponsor_opt[bronzesponsor]" value="<?php echo $options['bronzesponsor']; ?>" required></td>
				</tr>
			</table>
			<h2 class="title">Meldungen</h2>
			<table class="form-table">
				<tr>
					<th>Formular Fehlerhaft</th>
					<td><input type="text" name="sponsor_opt[error]" value="<?php echo $options['error']; ?>" class="large-text" required></textarea></td>
				</tr>
				<tr>
					<th>Übertragung Erfolgreich</th>
					<td><input type="text" name="sponsor_opt[success]" value="<?php echo $options['success']; ?>" class="large-text" required></textarea></td>
				</tr>
			</table>
			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e('Save Changes'); ?>">
			</p>
		</form>
	</div>


	<?php
}

function sponsor_opt_validate($input){
	$input['goldsponsor'] = wp_filter_nohtml_kses($input['goldsponsor']);
	$input['silbersponsor'] = wp_filter_nohtml_kses($input['silbersponsor']);
	$input['bronzesponsor'] = wp_filter_nohtml_kses($input['bronzesponsor']);
	$input['error'] = wp_filter_nohtml_kses($input['error']);
	$input['success'] = wp_filter_nohtml_kses($input['success']);

	return $input;
}
?>