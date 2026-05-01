<?php get_header(); ?>
<main style="padding: 100px 20px; text-align: center;">
    <h1>Страница блога</h1>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); the_content(); endwhile; endif; ?>
</main>
<?php get_footer(); ?>