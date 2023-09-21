<?php

namespace Elementor_React_Addon\Widgets;

defined('ABSPATH') || exit;

class TestWidget extends \Elementor\Widget_Base
{
  public function get_name()
  {
    return 'widget_react_name';
  }

  public function get_title()
  {
    return esc_html__('My React Widget Name / Title', 'textdomain');
  }

  public function get_icon()
  {
    return 'eicon-code';
  }

  public function get_custom_help_url()
  {
    return 'https://go.elementor.com/widget-name';
  }

  public function get_categories()
  {
    return ['general'];
  }

  public function get_keywords()
  {
    return ['keyword', 'keyword'];
  }

  public function get_script_depends()
  {
    // Consider requiring 'wp-components' for fast component reuse if necessary
    return ['wp-element', 'widget-script-1'];
  }

  public function get_style_depends()
  {
    return ['widget-style-1'];
  }

  protected function register_controls()
  {

    $this->start_controls_section(
      'content_section',
      [
        'label' => esc_html__('Content', 'textdomain'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT
      ]
    );

    $this->add_control(
      'example_control',
      [
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'label' => esc_html__('Simple Text Field', 'textdomain'),
        'default' => 'Hello! I was set through Elementor! :)',
      ]
    );

    $this->add_control(
      'root_id',
      [
        'type' => \Elementor\Controls_Manager::TEXT,
        'label' => esc_html__('Root ID', 'textdomain'),
        'default' => '' // having defaults can potentially override the component by adding another component to Elementor..
      ]
    );

    $this->end_controls_section();
  }


  // Javascript based rendering for the preview (editor)
  protected function content_template()
  {
    // Render root element
?>
    <# view.addRenderAttribute( 'wrapper' , { id: settings.root_id } ); #>
      <div {{{view.getRenderAttributeString('wrapper')}}}>
        <!-- Fallback here.. -->
        Oops, something went wrong while loading this widget..
      </div>

      <script type="module">
        import App from '<?= ELEMENTOR_REACT_ADDON_PLUGIN_PATH_URL . 'assets/index.js' ?>';
        var root = ReactDOM.createRoot(document.getElementById("{{{settings.root_id}}}"));

        // The settings. Only way I found to access them is through a string.
        // !!! UNSAFE -- user input gets escaped on writing "</ script>" due to escaping php html!!!
        // TODO: Find a safer way to do this.
        var settings = {
          text: "{{{settings.example_control}}}"
        }

        root.render(React.createElement(() => App(settings)))
      </script>
    <?php
  }

  // PHP based rendering for the front end (what the end user sees)
  protected function render()
  {
    $settings = $this->get_settings_for_display();
    // Render the root element

    $this->add_render_attribute(
      'wrapper',
      [
        'id' => $settings['root_id']
      ]
    );

    ?>

      <?php if (!$settings['root_id']) : ?>
        <p style="color: red;">Missing Root ID.</p>
      <?php else : ?>
        <div <?= $this->get_render_attribute_string('wrapper') ?>>
          <!-- Fallback here.. -->
          Oops, something went wrong while loading this widget..
        </div>

        <script type="module">
          import App from '<?= ELEMENTOR_REACT_ADDON_PLUGIN_PATH_URL . 'assets/index.js' ?>';
          var root = ReactDOM.createRoot(document.getElementById("<?= $settings['root_id'] ?>"));

          // It doesn't seem that react based applications need filtering functions..
          var settings = {
            text: "<?= $settings['example_control'] ?>"
          }

          root.render(React.createElement(() => App(settings)))
        </script>
      <?php endif; ?>
  <?php
  }
}
