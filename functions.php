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


add_action( 'admin_enqueue_scripts', function() { 
    wp_enqueue_style( 'admin-styles', "" . get_template_directory_uri() . '/assets/css/admin-styles.css?mod=08172020' );   
});

add_action( 'wp_enqueue_scripts', function() {
    wp_register_script( 'javascript-functions', get_template_directory_uri() . '/assets/javascript/javascript-functions.js' );
    wp_enqueue_script( 'javascript-functions', get_template_directory_uri() . '/assets/javascript/javascript-functions.js' );  
    wp_enqueue_style( 'styles', "" . get_template_directory_uri() . '/assets/css/main-styles.css?mod=08082020' );
    wp_enqueue_style( 'styles', "" . get_template_directory_uri() . '/assets/css/print-styles.css?mod=12202019' );   
});


//Theme support.
add_theme_support( "post-thumbnails" ); //Allow image thumbnails in pages and posts.
add_theme_support( 'custom-logo' );   //Let user upload the logo.


//Enable Widgets in theme.
if ( function_exists( 'register_sidebar' ) ) {
    register_sidebar( array(
        'name' => 'Widgetized Area',
        'id' => 'widgetized-area',
        'description' => 'This is a widgetized area.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>'
    ));
}


//Allow cropping for medium thumbnail images.
if(false === get_option( "medium_crop" )) {
    add_option( "medium_crop", "1" );
} else {
    update_option( "medium_crop", "1" );
}



