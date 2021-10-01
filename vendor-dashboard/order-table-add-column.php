<?php 

/**
 * WC Vendors Pro
 * 
 * Add a column to the Vendor Dashboards orders table. 
 * 
 * There are two filters you will need to hook into. 
 * wcv_orders_table_columns 
 * wcv_orders_table_rows
 */

/**
 * Add the new column the orders table
 */
add_filter( 'wcv_orders_table_columns', 'wcv_add_orders_column' ); 
function wcv_add_orders_column( $columns ){ 
	$columns = [
		'ID'           => __( 'ID', 'wcvendors-pro' ),
        'order_number' => __( 'Order', 'wcvendors-pro' ),
        'customer'     => __( 'Customer', 'wcvendors-pro' ),
        'products'     => __( 'Products', 'wcvendors-pro' ),
        'order_notes'  => __( 'Customer Notes', 'wcvendors-pro' ),
        'total'        => __( 'Total', 'wcvendors-pro' ),
        'status'       => __( 'Shipped', 'wcvendors-pro' ),
        'order_date'   => __( 'Order Date', 'wcvendors-pro' ),
    ];
	return $columns; 
}

/**	
 *  Hook into the row data to add the new column data.
 * 
 *  The row is a std Object and adding a property 
 *  that is the same name as the column array key
 */
add_filter( 'wcv_orders_table_rows', 'wcv_add_orders_row_data' ); 
function wcv_add_orders_row_data( $rows ){ 
	foreach ( $rows as $key => $row) {
		// You would add your query related to the orders here.
		// $row->ID is the $orders post ID.
		$order = wc_get_order( $row->ID ); 
		$row->order_notes = $order->get_order_notes(); 
	}

	return $rows; 
}