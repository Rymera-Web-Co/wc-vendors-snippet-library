<?php 
/**
 * Hook into the wp_editor() in the dashboard
 * Set the editor to read only. 
 * 
 * WC Vendors Pro uses the teeny editor so we must use 
 * teeny_mce_before_init and ensure this only runs 
 * on the dashboard page we require. 
 */

 /**
  * Hook into the product edit template 
  */
add_action( 'wcv_before_product_details', 'wcv_set_editor_readonly' );
function wcv_set_editor_readonly(){
	// Add your extra checks here. 

	// Set the editor to readonly. 
	add_filter( 'teeny_mce_before_init', function( $args ) {
		$args['readonly'] = 1;
		return $args;
	} );
}