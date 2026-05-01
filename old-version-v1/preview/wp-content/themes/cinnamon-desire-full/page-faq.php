<?php 
/* Template Name: FAQ */
get_header(); 
$page = cinnamon_setting( 'pages.faq', array() );
$faq_items = $page['items'] ?? array();
?>

<main>
    <section class="faq-container">
        <div class="faq-header">
            <span class="line"></span>
            <span class="header-text">🙋‍♀️ ЧАСТЫЕ ВОПРОСЫ</span>
            <span class="line"></span>
        </div>
        <div class="faq-badge"><?php echo esc_html( $page['title'] ?? 'FAQ' ); ?></div>
        <p class="faq-description"><?php echo esc_html( $page['description'] ?? '' ); ?></p>
    </section>

    <section class="faq-accordion">
        <?php foreach ( $faq_items as $item ) : ?>
            <details class="faq-item">
                <summary class="faq-question"><?php echo esc_html( $item['question'] ?? '' ); ?> <span class="plus-icon"></span></summary>
                <div class="faq-answer"><?php echo wp_kses_post( $item['answer'] ?? '' ); ?></div>
            </details>
        <?php endforeach; ?>
    </section>

    <section class="cta-section">
        <div class="cta-box">
            <h2 class="cta-title">Остались вопросы?</h2>
            <p class="cta-subtitle">Напишите нам, и мы ответим в течение <span>15 минут.</span></p>
            <a href="#" class="btn-cta early-access-btn">Contact</a>
        </div>
    </section>
</main>

<?php get_footer(); ?>
