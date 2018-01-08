<?php

namespace includes\example;

class HomeWorkExampleAction
{
    public function __construct() {
        //Прикрепим функцию к событию 'my_action'
        add_action('my_action', array(&$this, 'myActionFunction'));
        // Прикрепим функцию к событию 'my_hook'
        //add_action('my_hook', function(){ error_log(1); });
        //add_action('my_hook', function(){ error_log(2); });
        //add_action('my_hook', function(){ error_log(3); });
        //add_action('my_hook', function(){ error_log(4); }, 15);
        //add_action('my_hook', function(){ error_log(5); }, 10); // можно не указывать 10 - по умолчанию
        //add_action('my_hook', function(){ error_log(6); }, 5);

        //do_action('my_hook');
		
        add_action('my_action', array(&$this, 'myActionFunction'));
        add_action('plugins_loaded', function(){ error_log(__('MyHomeWork action 1', HOMEWORK_PlUGIN_TEXTDOMAIN)); }, 100);
		do_action('my_action');
    }
    public static function newInstance(){
        $instance = new self;
        return $instance;
    }

    /**
     * Функция события my_action
     */
    public function myActionFunction(){
        //Выводим сообщение в debug.log
		error_log(__('MyHomeWork action 2', HOMEWORK_PlUGIN_TEXTDOMAIN));
    }

    public function callMyAction(){
        // Вызов самого события.
        do_action('my_action');
    }

    /**
     * Функция события my_action
     */
    public function myActionFunctionAdditionalParameter($data1 = "", $data2 = "", $data3 = "" ){
        //Выводим сообщение в debug.log
        error_log("my_action call {$data1} {$data2} {$data3}");
    }

    public function callMyActionAdditionalParameter( $data1, $data2, $data3 ){
        // Вызов самого события.
        do_action('my_action', $data1, $data2, $data3 );
    }
}