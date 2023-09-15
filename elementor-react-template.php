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

//  ! All the names here must be unique to avoid collisions!.

function elementor_react_addon()
{
  // Load plugin files
  require_once(__DIR__ . '/includes/plugin.php');

  // Scripts

  // React scripts
  wp_register_script('react', "https://unpkg.com/react@18/umd/react.production.min.js");
  wp_register_script('react-dom', "https://unpkg.com/react-dom@18/umd/react-dom.production.min.js");

  // Widget scripts
  wp_register_script('widget-script-1', plugins_url('assets/index.js', __FILE__));

  // Styles
  wp_register_style('widget-style-1', plugins_url('assets/style.css', __FILE__));

  // Run the plugin
  \Elementor_React_Addon\Plugin::instance();
}


add_action('plugins_loaded', 'elementor_react_addon');
