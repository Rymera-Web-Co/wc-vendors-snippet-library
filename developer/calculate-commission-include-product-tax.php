<?php
/**
 * Calculate commission
 *
 * @param float    $commission Commission.
 * @param int      $product_id The product ID.
 * @param float    $product_price Product price.
 * @param WC_Order $order the order.
 * @param int      $qty Product qty.
 */
function wcv_calculate_commission_include_product_tax( $commission, $product_id, $product_price, $order, $qty ) {

	$product                   = new WC_Product( $product_id );
	$product_price_include_tax = wc_get_price_including_tax( $product );
	$commission_rate           = WCV_Commission::get_commission_rate( $product_id );
	$commission                = $product_price_include_tax * ( $commission_rate / 100 );

	// if there is a negative number then make it 0.
	if ( $commission < 0 ) {
		$commission = 0;
	}

	// Round commission so it doesn't break gateways.
	$commission = round( $commission, 2 );

	// Return commission.
	return $commission;
}
add_filter( 'wcvendors_commission_rate', 'wcv_calculate_commission_include_product_tax', 10, 5 );
