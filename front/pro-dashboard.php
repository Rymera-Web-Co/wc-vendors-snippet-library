<?php
/**
 * Hooks into the dashboard page.
 */
if ( ! function_exists( 'wcv_remove_recent_order_table_columns' ) ) {

	/**
	 * Remove columns from Recent Orders table in Pro Dashboard
	 *
	 * @param  array $columns Columns of table.
	 * @return array
	 */
	function wcv_remove_recent_order_table_columns( $columns ) {
        //Remove commission column
		unset( $columns['commission'] );
		return $columns;
	}

	add_filter( 'wcvendors_recent_order_table_columns', 'wcv_remove_recent_order_table_columns', 10, 1 );
}

if ( ! function_exists( 'wcv_remove_recent_product_table_columns' ) ) {

	/**
	 * Remove columns from Recent Products table in Pro Dashboard
	 *
	 * @param  array $columns Columns of table.
	 * @return array
	 */
	function wcv_remove_recent_product_table_columns( $columns ) {
        //Remove Status column
		unset( $columns['status'] );
		return $columns;
	}

	add_filter( 'wcvendors_recent_product_table_columns', 'wcv_remove_recent_product_table_columns', 10, 1 );
}