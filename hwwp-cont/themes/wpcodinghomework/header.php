<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta name="interkassa-verification" content="56058e9a8c6d9c32350b3f794c4a35fb" />
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title><?php wp_title('&laquo;', true, 'right'); ?></title>
<?php
$slimwriter_logo = get_header_image();
    $slimwriter_logo = $slimwriter_logo
    ? ('<img src="'. esc_url($slimwriter_logo). '" />' )
    : get_bloginfo('name');
?>

    <?php
        if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
        wp_head();
    ?>
</head>
<body <?php body_class();?>>
    <div id="mobile-nav">
        <?php /*wp_nav_menu( $slimwriter_primary_menu );*/ ?>
    </div>

    <div id="wrap">
        <div id="branding">
            <a id="logo" href="<?php echo esc_url(home_url());?>"><?php echo $slimwriter_logo; ?></a>
            <button id="btn-mobile-menu-toggle"></button>
        </div>
        <div id="nav"><nav class="main">
        </nav></div>
				
                <?php

                $args = array(
                    'theme_location' => 'primary',        // (string) Расположение меню в шаблоне. (указывается ключ которым было зарегистрировано меню в функции register_nav_menus)
                    'menu'            => 'HomeWorkMainMenu',              // (string) Название выводимого меню (указывается в админке при создании меню, приоритетнее
                    // чем указанное местоположение theme_location - если указано, то параметр theme_location игнорируется)
                    'container'       => 'nav',           // (string) Контейнер меню. Обворачиватель ul. Указывается тег контейнера (по умолчанию в тег div)
                    'container_class' => '',              // (string) class контейнера (div тега)
                    'container_id'    => 'main-menu',              // (string) id контейнера (div тега)
                    'menu_class'      => 'horizontal-navigation',          // (string) class самого меню (ul тега)
                    'menu_id'         => '',              // (string) id самого меню (ul тега)
                    'echo'            => true,            // (boolean) Выводить на экран или возвращать для обработки
                    'fallback_cb'     => 'wp_page_menu',  // (string) Используемая (резервная) функция, если меню не существует (не удалось получить)
                    'before'          => '',              // (string) Текст перед <a> каждой ссылки
                    'after'           => '',              // (string) Текст после </a> каждой ссылки
                    'link_before'     => '',              // (string) Текст перед анкором (текстом) ссылки
                    'link_after'      => '',              // (string) Текст после анкора (текста) ссылки
                    'depth'           => 0,               // (integer) Глубина вложенности (0 - неограничена, 2 - двухуровневое меню)
                    'walker'          => '',              // (object) Класс собирающий меню. Default: new Walker_Nav_Menu

                );				
                wp_nav_menu($args);

                ?>  
