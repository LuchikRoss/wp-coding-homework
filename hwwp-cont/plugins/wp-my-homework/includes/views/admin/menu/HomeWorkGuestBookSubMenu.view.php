<!-- Ссылка ссылаеться на страницу гостевой книги только у нее добавлен $_GET['action'] параметр &action=add_data
    По этому параметру мы будем в методе render определять что делать
 -->
<a href="admin.php?page=home_work_control_guest_book_menu&action=add_data">
    <?php _e('Add', HOMEWORK_PlUGIN_TEXTDOMAIN ); ?>
</a>

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
        <td>
            <?php _e('Actions', HOMEWORK_PlUGIN_TEXTDOMAIN ); ?>
        </td>
    </tr>
    </thead>
    <tbody>
    <!-- Проверка данных на пустоту чтобы цикл не вернул ошибку -->
    <?php if(count($data) > 0 && $data !== false){  ?>
        <?php foreach($data as $value): ?>
            <tr class="row table_box">

                <td>
                    <?php echo $value['user_name']; ?>
                </td>
                <td>
                    <?php echo $value['message']; ?>
                </td>
                <td>
                    <?php echo date('d-m-Y H:i', $value['date_add']); ?>
                </td>

                <td>
                    <!-- Ссылки  ссылаються на страницу гостевой книги только у них добавлен $_GET['action'] параметр
                     для редактирования &action=edit_data для удаления &action=delete_data и в этих ссылок еще добавлен
                     один $_GET['id'] параметр это &id=(id записи) записи гостевой книги по котором мы будем выполнять
                     действия -->
                    <a href="admin.php?page=home_work_control_guest_book_menu&action=edit_data&id=<?php echo $value['id'];?>">
                        <?php _e('Edit', HOMEWORK_PlUGIN_TEXTDOMAIN ); ?>
                    </a>
                    <a href="admin.php?page=home_work_control_guest_book_menu&action=delete_data&id=<?php echo $value['id'];?>">
                        <?php _e('Delete', HOMEWORK_PlUGIN_TEXTDOMAIN ); ?>
                    </a>


                </td>

            </tr>
        <?php endforeach ?>
    <?php }else{ ?>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    <?php } ?>
    </tbody>
</table>