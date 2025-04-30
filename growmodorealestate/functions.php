<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once get_template_directory() . '/includes/class-theme-setup.php';
require_once get_template_directory() . '/includes/class-assets.php';

new Growmodo_Theme_Setup();
new Growmodo_Assets();

function growmodo_enqueue_google_fonts() {
    wp_enqueue_style(
        'growmodo-google-fonts',
        'https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;700&display=swap',
        [],
        null
    );
}
add_action('wp_enqueue_scripts', 'growmodo_enqueue_google_fonts');
