<?php 
/**
 * All snippets here are related to the Dashboard settings page
 */

/**
 * Add a tip below the store description 
 * 
 * 
 */
add_filter( 'wcvendors_settings_after_shop_description' , 'wcv_add_store_description_tip', 10, 1 );
function wcv_add_store_description_tip( ){ 
    echo "<p><strong>Tip:</strong> Your store description should outline your store's offerings. This should be no more than 50 words.</p>";
}

/**
 * Add a custom tab to your vendors settings page. 
 */

//  Add the tab to the tabs.
add_filter( 'wcv_store_tabs', 'add_custom_tab_nav' );
function add_custom_tab_nav( $tabs ){ 
	// Target is the custom css id for the content tab in the code below this
	$tabs['custom_tab'] = array( 
		'label'  => __( 'Custom', 'wcvendors-pro' ),
		'target' => 'custom-tab',
		'class'  => array(),
	); 

	return $tabs;
}

/**
 * Add the tab contents after one of the store tabs choose the tab you want this after 
 * 
 * Available actions are : 
 * 
 * wcvendors_settings_after_store_tab
 * wcvendors_settings_after_payment_tab
 * wcvendors_settings_after_branding_tab
 * wcvendors_settings_after_shipping_tab
 * wcvendors_settings_after_social_tab
 * wcvendors_settings_after_policies_tab
 * wcvendors_settings_after_seo_tab
 * 
 * To ensure this is clean we recommend including a file with your HTML mark up in it. 
 */
add_action( 'wcvendors_settings_after_seo_tab', 'wcv_custom_tab_content_after_shipping' ); 
function wcvcustom_tab_content_after_shipping(){ 
  include( 'customtab-template.php' ); 
} 

// Contents of customtab-template.php.
?>
	<div class="tabs-content" id="custom-tab">
	<h1>My custom settings tab</h1>
	<p>form elements go here</p>
	</div>
<?php 
