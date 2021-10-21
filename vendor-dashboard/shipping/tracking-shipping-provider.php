<?php 
/** 
 * WC Vendors Pro 
 * 
 * Shipping tracking providers can be added or removed from the 
 * shipping provider or country from tracking number on
 * the vendor dashboard. 
 * 
 * Filter used: wcv_shipping_providers_list 
 */

 /**
  * Add a country and shipping provider 
  */
/**
*  Add more shipping providers from France for vendors to select from 
*/
add_filter( 'wcv_shipping_providers_list', 'wcv_add_custom_shipping_providers' );
function wcv_add_custom_shipping_providers( $providers ){
 
    $providers['New France'] = array(
      'Colissimo' => 'https://www.laposte.fr/particulier/outils/suivre-vos-envois?code=%1$s',
      'Chronopost' => 'http://www.chronopost.fr/expedier/inputLTNumbersNoJahia.do?listeNumeros=%1$s',
      'DHL France' => 'http://www.dhl.fr/publish/fr/fr/eshipping/track.high.html?pageToInclude=RESULTS&type=trackindex&brand=I&AWB=%1$s',
      'UPS' => 'http://wwwapps.ups.com/etracking/tracking.cgi?loc=fr_FR&TypeOfInquiryNumber=T&InquiryNumber1=%1$s',
      'FEDEX' => 'http://fedex.com/Tracking?ascend_header=1&clienttype=dotcomreg&cntry_code=fr&language=french&tracknumbers=%1$s',
      'TNT' => 'http://www.tnt.fr/public/suivi_colis/recherche/visubontransport.do?radiochoixrecherche=BT&bonTransport=%1$s',
      'Mondial Relay' => 'http://www.mondialrelay.fr/public/mr_suivi.aspx?cab=%1$s',
      'Lettre Suivie' => 'https://www.laposte.fr/particulier/outils/suivre-vos-envois?code=%1$s',
    );
   
    return $providers;
}
   
/**
 * Remove a specific shipping provider from the tracking number dropdown
 */
add_filter( 'wcv_shipping_providers_list', 'wcv_remove_shipping_provider' );
function wcv_remove_shipping_provider( $providers ){
    unset( $providers['Australia']['Autralia Post']);
    return $providers;
}

/**
 * Remove a country and all providers from that country from the tracking number dropdown
 */
add_filter( 'wcv_shipping_providers_list', 'wcv_remove_country_shipping_provider' );
function wcv_remove_country_shipping_provider( $providers ){
    unset( $providers['Australia'] );
    return $providers;
}