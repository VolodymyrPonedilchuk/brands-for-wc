<?php
/*
Plugin Name: Brands for WC
Description: Add Brands functionality
Version: 1.0
Author: Volodymyr Ponedilchuk
*/


// Create route and Flush rewright rules after plugin activation
function brandsforwc_activate() {
    add_rewrite_rule(
        '^brands/([a-zA-Z0-9_-]+)/?$',
        'index.php?pagename=brands&brand_id=$matches[1]',
        'top' );
    flush_rewrite_rules();
}
register_activation_hook( __FILE__ , 'brandsforwc_activate' );

// Flush rewright rules on plugin deactivation
function brandsforwc_deactivate() {
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__ , 'brandsforwc_deactivate' );

// Create Routes
include_once('routes.php');

// Plugin functions.
include_once('functions.php');

// Add custom fields.
include_once('custom-fields.php');

