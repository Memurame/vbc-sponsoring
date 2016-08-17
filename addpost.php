<?php
/*################################################
* Beitrag erstellung
#################################################*/
add_action( 'add_meta_boxes', 'sponsor_metabox' );
add_action( 'save_post', 'sponsor_save' );
add_action( 'admin_init', 'posts_order_wpse_91866' );

function posts_order_wpse_91866() 
{
    add_post_type_support( 'sponsor', 'page-attributes' );
}
function sponsor_metabox(){
  add_meta_box(
    'sponsor_metabox',
    'Preis Gestaltung',
    'sponsor_metabox_render',
    'sponsor',
    'side',
    'high'
  );
}
 
function sponsor_metabox_render( $post ){

	wp_nonce_field( 'wirrwarr', 'sponsor_nonce' );
  ?>
  	<div id="sponsor-metabox">
	    <label for="price">Preis:</label>
	    <input type="text" id="price" value="<?php echo esc_attr( urldecode( get_post_meta( $post->ID, '_price', true ) ) ); ?>" name="price" />
	    <p>Um einen fixen Preis fest zulegen muss ein Preis eingetragen werden. Wurde kein Preis eingetragen so hat der Sponsor die Möglichkeit einen Individuellen Preis anzugeben.</p>
	  </div>
  <?php
}


function sponsor_save( $post_id ){
  if(
    ! isset( $_POST['sponsor_nonce'] ) ||
    ! wp_verify_nonce( $_POST['sponsor_nonce'], 'wirrwarr' ) || 
    ! isset( $_POST['price'] )  ||
    wp_is_post_revision( $post_id )
  )
    return;

  update_post_meta( $post_id, '_price', $_POST['price'] );
}
?>