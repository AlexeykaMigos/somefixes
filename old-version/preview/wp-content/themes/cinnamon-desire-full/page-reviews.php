<?php
/* Template Name: Reviews */
get_header();

$page = cinnamon_setting( 'pages.reviews', array() );
?>

<section class="cinnamon-section">
    <div class="cinnamon-container">
        <div class="cinnamon-label"><span class="label-text">REVIEWS</span></div>
        <h1 class="cinnamon-title"><?php echo esc_html( $page['title'] ?? 'Reviews' ); ?></h1>
        <p class="cinnamon-description"><?php echo esc_html( $page['description'] ?? '' ); ?></p>
    </div>
</section>

<main class="container cd-simple-page">
    <div class="philosophy-grid">
        <div class="philosophy-card">
            <div class="card-icon">“</div>
            <h3 class="card-title">Warm family experience</h3>
            <p class="card-description">Наш котенок приехал социализированным, спокойным и с полным комплектом рекомендаций.</p>
        </div>
        <div class="philosophy-card">
            <div class="card-icon">“</div>
            <h3 class="card-title">Transparent process</h3>
            <p class="card-description">Было легко получить фото, документы и консультацию по подготовке дома.</p>
        </div>
        <div class="philosophy-card">
            <div class="card-icon">“</div>
            <h3 class="card-title">Beautiful kitten</h3>
            <p class="card-description">Спасибо Cinnamon Desire за бережное отношение и поддержку после переезда.</p>
        </div>
    </div>
</main>

<?php get_footer(); ?>
