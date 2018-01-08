<?php

namespace includes\controllers\admin\menu;


abstract class HomeWorkBaseAdminMenuController implements HomeWorkICreatorInstance
{
    public function __construct(){
        /*
         * Регистрирует хук-событие. При регистрации указывается PHP функция,
         * которая сработает в момент события, которое вызывается с помощью do_action().
         */
        add_action('admin_menu', array( &$this, 'action'));
    }

    abstract public function action();
    abstract public function render();

    /**
     * Метод подключения view
     * @param $view
     * @param int $type
     * @param array $data
     */
    protected function loadView($view, $type = 0, $data = array()){
        if (file_exists($view)) {
            switch($type){
                case 0:
                    require_once $view;
                    break;
                case 1:
                    require $view;
                    break;
                default:
                    require_once $view;
                    break;
            }
        } else {
            wp_die(sprintf(__('(View %s not found)', HOMEWORK_PlUGIN_TEXTDOMAIN), $view));
        }
    }
}