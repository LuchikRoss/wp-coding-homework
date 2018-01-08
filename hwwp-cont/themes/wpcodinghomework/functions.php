<?php
/**
 * Registers a stylesheet.
 */
function wp_homework_register_styles() {
    wp_register_style( 'my-homework-theme', get_stylesheet_directory_uri() . '/css/hwstyle.css' );
    wp_enqueue_style( 'my-homework-theme' );
}
// Register style sheet.
add_action( 'wp_enqueue_scripts', 'wp_homework_register_styles' );

// Удаляем определение версии WordPress и др бред
remove_action ('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');


