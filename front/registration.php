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