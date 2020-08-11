<?php

/*Prevent non-logged in users from accessing the site's user and post data using the WordPress REST API.*/
add_filter( 'rest_authentication_errors', function( $result ) {
   if ( !empty( $result ) ) {
       return $result;
   } 
   if( !is_user_logged_in() ) {
       return new WP_Error( 'rest_not_logged_in', 'You are not currently logged in.', array( 'status' => 401 ) );    
   }
   return $result;
});



//Theme support.
add_theme_support( "post-thumbnails" ); //Allow image thumbnails in pages and posts.
add_theme_support( 'custom-logo' );   //Let user upload the logo.



//Allow cropping for medium thumbnail images.
if(false === get_option( "medium_crop" )) {
    add_option( "medium_crop", "1" );
} else {
    update_option( "medium_crop", "1" );
}

add_action('wp_enqueue_scripts', function() {
    wp_register_script( 'javascript-functions', get_template_directory_uri() . '/assets/javascript/javascript-functions.js' );
    wp_enqueue_script( 'javascript-functions', get_template_directory_uri() . '/assets/javascript/javascript-functions.js' );  
    wp_enqueue_style( 'styles', "" . get_template_directory_uri() . '/assets/css/main-styles.css?mod=08082020' );
    wp_enqueue_style( 'styles', "" . get_template_directory_uri() . '/assets/css/print-styles.css?mod=12202019' );   
});



//Add Theme Appearance Customization controls.
function bakery_theme_customize_register( $wp_customize ){
    $wp_customize->add_section( "MetaSettings", array(
        "title" => __("Meta Settings", "meta_settings_sections"),
        "priority" => 30,
    ));
    
    
    //Meta Description control.
    $wp_customize->add_setting( "meta_description_code", array(
        "default" => "",
        "transport" => "refresh",
    ));
    
    $wp_customize->add_control( new WP_Customize_control(
        $wp_customize,
        "meta_description_code",
        array(
            "label" =>__( "Meta Description (sitewide): add a short description of your site for search engine visitors.", "meta_settings_label" ),
            "section" => "MetaSettings",
            "settings" => "meta_description_code",
            "type" => "textarea",
        )
    ));   
    
    
    //Meta Keywords control.
    $wp_customize->add_setting( "meta_keywords_code", array(
        "default" => "",
        "transport" => "refresh",
    ));
        
    $wp_customize->add_control( new WP_Customize_control(
        $wp_customize,
        "meta_keywords_code",
        array(
            "label" =>__( "Meta Keywords (sitewide): add several relevant words or short phrases about your site.  Example: bakery, baked goods, fresh.", "meta_keywords_label" ),
            "section" => "MetaSettings",
            "settings" => "meta_keywords_code",
            "type" => "textarea",
        )
    ));  
}
add_action( 'customize_register', 'bakery_theme_customize_register' );