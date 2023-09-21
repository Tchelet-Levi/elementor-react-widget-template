<?php

/**
 * Plugin Name: Elementor React Template Plugin
 * Description: Template plugin for widget creation with React content
 * Version: 1.0.0
 * Author: Me! Zu!
 * Text Domain: elementor-react-template
 *
 * Elementor tested up to: 3.15.3
 * Elementor Pro tested up to: 3.15.3
 */

use Elementor_React_Addon\Plugin;

defined('ABSPATH') || exit;

// define *global* variables for plugin file and dir path for our plugin.
// Care for naming conflicts..
if (!defined('ELEMENTOR_REACT_ADDON_PLUGIN_FILE')) {
  define('ELEMENTOR_REACT_ADDON_PLUGIN_FILE', __FILE__);
}

if (!defined('ELEMENTOR_REACT_ADDON_PLUGIN_PATH')) {
  define('ELEMENTOR_REACT_ADDON_PLUGIN_PATH', plugin_dir_path(__FILE__));
}

if (!defined('ELEMENTOR_REACT_ADDON_PLUGIN_PATH_URL')) {
  define('ELEMENTOR_REACT_ADDON_PLUGIN_PATH_URL', plugin_dir_url(__FILE__));
}

// require_once our autoload
require_once ELEMENTOR_REACT_ADDON_PLUGIN_PATH . 'vendor/autoload.php';

if (!function_exists('elementor_react_plugin')) {
  function elementor_react_plugin()
  {
    return Plugin::instance();
  }
}

// Run the plugin
add_action('plugins_loaded', 'elementor_react_plugin');
