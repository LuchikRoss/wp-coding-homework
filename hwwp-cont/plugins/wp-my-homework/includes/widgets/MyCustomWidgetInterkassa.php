<?php

namespace includes\widgets;
//use includes\models\admin\menu\HomeWorkInterkassaSubMenuModel;

class MyCustomWidgetInterkassa extends \WP_Widget
{ 
	function __construct() {
		// Запускаем родительский класс
		parent::__construct(
			'MyCustomWidgetInterkassa', // ID виджета, если не указать (оставить ''), то ID будет равен названию класса в нижнем регистре: my_widget
			'Интеркасса',
			array('description' => 'Курсы валют')
		);

		// стили скрипты виджета, только если он активен
		if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
			add_action('wp_enqueue_scripts', array( $this, 'add_my_widget_scripts' ));
			add_action('wp_head', array( $this, 'add_my_widget_style' ) );
		}
	}

	// Вывод виджета
	function widget( $args, $instance ){
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $args['before_widget'];

		if( $title )
			echo $args['before_title'] . $title . $args['after_title'];
		
		       // TODO: Implement render() method.
		$request = wp_remote_get( 'https://api.interkassa.com/v1/currency' );
		
		$pins = json_decode( $request['body'], true );
			
		if( !empty( $pins['data'] ) ) {
			echo "<div style='padding: 15px 5px; margin: 20px;'><pre style='background-color: #252525; border-color: #5B4B54;'><b>";
			echo "<h1 style='color: #679ED2;'>Интеркасса (API)</h1><b>";
			echo "<h2 align='center' style='color: #FFD48E;'>Доллар</h2><pre align='center' style='background-color: #1B1B1B; color: #A4B29B; border-color: #679ED2; '>";
			echo "покупка  $ 1 | " . round ( $pins['data']['USD']['UAH']['in'] , 2 ) . " грн<br />";
			echo "продажа  $ 1 | " . round ( $pins['data']['USD']['UAH']['out'] , 2 ) . " грн</pre>";
			
			echo "<h2 align='center' style='color: #FFD48E;'>Евро</h2><pre align='center' style='background-color: #1B1B1B; color: #A4B29B; border-color: #679ED2; '>" ;
			echo "покупка  € 1 | " . round ( $pins['data']['EUR']['UAH']['in'] , 2 ) . " грн<br />";
			echo "продажа  € 1 | " . round ( $pins['data']['EUR']['UAH']['out'] , 2 ) . " грн<br />";
			echo '</b></pre><br />';
			
			echo '<form id="payment" name="payment" method="post" action="https://sci.interkassa.com/" enctype="utf-8">';
			
			echo '<input type="hidden" name="ik_co_id" value="5a43a6b93d1eaf97018b4567" />';
			echo '<input type="hidden" name="ik_pm_no" value="ID_4266" />';
			echo '<input type="hidden" name="ik_desc" value="виртуальная оплата в интеркассу" />';
			echo '<input type="hidden" name="ik_cur2" value="UAH" />';	
			
			echo '<table style="text-align:center; border-style: dotted; border-color: #252525;"><row><td style="border-style: dotted;">';
			//echo '<div align="center" valign="center">';
			echo '<input style="background-color: #E6E6FA; padding: 4px; width: 65px; text-align: center; border-color: #252525;" name="ik_am" value="1000" /></td>';
			
			echo '<td style="border-style: dotted;"><select name="ik_cur" style="padding: 5px; width: 60px; text-align: center; background-color: #E6E6FA; border-color: #252525;"><option>UAH</option><option>USD</option><option>EUR</option></select></td>';
			echo '<td style="border-style: dotted;"><b><input type="submit" value="Провести" style="padding: 4px; background-color: #E6E6FA; border-color: #252525;"/></td></row></table>';
			
			echo '<br /></form></div>';
			
			

		echo $args['after_widget'];
		}
	}
	// Сохранение настроек виджета (очистка)
	function update( $new_instance, $old_instance ) {
	}

	// html форма настроек виджета в Админ-панели
	function form( $instance ) {
	}

	// скрипт виджета
	function add_my_widget_scripts() {
		// фильтр чтобы можно было отключить скрипты
		if( ! apply_filters( 'show_my_widget_script', true, $this->id_base ) )
			return;

		$theme_url = get_stylesheet_directory_uri();

		//wp_enqueue_script('my_widget_script', $theme_url .'/my_widget_script.js' );
	}

	// стили виджета
	function add_my_widget_style() {
		// фильтр чтобы можно было отключить стили
		if( ! apply_filters( 'show_my_widget_style', true, $this->id_base ) )
			return;
		?>
		<style>
			.my_widget a{ display:inline; }
		</style>
		<?php
	}
}

// Регистрация класса виджета
//add_action( 'widgets_init', 'my_register_widgets' );
//function my_register_widgets() {
//	register_widget( 'My_Custom_Widget_Interkassa' );
//}
