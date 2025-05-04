<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once get_template_directory() . '/includes/class-theme-setup.php';
require_once get_template_directory() . '/includes/class-assets.php';
require_once get_template_directory() . '/includes/class-custom-widget.php';


new Growmodo_Theme_Setup();
new Growmodo_Assets();