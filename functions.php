<?php

define( 'DISABLE_ULTIMATE_GOOGLE_MAP_API', true );

if ( ! isset( $content_width ) ) {
    $content_width = 1920;
}

require_once get_template_directory() . '/includes/class-myhome.php';

function My_Home_Theme() {
    return My_Home::get_instance();
}

// initiate MyHome theme
My_Home_Theme()->init();
