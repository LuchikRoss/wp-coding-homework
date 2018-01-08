<?php

namespace includes\example;

class HomeWorkExampleFilter
{
    public function __construct() {
       
    }
    public static function newInstance(){
		 //Прикрепляем функцию к фильтру
        add_filter('my_filter', array(&$this, 'myFiterFunction'));
        add_filter('my_filter', array(&$this, 'myFiterFunctionAdditionalParameter'), 10 , 3); // 3 - кол. параметров
		
        $instance = new self;
        return $instance;
    }

    /**
     * Функция которую вызовет фильтер
     * @param $str
     * @return string
     */
    public function myFiterFunction( $str ){
        $str = "HomeWork filter";
        return $str;
    }
    /**
     * @param $name
     */
    public function callMyFilter( $name ){
        $name = apply_filters('my_filter', $name);
        //Выводим результат в debug.log
        error_log($name);
    }
    /**
     *  Функция которую вызовет фильтер
     * @param $str
     * @param $data1
     * @param $data2
     * @return string
     */
    public function myFiterFunctionAdditionalParameter( $str, $data1 = "", $data2 = "" ){
        $str = "HomeWork filter {$str} {$data1} {$data2}";
        return $str;
    }

    public function callMyFilterAdditionalParameter( $name, $data1, $data2 ){
        $name = apply_filters('my_filter', $name, $data1, $data2);
        //Выводим результат в debug.log
        error_log($name);
    }


}