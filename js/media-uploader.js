jQuery(document).ready(function($){

    if( $('#brand-logo').val() ){
        var logo_thumbnail = $( "#brand-logo" ).val();
        $("#brand-logo-thumb").html("<img style='width:128px;' src='" + logo_thumbnail + "' />");
    }
   
    if( $('#background-image').val() ){
        var background_thumbnail = $( "#background-image" ).val();
        $("#background-image-thumb").html("<img style='width:128px;' src='" + background_thumbnail + "' />");
    }
   

    // Instantiates the variable that holds the media library frame.
    var meta_image_frame_logo;
    var meta_image_frame_background;


    // Runs when the image button is clicked for Brand Logo.
    $('#upload_brand_logo_btn').click(function(e){

        // Prevents the default action from occuring.
        e.preventDefault();

        // If the frame already exists, re-open it.
        if ( meta_image_frame_logo ) {
            meta_image_frame_logo.open();
            return;
        }

        // Sets up the media library frame
        meta_image_frame_logo = wp.media.frames.meta_image_frame_logo = wp.media({
            title: meta_image.title,
            button: { text:  meta_image.button },
            library: { type: 'image' }
        });

        // Runs when an image is selected.
        meta_image_frame_logo.on('select', function(){

            // Grabs the attachment selection and creates a JSON representation of the model.
            var media_attachment_logo = meta_image_frame_logo.state().get('selection').first().toJSON();

            // Sends the attachment URL to our custom image input field.

            var image_url_logo = media_attachment_logo.url;
            image_url_logo = image_url_logo.substr(image_url_logo.indexOf('/', 9));
            
            $('#brand-logo').val(image_url_logo);
            
            $("#brand-logo-thumb").html("<img style='width:128px;' src='" + image_url_logo + "' />");

        });

        // Opens the media library frame.
        meta_image_frame_logo.open();
    });


    // Runs when the image button is clicked for Background image.
    $('#upload_background-image_btn').click(function(e){

        // Prevents the default action from occuring.
        e.preventDefault();

        // If the frame already exists, re-open it.
        if ( meta_image_frame_background ) {
            meta_image_frame_background.open();
            return;
        }

        // Sets up the media library frame
        meta_image_frame_background = wp.media.frames.meta_image_frame_background = wp.media({
            title: meta_image.title,
            button: { text:  meta_image.button },
            library: { type: 'image' }
        });

        // Runs when an image is selected.
        meta_image_frame_background.on('select', function(){

            // Grabs the attachment selection and creates a JSON representation of the model.
            var media_attachment_background = meta_image_frame_background.state().get('selection').first().toJSON();

            // Sends the attachment URL to our custom image input field.

            var image_url_background = media_attachment_background.url;
            image_url_background = image_url_background.substr(image_url_background.indexOf('/', 9));
            
            $('#background-image').val(image_url_background);
            
            $("#background-image-thumb").html("<img style='width:128px;' src='" + image_url_background + "' />");

        });

        // Opens the media library frame.
        meta_image_frame_background.open();
    });

});