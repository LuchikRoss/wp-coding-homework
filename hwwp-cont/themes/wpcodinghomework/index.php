<?php get_header();?>

<?php if(have_posts()): while(have_posts()) : the_post(); ?>


<?php get_template_part('content', get_post_type());?>

<?php endwhile; else:?>
<?php endif;?>


<?php get_sidebar();?>


<?php get_footer();?>
