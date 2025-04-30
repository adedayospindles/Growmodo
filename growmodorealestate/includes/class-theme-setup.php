<?php
class Growmodo_Theme_Setup {
    public function __construct() {
        add_action('after_setup_theme', [$this, 'setup']);
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

}