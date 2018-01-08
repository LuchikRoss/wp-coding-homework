<?php

namespace includes\widgets;
use includes\models\admin\menu\HomeWorkInterkassaSubMenuModel;
class HomeWorkInterkassaWidget extends \WP_Widget
{
    public function __construct() {
        /**
         * https://developer.wordpress.org/reference/classes/wp_widget/__construct/
         * WP_Widget::__construct(
         *      string $id_base, //Base ID для виджета, в нижнем регистре и уникальным. Если оставить пустым,
         *                          то часть имени класса виджета будет использоваться Должно быть уникальным.
         *      string $name, //Имя виджета отображается на странице конфигурации.
         *      array $widget_options = array(),
         *      array $control_options = array()
         * )
         *
         */
        parent::__construct(
            "home_work_widget_interkassa",
            "Home Work Interkassa Widget",
            array("description" => "Interkassa")
        );
    }
    /**
     * Метод form() используется для отображения настроек виджета на странице виджетов.
     * @param $instance
     */
    public function form($instance) {
        $title = "";
        $text = "";
        // если instance не пустой, достанем значения
        if (!empty($instance)) {
            $title = $instance["title"];
            $text = $instance["text"];
        }
        $tableId = $this->get_field_id("title");
        $tableName = $this->get_field_name("title");
        echo '<label for="' . $tableId . '">Title</label><br>';
        echo '<input id="' . $tableId . '" type="text" name="' .
            $tableName . '" value="' . $title . '"><br>';
        $textId = $this->get_field_id("text");
        $textName = $this->get_field_name("text");
        echo '<label for="' . $textId . '">Text</label><br>';
        echo '<textarea id="' . $textId . '" name="' . $textName .
            '">' . $text . '</textarea>';
    }
    /**
     * @param $newInstance
     * @param $oldInstance
     * @return array
     */
    public function update($newInstance, $oldInstance) {
        $values = array();
        $values["title"] = htmlentities($newInstance["title"]);
        $values["text"] = htmlentities($newInstance["text"]);
        return $values;
    }
    /**
     * @param $args
     * @param $instance
     */
    public function widget($args, $instance) {
        $title = $instance["title"];
        $text = $instance["text"];
        echo "<h2>$title</h2>";
        echo "<p>$text</p>";
        // Вывод таблички гостевой книги
        $data = HomeWorkGuestBookSubMenuModel::getAll();
        ?>
        <table  border="1">
            <thead>
            <tr>
		
                <td>
                    <?php _e('Name', HOMEWORK_PlUGIN_TEXTDOMAIN ); ?>
                </td>
                <td>
                    <?php _e('Messsage', HOMEWORK_PlUGIN_TEXTDOMAIN ); ?>
                </td>
                <td>
                    <?php _e('Date', HOMEWORK_PlUGIN_TEXTDOMAIN ); ?>
                </td>

            </tr>
            </thead>
            <tbody>
        <?php if(count($data) > 0 && $data !== false){  ?>
            <?php foreach($data as $value): ?>
                <tr>
			
                    <td>
                        <?php echo $value['user_name']; ?>
                    </td>
                    <td>
                        <?php echo $value['message']; ?>
                    </td>
                    <td>
                        <?php echo date('d-m-Y H:i', $value['date_add']); ?>
                    </td>
                </tr>
            <?php endforeach ?>
        <?php }else{ ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        <?php } ?>
        </tbody>
        </table>
        <?php
    }
}