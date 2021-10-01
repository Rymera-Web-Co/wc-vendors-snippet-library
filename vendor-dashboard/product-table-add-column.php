<?php 

/**
 * WC Vendors Pro
 * 
 * Add a column to the Vendor Dashboards Product table. 
 * 
 * There are two filters you will need to hook into. 
 * wcv_product_table_columns 
 * wcv_product_table_rows
 */

/**
 * Add the new column the product table
 */
add_filter( 'wcv_product_table_columns', 'wcv_add_product_column' ); 
function wcv_add_product_column( $columns ){ 
	$columns = array(
		'ID'      => __( 'ID', 'wcvendors-pro' ),
		'tn'      => __( '<i class="wcv-icon wcv-icon-image"></i>', 'wcvendors-pro' ),
		'details' => __( 'Details', 'wcvendors-pro' ),
		'stock_status' => __( 'Stock Status', 'wcvendors-pro'), 
		'price'   => __( '<i class="wcv-icon wcv-icon-shopping-cart"></i>', 'wcvendors-pro' ),
		'status'  => __( 'Status', 'wcvendors-pro' ),
	);
	return $columns; 
}

/**	
 *  Hook into the row data to add the new column data.
 * 
 *  The row is a std Object and adding a property 
 *  that is the same name as the column array key
 * 
 */
add_filter( 'wcv_product_table_rows', 'wcv_add_product_row_data' ); 
function wcv_add_product_row_data( $rows ){ 
	$stock_status = wc_get_product_stock_status_options(); 
	foreach ($rows as $key => $row) {
		// You would add your query related to the product here.
		// $row->ID is the $products post ID.
		$product = wc_get_product( $row->ID ); 
		$row->stock_status = $stock_status[ $product->get_stock_status() ] . '<br />'; 
	}

	return $rows; 
}