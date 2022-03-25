<?php
/**
 * WC Vendors Pro
 * 
 * Hide the "Everywhere else" option in the countries dropdown. 
 * 
 * There a filter you will need to hook into. 
 * wcvendors_shipping_table_regions 
 */

if ( ! function_exists( 'wcv_hide_everywhere_else' ) ) {

	/**
	 * Hide the "Everywhere else" option in the countries dropdown.
	 *
	 * @param  array $regions Array of countries.
	 */
	function wcv_hide_everywhere_else( $regions ) {
		unset( $regions['EWE'] );
		return $regions;
	}

	add_filter( 'wcvendors_shipping_table_regions', 'wcv_hide_everywhere_else', 10, 1 );
}