<?php
/**
 * Template name: Example WP_Query
 */

?>

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

                    <h2 class="entry-title" itemprop="headline">Знакомство с WP_Query</h2>
                    <br/>
                    <?php
                    $query = new WP_Query( array( 'category_name' => 'news' ) );
                    while ( $query->have_posts() ) {
                        $query->the_post();
                        the_title(); // выведем заголовок поста
                    }
                    wp_reset_postdata()
                    ?>
                    <br/>

                    <?php
                    global $wp_query;
                    //print_r($wp_query);
                    //var_dump("<pre>",$wp_query,"</pre>");
                    ?>

                    <br/>
                    <?php
                    $my_posts = new WP_Query;
                    $myposts = $my_posts->query( array(
                        'post_type' => 'page'
                    ) );
                    foreach( $myposts as $pst ){
                        echo $pst->post_title.'<br/>';
                    }
                    wp_reset_postdata()
                    ?>

                    <hr/>
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
