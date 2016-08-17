  <?php
/*
Plugin Name: VBC Sponsoring
Description: Plugin um die Sponsoring anfragen eleganter zu gestalten und dem zukünftigen Sponsor direkt anzuzeigen wieviel er bereits ausgewählt hat und wieviel noch nötig ist bis zur nächsten Sponsoring stufe.
Version: 0.6.5
Author: Tom Hirter
Author URI: http://thomas-hirter.ch

*/
require 'plugin-update-checker/plugin-update-checker.php';
$MyUpdateChecker = PucFactory::buildUpdateChecker(
'https://wpupdate.thomas-hirter.ch/?action=get_metadata&slug=vbc-sponsoring', //Metadata URL.
__FILE__, //Full path to the main plugin file.
'plugin-directory-name' //Plugin slug. Usually it's the same as the name of the directory.
);
require_once("einstellungen.php");

require_once("init.php");

require_once("addpost.php");

require_once("sendmail.php");
require_once("calcPrice.php");
 
require_once("output.php");
?>