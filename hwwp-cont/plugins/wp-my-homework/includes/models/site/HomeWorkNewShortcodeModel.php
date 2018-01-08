<?php

namespace includes\models\site;


use includes\common\HomeWorkRequestApi;
use includes\controllers\admin\menu\HomeWorkICreatorInstance;

class HomeWorkNewShortcodeModel implements HomeWorkICreatorInstance
{

    public function __construct() {

    }

    /**
     * Получения данных от кэша если данных нет в кэше запросить от сервера и записать в кэш
     * @param $currency
     * @param $origin
     * @param $destination
     * @param string $month
     * @return array|bool
     */
    public function getData($currency, $origin, $destination, $month = ""){
        $cacheKey = "";
        $data = array();
        $cacheKey = $this->getCacheKey($origin, $destination, $currency);
        if ( false === ($data = get_transient($cacheKey))) {
            $reuestAPI = HomeWorkRequestApi::getInstance();
            $data = $reuestAPI->getCalendarPricesMonth($currency, $origin, $destination, $month);
            set_transient($cacheKey, $data, 100);
        }

        return $data;
    }

    /**
     * Создает ключ для кэша
     */
    public function getCacheKey($origin, $destination, $currency){
        return HOMEWORK_PlUGIN_TEXTDOMAIN
            ."_calendar_prices_month_origin_{$origin}_destination_{$destination}_currency_{$currency}";
    }

    public static function newInstance()
    {
        // TODO: Implement newInstance() method.
        $instance = new self;
        return $instance;
    }
}