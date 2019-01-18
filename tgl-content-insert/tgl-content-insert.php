<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              thegreenlion.net
 * @since             1.0.0
 * @package           Tgl_Content_Insert
 *
 * @wordpress-plugin
 * Plugin Name:       TGL Content Insert
 * Plugin URI:        thegreenlion.net
 * Description:       Gives you an easy way to add The Green Lion's program descriptions to your website. No more copy-paste, no more keeping them updated by hand.
 * Version:           0.10.0
 * Author:            Bernhard Gessler
 * Author URI:        thegreenlion.net
 * License:           MIT
 * License URI:       https://opensource.org/licenses/MIT
 * Text Domain:       tgl-content-insert
 * Domain Path:       /languages
 */

//TGL API Client
include ('tglApiClient/tglApiClient.php');

//Settings Page
include ('tgl-content-insert-options.php');

//shortcodes
include ('shortcodes/tgl-insert.php');
include ('shortcodes/tgl-login.php');
include ('shortcodes/tgl-verify.php');