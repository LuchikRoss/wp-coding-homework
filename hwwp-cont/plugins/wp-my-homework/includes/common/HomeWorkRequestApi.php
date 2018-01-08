<?php

namespace includes\common;


class HomeWorkRequestApi
{
    const HOMEWORK_API_V2 = "http://api.travelpayouts.com/v2";
    const HOMEWORK_TOKEN = "f3bab9d72720c285c6947b6b7777c0de";
    const HOMEWORK_MARKER = "157934";
    private static $instance = null;

    private function __construct(){

    }
    public static function getInstance(){
        if ( null == self::$instance ) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function getToken(){
        return "&token=".self::HOMEWORK_TOKEN;
    }


    /**
     * Календарь цен на месяц
     * Запрос
     * http://api.travelpayouts.com/v2/prices/month-matrix
     * Параметры запроса
     * currency — валюта цен на билеты. Значение по умолчанию — rub.
     * origin — пункт отправления. IATA код города или код страны. Длина не менее 2 и не более 3 символов.
     * destination — пункт назначения. IATA код города или код страны. Длина не менее 2 и не более 3.
     *               Обратите внимание! Если не указывать пункт отправления и назначения, то API вернет
     *               список самых дешевых билетов, которые были найдены за последние 48 часов.
     * show_to_affiliates — false — все цены, true — только цены, найденные с партнёрским маркером (рекомендовано).
     *                      Значение по умолчанию — true.
     * month — первый день месяца, в формате «YYYY-MM-DD».
     */
    public function getCalendarPricesMonth($currency, $origin, $destination, $month = ""){
        $requestURL = "";
        if ($currency == false || empty($currency)){
            $currency = "currency=RUB";
        } else {
            $currency = "currency={$currency}";
        }
        if ($origin == false || empty($origin)){
            return false;
        } else {
            $origin = "&origin={$origin}";
        }
        if ($destination == false || empty($destination)){
            return false;
        } else {
            $destination = "&destination={$destination}";
        }
        if ($month == false || empty($month)){
            $month = "&month=".date('Y-m-d');
        } else {
            $month = "&month={$month}";
        }
        $requestURL = self::HOMEWORK_API_V2."/prices/month-matrix?{$currency}{$origin}{$destination}{$month}"
            .$this->getToken();

        return $this->requestAPI($requestURL);
    }

    public function requestAPI($requestURL){
        $response = wp_remote_get( $requestURL, array('headers' => array(
            'Accept-Encoding' => 'gzip, deflate',
        )) );
        $body = wp_remote_retrieve_body($response);
        $json = json_decode($body);
        if (!is_wp_error($json) && $json->success == true) {
            return $json->data;
        } else {
            return false;
        }

    }




}