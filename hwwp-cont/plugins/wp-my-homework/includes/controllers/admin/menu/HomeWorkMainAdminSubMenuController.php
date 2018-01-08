<?php

namespace includes\controllers\admin\menu;

use includes\common\HomeWorkRequestApi;
use includes\models\admin\menu\HomeWorkMainAdminMenuModel;

class HomeWorkMainAdminSubMenuController extends HomeWorkBaseAdminMenuController
{

	public $model;
    public function __construct(){
    parent::__construct();
    $this->model = HomeWorkMainAdminMenuModel::newInstance();
    }

    public function action()
    {
        // TODO: Implement action() method.
        $pluginPage = add_submenu_page(
            HOMEWORK_PlUGIN_TEXTDOMAIN,
            _x(
                'HTTP Controller',
                'admin submenu page' ,
                HOMEWORK_PlUGIN_TEXTDOMAIN
            ),
            _x(
                'HTTP Controller',
                'admin submenu page' ,
                HOMEWORK_PlUGIN_TEXTDOMAIN
            ),
            'manage_options', 'HTTP Controller', array(&$this, 'render'));
			
	
			
			$pluginPage4 = add_submenu_page(
            HOMEWORK_PlUGIN_TEXTDOMAIN,
            _x(
                'Speed Test Controller',
                'admin submenu page' ,
                HOMEWORK_PlUGIN_TEXTDOMAIN
            ),
            _x(
                'Speed Test Controller',
                'admin submenu page' ,
                HOMEWORK_PlUGIN_TEXTDOMAIN
            ),
            'manage_options', 'Speed Test Controller', array(&$this, 'render_2'));
			
				
			$pluginPage4 = add_submenu_page(
            HOMEWORK_PlUGIN_TEXTDOMAIN,
            _x(
                'Widget Controller',
                'admin submenu page' ,
                HOMEWORK_PlUGIN_TEXTDOMAIN
            ),
            _x(
                'Widget Controller',
                'admin submenu page' ,
                HOMEWORK_PlUGIN_TEXTDOMAIN
            ),
            'manage_options', 'Widget Controller', array(&$this, 'render_3'));
    }

    public function render()
    {
        // TODO: Implement render() method.
        _e("best new sub menu", HOMEWORK_PlUGIN_TEXTDOMAIN);
		
		echo "<h1><br />Sub Menu Controller</h1>";
			global $wp_version;
			echo "<br /><b><h2>The installed version of WordPress (Global): " . $wp_version . "</h2>";
			echo "<h3> - wp_remote_get(url),<br /> - wp_remote_retrieve_response_code(response),<br /> - wp_remote_retrieve_response_message(response)";
			$response = wp_remote_get('http://httpbin.org/get?a=b&c=d');
			echo "<br /><br /> GET запрос на ресурс http://httpbin.org/get?a=b&c=d <br /><br />" . "<h3 style='color:green;'>" . "ответ: " . wp_remote_retrieve_response_code( $response ) . " "; //> 200
			echo wp_remote_retrieve_response_message( $response ); //> OK
			echo '</h3></b><br />';
			
			//$data = array();
			//$pathView = STEPBYSTEP_PlUGIN_DIR.”/includes/views/admin/menu/StepByStepGuestBookSubMenu.view.php”;
			//$this->loadView($pathView, 0, $data);		
			// TODO: Implement render() method.
			//_e("Hello world", STEPBYSTEP_PlUGIN_TEXTDOMAIN);
			
			$requestAPI = HomeWorkRequestApi::getInstance();
			//var_dump($requestAPI->getCalendarPricesMonth('RUB', 'MOW', 'LED'));
			$pathView = HOMEWORK_PlUGIN_DIR . "/includes/views/admin/menu/HomeWorkMainAdminMenu.view.php";
			$this->loadView($pathView);
	}
	
		public function render_2()
    {
			echo "<br /><b><h1>Speed Test Controller <br />"; ?>
			<br /><a href="javascript:;" onclick='window.open("https://2ip.ua/ru/myspeed","speedo","width=875"+",height=600,left="+(screen.width - 875)/2+",top="+(screen.height - 600)/2+",scrollbars=yes,resizable=yes" );' title="MYSPEED.today"><img src="https://2ip.ua/images/speedometr/7.png" style="width:200px;"></a>
			<?php
	}
	
		public function render_3()
    {
		echo "<br /><b><h1>Custom Widget Controller <br /><br /></h1><h4>";
		//the_widget( 'My_Custom_Widget', $instance, $args );	
		the_widget( 'WP_Widget_Text', 'title=Простой виджет &text=Содержание: <b>простой текст</b>' );
		?><br />
		<?php		
	}

    public static function newInstance()
    {
        // TODO: Implement newInstance() method.
        $instance = new self;
        return $instance;
    }	
}
		
	
	