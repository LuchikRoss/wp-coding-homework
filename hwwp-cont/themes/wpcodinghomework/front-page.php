<?php get_header();?>

<?php

//$query = new WP_Query( array( 'category_name' => 'css-lessons' ) );

//while ( $query->have_posts() ) {
//	$query->the_post();
//	echo '<p>';
//	the_title(); // выведем заголовок поста
//	echo '</p>';
//}
//wp_reset_postdata();
?> 

<?php if(have_posts()): while(have_posts()) : the_post(); ?>


<?php get_template_part('content', get_post_type());?>

<?php endwhile; else:?>
<?php endif;?>

<?php get_sidebar();?>


<?php get_footer();?>
