<?php
class Growmodo_Assets {
    public function __construct() {
        add_action('wp_enqueue_scripts', [$this, 'enqueue']);
    }

    public function enqueue() {
        // Load default stylesheet
        wp_enqueue_style('growmodo-style', get_stylesheet_uri());

        // Load custom CSS
        wp_enqueue_style(
            'growmodo-main',
            get_template_directory_uri() . '/assets/css/main.css',
            [],
            '1.0'
        );

        // Load banner CSS
        wp_enqueue_style(
            'growmodo-banner',
            get_template_directory_uri() . '/assets/css/banner.css',
            [],
            '1.0'
        );

        // Load custom JS (main functionality)
        wp_enqueue_script(
            'growmodo-main',
            get_template_directory_uri() . '/assets/js/main.js',
            ['jquery'],
            '1.0',
            true
        );

        // Load banner JS (dismiss logic)
        wp_enqueue_script(
            'growmodo-banner',
            get_template_directory_uri() . '/assets/js/banner.js',
            [],
            '1.0',
            true
        );
    }
}