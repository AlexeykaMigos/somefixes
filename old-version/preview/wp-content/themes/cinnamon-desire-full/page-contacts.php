<?php
/* Template Name: Contacts */
get_header();

$page = cinnamon_setting( 'pages.contacts', array() );
?>

<section class="cinnamon-section">
    <div class="cinnamon-container">
        <div class="cinnamon-label">
            <span class="label-text">CONTACTS</span>
        </div>
        <h1 class="cinnamon-title"><?php echo esc_html( $page['title'] ?? 'Contacts' ); ?></h1>
        <p class="cinnamon-description"><?php echo esc_html( $page['description'] ?? '' ); ?></p>
    </div>
</section>

<main class="container cd-simple-page">
    <div class="features-grid">
        <div class="feature-card">
            <h3>Phone</h3>
            <p><?php echo esc_html( cinnamon_setting( 'brand.phone', '' ) ); ?></p>
        </div>
        <div class="feature-card">
            <h3>Email</h3>
            <p><?php echo esc_html( cinnamon_setting( 'brand.email', '' ) ); ?></p>
        </div>
        <div class="feature-card">
            <h3>Address</h3>
            <p><?php echo esc_html( cinnamon_setting( 'brand.address', '' ) ); ?></p>
        </div>
    </div>
    <section class="cta-section">
        <a href="#" class="cta-main-button early-access-btn">Contact for a Private Consultation</a>
    </section>
</main>

<?php get_footer(); ?>
