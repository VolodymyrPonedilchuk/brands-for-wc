<?php
/**
 * The Template for displaying all single brands
 *
 */

defined('ABSPATH') or die("Die!");

$brand_id = get_query_var('brand_id');


// hat
get_header ();

$brand = get_term_by('slug', $brand_id, 'pa_brand' );
$brand_name = $brand->name;
$all_meta = get_term_meta( $brand->term_id, $key = '', false );

$tag = get_term_by('slug', $brand_id,'post_tag');
if ($tag){
    $posts_count = $tag->count;
}else {
    $posts_count = 0;
}


if (isset($all_meta['about-distillery'][0])){
    $about_distillery = $all_meta['about-distillery'][0];
} else {
    $about_distillery =  __( 'The distillery description will appear here shortly.', 'brandsforwc' );
}

if (isset($all_meta['brand-logo'][0])){
    $logo = $all_meta['brand-logo'][0];
    $logo = "<img src='$logo' />";
}else {
    $logo = "<span class='brand-name'>$brand_name</span>";
}

if (isset($all_meta['background-image'][0])){
    $background = $all_meta['background-image'][0];
}else {
    $background = '../../wp-content/themes/Glentbotal/src/img/bg/bg-distillery.jpg';
}

if (isset($all_meta['country-field'][0])){
    $country = $all_meta['country-field'][0];
}else {
    $country = 'n/a';
}

if (isset($all_meta['region-field'][0])){
    $region = $all_meta['region-field'][0];
}else {
    $region = 'n/a';
}

if (isset($all_meta['address-field'][0])){
    $address = $all_meta['address-field'][0];
}else {
    $address =  __( 'Address is not provided.', 'brandsforwc' );
}

if (isset($all_meta['website-field'][0])){
    $website = $all_meta['website-field'][0];
    $website_link = "<a href='//$website'>$website</a>";
}else {
    $website_link =  __( 'Website is not provided.', 'brandsforwc' );
}

if (isset($all_meta['established-field'][0])){
    $established = $all_meta['established-field'][0];
}else {
    $established = 'n/a';
}

if (isset($all_meta['owner-field'][0])){
    $owner = $all_meta['owner-field'][0];
}else {
    $owner = 'n/a';
}

if (isset($all_meta['type-field'][0])){
    $type = $all_meta['type-field'][0];
}else {
    $type = 'n/a';
}

if (isset($all_meta['stills-field'][0])){
    $stills = $all_meta['stills-field'][0];
}else {
    $stills = 'n/a';
}

if (isset($all_meta['visitor-field'][0])){
    $visitor = $all_meta['visitor-field'][0];
}else {
    $visitor = 'n/a';
}

if (isset($all_meta['status-field'][0])){
    $status = $all_meta['status-field'][0];
}else {
    $status = 'n/a';
}

if (isset($all_meta['phone-field'][0])){
    $phone = $all_meta['phone-field'][0];
}else {
    $phone = 'n/a';
}


if (isset($all_meta['latitude-field'][0])){
    $latitude = $all_meta['latitude-field'][0];
}

if (isset($all_meta['longitude-field'][0])){
    $longitude = $all_meta['longitude-field'][0];
}


//var_dump($about_distillery);
?>
<div class='single_distillery_wrap' style='background-image: url(<?php echo $background; ?>)' >
    <div class='left_bubble'>
        <div class='brand-logo'><?php echo $logo; ?></div>
        <div class='brand-addresses'>
            <div class='brand-address'><?php echo $address; ?></div>
            <div class='brand-website'><?php echo $website_link; ?></div>
        </div>
    </div>
    <div class='right_bubble'>
        <table>
            <tr><td class='attr_key'><?php  _e('Country', 'brandsforwc'); ?></td><td class='attr_value'><?php echo $country; ?></td></tr>
            <tr><td class='attr_key'><?php _e('Region', 'brandsforwc'); ?></td><td class='attr_value'><?php echo $region; ?></td></tr>
            <tr><td class='attr_key'><?php _e('Established', 'brandsforwc'); ?></td><td class='attr_value'><?php echo $established; ?></td></tr>
            <tr><td class='attr_key'><?php _e('Owner', 'brandsforwc'); ?></td><td class='attr_value'><?php echo $owner; ?></td></tr>
            <tr><td class='attr_key'><?php _e('Type', 'brandsforwc'); ?></td><td class='attr_value'><?php echo $type; ?></td></tr>
            <tr><td class='attr_key'><?php _e('Number of stills', 'brandsforwc'); ?></td><td class='attr_value'><?php echo $stills; ?></td></tr>
            <tr><td class='attr_key'><?php _e('Visitor center', 'brandsforwc'); ?></td><td class='attr_value'><?php echo $visitor; ?></td></tr>
            <tr><td class='attr_key'><?php _e('Status', 'brandsforwc'); ?></td><td class='attr_value'><?php echo $status; ?></td></tr>
            <tr><td class='attr_key'><?php _e('Phone', 'brandsforwc'); ?></td><td class='attr_value'><?php echo $phone; ?></td></tr>
        </table>
    </div>
