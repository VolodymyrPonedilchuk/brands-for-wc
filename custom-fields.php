<?php 
// Add fields to Brand atributie on create page
add_action( 'pa_brand_add_form_fields', 'add_fields_to_brand_atributie' );
function add_fields_to_brand_atributie( $taxonomy ) {

    // Get all categories for dropdown Country and Region fields
    $category = get_term_by( 'slug', 'whiskey', 'product_cat' );
    $cat_id = $category->term_id;
    $args = array(
        'hide_empty' => 0,
        'child_of' => $cat_id,
        'taxonomy' => 'product_cat',
        'orderby' => 'name',
     );
   $all_countries = get_categories( $args );

    // About distillery field
    echo "About distillery:";
    echo '
    <div class="form-field term-about-wrap">'
    . wp_editor('', 'about-distillery', array('media_buttons' => false,'wpautop'=> false, 'textarea_rows' => '6')) . '
    </div>
    <script>
    jQuery(function($) {
        $("#submit").click(function() {
            var about_distillery_val =  $("#about-distillery_ifr").contents().find("body").html();;
            $("#about-distillery").html(about_distillery_val);
          });
    });</script>';


    // Background image field
	echo '<div class="form-field term-background-wrap">
	<label for="background-image">Background image:</label>
	<input type="text" name="background-image" id="background-image" />
	<input type="button" id="upload_background-image_btn" class="button" style="margin-top:10px;" value="Upload an Image" />
	<p>This image will be shown on single distillery page as background. </p>
	<div id="background-image-thumb"></div>
    </div>';
    
    
    // Brand logo field
	echo '<div class="form-field term-logo-wrap">
	<label for="brand-logo">Brand logo:</label>
	<input type="text" name="brand-logo" id="brand-logo" />
	<input type="button" id="upload_brand_logo_btn" class="button" style="margin-top:10px;" value="Upload a Logo" />
	<p>This image will be shown on distilleries pages </p>
	<div id="brand-logo-thumb"></div>
    </div>';
        
    
    // Address field
	echo '<div class="form-field term-address-wrap">
	<label for="address-field">Address:</label>
	<input type="text" name="address-field" id="address-field" />
    </div>';
            
    
    // Website field
	echo '<div class="form-field term-website-wrap">
	<label for="website-field">Website:</label>
	<input type="text" name="website-field" id="website-field" />
    </div>';
    

    // Country field
/*	echo '<div class="form-field term-country-wrap">
	<label for="country-field">Country:</label>
	<input type="text" name="country-field" id="country-field" />
    </div>';
*/
    echo '<label for="country-field">Country:</label>
        <select name="country-field" class="fl" id="country-field">
        <option value="" selected="selected">Country</option>';

            foreach($all_countries as $country_item){
                
                if($country_item->category_parent != $cat_id) continue;
                
                $contry_filter = $country_item->slug;
                $contry_name = $country_item->name;

                echo "<option value='" . $contry_filter . "'>" . $contry_name . "</option>";
            }

    echo '</select>';
        

    // Region field
/*	echo '<div class="form-field term-region-wrap">
	<label for="region-field">Region:</label>
	<input type="text" name="region-field" id="region-field" />
    </div>';
*/

    echo '<label for="region-field">Region:</label>
    <select name="region-field" class="fl" id="region-field">
    
    <option value="" selected="selected">Region</option>';

        foreach($all_countries as $region_item){
            if($region_item->category_parent == $cat_id) continue;

            $region_filter = $region_item->slug;
            $region_name = $region_item->name;

            echo "<option value='" . $region_filter . "' >" . $region_name . "</option>";
        }

    echo '</select>';


    // Established field
	echo '<div class="form-field term-established-wrap">
	<label for="established-field">Established:</label>
	<input type="text" name="established-field" id="established-field" />
    </div>';
    
    
    // Owner field
	echo '<div class="form-field term-owner-wrap">
	<label for="owner-field">Owner:</label>
	<input type="text" name="owner-field" id="owner-field" />
    </div>';
	   
    
    // Type field
	echo '<div class="form-field term-type-wrap">
	<label for="type-field">Type:</label>
	<input type="text" name="type-field" id="type-field" />
    </div>';
	   
    
    // Number of stills field
	echo '<div class="form-field term-stills-wrap">
	<label for="stills-field">Number of stills:</label>
	<input type="text" name="stills-field" id="stills-field" />
    </div>';
		
	   
    // Visitor center field
	echo '<div class="form-field term-visitor-wrap">
	<label for="visitor-field">Visitor center:</label>
	<input type="text" name="visitor-field" id="visitor-field" />
    </div>';
		
	   
    // Status field
	echo '<div class="form-field term-status-wrap">
	<label for="status-field">Status:</label>
	<input type="text" name="status-field" id="status-field" />
    </div>';
		
	   
    // Phone field
	echo '<div class="form-field term-phone-wrap">
	<label for="phone-field">Phone:</label>
	<input type="text" name="phone-field" id="phone-field" />
    </div>';

    
    // Latitude field
	echo '<div class="form-field term-latitude-wrap">
	<label for="latitude-field">Latitude (for map):</label>
	<input type="text" name="latitude-field" id="latitude-field" />
    </div>';

    
    // Longitude field
	echo '<div class="form-field term-longitude-wrap">
	<label for="longitude-field">Longitude (for map):</label>
	<input type="text" name="longitude-field" id="longitude-field" />
    </div>';
    
	
}





