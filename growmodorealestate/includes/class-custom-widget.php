<?php
class Growmodo_Custom_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'growmodo_custom_widget',
            esc_html__('Growmodo Custom Widget', 'growmodo'),
            ['description' => esc_html__('A simple custom widget with shortcode.', 'growmodo')]
        );

        add_shortcode('growmodo_custom_widget', [$this, 'render_shortcode']);
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }
        echo '<p>This is a Growmodo custom widget output.</p>';
        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : esc_html__('New title', 'growmodo');
        ?>
        <p>
        <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('Title:', 'growmodo'); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
               name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text"
               value="<?php echo esc_attr($title); ?>">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = [];
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }

    public function render_shortcode($atts) {
        $atts = shortcode_atts([
            'title' => '',
            'area'  => 'growmodo-widget-area' // you can define a default widget area slug
        ], $atts);

        ob_start();
        echo '<div class="widget shortcode-widget">';
        echo '<h2 class="widget-title">' . esc_html($atts['title']) . '</h2>';

        // Render the actual widget area (sidebar)
        if (is_active_sidebar($atts['area'])) {
            dynamic_sidebar($atts['area']);
        } else {
            echo '<p>No widgets added to this area yet.</p>';
        }

        echo '</div>';
        return ob_get_clean();
    }


}

function growmodo_register_custom_widget() {
    register_widget('Growmodo_Custom_Widget');
}
add_action('widgets_init', 'growmodo_register_custom_widget');
