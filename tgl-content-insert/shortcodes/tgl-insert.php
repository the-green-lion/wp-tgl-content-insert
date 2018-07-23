<?php

/////////////////////////////////////////////////////////title/////////////////////////////////////////
add_shortcode('tgl_insert', 'tgl_shortcode_insert');
function tgl_shortcode_insert($atts, $content = null)
{
    // Load options
    $settings = get_option('tgl_settings');
    //$setting_api_key = $settings['tgl_api_key'];
    //$setting_api_secret = $settings['tgl_api_key'];

    $setting_api_key = '';
    $setting_api_secret = '';
    $setting_show_errors = false;
    $setting_hide_from_search = false;
    if (array_key_exists ( 'tgl_api_key' , $settings )) { $setting_api_key = $settings['tgl_api_key']; }
    if (array_key_exists ( 'tgl_api_secret' , $settings )) { $setting_api_secret = $settings['tgl_api_secret']; }
    if (array_key_exists ( 'tgl_show_errors' , $settings )) { $setting_show_errors = $settings['tgl_show_errors']; }
    if (array_key_exists ( 'tgl_hide_from_search' , $settings )) { $setting_hide_from_search = $settings['tgl_hide_from_search']; }

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
        'headline_nr' => '1',
        'headline_show'  => true,
    ], $atts);
    
    if($atts['id'] == '' || $atts['path'] == '') {
        return '';
    }
    
    $document = null;
    $documentString = get_transient( $atts['id'] );
    
    if( !$documentString ) {
        
        $client = new TglApiClient();
        $client->signIn($setting_api_key, $setting_api_secret);

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

        if(is_numeric($value) && is_array($item)) {
            $item = $item[intval($value)];
        } else {
            $item = $item->$value;
        }        
        
        if ($item == null) break;
    }
    
    // Render the node
    $itemRendered = $item;
    $classes = "";
    if ($atts['renderer'] == 'facts') {
        $itemRendered = tgl_shortcode_insert_render_facts($itemRendered);
        $classes = 'facts';

    } else if ($atts['renderer'] == 'paragraph') {        
        $itemRendered = tgl_shortcode_insert_render_paragraph($itemRendered, $atts['headline_nr'], $atts['headline_show']);
        $classes = 'paragraph';
    }
    
    // Check if the node actually turned into text
    if (!is_string($itemRendered) && !is_numeric ($itemRendered)) {            
        if ($setting_show_errors == true) return '<span style="color:red">Invalid path</span>';
        else return '';   
    }
    
 
    // wrap output
    $o .= '<div class="dynContent ' . $classes .'">';        
    $o .= strval ($itemRendered);   
    $o .= '</div>'; 
    
    // return output
    return $o;
}
//end shortcode

function tgl_shortcode_insert_render_facts($facts) {
    
    // Facts don't display well if you just output their HTML. When exporting from Google Docs, the tabs get replaced by spaces.
    // So depending on the font used here, the second column will be disarranged.
    // No worries, lets just output the facts one by one, creating a CSS table.
    $html = "";
    $footnotes = array();   
    for ($i = 0; $i < count($facts); $i++) {

        // In case these are accommodation facts, these may come with footnotes. If so, lets find the footnotes and 'number' them with asterisks 
        $asterisks = "";
        if (property_exists ($facts[$i], 'footnote')) {
            $asterisks = str_repeat('*', count($footnotes) + 1);
            $footnotes[] = $asterisks . " " . $facts[$i]->footnote;        
        }

        $html .= tgl_shortcode_insert_render_fact($facts[$i], $asterisks);
    }
    
    // If we found any footnotes, put them underneath the facts table
    $htmlFootnotes = "";
    if (count($footnotes) > 0) {
        $htmlFootnotes = '<p class="footnotes">' . implode ('<br>', $footnotes) . '</p>';
    }
    return $html . $htmlFootnotes;
}

function tgl_shortcode_insert_render_fact($fact, $asterisks) {
    // Create one row in our table. The inline CSS makes it a table row.
    return '<p style="display: table-row;">' .
        '<span style="display: table-cell; font-weight: bold; padding-right: 36px;">' . $fact->title . ':</span>' .
        '<span style="display: table-cell;">' . $fact->value . ' ' . $asterisks . '</span>' .
        '</p>';
}

function tgl_shortcode_insert_render_paragraph($paragraphRaw, $headlineNr, $headlineShow) {
    
    // Facts don't display well if you just output their HTML. When exporting from Google Docs, the tabs get replaced by spaces.
    // So depending on the font used here, the second column will be disarranged.
    // No worries, lets just output the facts one by one, creating a CSS table.
    $headline = "";
    if ($headlineShow) {
        $headline = "<h" . $headlineNr . ">" . $paragraphRaw->headline . "</h" . $headlineNr . ">";
    }
    
    $content = $paragraphRaw->contentHtml;
    preg_match_all("/(?<=<h)1|(?<=<h)2|(?<=<h)3|(?<=<h)4|(?<=<h)5|(?<=<h)h6/", $content, $output_array);
    $maxContentHeadline = max(array_map('intval', $output_array[0]));
    $diff = $headlineNr - $maxContentHeadline + 1;

    if ($diff < 0) {
        for ($i = 1; $i <= 6; $i++) {
            $content = str_replace("<h" . $i, "<h" . strval ($i + $diff), $content);
            $content = str_replace("</h" . $i, "</h" . strval ($i + $diff), $content);
        }
    } else{
        for ($i = 6; $i >= 1; $i--) {
            $content = str_replace("<h" . $i, "<h" . strval ($i + $diff), $content);
            $content = str_replace("</h" . $i, "</h" . strval ($i + $diff), $content);
        }
    }

    $disclaimers = "";
    if ($paragraphRaw->disclaimers) 
    {
        for ($i = 0; $i < count($paragraphRaw->disclaimers); $i++) {
            $disclaimers .=  "<p class='disclaimer'>" . $paragraphRaw->disclaimers[$i] . "</p>";
        }
    }

    return $headline . $content . $disclaimers;
}