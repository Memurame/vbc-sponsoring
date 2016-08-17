<?php
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) { exit(); }
if( !WP_UNINSTALL_PLUGIN ){	exit(); }
 
// Alle einstellungen löschen
delete_option('sponsor_opt');


// alle Beiträge löschen vom Sponsorplugin
$args = array(
	'numberposts' => 100,
	'post_type' =>	'sponsor'
);
$posts = get_posts( $args );
if (is_array($posts)) {
   foreach ($posts as $post) {
       wp_delete_post( $post->ID, true);
   }
}
?>