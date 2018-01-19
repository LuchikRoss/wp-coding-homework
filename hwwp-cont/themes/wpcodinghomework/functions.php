

<?php

// Удаляем определение версии WordPress и др бред
remove_action ('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles(){
	wp_register_style( 'my-homework-theme', get_stylesheet_directory_uri() . '/css/hwstyle.css' );
	wp_enqueue_style( 'my-homework-theme', get_stylesheet_directory_uri() . '/css/hwstyle.css' , array ( '-slimwriter-style' ) , array ( '-slimwriter-bootstrap' ) , array ( '-slimwriter-fonts' ) , array ( '-slimwriter-ie8' ) );
}


define('HOMEWORK_THEME_TEXTDOMAIN', 'wpcodinghomework');
/**
 * Интернационализация, локализация
 */
add_action( 'after_setup_theme', 'themeLocalization' ); 
function themeLocalization(){
   load_theme_textdomain( HOMEWORK_THEME_TEXTDOMAIN, get_template_directory() . '/languages/' );
}

/**
 * Включаем поддержку произвольных меню
 */
add_action( 'after_setup_theme', 'theme_register_nav_menu', 100 );
function theme_register_nav_menu() {
	register_nav_menu( 'primary', __( 'Primary Menu', HOMEWORK_THEME_TEXTDOMAIN ) );
}

add_theme_support( 'custom-background' );

$args = array(
'flex-width'    => true,
'width'         => 486,
'flex-height'    => true,
'height'        => 151,
'default-image' => get_template_directory_uri() . '/images/header-small.jpg',
);
add_theme_support( 'custom-header', $args );



   //var_dump(‘<pre>’, $wp_customize ,'</pre>’);

   /*$wp_customize->add_panel();

   $wp_customize->get_panel();

   $wp_customize->remove_panel();

   $wp_customize->add_section();

   $wp_customize->get_section();

   $wp_customize->remove_section();

   $wp_customize->add_setting();

   $wp_customize->get_setting();

   $wp_customize->remove_setting();

   $wp_customize->add_control();

   $wp_customize->get_control();

   $wp_customize->remove_control();*/
 
 // создать секцию
add_action('customize_register', function($customizer){
    $customizer->add_section(
        'example_section_one',
        array(
            'title' => 'Мои настройки',
            'description' => 'Пример секции',
            'priority' => 11,
        )
    );
	
	 // добавить настройку
$customizer->add_setting(
    'color-setting',
    array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
// добавить контрол
$customizer->add_control(
    new WP_Customize_Color_Control(
        $customizer,
        'color-setting',
        array(
            'label' => 'Настройка цвета',
            'section' => 'example_section_one',
            'settings' => 'color-setting',
       )
    )
);
			
});

/*$id — уникальный идентификатор

$args — массив аргументов

В массиве $args может быть несколько позиций, а именно:

title — как секция будет называться

description — описание секции (необязательно)

priority — какой по счету будет располагаться секция или ее приоритет (по-умолчанию 10)

capability — права пользователя, необходимые для изменения данного параметра. Т.е. разные параметры могут видеть разные группы пользователей. Круто! (необязательно)

theme_supports — указывает на то, что текущая тема должна поддерживать описанную в параметре функцию (необязательно)
*/


// вывод настройки в теме
//echo get_theme_mod('example_textbox', 'Пример настройки');