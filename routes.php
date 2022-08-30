<?php 
// Create routing
add_action( 'init', 'create_route_for_brand_page' );
function create_route_for_brand_page(){
    add_rewrite_rule(
        '^brands/([a-zA-Z0-9_-]+)/?$',
        'index.php?pagename=brands&brand_id=$matches[1]',
        'top' );
}


// Query vars 
add_filter( 'query_vars', 'brand_page_query_vars' );
function brand_page_query_vars( $query_vars ){
    $query_vars[] = 'brand_id';
    return $query_vars;
}

// Set template path
add_filter('template_include', 'set_barnds_template_path');
function set_barnds_template_path($template){

    if(get_query_var('brand_id')){
        global $wp_query;
        $wp_query->is_404 = false;
        status_header(200);
        //print_r($wp_query->query['pagename']);
        
        // path to the template file
        $new_template =  untrailingslashit( plugin_dir_path( __FILE__ ) ) . '/templates/page-brands.php';

        if(file_exists($new_template)){
            $template = $new_template;
        } 
    }    

    return $template;    

}