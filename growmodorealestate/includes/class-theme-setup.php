<?php
class Growmodo_Theme_Setup {
    public function __construct() {
        add_action('after_setup_theme', [$this, 'setup']);
        add_action('widgets_init', [$this, 'register_widget_areas']);
        add_action( 'customize_register', [ $this, 'customizer_settings' ] );

    }

    public function customizer_settings( $wp_customize ) {
    $wp_customize->add_section( 'top_banner_section', [
        'title' => __( 'Top Banner', 'growmodorealestate' ),
        'priority' => 30,
    ]);

    $wp_customize->add_setting( 'top_banner_text', [
        'default' => '✨Discover Your Dream Property with Estatein <a href="/properties">Learn More</a>',
        'sanitize_callback' => 'wp_kses_post',
    ]);

    $wp_customize->add_control( 'top_banner_text', [
        'label' => __( 'Banner Text (HTML allowed)', 'growmodorealestate' ),
        'section' => 'top_banner_section',
        'type' => 'textarea',
    ]);

    // Banner Background Image
    $wp_customize->add_setting('top_banner_bg', [
        'default' => get_template_directory_uri() . '/assets/images/abstract-design.png',
        'sanitize_callback' => 'esc_url_raw'
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'top_banner_bg', [
        'label' => __('Top Banner Background Image', 'growmodorealestate'),
        'section' => 'top_banner_section',
        'settings' => 'top_banner_bg',
    ]));

}

    public function setup() {
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('custom-logo');
        add_theme_support('menus');

        register_nav_menus([
            'primary' => __('Primary Menu', 'growmodorealestate'),
            'footer'  => __('Footer Menu', 'growmodorealestate'),
        ]);
    }


    public function register_widget_areas() {
        register_sidebar([
            'name'          => __('Main Sidebar', 'growmodo'),
            'id'            => 'main-sidebar',
            'description'   => __('Appears on the right side of pages/posts.', 'growmodo'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ]);

        register_sidebar([
            'name'          => __('Footer Widgets', 'growmodo'),
            'id'            => 'footer-widgets',
            'description'   => __('Widgets area in the footer', 'growmodo'),
            'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="footer-widget-title">',
            'after_title'   => '</h4>',
        ]);
		
		register_sidebar([
			'name'          => esc_html__('Growmodo Widget Area', 'growmodo'),
			'id'            => 'growmodo-widget-area',
			'description'   => esc_html__('Add widgets here.', 'growmodo'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
    ]);
    }
    
}