//Add Theme Appearance Customization controls.
function bakery_theme_customize_register( $wp_customize ){
    
    //Meta Settings
    $wp_customize->add_section( "MetaSettings", array(
        "title" => __("Meta Settings", "meta_settings_sections"),
        "priority" => 30,
    ));
       
    //Meta Description control.
    $wp_customize->add_setting( "meta_description_code", array(
        "default" => "",
        "sanitize_callback" => "wp_filter_nohtml_kses", //Remove any user provided HTML tags
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
        "sanitize_callback" => "wp_filter_nohtml_kses", //Remove any user provided HTML tags
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
    
    
    
    //Business Info
    $wp_customize->add_section( "BusinessInfo", array(
        "title" => __("Business Info", "business_info_sections"),
        "priority" => 30,
    ));
        
    //Location control.
    $wp_customize->add_setting( "location_code", array(
        "default" => "",
        "sanitize_callback" => "wp_filter_nohtml_kses", //Remove any user provided HTML tags
        "transport" => "refresh",
    ));
    $wp_customize->add_control( new WP_Customize_control(
        $wp_customize,
        "location_code",
        array(
            "label" =>__( "Location", "location_label" ),
            "section" => "BusinessInfo",
            "settings" => "location_code",
            "type" => "text",
        )
    ));   
        
    //Hours controls.
    $wp_customize->add_setting( "hours_code0", array(
        "default" => "",
        "sanitize_callback" => "wp_filter_nohtml_kses", //Remove any user provided HTML tags
        "transport" => "refresh",
    ));
    $wp_customize->add_control( new WP_Customize_control(
        $wp_customize,
        "hours_code0",
        array(
            "label" =>__( "Hours", "hours_label0" ),
            "section" => "BusinessInfo",
            "settings" => "hours_code0",
            "type" => "text",
        )
    )); 
    
    $wp_customize->add_setting( "hours_code1", array(
        "default" => "",
        "sanitize_callback" => "wp_filter_nohtml_kses", //Remove any user provided HTML tags
        "transport" => "refresh",
    ));
    $wp_customize->add_control( new WP_Customize_control(
        $wp_customize,
        "hours_code1",
        array(
            "label" =>__( "Hours (2nd line, as needed)", "hours_label1" ),
            "section" => "BusinessInfo",
            "settings" => "hours_code1",
            "type" => "text",
        )
    )); 
    
    $wp_customize->add_setting( "hours_code2", array(
        "default" => "",
        "sanitize_callback" => "wp_filter_nohtml_kses", //Remove any user provided HTML tags
        "transport" => "refresh",
    ));
    $wp_customize->add_control( new WP_Customize_control(
        $wp_customize,
        "hours_code2",
        array(
            "label" =>__( "Hours (3rd line, as needed)", "hours_label2" ),
            "section" => "BusinessInfo",
            "settings" => "hours_code2",
            "type" => "text",
        )
    )); 
    
    $wp_customize->add_setting( "hours_code3", array(
        "default" => "",
        "sanitize_callback" => "wp_filter_nohtml_kses", //Remove any user provided HTML tags
        "transport" => "refresh",
    ));
    $wp_customize->add_control( new WP_Customize_control(
        $wp_customize,
        "hours_code3",
        array(
            "label" =>__( "Hours (4th line, as needed)", "hours_label3" ),
            "section" => "BusinessInfo",
            "settings" => "hours_code3",
            "type" => "text",
        )
    )); 
    
    
    //Scoial Links
    $wp_customize->add_section( "SocialLinks", array(
        "title" => __("Social Links", "social_links_sections"),
        "priority" => 30,
    ));
       
    //Social Links controls.
    $wp_customize->add_setting( "pinterest_code", array(
        "default" => "",
        "sanitize_callback" => "wp_filter_nohtml_kses", //Remove any user provided HTML tags
        "transport" => "refresh",
    ));
    $wp_customize->add_control( new WP_Customize_control(
        $wp_customize,
        "pinterest_code",
        array(
            "label" =>__( "Pinterest URL:", "pinterest_label" ),
            "section" => "SocialLinks",
            "settings" => "pinterest_code",
            "type" => "text",
        )
    ));
    
    //Social Links controls.
    $wp_customize->add_setting( "instagram_code", array(
        "default" => "",
        "sanitize_callback" => "wp_filter_nohtml_kses", //Remove any user provided HTML tags
        "transport" => "refresh",
    ));
    $wp_customize->add_control( new WP_Customize_control(
        $wp_customize,
        "instagram_code",
        array(
            "label" =>__( "Instagram URL:", "instagram_label" ),
            "section" => "SocialLinks",
            "settings" => "instagram_code",
            "type" => "text",
        )
    ));
    
    //Social Links controls.
    $wp_customize->add_setting( "facebook_code", array(
        "default" => "",
        "sanitize_callback" => "wp_filter_nohtml_kses", //Remove any user provided HTML tags
        "transport" => "refresh",
    ));
    $wp_customize->add_control( new WP_Customize_control(
        $wp_customize,
        "facebook_code",
        array(
            "label" =>__( "Facebook URL:", "facebook_label" ),
            "section" => "SocialLinks",
            "settings" => "facebook_code",
            "type" => "text",
        )
    ));
    
    //Social Links controls.
    $wp_customize->add_setting( "twitter_code", array(
        "default" => "",
        "sanitize_callback" => "wp_filter_nohtml_kses", //Remove any user provided HTML tags
        "transport" => "refresh",
    ));
    $wp_customize->add_control( new WP_Customize_control(
        $wp_customize,
        "twitter_code",
        array(
            "label" =>__( "Twitter URL:", "twitter_label" ),
            "section" => "SocialLinks",
            "settings" => "twitter_code",
            "type" => "text",
        )
    ));
    
    //Social Links controls.
    $wp_customize->add_setting( "youtube_code", array(
        "default" => "",
        "sanitize_callback" => "wp_filter_nohtml_kses", //Remove any user provided HTML tags
        "transport" => "refresh",
    ));
    $wp_customize->add_control( new WP_Customize_control(
        $wp_customize,
        "youtube_code",
        array(
            "label" =>__( "Youtube URL:", "youtube_label" ),
            "section" => "SocialLinks",
            "settings" => "youtube_code",
            "type" => "text",
        )
    ));
    
}
add_action( 'customize_register', 'bakery_theme_customize_register' );



//Add About Theme tab in Admin Menu.
function add_about_theme_page(){
    ?>
<div class="wrap">
    <h1 class="wrap__title">About Bakery Morning</h1>
    <div class="wrap__content">
        <p>Use this theme for your bakery website or for any other business.  The color scheme is especially designed for bakery themed sites but you can
            customize the CSS too.</p>
        <h2>Theme Customization Features</h2>
        <ul class="content__features-list">
            <li>Set Meta Description and Keywords.</li>
            <li>Store Location</li>
            <li>Store Hours</li>
        </ul>
    </div>
</div>
    <?php
}


function add_about_theme_item(){
    add_theme_page( "About Bakery Morning", "About Theme", "manage_options", "theme-options", "add_about_theme_page", null, 99 ); 
}
add_action( "admin_menu", "add_about_theme_item" );
