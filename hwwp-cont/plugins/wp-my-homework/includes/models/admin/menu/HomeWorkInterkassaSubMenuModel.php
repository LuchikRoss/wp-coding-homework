<?php

namespace includes\models\admin\menu;

class HomeWorkInterkassaSubMenuModel
{
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
			echo '<input type="hidden" name="ik_pm_no" value="ID_425555" />';
			echo '<input style="width: 70px;" name="ik_am" value="100.00" />';
			echo '<input style="width: 38px;" name="ik_cur" value="UAH" />';
			echo '<input type="hidden" name="ik_desc" value="виртуальная оплата в интеркассу" />';
			echo '<input type="submit" value="Тестовый платёж" />';
			echo '</form><br />';
		}
}