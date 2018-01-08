<form action="options.php" method="POST">
    <?php
        settings_fields( 'HomeWorkMainSettings' );     // скрытые защитные поля
        do_settings_sections( 'home-work-development-plugin' ); // секции с настройками (опциями). У нас она всего одна 'section_id'
        submit_button();
    ?>
</form>