// Add fiels to Brand atributie on edit page
add_action( 'pa_brand_edit_form_fields', 'edit_fields_for_brand_atributie', 10, 2 );
function edit_fields_for_brand_atributie( $term, $taxonomy ) {
        
    // Get all categories for dropdown Country and Region fields
        $category = get_term_by( 'slug', 'whiskey', 'product_cat' );
        $cat_id = $category->term_id;
        $args = array(
            'hide_empty' => 0,
            'child_of' => $cat_id,
            'taxonomy' => 'product_cat',
            'orderby' => 'name',
         );
       $all_countries = get_categories( $args );

    // About distillery field
    $about_distillery = get_term_meta( $term->term_id, 'about-distillery', true );  
    ?>
    <tr valign="top">
        <th scope="row">About Distillery</th>
        <td>
            <?php 
   // var_dump($about_distillery);
            wp_editor(html_entity_decode($about_distillery), 'about-distillery', array('media_buttons' => false,'wpautop'=> false,'textarea_rows' => '6')); 
            ?>
        </td>
    </tr>
    <?php

    
    // Background image field
    $background_image = get_term_meta( $term->term_id, 'background-image', true );
	echo '<tr class="form-field term-group">
	<th>
		<label for="background-image">Background image:</label>
	</th>
	<td>
	<input type="text" name="background-image" id="background-image" value="'. $background_image .'" style="width: 72%">
	<input type="button" id="upload_background-image_btn" class="button" value="Upload an Image" />
	<p>This image will be shown on single distillery page as background.</p>
	<div id="background-image-thumb"></div>
	</td>
    </tr>';


    // Brand logo field
    $brand_logo = get_term_meta( $term->term_id, 'brand-logo', true );
	echo '<tr class="form-field term-group">
	<th>
		<label for="brand-logo">Brand logo:</label>
	</th>
	<td>
	<input type="text" name="brand-logo" id="brand-logo" value="'. $brand_logo .'" style="width: 75%">
	<input type="button" id="upload_brand_logo_btn" class="button" value="Upload a Logo" />
	<p>This image will be shown on distilleries pages.</p>
	<div id="brand-logo-thumb"></div>
	</td>
    </tr>';


    // Address field
    $address_field = get_term_meta( $term->term_id, 'address-field', true );
    echo '<tr class="form-field term-group">
        <th>
            <label for="address-field">Address:</label>
        </th>
        <td>
            <input type="text" name="address-field" id="address-field" value="'. $address_field .'">
        </td>
    </tr>';

             

    // Website field
    $website_field = get_term_meta( $term->term_id, 'website-field', true );
    echo '<tr class="form-field term-group">
        <th>
            <label for="website-field">Website:</label>
        </th>
        <td>
            <input type="text" name="website-field" id="website-field" value="'. $website_field .'">
        </td>
    </tr>';

    
    // Country field
    $country_field = get_term_meta( $term->term_id, 'country-field', true );
    if (!$country_field){
        $selected_country = 'selected="selected"';
    } else {
        $selected_country = '';
    }

    echo '<tr class="form-field term-group">
        <th>
            <label for="country-field">Country:</label>
        </th>
        <td>
        <select name="country-field" class="fl" id="country-field">
        <option value=""' . $selected_country  . '>Select country</option>';
				
            foreach($all_countries as $country_item){
                if($country_item->category_parent != $cat_id) continue;
                $contry_filter = $country_item->slug;
                $contry_name = $country_item->name;

                echo "<option value='" . $contry_filter . "' " .  selected($contry_filter, $country_field, false) . ">" . $contry_name . "</option>";
               
            }  
    
            echo '</select></td> 
    </tr>';
    
    
        
    
    // Region field
    $region_field = get_term_meta( $term->term_id, 'region-field', true );
    if (!$region_field){
        $selected_region = 'selected="selected"';
    } else {
        $selected_region = '';
    }
    echo '<tr class="form-field term-group">
        <th>
            <label for="region-field">Region:</label>
        </th>
        <td>
        <select name="region-field" class="fl" id="region-field">
        <option value="" ' . $selected_region . '>Select region</option>';

            foreach($all_countries as $region_item){
                if($region_item->category_parent == $cat_id) continue;
                $region_filter = $region_item->slug;
                $region_name = $region_item->name;

                echo "<option value='" . $region_filter . "' " .  selected($region_filter, $region_field, false) . ">" . $region_name . "</option>";
            }


    echo '</select></td>
    </tr>';




    // Established field
    $established_field = get_term_meta( $term->term_id, 'established-field', true );
    echo '<tr class="form-field term-group">
        <th>
            <label for="established-field">Established:</label>
        </th>
        <td>
            <input type="text" name="established-field" id="established-field" value="'. $established_field .'">
        </td>
    </tr>';


    // Owner field
    $owner_field = get_term_meta( $term->term_id, 'owner-field', true );
    echo '<tr class="form-field term-group">
        <th>
            <label for="owner-field">Owner:</label>
        </th>
        <td>
            <input type="text" name="owner-field" id="owner-field" value="'. $owner_field .'">
        </td>
    </tr>';
    

    // Type field
    $type_field = get_term_meta( $term->term_id, 'type-field', true );
    echo '<tr class="form-field term-group">
        <th>
            <label for="type-field">Type:</label>
        </th>
        <td>
            <input type="text" name="type-field" id="type-field" value="'. $type_field .'">
        </td>
    </tr>';
        

    // Number of stills field
    $stills_field = get_term_meta( $term->term_id, 'stills-field', true );
    echo '<tr class="form-field term-group">
        <th>
            <label for="stills-field">Number of stills:</label>
        </th>
        <td>
            <input type="text" name="stills-field" id="stills-field" value="'. $stills_field .'">
        </td>
    </tr>';
        

    // Visitor center field
    $visitor_field = get_term_meta( $term->term_id, 'visitor-field', true );
    echo '<tr class="form-field term-group">
        <th>
            <label for="visitor-field">Visitor center:</label>
        </th>
        <td>
            <input type="text" name="visitor-field" id="visitor-field" value="'. $visitor_field .'">
        </td>
    </tr>';
        

    // Status field
    $status_field = get_term_meta( $term->term_id, 'status-field', true );
    echo '<tr class="form-field term-group">
        <th>
            <label for="status-field">Status:</label>
        </th>
        <td>
            <input type="text" name="status-field" id="status-field" value="'. $status_field .'">
        </td>
    </tr>';
         

    // Phone field
    $phone_field = get_term_meta( $term->term_id, 'phone-field', true );
    echo '<tr class="form-field term-group">
        <th>
            <label for="phone-field">Phone:</label>
        </th>
        <td>
            <input type="text" name="phone-field" id="phone-field" value="'. $phone_field .'">
        </td>
    </tr>';
                   
    
    // Latitude field (for google maps)
    $latitude_field = get_term_meta( $term->term_id, 'latitude-field', true );
    echo '<tr class="form-field term-group">
        <th>
            <label for="latitude-field">Latitude (for map):</label>
        </th>
        <td>
            <input type="text" name="latitude-field" id="latitude-field" value="'. $latitude_field .'">
        </td>
    </tr>';        

    
    // Longitude field (for google maps)
    $longitude_field = get_term_meta( $term->term_id, 'longitude-field', true );
    echo '<tr class="form-field term-group">
        <th>
            <label for="longitude-field">Longitude (for map):</label>
        </th>
        <td>
            <input type="text" name="longitude-field" id="longitude-field" value="'. $longitude_field .'">
        </td>
    </tr>';

               
    

}

