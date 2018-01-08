<?php

namespace includes\controllers\admin\menu;

//use includes\common\HomeWorkRequestApi;
use includes\models\admin\menu\HomeWorkMainAdminMenuModel;

class HomeWorkMainAdminMenuController extends HomeWorkBaseAdminMenuController
{
	public $model;
    public function __construct(){
    parent::__construct();
    $this->model = HomeWorkMainAdminMenuModel::newInstance();
    }
	
    public function action()
    {
        // TODO: Implement action() method.
        /**
         * add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
         *
         */
        $pluginPage = add_menu_page(
            _x(
                'Интеркасса',
                'admin menu page' ,
                HOMEWORK_PlUGIN_TEXTDOMAIN
            ),
            _x(
                'Интеркасса',
                'admin menu page' ,
                HOMEWORK_PlUGIN_TEXTDOMAIN
            ),
            'manage_options',
            HOMEWORK_PlUGIN_TEXTDOMAIN,
            array(&$this,'render'),
            HOMEWORK_PlUGIN_URL .'assets/images/main-menu.png'
        );
		
	}
    /**
     * Метод отвечающий за контент страницы
     */
    public function render()
    {
        // TODO: Implement render() method.
		$request = wp_remote_get( 'https://api.interkassa.com/v1/currency' );
		echo '<pre><br /><b>'; 
		$pins = json_decode( $request['body'], true );
			
		if( !empty( $pins['data'] ) ) {
			echo "<h1>Курсы валют Интеркассы</h1>";
			echo "<h2><br />Стоимость доллара сейчас</h2>";
			echo "покупка (GET): $ 1 / " . $pins['data']['USD']['UAH']['in'] . " грн<br /><pre>";
			echo "продажа (GET): $ 1 / " . $pins['data']['USD']['UAH']['out'] . " грн<br />";
			
			echo "<h2>Стоимость евро сейчас</h2>" ;
			echo "покупка (GET): е 1 / " . $pins['data']['EUR']['UAH']['in'] . " грн<br /><pre>";
			echo "продажа (GET): е 1 / " . $pins['data']['EUR']['UAH']['out'] . " грн<br />";
			echo '</b><br />';
			
			echo '<form id="payment" name="payment" method="post" action="https://sci.interkassa.com/" enctype="utf-8">';
			echo '<input type="hidden" name="ik_co_id" value="5a43a6b93d1eaf97018b4567" />';
			echo '<input type="hidden" name="ik_pm_no" value="ID_4255" />';
			echo '<input style="width: 70px;" name="ik_am" value="555" />';
			echo '<input style="width: 38px;" name="ik_cur" value="UAH" />';
			echo '<input type="hidden" name="ik_desc" value="Event Description" />';
			echo '<input type="submit" value="Тестовый платёж" />';
			echo '</form><br />';			
		}
		
		//$pathView = HOMEWORK_PlUGIN_DIR."/includes/views/admin/menu/HomeWorkMainAdminMenu.view.php";
        //$this->loadView($pathView);
    }

    public static function newInstance()
    {
        // TODO: Implement newInstance() method.
        $instance = new self;
        return $instance;
    }
}