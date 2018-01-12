<?php
/*
 * Подключает файл шаблона header.php (шапку). Если передан параметр $name, то будет подключен файл header-{name}.php.
 * Если файл не найден в шаблоне темы, то будет взять файл по умолчанию: wp-includes/theme-compat/header.php
 * get_header( $name );
 * https://wp-kama.ru/function/get_header
  */
//header.php подключил к index.php
get_header();
?>
    <main id="content" role="main">
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="three-quarters-block">
                        <?php if ( have_posts() ) : ?>
                            <?php /* начинается цикл */ ?>
                            <?php while ( have_posts() ) : the_post(); ?>
                                <?php
                                    //Предназначена для поиска и подключения разных частей темы. Похожа на PHP функцию include(),
                                    // только тут не нужно указывать путь до темы.
                                    get_template_part( 'template-parts/content', get_post_format() );
                                ?>
                        <?php endwhile; ?>
                            <?php the_posts_pagination(); ?>
                        <?php else : ?>
                            <?php get_template_part( 'template-parts/content', 'none' ); ?>
                        <?php endif; ?>
                    </div>

                    <!-- sidebar -->
                    <!--

                     get_sidebar()
                     Подключает файл шаблона sidebar.php (сайдбар). Если передан параметр $name, то будет подключен файл sidebar-{name}.php.
                     Если файл не найден в шаблоне темы, то будет взять файл по умолчанию: wp-includes/theme-compat/sidebar.php
                     https://wp-kama.ru/function/get_sidebar
                     -->
                    <?php
                    //sidebar.php подключил к index.php
                    get_sidebar();
                    ?>
                    <!-- end sidebar -->

                </div> <!-- .row -->
            </div> <!-- .container -->
        </div> <!-- .section -->


    </main> <!-- #content -->


<?php
/*
 * get_footer()
 * Подключает файл footer.php из шаблона (темы). Если указано имя в параметре, то будет подключен файл: footer-{name}.php
 * из шаблона темы. Если в footer.php шаблоне не будет найден, то будет подключен дефолтный файл
 * wp-includes/theme-compat/footer.php.
 *
 * https://wp-kama.ru/function/get_footer
 */
//footer.php подключил к index.php
get_footer();
?>