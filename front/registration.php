<?php 
/**
 * Hook into the vendor registration form on the my-account page
 */

/**
 * Add a notice before the apply to be a vendor checkbox on the registration page.
 */
add_action( 'wcvendors_login_apply_for_vendor_before', 'wcv_add_vendor_registration_note' );
function wcv_add_vendor_registration_note(){ 
?>
<p>This is a notice that you can display before the apply to be a vendor checkbox.</p>
<?php
}

/**
 * Add CSS class to apply for vendor label in a registration
 *
 * @param  string $class CSS classes.
 * @return string
 */
function add_apply_vendor_label_css_class( $class ) {
	$class .= 'example_css_class';

	return $class;
}
add_filter( 'wcvendors_vendor_registration_apply_label_css_classes', 'add_apply_vendor_label_css_class', 10, 1 );

/**
 * Add CSS class to term and condition label in a registration
 *
 * @param  string $class CSS classes.
 * @return string
 */
function add_term_label_css_class( $class ) {
	$class .= 'example_css_class';

	return $class;
}
add_filter( 'wcvendors_vendor_registration_term_label_css_classes', 'add_term_label_css_class', 10, 1 );