</div>


<div class=" page__content media__block">

    <div class='middle_content'>
        <div class='about-distillery'>
            <h3><?php printf( __( 'About <br/>%s Distillery', 'brandsforwc' ), $brand_name ); ?></h3>
            <div class='about-distillery-text'><?php echo $about_distillery; ?></div>
            
            <div class='about-distillery-map'>
                <iframe style ="border-radius: 20px;"width="100%" height="280" id="gmap_canvas" src="https://maps.google.com/maps?q=<?php echo $address; ?>&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                <!--The div element for the map -->
                <?php
                /*
                if (isset($latitude) && isset($longitude)){
                    echo "
                    <script>
                        // Initialize and add the map
                        function initMap() {
                        // The location of Uluru
                        const uluru = { lat: $latitude, lng: $longitude };
                        // The map, centered at Uluru
                        const map = new google.maps.Map(document.getElementById('map'), {
                            zoom: 16,
                            center: uluru,
                            zoomControl: false,
                            mapTypeControl: false,
                            scaleControl: false,
                            streetViewControl: false,
                            rotateControl: false,
                            fullscreenControl: false
                        
                        });
                        // The marker, positioned at Uluru     
                        const marker = new google.maps.Marker({
                            position: uluru,
                            map: map,
                            icon: '../wp-content/themes/Glentbotal/src/img/icons/vector.png'
                        });
                        }
                    </script>
                    <div id='map'></div>";
                }
                */
                ?>

                <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
                <!--
                <script
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDs8YzmI6YonZxDxYUFFEdvEMrXsgBjNCQ&callback=initMap&libraries=&v=weekly"
                async
                ></script>     -->    
            </div>

        </div>
        <div class='distillery-news'>
            <h3><?php printf( __( 'News from <br/>%s Distillery', 'brandsforwc' ), $brand_name ); ?></h3>
            <div class="news-items-grid">
            <?php
            $args = array(
                'tag' => $brand_name,
                'posts_per_page' => 3,
            );
            $query = new WP_Query($args);
            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
                ?>
                <div class="news-item">
                <?php
                    echo '<div class="news-header">';
                        the_title('<h4 class="news-title">','</h4>');?> 
                        <?php the_date( 'jS F Y', '<div class="news-date">', '</div>' ); 
                    echo '</div>';
                    ?>
               
                    <div class='news-content'><?php the_content(); ?></div>
                </div>

            <?php endwhile; 

        
            else: ?>
            <p><?php _e('Sorry, there are no news from this distillery yet.', 'brandsforwc') ?></p>
            <?php endif; wp_reset_query(); ?>
            
            </div> <!-- End news-items-grid -->

            <div class='distillery-news-bottom'>
                <?php 
                if ($posts_count > 0 ): ?>
                    <a class='button' href='<?php echo '/'; ?>'><?php _e('More ...', 'brandsforwc'); ?></a>

                <?php
                endif;
                ?> 
            </div>
        </div>
    </div>

    <div class='distillery-products'>
        <h3 class='distillery-products-heading'><?php printf( __( 'Bottles from %s Distillery', 'brandsforwc' ), $brand_name ); ?></h3>
        <div class='distillery-product-items grid products owl-carousel owl-theme'>
        
    <?php    
        $query = new WP_Query( $args = array(
            'post_type'             => 'product',
            'post_status'           => 'publish',
            'ignore_sticky_posts'   => 1,
            'posts_per_page'        => 5, // Limit number of products
            'tax_query'             => array( array(
                'taxonomy'      => 'pa_brand',
                'field'         => 'slug', // can be 'term_id', 'slug' or 'name'
                'terms'         => $brand_id,
            ), ),
            'orderby'        => 'menu_order',
            'order'          => 'DESC',
        ));

        //print_r($query->posts);

        // The WP_Query loop
        if ( $query->have_posts() ): 
            while( $query->have_posts() ): 
                $query->the_post();

                global $product;

                ?>
                
                <article <?php wc_product_class('center--text grid__item product-item', $product); ?>>
                
                    <?php 
                    if ($product->get_stock_quantity() == '1'){
                        echo "<div class='grid__item--last__one'></div>"; 
                    }elseif ($product->get_stock_quantity() < '1' && $product->get_stock_quantity() > '0')	{
                        echo "<div class='grid__item--share__only'></div>"; 
                    }	
                    ?>

                    <?php
                    global $product;
                    $attachment_ids = $product->get_gallery_image_ids();	
                    foreach( $attachment_ids as $attachment_id ) 
                    {		
                        echo '<a class="grid__item--cover" href="' . get_permalink($product->get_id()) . '">' . wp_get_attachment_image($attachment_id, 'thumbnail') . '</a>'; 

                    }
                    
                    
                    ?>
                
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                
                    <p class="bottle__info"><?php
                
                    // attr
                    $attr_size_values = get_the_terms($product->get_id(), 'pa_size');
                    $attr_strength_values = get_the_terms($product->get_id(), 'pa_strength');
                    //var_dump($attr_size_values);
                    
                    if ($attr_size_values){
                        foreach($attr_size_values as $attr_size_value) {
                            echo '' . $attr_size_value->name . 'cl';
                        }
                    }
                
                    if ($attr_size_values && $attr_strength_values) echo " &#47; ";
                    // strength
                    if ($attr_strength_values){
                        foreach ($attr_strength_values as $attr_strength_value) {
                            echo '' . $attr_strength_value->name . '&#37;';
                        }
                    }
                
                    print "</p><p>";
                
                    // meta
                    $price = get_post_meta(get_the_ID(), '_regular_price', true);
                    $sale = get_post_meta(get_the_ID(), '_price', true);
                
                    // price
                    if ( !empty($sale) ) {
                        echo "<strong>&#163;", $sale, "</strong>";
                    } else {
                        echo "<strong>&#163;", $price, "</strong>";
                    }
                
                    ?></p>
                
                    <form class="cart" method="post" enctype="multipart/form-data">
                        <?php global $product;
                
                        // cart button
                        do_action("woocommerce_before_add_to_cart_button");
                
                        // Dissable "Add to cart" button if quantity is less than 1
                        $disabled_add_to_cart = false;
                        if (!$product->is_sold_individually() && $product->get_stock_quantity() < '1' && $product->managing_stock() ) {
                            $disabled_add_to_cart = true;
                        }
                
                        ?>
                
                        <input type="hidden" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>" />
                
                        <input type='hidden' name='item-title' value='<?php echo get_the_title($product->get_id()); ?>'>
                
                        <input type='hidden' name='item-price' value='<?php echo $product->get_price(); ?>'>
                        
                        <button type="submit" <?php if($disabled_add_to_cart) echo "disabled"; ?> class="single_add_to_cart_button button alt"><img class="single_add_to_cart_button--basket" src="<?php echo get_stylesheet_directory_uri();  ?>/src/img/icons/add-to-basket.svg" /><?php echo $product->single_add_to_cart_text(); ?></button>
                        <?php

                        do_action('woocommerce_after_add_to_cart_button');
                
                        ?>
                    </form>
                    <?php
                    if (
                        !is_admin() && 
                        !current_user_can('first_type_subscription') or current_user_can('second_type_subscription') or current_user_can('third_type_subscription')
                    ) {
                        if ($price == 100 or $price < 100) print "<form class='subscription_cart' method='post' enctype='multipart/form-data'><input type='hidden' name='add-to-cart' value='188," . $product->get_id() . "'><input type='hidden' name='quantities' value='1," . get_share_size() . "'><input type='hidden' name='item-title' value='". get_the_title(188) . " and ". get_the_title($product->get_id()) ."'><input type='hidden' name='item-price' value='". wc_get_product(188)->get_price()."'><button type='submit' class='single_subscription_button button alt product_type_simple add_to_cart_button ajax_add_to_cart " . is_disabled_get_share() . "'>Get Share <img class='single_subscription_button--question' src='" . get_stylesheet_directory_uri() . "/src/img/icons/question.svg' /></button></form>";
                        elseif ($price == 600 or $price > 100 && $price < 600) print "<form class='subscription_cart' method='post' enctype='multipart/form-data'><input type='hidden' name='add-to-cart' value='189," . $product->get_id() . "'><input type='hidden' name='quantities' value='1," . get_share_size() . "'><input type='hidden' name='item-title' value='". get_the_title(189) . " and ". get_the_title($product->get_id()) ."'><input type='hidden' name='item-price' value='". wc_get_product(189)->get_price()."'><button type='submit' class='single_subscription_button button alt product_type_simple add_to_cart_button ajax_add_to_cart " . is_disabled_get_share() . "'>Get Share <img class='single_subscription_button--question' src='" . get_stylesheet_directory_uri() . "/src/img/icons/question.svg' /></button></form>";
                        elseif ($price > 600 && $price < 10000) print "<form class='subscription_cart' method='post' enctype='multipart/form-data'><input type='hidden' name='add-to-cart' value='199," . $product->get_id() . "'><input type='hidden' name='quantities' value='1," . get_share_size() . "'><input type='hidden' name='item-title' value='". get_the_title(199) . " and ". get_the_title($product->get_id()) ."'><input type='hidden' name='item-price' value='". wc_get_product(199)->get_price()."'><button type='submit' class='single_subscription_button button alt product_type_simple add_to_cart_button ajax_add_to_cart " . is_disabled_get_share() . "'>Get Share <img class='single_subscription_button--question' src='" . get_stylesheet_directory_uri() . "/src/img/icons/question.svg' /></button></form>";
                    }
                    ?>
                
                    <?php do_action('woocommerce_after_add_to_cart_form'); ?>
                
                </article>
            <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>       
        

        </div>
    </div>


</div>


<?php
        // shortcode
        echo do_shortcode('[about_us_shortcode][/about_us_shortcode]');
    ?>

<?php
// notifications
//wc_print_notices();


get_footer();

