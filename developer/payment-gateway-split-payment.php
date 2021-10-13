<?php 
/**
 * The purpose of this file is to provide an example for how you would 
 * split a payment when creating a payment gateway. 
 */

/**
 * Process a split payment 
 *
 * @param WC_Order $order the order to process the split payment 
 * @return void
 */
public function process_split_payment( $order ){
    // Track which vendors in the order have been paid
    $vendors_paid  = array();
    
    $coupons         = $order->get_items( 'coupon' );
    $commission_type = get_option( 'wcvendors_commission_type', '' );
    $commission_rate = get_option( 'wcvendors_vendor_commission_rate', '' );
    
    /**
     * Process the vendor charges first 
     */
    $vendors_due = WCV_Vendors::get_vendor_dues_from_order( $order, false );
    foreach ( $vendors_due as $vendor_id => $products ) {
        // if this is the admin do nothing. 
        if ( $vendor_id == 1 ) {
            continue;
        }

        $product_admin_fee = 0;
        // Marketplace half of the products commission 
        $total_admin_fee   = 0;
        // Vendor payout total 
        $total             = 0;

        // Get the totals
        foreach ( $products as $key => $product ) {
            $product_owner     = WCVendors_Pro_Vendor_Controller::get_vendor_from_object( $product['product_id'] );
            $product_admin_fee = $vendors_due[1][ $key ]['total'];
            $add_admin_fee     = ( 'percent' != $commission_type && 100 > $commission_rate ) ? true : false;

            if ( empty( $coupons ) || $add_admin_fee ) {
                $total_admin_fee += $product_admin_fee;
            }
            $total += ( $product['total'] + $product_admin_fee );
            unset( $vendors_due[1][ $key ], $vendors_due[ $vendor_id ][ $key ] );
            $vendors_paid[ $vendor_id ][] = array(
                'product_id' => $product['product_id'],
                'order_id'   => $order->get_id(),
            );				
        }

        $cart_fees = $this->get_cart_fees();
        // Cart fees are sent to the marketplace 
        $total_admin_fee += $cart_fees;

        // If there is no commission to pay, skip.
        if ( $total <= 0 ) {
            continue;
        }

        /**
         * You will need to process your split payments to the platform here. 
         * The method here is a dummy method to represent your platforms API 
         * 
         * This is where you would confirm the process was successful 
         */

        $payment = $this->process_platform_split( $total, $total_admin_fee, $order ); 
    }

    /**
     * Process any remaining marketplace charges and 
     * send them to the platform
     */
    $total = 0;

    foreach ( $vendors_due as $vendor_id => $products ) {
        foreach ( $products as $product_id => $product ) {
            $total += $product['total'];
            unset( $vendors_due[ $vendor_id ][ $product_id ] );
        }
    }



    /**
     * You will need to process your remaining marketplace due payments to the platform here. 
     * The method here is a dummy method to represent your platforms API 
     * 
     * This is where you would confirm the process was successful 
     */
    $payment = $this->process_platform_payment( $total, $order ); 

    // Log the commissions paid 
    $this->log_commission( $vendors_paid );

    // Return payment platform response  
    return (object) array(
        'vendors_paid' => $vendors_paid,
    );
}

/**
 * Log the commissions as paid for the vendor
 *
 * @since 2.0.0
 * @param array $vendors_paid
 */
public function log_commission( $vendors_paid ) {
    if ( ! class_exists( 'WCV_Commission' ) ) {
        return;
    }

    foreach ( $vendors_paid as $vendor_id => $products ) {
        foreach ( $products as $product ) {
            WCV_Commission::set_vendor_product_commission_paid(
                $vendor_id,
                $product['product_id'],
                $product['order_id']
            );
        }
    }
}