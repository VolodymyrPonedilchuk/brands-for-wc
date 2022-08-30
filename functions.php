<?php

// Enqueue image uploader script
function image_uploader_enqueue_script() {
	global $typenow;
	//print_r($typenow);
    if( ($typenow == 'product') ) {
        wp_enqueue_media();
        $media_uploader_url = plugin_dir_url( __FILE__ ) . 'js/media-uploader.js';
       
        wp_register_script( 'meta-image', $media_uploader_url, array( 'jquery' ) );
        wp_localize_script( 'meta-image', 'meta_image',
            array(
                'title' => 'Upload an Image',
                'button' => 'Use this Image',
            )
        );
        wp_enqueue_script( 'meta-image' );
    }
}
add_action( 'admin_enqueue_scripts', 'image_uploader_enqueue_script' );



function custom_page_title_for_brand_page() {
    
    if(get_query_var('brand_id')){
        $distillery_title = get_query_var('brand_id');

        $distillery_title = get_term_by('slug', $distillery_title, 'pa_brand' );

        $page_title = $distillery_title->name . __(' distillery', 'brandsforwc');
        echo "<title>$page_title</title>";
    }
   
}
add_action( 'wp_head', 'custom_page_title_for_brand_page', 0 );
