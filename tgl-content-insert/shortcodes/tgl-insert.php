<?php

/////////////////////////////////////////////////////////title/////////////////////////////////////////
add_shortcode('tgl_insert', 'tgl_shortcode_insert');
function tgl_shortcode_insert($atts, $content = null)
{
    // Load options
    $settings = get_option('tgl_settings');
    $setting_show_errors = $settings['tgl_show_errors'];
    $setting_hide_from_search = $settings['tgl_hide_from_search'];
    
    // Hide from search engines, if chosen
    if ($setting_hide_from_search && isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/bot|crawl|slurp|spider/i', $_SERVER['HTTP_USER_AGENT'])) {
        return '';
    }
    
    // normalize attribute keys, lowercase
    $atts = array_change_key_case((array)$atts, CASE_LOWER);
 
    // override default attributes with user attributes
    $atts = shortcode_atts([
        'id' => '',
        'path' => '',
        'renderer' => '',
    ], $atts);
    
    if($atts['id'] == '' || $atts['path'] == '') {
        return '';
    }
    
    $document = null;
    $documentString = get_transient( $atts['id'] );
    
    if( !$documentString ) {
        
        $key = get_option('tgl_api_key'); //"e193c470-cc9a-48f7-ab89-4d2429066864";
        $client = new TglApi();
        $client->signInWithApiKey($key);

        $document = $client->getDocument($atts['id']);
        
        if (!$document) {
            if ($setting_show_errors == true) return '<span style="color:red">Invalid document ID</span>';
            else return '';   
        }
        
        set_transient( $atts['id'], json_encode($document), 60*60*48 );
        
    } else {
        $document = json_decode($documentString);
    }
    
    
    // Get the node within the document we specified in path
    $path = explode(".", $atts['path']);
    $item = $document;
    foreach ($path as &$value) {
        $item = $item->$value;
        
        if ($item == null) break;
    }
    
    // Render the node
    $itemRendered = $item;
    if ($atts['renderer'] == 'facts') {
        $itemRendered = tgl_shortcode_insert_render_facts($itemRendered);
        
    }
    
    // Check if the node actually turned into text
    if (!is_string($itemRendered)) {            
        if ($setting_show_errors == true) return '<span style="color:red">Invalid path</span>';
        else return '';   
    }
    
 
    // wrap output
    $o .= '<div class="dynContent">';        
    $o .= $itemRendered;    
    $o .= '</div>'; 
    
    // return output
    return $o;
}
//end shortcode

function tgl_shortcode_insert_render_facts($paragraph) {
    
    // Facts don't display well if you just output their HTML. When exporting from Google Docs, the tabs get replaced by spaces.
    // So depending on the font used here, the second column will be disarranged.
    // No worries, lets just output the facts one by one, creating a CSS table.
    $html = "";    
    for ($i = 0; $i < count($paragraph->facts); $i++) {
        $html .= tgl_shortcode_insert_render_fact($paragraph->facts[$i]);
    }
    
    return $html;
}

function tgl_shortcode_insert_render_fact($fact) {
    // Create one row in our table. The inline CSS makes it a table row.
    return '<p style="display: table-row;">' .
        '<span style="display: table-cell; font-weight: bold; padding-right: 36px;">' . $fact->title . ':</span>' .
        '<span style="display: table-cell;">' . $fact->value . '</span>' .
        '</p>';
}