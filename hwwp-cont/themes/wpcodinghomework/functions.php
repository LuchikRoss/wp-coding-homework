<<<<<<< HEAD


<?php
=======
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
>>>>>>> aae5663cf8f13adaed83fbdad5e69700833b63cb

// Удаляем определение версии WordPress и др бред
remove_action ('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');

<<<<<<< HEAD
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles(){
	wp_register_style( 'my-homework-theme', get_stylesheet_directory_uri() . '/css/hwstyle.css' );
	wp_enqueue_style( 'my-homework-theme', get_stylesheet_directory_uri() . '/css/hwstyle.css' , array ( '-slimwriter-style' ) , array ( '-slimwriter-bootstrap' ) , array ( '-slimwriter-fonts' ) , array ( '-slimwriter-ie8' ) );
}



/**
 * Включаем поддержку произвольных меню
 */
 
add_action( 'after_setup_theme', 'theme_register_nav_menu' );
function theme_register_nav_menu() {
	register_nav_menu( 'primary', 'Primary Menu' );
}
=======

>>>>>>> aae5663cf8f13adaed83fbdad5e69700833b63cb
