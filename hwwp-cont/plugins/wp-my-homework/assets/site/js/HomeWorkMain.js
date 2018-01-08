/**
 * Created by rostyslavnaryzhniak on 19.12.17.
 */
jQuery(function($) {
    $(document).ready(function(){

    });
    // Отслежываем нажатие  на кнопку Add (<button class="step-by-steb-btn-add" >'.__('Add', STEPBYSTEP_PlUGIN_TEXTDOMAIN ).'</button> )
    $(document).find('.home-work-btn-add').click(function (e) {
        var userName, userMessage, data;
        // Получаем данные формы
        userName = $(this).parent().find('.work-user-name').val();
        userMessage = $(this).parent().find('.work-message').val();
        // Формируем обьект данных который получит AJAX  обработчик
        data = {
            action: 'guest_book',
            user_name: userName,
            message: userMessage
        }
        // Вывод данных в консоль браузера
        console.log(data);
        console.log(ajaxurl+ '?action=guest_book');

        // Отправка данных ajax обработчику (wp_ajax_guest_book, wp_ajax_nopriv_guest_book)
        $.post( ajaxurl, data, function(response) {
            alert('Получено с сервера: ' + response.data.message);
            console.log(response);
        });

        // Запрещаем отправление формы что бы страница не перезагружалась
        return false;
    });
});