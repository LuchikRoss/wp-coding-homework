/**
 * Created by solomashenko on 09.03.17.
 */
(function($){
    wp.customize("step_by_step_my_settings", function(value) {
        console.log(value)
        value.bind(function(newval) {
            $("#step_by_step_my_settings").html(newval);
        } );
    });
})(jQuery);