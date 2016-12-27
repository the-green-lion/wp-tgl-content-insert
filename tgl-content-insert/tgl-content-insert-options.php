<?php
add_action( 'admin_menu', 'tgl_add_admin_menu' );
add_action( 'admin_init', 'tgl_settings_init' );

function tgl_add_admin_menu(  ) { 

	add_options_page( 'TGL Content Insert', 'TGL Content', 'manage_options', 'tgl-content-insert-options.php', 'tgl_options_page' );
    
}


function tgl_settings_init(  ) { 

	register_setting( 'pluginPage', 'tgl_settings' );

	add_settings_section(
		'tgl_pluginPage_section', 
		__( 'General Settings', 'wordpress' ), 
		'tgl_settings_section_callback', 
		'pluginPage'
	);

	add_settings_field( 
		'tgl_api_key', 
		__( 'Your TGL API key', 'wordpress' ), 
		'tgl_api_key_render', 
		'pluginPage', 
		'tgl_pluginPage_section' 
	);

	add_settings_field( 
		'tgl_hide_from_search', 
		__( 'Hide From Search Engines', 'wordpress' ), 
		'tgl_hide_from_search_render', 
		'pluginPage', 
		'tgl_pluginPage_section' 
	);

	add_settings_field( 
		'tgl_show_errors', 
		__( 'Show Errors', 'wordpress' ), 
		'tgl_show_errors_render', 
		'pluginPage', 
		'tgl_pluginPage_section' 
	);


}


function tgl_api_key_render(  ) { 

	$options = get_option( 'tgl_settings' );
	?>
	<textarea cols='50' rows='1' name='tgl_settings[tgl_api_key]'><?php echo $options['tgl_api_key']; ?></textarea><br>
    <small>To obtain an API key, contact <a href="mailto:bernhard@thegreenlion.net">the Green Lion team</a>. Keep this key secret, it is only for you.</small>
	<?php

}


function tgl_hide_from_search_render(  ) { 

	$options = get_option( 'tgl_settings' );
	?>
	<input type='checkbox' name='tgl_settings[tgl_hide_from_search]' <?php checked( $options['tgl_hide_from_search'], 1 ); ?> value='1'><br>
    <small>Recommended to avoid the duplicate content issue. This is if search engines think you just copied text from some other website.</small>
	<?php

}


function tgl_show_errors_render(  ) { 

	$options = get_option( 'tgl_settings' );
	?>
	<input type='checkbox' name='tgl_settings[tgl_show_errors]' <?php checked( $options['tgl_show_errors'], 1 ); ?> value='1'><br>
    <small>Helpful for getting started. If you e.g. specify an invalid path or id, nothing will show up. Tick off this setting to show an error message instead.</small>
	<?php

}


function tgl_settings_section_callback(  ) { 

	echo __( 'To use The Green Lion\'s descriptions on your website, insert your personal API key below and use the shortcode <b>[tgl_insert id="..." path="..."]</b>', 'wordpress' );

}


function tgl_options_page(  ) { 

    if ( !current_user_can( 'manage_options' ) )  {
        wp_die( 'You do not have sufficient permissions to access this page.' );
    }
    
	?>
	<form action='options.php' method='post'>

		<h2>TGL Content Insert</h2>

		<?php
		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
		submit_button();
		?>

	</form>
	<?php

}

?>