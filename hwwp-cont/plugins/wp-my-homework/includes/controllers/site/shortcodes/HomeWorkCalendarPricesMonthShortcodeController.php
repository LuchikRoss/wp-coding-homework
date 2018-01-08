<?php
/**
 * User: rostyslavnaryzhniak
 * Date: 19.12.17
 */

namespace includes\controllers\site\shortcodes;


use includes\common\HomeWorkRequestApi;
use includes\controllers\admin\menu\HomeWorkICreatorInstance;
use includes\models\site\HomeWorkCalendarPricesMonthShortcodeModel;

class HomeWorkCalendarPricesMonthShortcodeController extends HomeWorkShortcodesController
    implements HomeWorkICreatorInstance
{
    public $model;
    public function __construct() {
        parent::__construct();
        $this->model = HomeWorkCalendarPricesMonthShortcodeModel::newInstance();
    }
    /**
     * Функция в которой будем добалять шорткоды через функцию add_shortcode( $tag , $func );
     * @return mixed
     */
    public function initShortcode()
    {
        // TODO: Implement initShortcode() method.
        /*
         * Добавляем щорткод [step_by_step_calendar_price_month]
         */
        add_shortcode( 'home_work_calendar_price_month', array(&$this, 'action'));
    }

    /**
     * Функция обработки шоткода
     * Функция указанная в параметре $func, получает 3 параметра, каждый из них может быть передан,
     * а может нет:
     * $atts(массив)
     *      Ассоциативный массив атрибутов указанных в шоткоде. По умолчанию пустая строка - атрибуты
     *      не переданы.
     *      По умолчанию: ''
     * $content(строка)
     *      Текст шоткода, когда используется закрывающая конструкция шотркода: [foo]текст шорткода[/foo]
     *      По умолчанию: ''
     * $tag(строка)
     *      Тег шорткода. Может пригодится для передачи в доп. функции. Пр: если шорткод - [foo],
     *      то тег будет - foo.
     *      По умолчанию: текущий тег
     * @param array $atts
     * @param string $content
     * @param string $tag
     * @return mixed
     */
    public function action($atts = array(), $content = '', $tag = '')
    {
        // TODO: Implement action() method.
        /**
         * Объединяет атрибуты (параметры) шоткода с известными атрибутами, остаются только известные
         * атрибуты. Устанавливает значения атрибута по умолчанию, если он не указан.
         */
        $atts = shortcode_atts( array(
            'currency' => 'RUB',
            'origin' => '',
            'destination' => '',
            'month' => date('Y-m-d'),
        ), $atts, $tag );
        /*$reuestAPI = HomeWorkRequestApi::getInstance();
        $data = $reuestAPI->getCalendarPricesMonth($atts['currency'], $atts['origin'],
            $atts['destination'], $atts['month']);*/
        $data = $this->model->getData($atts['currency'], $atts['origin'],
            $atts['destination'], $atts['month']);
        if ($data == false) return false;
        return $this->render($data);
    }

    /**
     * Функция отвечающа за вывод обработаной информации шорткодом
     * @param $data
     * @return mixed
     */
    public function render($data)
    {
        // TODO: Implement render() method.
        var_dump('<pre>', $data, '</pre>');
    }

    public static function newInstance()
    {
        // TODO: Implement newInstance() method.
        $instance = new self;
        return $instance;
    }
}