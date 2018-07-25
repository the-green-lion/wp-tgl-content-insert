<?php

add_action( 'wp_enqueue_scripts', 'register_tgl_verify_script' );

function register_tgl_verify_script() {
    wp_register_script( 'tgl-verify-js', plugins_url( '/scripts/tgl_shortcode_verify.js' , dirname(__FILE__) ), array(), '1.1.0', true );
}

/////////////////////////////////////////////////////////title/////////////////////////////////////////
add_shortcode('tgl_verify', 'tgl_shortcode_verify');
function tgl_shortcode_verify($atts = null, $content = null)
{
    // If we use the shortcode, embed the js
    wp_enqueue_script( 'tgl-verify-js' );

        
    // Create output HTML
    $o = '<div class="self_service">' .
        '<div class="spinner_container"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>' .
        '<div class="field_container" style=display:none;>' .
        '  <input type="text" id="tgl_field_code" class="nicdark_border_grey" aria-required="true" aria-invalid="false" placeholder="Verification Code">' .
        '  <input type="submit" id="tgl-login" value="VERIFY DOCUMENT" class="wpcf7-form-control wpcf7-submit nicdark_bg_green nicdark_center">' . 
        '</div>' .
        '<style>.self_service .spinner_container, .self_service .field_container{text-align:center;display:block;}</style>' .
        '</div>';
  
    
    // return output
    return $o;
}
//end shortcode