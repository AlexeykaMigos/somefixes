<?php
/* Template Name: Blog */
get_header();

$page = cinnamon_setting( 'pages.blog', array() );
$posts = get_posts( array( 'numberposts' => 6, 'post_status' => 'publish' ) );
?>

<section class="cinnamon-section">
    <div class="cinnamon-container">
        <div class="cinnamon-label"><span class="label-text">BLOG</span></div>
        <h1 class="cinnamon-title"><?php echo esc_html( $page['title'] ?? 'Blog' ); ?></h1>
        <p class="cinnamon-description"><?php echo esc_html( $page['description'] ?? '' ); ?></p>
    </div>
</section>

<main class="container cd-simple-page">
    <div class="features-grid">
        <?php if ( $posts ) : ?>
            <?php foreach ( $posts as $post ) : setup_postdata( $post ); ?>
                <article class="feature-card">
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 22 ) ); ?></p>
                </article>
            <?php endforeach; wp_reset_postdata(); ?>
        <?php else : ?>
            <div class="feature-card">
                <h3>Coming soon</h3>
                <p>Материалы блога появятся здесь после публикации в WordPress.</p>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
