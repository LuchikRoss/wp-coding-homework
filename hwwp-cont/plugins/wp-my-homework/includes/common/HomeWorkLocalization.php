<?php

namespace includes\common;

class HomeWorkLocalization
{
   private static $instance = null;
   private function __construct() {
       add_action( 'plugins_loaded' , array(&$this,  'localization' ));
   }
   public static function getInstance() {

       if ( null == self::$instance ) {
           self::$instance = new self;
       }

       return self::$instance;

   }

   public function localization(){
       /**
        * load_plugin_textdomain( $domain, $deprecated, $plugin_rel_path )
        * $domain – Уникальный идентификатор для получения строки перевода. (константа HOMEWORK_PlUGIN_TEXTDOMAIN
        *           заданая в файле config-path.php)
        * $deprecated – Отмененный аргумент, работает до версии 2.7. Путь подобный ABSPATH, до .mo файла.
        * $plugin_rel_path – Путь (с закрывающим слэшем) до каталога .mo файлов относительно WP_PLUGIN_DIR.
        *                    Этот аргумент следует использовать вместо $abs_rel_path.
        *                   (константа HOMEWORK_PlUGIN_DIR_LOCALIZATION заданая в файле config-path.php)
        */
       load_plugin_textdomain(HOMEWORK_PlUGIN_TEXTDOMAIN, false, HOMEWORK_PlUGIN_DIR_LOCALIZATION);
   }
}


