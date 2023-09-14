<?php

class Elementor_React_Widget extends \Elementor\Widget_Base
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
    return ['react', 'react-dom', 'widget-script-1'];
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
        'type' => \Elementor\Controls_Manager::TEXT,
        'label' => esc_html__('Simple Text Field', 'textdomain'),
      ]
    );

    $this->add_control(
      'root_id',
      [
        'type' => \Elementor\Controls_Manager::TEXT,
        'label' => esc_html__('Root ID', 'textdomain'),
        'default' => 'root'
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
      </div>

      <script type="module">
        import App from '<?= plugin_dir_url(dirname(dirname(__FILE__))) . 'assets/index.js' ?>';
        var root = ReactDOM.createRoot(document.getElementById("{{{settings.root_id}}}"));

        // The settings. Only way I found to access them is through a string.
        var settings = {
          text: "{{settings.example_control}}"
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
      <div <?= $this->get_render_attribute_string('wrapper') ?>>
      </div>

      <script type="module">
        import App from '<?= plugin_dir_url(dirname(dirname(__FILE__))) . 'assets/index.js' ?>';
        var root = ReactDOM.createRoot(document.getElementById("<?= $settings['root_id'] ?>"));

        var settings = {
          text: "<?= esc_html($settings['example_control']) ?>"
        }

        root.render(React.createElement(() => App(settings)))
      </script>
  <?php
  }
}
