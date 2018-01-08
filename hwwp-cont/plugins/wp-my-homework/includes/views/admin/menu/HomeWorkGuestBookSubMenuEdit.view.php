

<!-- View форма для редактирования записи в таблицу. action формы это ссылка на страницу гостевой книги с $_GET['action']
параметр &action=update_data в методе render контроллера мы будем обрабатывать параметр $_GET['action']  update_data.
Эта форма похожая на форму StepByStepGuestBookSubMenuAdd.view.php только у ее полей ввода есть атрибут value со значением
записи в таблицы которую мы будем редактировать. И еще есть одно скрытое поле id по котором будем обновлять запись в таблице.
-->
<form action="admin.php?page=home_work_control_guest_book_menu&action=update_data" method="post">
<input type="text" name="user_name" value="<?php echo $data['user_name']; ?>">
<textarea name="message">
	<?php echo $data['message']; ?>
</textarea>
<!-- Поле id по котором будем обновлять запись в таблице -->
<input type="hidden" name="id" value="<?php echo $data['id']; ?>">

<input type="submit" name="<?php _e('Add', HOMEWORK_PlUGIN_TEXTDOMAIN ); ?>">
</form>