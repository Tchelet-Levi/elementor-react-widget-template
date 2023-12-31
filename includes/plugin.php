<?php

namespace Elementor_React_Addon;

use Elementor_React_Addon\Widgets\TestWidget;

defined('ABSPATH') || exit;

final class Plugin
{
  /**
   * Instance
   *
   * @since 1.0.0
   * @access private
   * @static
   * @var \Elementor_React_Addon\Plugin The single instance of the class.
   */
  private static $_instance = null;

  /**
   * Instance
   *
   * Ensures only one instance of the class is loaded or can be loaded.
   *
   * @since 1.0.0
   * @access public
   * @static
   * @return \Elementor_React_Addon\Plugin An instance of the class.
   */
  public static function instance()
  {
    if (is_null(self::$_instance)) {
      self::$_instance = new self();
    }

    return self::$_instance;
  }


  /**
   * Minimum Elementor Version
   *
   * @since 1.0.0
   * @var string Minimum Elementor version required to run the addon.
   */
  const MINIMUM_ELEMENTOR_VERSION = '3.2.0';

  /**
   * Minimum PHP Version
   *
   * @since 1.0.0
   * @var string Minimum PHP version required to run the addon.
   */
  const MINIMUM_PHP_VERSION = '7.0';

  /**
   * Constructor
   *
   * Perform some compatibility checks to make sure basic requirements are meet.
   * If all compatibility checks pass, initialize the functionality.
   *
   * @since 1.0.0
   * @access public
   */
  public function __construct()
  {
    if ($this->is_compatible()) {
      add_action('elementor/init', [$this, 'init']);
    }
  }

  /**
   * Compatibility Checks
   *
   * Checks whether the site meets the addon requirement.
   *
   * @since 1.0.0
   * @access public
   */
  public function is_compatible()
  {
    // Check if Elementor is installed and activated
    if (!did_action('elementor/loaded')) {
      add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
      return false;
    }

    // Check for required Elementor version
    if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
      add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
      return false;
    }

    // Check for required PHP version
    if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
      add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
      return false;
    }

    return true;
  }

  /**
   * Admin notice
   *
   * Warning when the site doesn't have Elementor installed or activated.
   *
   * @since 1.0.0
   * @access public
   */
  public function admin_notice_missing_main_plugin()
  {

    if (isset($_GET['activate'])) unset($_GET['activate']);

    $message = sprintf(
      /* translators: 1: Plugin name 2: Elementor */
      esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'elementor-test-addon'),
      '<strong>' . esc_html__('Elementor Test Addon', 'elementor-test-addon') . '</strong>',
      '<strong>' . esc_html__('Elementor', 'elementor-test-addon') . '</strong>'
    );

    printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
  }

  /**
   * Admin notice
   *
   * Warning when the site doesn't have a minimum required Elementor version.
   *
   * @since 1.0.0
   * @access public
   */
  public function admin_notice_minimum_elementor_version()
  {

    if (isset($_GET['activate'])) unset($_GET['activate']);

    $message = sprintf(
      /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
      esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-test-addon'),
      '<strong>' . esc_html__('Elementor Test Addon', 'elementor-test-addon') . '</strong>',
      '<strong>' . esc_html__('Elementor', 'elementor-test-addon') . '</strong>',
      self::MINIMUM_ELEMENTOR_VERSION
    );

    printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
  }

  /**
   * Admin notice
   *
   * Warning when the site doesn't have a minimum required PHP version.
   *
   * @since 1.0.0
   * @access public
   */
  public function admin_notice_minimum_php_version()
  {

    if (isset($_GET['activate'])) unset($_GET['activate']);

    $message = sprintf(
      /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
      esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-test-addon'),
      '<strong>' . esc_html__('Elementor Test Addon', 'elementor-test-addon') . '</strong>',
      '<strong>' . esc_html__('PHP', 'elementor-test-addon') . '</strong>',
      self::MINIMUM_PHP_VERSION
    );

    printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
  }

  /**
   * Initialize
   *
   * Load the addons functionality only after Elementor is initialized.
   *
   * Fired by `elementor/init` action hook.
   *
   * @since 1.0.0
   * @access public
   */
  public function init()
  {
    // Widget scripts
    wp_register_script('widget-script-1', ELEMENTOR_REACT_ADDON_PLUGIN_PATH_URL . 'assets/index.js');

    // Styles
    wp_register_style('widget-style-1', ELEMENTOR_REACT_ADDON_PLUGIN_PATH_URL . 'assets/style.css');

    // Register widgets and controls
    add_action('elementor/widgets/register', [$this, 'register_widgets']);
  }

  /**
   * Register Widgets
   *
   * Load widgets files and register new Elementor widgets.
   *
   * Fired by `elementor/widgets/register` action hook.
   *
   * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
   */
  public function register_widgets($widgets_manager)
  {
    // Register widget
    $widgets_manager->register(new TestWidget());
  }
}
