<?php
define( 'SPONSOR_FILE', __FILE__ );
define( 'SPONSOR_URL', plugins_url( '', __FILE__ ));
define( 'SPONSOR_SRV', plugin_dir_path( __FILE__ ));

add_action('wp_enqueue_scripts', 'sponsor_enqueue_scripts');
add_action('wp_enqueue_scripts', 'sponsor_enqueue_style');
function sponsor_enqueue_scripts(){
	wp_enqueue_script('sponsoring_jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js');
	wp_enqueue_script('sponsoring_script', SPONSOR_URL . '/js/script.js', array("jquery"));
	wp_localize_script( 'sponsoring_script', 'the_ajax_script', array( 'ajaxurl' => admin_url('admin-ajax.php' )) );	
}
function sponsor_enqueue_style(){
	wp_enqueue_style('sponsoring_style', SPONSOR_URL . '/css/sponsoring.css');
}

/*################################################
* Adminlink
#################################################*/
add_action( 'init', 'sponsor_adminlink' );
function sponsor_adminlink(){
  $args = array(
          'labels'         => array( 
          	'name' =>	'Sponsoring',
          	'add_new_item' => 'Neue Sponsoringkategorie'),
          'public'        => true,
          'supports'      => array( 'title' )
  );
  register_post_type( 'sponsor', $args );
}

?>