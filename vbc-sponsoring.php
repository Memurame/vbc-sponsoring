  <?php
/*
Plugin Name: VBC Sponsoring
Description: Plugin um die Sponsoring anfragen eleganter zu gestalten und dem zukünftigen Sponsor direkt anzuzeigen wieviel er bereits ausgewählt hat und wieviel noch nötig ist bis zur nächsten Sponsoring stufe.
Version: 0.6.8
Author: Tom Hirter
Author URI: http://thomas-hirter.ch

*/

require 'plugin-update-checker/plugin-update-checker.php';
$className = PucFactory::getLatestClassVersion('PucGitHubChecker');
$myUpdateChecker = new $className(
    'https://github.com/n30nl1ght/vbc-sponsoring/',
    __FILE__,
    'master'
);

require_once("einstellungen.php");

require_once("init.php");

require_once("addpost.php");

require_once("sendmail.php");
require_once("calcPrice.php");
 
require_once("output.php");
?>