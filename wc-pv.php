<?php
/**
 * Phone Validator for WooCommerce
 *
 * @package PluginPackage
 * @author Yousif Ward
 * @copyright 2024 Yousif Ward & CodeExplorer
 * @license GPL-3.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name: WooCommerce Phone Validator
 * Plugin URI: https://1os.dev
 * Description: Phone Validator for WooCommerce validates the number per country basis.
 * Author: Yousif Ward
 * Author URI: https://1os.dev
 * Version: 2.0
 * Requires at least: 5.0
 * Tested up to: 6.6
 * WC requires at least: 3.0
 * WC tested up to: 9.2
 * 
 * Text Domain: woo-phone-validator
 * Domain Path: /languages
 */

if ( !defined('ABSPATH') ) {
    exit;
}
//make sure you update the version values when necessary
define( 'WC_PV_PLUGIN_DIR',  plugin_dir_path( __FILE__ ) );
define( 'WC_PV_PLUGIN_FILE', __FILE__ );
define( 'WC_PV_TEXT_DOMAIN', 'woo-phone-validator' );
define( 'WC_PV_PLUGIN_VERSION', '1.2.1' );

/**
 * Environment, should be either test or production
 * Note: if youre on localhost, even if you change this constant to production, it'll still use test :)
 */
$_wc_pv_env = 'production';

if ( isset( $_SERVER['SERVER_NAME'] ) && strpos( $_SERVER['SERVER_NAME'], 'localhost' ) !== false || ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) )
    $_wc_pv_env = 'test';

define( 'WC_PV_ENVIRONMENT', $_wc_pv_env );

//for global option meta access :)
//$wc_pv_option_meta = array();
//custom fields names
$wc_pv_woo_custom_field_meta = array(
    'billing_hidden_phone_field' =>'_wc_pv_phone_validator',
    'billing_hidden_phone_err_field'=>'_wc_pv_phone_validator_err',
);
// include dependencies file
if(!class_exists('WC_PV_Dependencies')){
    include_once dirname(__FILE__) . '/includes/class-wc-pv-deps.php';
}
// Include the main class.
if(!class_exists('WC_PV')){
    include_once dirname(__FILE__) . '/includes/class-wc-pv.php';
}
function wc_pv(){
    return WC_PV::instance();
}
add_action( 'before_woocommerce_init', 'before_woocommerce_hpos' );
function before_woocommerce_hpos() { 
    if ( class_exists( \Automattic\WooCommerce\Utilities\FeaturesUtil::class ) ) { 
       \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true ); 
   } 
}
$GLOBALS['wc_pv'] = wc_pv();