// Save logo field for Brand atributie
add_action( 'created_pa_brand', 'brand_save_term_fields' );
add_action( 'edited_pa_brand', 'brand_save_term_fields' );
function brand_save_term_fields( $term_id ) {
 
    $about_distillery = get_term_meta( $term_id, 'about-distillery', true );
    if ($_POST[ 'about-distillery' ] && $_POST[ 'about-distillery' ] != '' && $_POST[ 'about-distillery' ] != $about_distillery){
        update_term_meta(
            $term_id,
            'about-distillery',
            $_POST[ 'about-distillery' ]
        );
    }else {
        if ($about_distillery && $_POST[ 'about-distillery' ] == ''){
            delete_term_meta(
                $term_id,
                'about-distillery'
            );
        }
        
    }


    $background_image = get_term_meta( $term_id, 'background-image', true );
    if ($_POST[ 'background-image' ] && $_POST[ 'background-image' ] != '' && $_POST[ 'background-image' ] != $background_image){
        update_term_meta(
            $term_id,
            'background-image',
            $_POST[ 'background-image' ]
        );
    } else {
        if ($background_image && $_POST[ 'background-image' ] == ''){
            delete_term_meta(
                $term_id,
                'background-image'
            );
        }
    }


    $brand_logo = get_term_meta( $term_id, 'brand-logo', true );
    if ($_POST[ 'brand-logo' ] && $_POST[ 'brand-logo' ] != '' && $_POST[ 'brand-logo' ] != $brand_logo){
        update_term_meta(
            $term_id,
            'brand-logo',
            sanitize_text_field( $_POST[ 'brand-logo' ] )
        );
    } else {
        if ($brand_logo && $_POST[ 'brand-logo' ] == ''){
            delete_term_meta(
                $term_id,
                'brand-logo'
            );
        }
    }


    $address_field = get_term_meta( $term_id, 'address-field', true );
    if ($_POST[ 'address-field' ] && $_POST[ 'address-field' ] != '' && $_POST[ 'address-field' ] != $address_field ){
        update_term_meta(
            $term_id,
            'address-field',
            sanitize_text_field( $_POST[ 'address-field' ] )
        );
    } else {
        if ($address_field && $_POST[ 'address-field' ] == ''){
            delete_term_meta(
                $term_id,
                'address-field'
            );
        }
    }


    $website_field = get_term_meta( $term_id, 'website-field', true );
    if ($_POST[ 'website-field' ] && $_POST[ 'website-field' ] != '' && $_POST[ 'website-field' ] != $website_field){
        update_term_meta(
            $term_id,
            'website-field',
            sanitize_text_field( $_POST[ 'website-field' ] )
        );
    } else {
        if ($website_field && $_POST[ 'website-field' ] == ''){
            delete_term_meta(
                $term_id,
                'website-field'
            );
        }
    }


    $country_field = get_term_meta( $term_id, 'country-field', true );
    if ($_POST[ 'country-field' ] && $_POST[ 'country-field' ] != '' && $_POST[ 'country-field' ] != $country_field){
        update_term_meta(
            $term_id,
            'country-field',
            $_POST[ 'country-field' ]
        );
    } else {
        if ($country_field && $_POST[ 'country-field' ] == ''){
            delete_term_meta(
                $term_id,
                'country-field'
            );
        }
    }


    $region_field = get_term_meta( $term_id, 'region-field', true );
    if ($_POST[ 'region-field' ] && $_POST[ 'region-field' ] != '' && $_POST[ 'region-field' ] != $region_field){
        update_term_meta(
            $term_id,
            'region-field',
            $_POST[ 'region-field' ]
        );
    } else {
        if ($region_field && $_POST[ 'region-field' ] == ''){
            delete_term_meta(
                $term_id,
                'region-field'
            );
        }
    }


    $established_field = get_term_meta( $term_id, 'established-field', true );
    if ($_POST[ 'established-field' ] && $_POST[ 'established-field' ] != '' && $_POST[ 'established-field' ] != $established_field ){
        update_term_meta(
            $term_id,
            'established-field',
            $_POST[ 'established-field' ]
        );
    } else {
        if ($established_field && $_POST[ 'established-field' ] == ''){
            delete_term_meta(
                $term_id,
                'established-field'
            );
        }
    }

        
    $owner_field = get_term_meta( $term_id, 'owner-field', true );
    if ($_POST[ 'owner-field' ] && $_POST[ 'owner-field' ] != '' && $_POST[ 'owner-field' ] != $owner_field){
        update_term_meta(
            $term_id,
            'owner-field',
            $_POST[ 'owner-field' ]
        );
    } else {
        if ($owner_field && $_POST[ 'owner-field' ] == ''){
            delete_term_meta(
                $term_id,
                'owner-field'
            );
        }
    }

      
    $type_field = get_term_meta( $term_id, 'type-field', true );
    if ($_POST[ 'type-field' ] && $_POST[ 'type-field' ] != '' && $_POST[ 'type-field' ] != $type_field){
        update_term_meta(
            $term_id,
            'type-field',
            $_POST[ 'type-field' ]
        );
    } else {
        if ($type_field && $_POST[ 'type-field' ] == ''){
            delete_term_meta(
                $term_id,
                'type-field'
            );
        }
    }

        
    $stills_field = get_term_meta( $term_id, 'stills-field', true );
    if ($_POST[ 'stills-field' ] && $_POST[ 'stills-field' ] != '' && $_POST[ 'stills-field' ] != $stills_field){
        update_term_meta(
            $term_id,
            'stills-field',
            $_POST[ 'stills-field' ]
        );
    } else {
        if ($stills_field && $_POST[ 'stills-field' ] == ''){
            delete_term_meta(
                $term_id,
                'stills-field'
            );
        }
    }


    $visitor_field = get_term_meta( $term_id, 'visitor-field', true );
    if ($_POST[ 'visitor-field' ] && $_POST[ 'visitor-field' ] != '' && $_POST[ 'visitor-field' ] != $visitor_field){
        update_term_meta(
            $term_id,
            'visitor-field',
            $_POST[ 'visitor-field' ]
        );
    } else {
        if ($visitor_field && $_POST[ 'visitor-field' ] == ''){
            delete_term_meta(
                $term_id,
                'visitor-field'
            );
        }
    }


    $status_field = get_term_meta( $term_id, 'status-field', true );
    if ($_POST[ 'status-field' ] && $_POST[ 'status-field' ] != '' && $_POST[ 'status-field' ] != $status_field){
        update_term_meta(
            $term_id,
            'status-field',
            $_POST[ 'status-field' ]
        );
    } else {
        if ($status_field && $_POST[ 'status-field' ] == ''){
            delete_term_meta(
                $term_id,
                'status-field'
            );
        }
    }


    $phone_field = get_term_meta( $term_id, 'phone-field', true );
    if ($_POST[ 'phone-field' ] && $_POST[ 'phone-field' ] != '' && $_POST[ 'phone-field' ] != $phone_field){
        update_term_meta(
            $term_id,
            'phone-field',
            $_POST[ 'phone-field' ]
        );
    } else {
        if ($phone_field && $_POST[ 'phone-field' ] == ''){
            delete_term_meta(
                $term_id,
                'phone-field'
            );
        }
    }


    $longitude_field = get_term_meta( $term_id, 'longitude-field', true );
    if ($_POST[ 'longitude-field' ] && $_POST[ 'longitude-field' ] != '' && $_POST[ 'longitude-field' ] != $longitude_field){
        update_term_meta(
            $term_id,
            'longitude-field',
            $_POST[ 'longitude-field' ]
        );
    } else {
        if ($longitude_field && $_POST[ 'longitude-field' ] == ''){
            delete_term_meta(
                $term_id,
                'longitude-field'
            );
        }
    }


    $latitude_field = get_term_meta( $term_id, 'latitude-field', true );
    if ($_POST[ 'latitude-field' ] && $_POST[ 'latitude-field' ] != '' && $_POST[ 'latitude-field' ] != $latitude_field){
        update_term_meta(
            $term_id,
            'latitude-field',
            $_POST[ 'latitude-field' ]
        );
    } else {
        if ($latitude_field && $_POST[ 'latitude-field' ] == ''){
            delete_term_meta(
                $term_id,
                'latitude-field'
            );
        }
    }

}