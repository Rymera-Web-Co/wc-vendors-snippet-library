<?php

/** Make commission table in WP Admin filterable */

// Add the column to commission table
add_filter( 'wcvendors_commissions_columns', 'wcv_test_col' );
function wcv_test_col( $columns ) {
	$columns['testcol'] = 'Test Column';
	return $columns;
}

// Hook into the column value
add_filter( 'wcvendors_commissions_column_default_testcol', 'wcv_populate_testcol', 10, 3 );
function wcv_populate_testcol( $value, $item, $column_name ) {
	// Show the commission internal ID for testing
	$value = $item->id;
	return $value;
}
