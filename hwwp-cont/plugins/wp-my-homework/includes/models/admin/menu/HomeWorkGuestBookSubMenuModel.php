<?php

namespace includes\models\admin\menu;
class HomeWorkGuestBookSubMenuModel
{
    //Название таблицы
    const HOMEWORK_TABLE_NAME = "home_work_guest_book";
    /**
     * Возвращает название таблицы с префиксом WordPress тот что задаеться при установке
     * всем таблицам
     * @return string
     */
    static public function getTableName(){
        global $wpdb;
        return $wpdb->prefix .static::HOMEWORK_TABLE_NAME;
    }
    /**
     * Метод создание таблицы в базе данных
     */
    static public function createTable()
    {
        global $wpdb;
        $tableName = self::getTableName();
        $sql = "CREATE TABLE " .$tableName. "(
                              id int(11) NOT NULL AUTO_INCREMENT,
                              date_add int(11) NOT NULL,
                              user_name varchar(255) NOT NULL,
                              message text NOT NULL,
                              PRIMARY KEY (id)
                            ) CHARACTER SET utf8 COLLATE utf8_general_ci;";
        // Проверяем на наличие таблицы в базе данных и если ее нет то создаем
        if($wpdb->get_var("show tables like '$tableName'") != $tableName) {
            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
        }
    }
    /**
     * Получает по ID строку в таблице
     * @return mixed
     */
    static public function getById($id){
        global $wpdb;
        $data = $wpdb->get_row("SELECT * FROM ".self::getTableName()." WHERE id= ". $id, ARRAY_A);
        if(count($data) > 0) return $data;
        return false;
    }
    /**
     * Вставляет данные в таблицу
     * @param $data
     * @return mixed
     */
    static public function insert($data){
        global $wpdb;
        $id = $wpdb->insert( self::getTableName(), $data);
        return $id;
    }
    /**
     * Обновляет данные в таблице по ID
     * @param $data
     * @return mixed
     */
    static public function updateById($data, $id){
        global $wpdb;
        $id = $wpdb->update(self::getTableName(), $data ,array('id' => $id));
        return $id;
    }
    /**
     * Удаляет данные в таблице по ID
     * @param $id
     * @return mixed
     */
    static public function deleteById($id){
        global $wpdb;
        $wpdb->query("DELETE FROM ".self::getTableName()." WHERE id = '".$id ."'");
    }
    /**
     * Метод удаляет таблицу в базе данных
     */
    static public function deleteTable()
    {
        global $wpdb;
        $wpdb->query("DROP TABLE IF EXISTS ".self::getTableName());
    }
    /**
     * Метод получает все записи в таблице
     * @return bool
     */
    static public function getAll()
    {
        // TODO: Implement getAll() method.
        global $wpdb;
        $data = $wpdb->get_results( "SELECT * FROM ".self::getTableName()." ORDER BY date_add DESC", ARRAY_A);
        if(count($data) > 0) return $data;
        return false;
    }
}