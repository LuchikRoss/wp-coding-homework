<?php

namespace includes;

use includes\common\HomeWorkDefaultOption;
use includes\common\HomeWorkLoader;
use includes\custom_post_type\BookPostType;
use includes\models\admin\menu\HomeWorkGuestBookSubMenuModel;


class HomeWorkPlugin
{
    private static $instance = null;

    private function __construct() {
        HomeWorkLoader::getInstance();
        add_action('plugins_loaded', array(&$this, 'setDefaultOptions'));
    }
    public static function getInstance() {

        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;

    }

    /**
     * Если не созданные настройки установить по умолчанию
     */
    public function setDefaultOptions(){
        if( ! get_option(HOMEWORK_PlUGIN_OPTION_NAME) ){
            update_option( HOMEWORK_PlUGIN_OPTION_NAME, HomeWorkDefaultOption::getDefaultOptions() );
        }
        if( ! get_option(HOMEWORK_PlUGIN_OPTION_VERSION) ){
            update_option(HOMEWORK_PlUGIN_OPTION_VERSION, HOMEWORK_PlUGIN_VERSION);
        }
    }

    static public function activation()
    {
        // debug.log
        error_log('plugin '.HOMEWORK_PlUGIN_NAME.' activation');
    }

    static public function deactivation()
    {
        // debug.log
        error_log('plugin '.HOMEWORK_PlUGIN_NAME.' deactivation');
        delete_option(HOMEWORK_PlUGIN_OPTION_NAME);
        delete_option(HOMEWORK_PlUGIN_OPTION_VERSION);
    }

}

HomeWorkPlugin::getInstance();

