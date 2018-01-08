<?php

namespace includes\common;

use includes\ajax\HomeWorkGuestBookAjaxHandler;
use includes\controllers\admin\menu\HomeWorkGuestBookSubMenuController;
use includes\controllers\site\shortcodes\HomeWorkGuestBookShortcodesController;
use includes\controllers\admin\menu\HomeWorkMainAdminMenuController;
use includes\controllers\admin\menu\HomeWorkMainAdminSubMenuController;
//use includes\controllers\admin\menu\HomeWorkMyCommentsMenuController;
//use includes\controllers\admin\menu\HomeWorkMyDashboardMenuController;
//use includes\controllers\admin\menu\HomeWorkMyMediaMenuController;
//use includes\controllers\admin\menu\HomeWorkMyOptionsMenuController;
//use includes\controllers\admin\menu\HomeWorkMyPagesMenuController;
//use includes\controllers\admin\menu\HomeWorkMyPluginsMenuController;
//use includes\controllers\admin\menu\HomeWorkMyPostsMenuController;
//use includes\controllers\admin\menu\HomeWorkMyThemeMenuController;
//use includes\controllers\admin\menu\HomeWorkMyToolsMenuController;
//use includes\controllers\admin\menu\HomeWorkMyUsersMenuController;
//use includes\controllers\site\shortcodes\HomeWorkCalendarPricesMonthShortcodeController;
//use includes\example\HomeWorkExampleAction;
//use includes\example\HomeWorkExampleFilter;
use includes\controllers\site\shortcodes\HomeWorkNewShortcodeController;

class HomeWorkLoader
{
    private static $instance = null;

    private function __construct(){
        // is_admin() Условный тег. Срабатывает когда показывается админ панель сайта (консоль или любая
        // другая страница админки).
        // Проверяем в админке мы или нет
        if ( is_admin() ) {
            // Когда в админке вызываем метод admin()
            $this->admin();
        } else {
            // Когда на сайте вызываем метод site()
            $this->site();
        }
        $this->all();


    }

    public static function getInstance(){
        if ( null == self::$instance ) {
            self::$instance = new self;
        }
        return self::$instance;
    }

	
	 /**
     * Метод будет срабатывать когда вы находитесь в Админ панеле. Загрузка классов для Админ панели
     */
    public function admin(){
        HomeWorkMainAdminMenuController::newInstance();
        HomeWorkMainAdminSubMenuController::newInstance();
        //HomeWorkMyDashboardMenuController::newInstance();
        //HomeWorkMyPostsMenuController::newInstance();
        //HomeWorkMyMediaMenuController::newInstance();
        //HomeWorkMyPagesMenuController::newInstance();
        //HomeWorkMyCommentsMenuController::newInstance();
        //HomeWorkMyThemeMenuController::newInstance();
        //HomeWorkMyPluginsMenuController::newInstance();
        //HomeWorkMyUsersMenuController::newInstance();
        //HomeWorkMyToolsMenuController::newInstance();
        //HomeWorkMyOptionsMenuController::newInstance();
		HomeWorkGuestBookSubMenuController::newInstance();

    }

    /**
     * Метод будет срабатывать когда вы находитесь Сайте. Загрузка классов для Сайта
     */
    public function site(){
		HomeWorkNewShortcodeController::newInstance();
		//HomeWorkCalendarPricesMonthShortcodeController::newInstance();
        // Шорткод для формы гостевой книги
        HomeWorkGuestBookShortcodesController::newInstance();
    }

    /**
     * Метод будет срабатывать везде. Загрузка классов для Админ панеле и Сайта
     */
    public function all(){
        HomeWorkLocalization::getInstance();
		HomeWorkLoaderScript::getInstance();
		//HomeWorkRequestApi::getInstance();
		HomeWorkGuestBookAjaxHandler::newInstance();
		
		//$homeWorkExampleAction = HomeWorkExampleAction::newInstance();
		//$homeWorkExampleFilter = HomeWorkExampleFilter::newInstance();

    }
}