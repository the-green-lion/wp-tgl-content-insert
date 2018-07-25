<?php

add_action( 'wp_enqueue_scripts', 'register_tgl_login_script' );

function register_tgl_login_script() {
    wp_register_script( 'tgl-login-js', plugins_url( '/scripts/tgl_shortcode_login.js' , dirname(__FILE__) ), array(), '1.1.0', true );
}

/////////////////////////////////////////////////////////title/////////////////////////////////////////
add_shortcode('tgl_login', 'tgl_shortcode_login');
function tgl_shortcode_login($atts = null, $content = null)
{
    // If we use the shortcode, embed the js
    wp_enqueue_script( 'tgl-login-js' );

    // Load options
    /*$settings = get_option('tgl_settings');
    $setting_api_key = $settings['tgl_api_key'];
    $setting_show_errors = $settings['tgl_show_errors'];*/
    
    // Create output HTML
    $o = '<div class="self_service">' .
        '<div class="spinner_container"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>' .
        '<div class="field_container" style=display:none;>' .
        '  <input type="text" id="tgl_field_id" class="nicdark_border_grey" aria-required="true" aria-invalid="false" placeholder="Booking Number">' .
        '  <input type="text" id="tgl_field_name" class="nicdark_border_grey" aria-required="true" aria-invalid="false" placeholder="Last Name">' .
        '  <input type="text" id="tgl_field_birthday" class="nicdark_border_grey" aria-required="true" aria-invalid="false" placeholder="Birthday" onfocus="(this.type=\'date\')">' .
        '  <input type="submit" id="tgl-login" value="SHOW MY BOOKING" class="wpcf7-form-control wpcf7-submit nicdark_bg_green nicdark_center">' . 
        '</div>' .
        '<style>.self_service .spinner_container, .self_service .field_container{text-align:center;display:block;}</style>' .
        '</div>';
  
    
    // return output
    return $o;
}
//end shortcode