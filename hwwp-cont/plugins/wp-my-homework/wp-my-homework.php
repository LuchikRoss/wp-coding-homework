<?php

/*
Plugin Name: WP My Home Work Plugin
Plugin URI: https://github.com/LuchikRoss/WP-HomeWork
Description: My home work progress plugin
Version: 1.0
Author: rostyslavnaryzhniak
Author URI: https://www.linkedin.com/in/rostyslav-naryzhniak-839513150/
Text Domain: wp-my-homework
Domain Path: /languages/
License: A “Slug” license name e.g. GPL2
	Copyright 2017  Rostyslav Naryzhniak  (email: webmaster@wp-homework.h1n.ru)
	    This program is free software; you can redistribute it and/or modify
	    it under the terms of the GNU General Public License as published by
	    the Free Software Foundation; either version 2 of the License, or
	    (at your option) any later version.
	    This program is distributed in the hope that it will be useful,
	    but WITHOUT ANY WARRANTY; without even the implied warranty of
	    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	    GNU General Public License for more details.
	    You should have received a copy of the GNU General Public License
	    along with this program; if not, write to the Free Software
	    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

require_once plugin_dir_path(__FILE__) . '/config-path.php';
require_once HOMEWORK_PlUGIN_DIR.'/includes/common/HomeWorkAutoload.php';
require_once HOMEWORK_PlUGIN_DIR.'/includes/HomeWorkPlugin.php';

//Регистрация виджета
//add_action('widgets_init', create_function('', 'return register_widget("includes\widgets\HomeWorkGuestBookWidget");'));
add_action('widgets_init', create_function('', 'return register_widget("includes\widgets\MyCustomWidgetInterkassa");'));

register_activation_hook( __FILE__, 'homework_activate' );
register_deactivation_hook( __FILE__, 'homework_deactivate' );

add_shortcode( 'ross', 'true_ross_func' );
function true_ross_func( $atts ){
	return "<p><b>(это шорткод - " . site_url() . ") </b></p>"; // никаких echo, только return
	}  

add_option( 'hw_option', '555' );
//echo get_option('blogname'). " "; 
//echo get_option('hw_option');
delete_option("hw_option"); 

update_option( 'posts_per_rss', 1 );
update_option( 'posts_per_page', 1);

// установка дополнительной опции на главной странице настроек "General"
add_action('admin_menu', 'add_option_field_to_general_admin_page');
	function add_option_field_to_general_admin_page(){
		$option_name = 'my_option';

		// регистрируем опцию
		register_setting( 'general', $option_name );

		// добавляем поле
		add_settings_field( 
			'home_work_setting-id', 
			'My HomeWork Option', 
			'home_work_setting_callback_function', 
			'general', 
			'default', 
			array( 
				'id' => 'home_work_setting-id', 
				'option_name' => 'my_option' 
			)
		);
}

function home_work_setting_callback_function( $val ){
	$id = $val['id'];
	$option_name = $val['option_name'];
	?>
	<input 
		type="text" 
		name="<? echo $option_name ?>" 
		id="<? echo $id ?>" 
		value="<? echo esc_attr( get_option($option_name) ) ?>" 
	/> 
	<?
}

//add_action('wp_footer', 'my_action_javascript', 99); // javascript ajax для фронта
//add_action('admin_print_footer_scripts', 'my_action_javascript', 99); //админка javascript ajax
	function my_action_javascript() {
		?>
		<script type="text/javascript" >
		jQuery(document).ready(function($) {
			var data = {
				action: 'my_action',
				whatever: 'homework AJAX adminmenu response'
			};

			// с версии 2.8 'ajaxurl' всегда определен в админке
			jQuery.post( ajaxurl, data, function(response) {
				alert('Получено с сервера: ' + response);
			});
		});
		</script>
		<?php
}
			
//обязательные хуки для фронта (ajax)
add_action('wp_ajax_(action)', 'my_action_callback');
add_action('wp_ajax_nopriv_(action)', 'my_action_callback');			
			
add_action('wp_ajax_my_action', 'my_action_callback');
	function my_action_callback() {
		$whatever = $_POST['whatever'];
		echo $whatever;
		wp_die(); // выход нужен для того, чтобы в ответе не было ничего лишнего, а только то, 
				  //что возвращает функция
}

add_action( 'wp_enqueue_scripts', 'myajax_data', 99 );
	function myajax_data(){
		// Первый параметр 'twentyfifteen-script' означает, что код будет прикреплен к скрипту 
		//с ID 'twentyfifteen-script'
		// 'twentyfifteen-script' должен быть добавлен в очередь на вывод, иначе WP не поймет куда 
		//вставлять код локализации
		// Заметка: обычно этот код нужно добавлять в functions.php в том месте где подключаются 
		//скрипты, после указанного скрипта
		wp_localize_script( 'home-work-script', 'myajax', 
			array(
				'url' => admin_url('admin-ajax.php')
			)
		);  
	}
	
add_action( 'init', 'my_custom_post_product' );
	function my_custom_post_product() {
	   $labels = array(
		  'name'               => _x( 'HomWork Production', 'post type general name' ),
		  'singular_name'      => _x( 'HomWork Product', 'post type singular name' ),
		  'add_new'            => _x( 'Add New', 'product' ),
		  'add_new_item'       => __( 'Add New Product' ),
		  'edit_item'          => __( 'Редактировать продукт' ),
		  'new_item'           => __( 'Новый продукт' ),
		  'all_items'          => __( 'All Products' ),
		  'view_item'          => __( 'Смотреть продукт' ),
		  'search_items'       => __( 'Найти продукт' ),
		  'not_found'          => __( 'Продукты не найдены' ),
		  'not_found_in_trash' => __( 'Нет удаленной продукции' ), 
		  'parent_item_colon'  => '',
		  'menu_name'          => 'Home Work Production'
	   );
	   $args = array(
		  'labels'        => $labels,
		  'description'   => 'Пользовательский тип записей продукции',
		  'public'        => true,
		  'menu_position' => 5,
		  'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'product_category'),
		  'has_archive'   => true,
	   );
	register_post_type( 'product', $args );   
}

//add_action( 'widgets_init', function(){
//	register_widget( 'My_Custom_Widget_Interkassa' );
//});

// отключение стандартных виджетов
add_action( 'widgets_init', 'true_remove_default_widget', 20 );
function true_remove_default_widget() {
	unregister_widget('WP_Widget_Archives'); // Архивы
	unregister_widget('WP_Widget_Calendar'); // Календарь
	//unregister_widget('WP_Widget_Categories'); // Рубрики
	//unregister_widget('WP_Widget_Meta'); // Мета
	//unregister_widget('WP_Widget_Pages'); // Страницы
	unregister_widget('WP_Widget_Recent_Comments'); // Свежие комментарии
	unregister_widget('WP_Widget_Recent_Posts'); // Свежие записи
	unregister_widget('WP_Widget_RSS'); // RSS
	unregister_widget('WP_Widget_Search'); // Поиск
	unregister_widget('WP_Widget_Tag_Cloud'); // Облако меток
	//unregister_widget('WP_Widget_Text'); // Текст
	//unregister_widget('WP_Nav_Menu_Widget'); // Произвольное меню
}

