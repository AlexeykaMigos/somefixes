<?php 
/* Template Name: Adoption */
get_header(); 
$page = cinnamon_setting( 'pages.adoption', array() );
?>

<section class="adoption-header">
    <div class="container">
        <div class="guide-subtitle">
            <span class="line"></span>
            <span class="subtitle-text">ПОЛНОЕ РУКОВОДСТВО</span>
            <span class="line"></span>
        </div>
        <h2 class="adoption-title"><?php echo esc_html( $page['title'] ?? 'Путь к усыновлению' ); ?></h2>
        <p class="adoption-desc">
            <?php echo esc_html( $page['description'] ?? 'От первого взгляда до первого мурлыканья в вашем доме — прозрачный пошаговый процесс.' ); ?>
        </p>
    </div>
</section>

<main class="container">
    
    <header class="section-header">
        <span class="number">01</span>
        <h2 class="title">Философия владельца</h2>
        <div class="divider"></div>
        <div class="badge">ОСНОВНЫЕ ПРИНЦИПЫ</div>
    </header>

    <section class="philosophy-content">
        <div class="philosophy-text-grid">
            <p class="intro-text">
                Мы не просто продаем котят; мы передаем их в семьи, где их будут искренне любить.
            </p>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="icon-check">✓</div>
                    <h3>ТОЛЬКО ДОМ</h3>
                    <p>Исключительно домашнее содержание.</p>
                </div>
                <div class="feature-card">
                    <div class="icon-check">✓</div>
                    <h3>ПРЕМИУМ ПИТАНИЕ</h3>
                    <p>Приверженность холистик-кормам.</p>
                </div>
                <div class="feature-card">
                    <div class="icon-check">✓</div>
                    <h3>ЗДОРОВЬЕ ПРЕЖДЕ ВСЕГО</h3>
                    <p>Ежегодные осмотры ветеринара.</p>
                </div>
                <div class="feature-card">
                    <div class="icon-check">✓</div>
                    <h3>БЕЗОПАСНАЯ СРЕДА</h3>
                    <p>Подготовка дома к приезду котенка.</p>
                </div>
            </div>
        </div>

        <div class="image-container">
            <div class="white-frame">
                <img src="<?php echo esc_url( $page['image'] ?? 'https://scottishkittensnyc.com/wp-content/uploads/2026/01/photo1.jpg' ); ?>" alt="<?php echo esc_attr( $page['title'] ?? 'Кот' ); ?>">
            </div>
        </div>
    </section>

    <header class="section-header">
        <span class="number">02</span>
        <h2 class="title">Архив документов</h2>
        <div class="divider"></div>
        <div class="badge">ДОКУМЕНТЫ И ЗДОРОВЬЕ</div>
    </header>

    <section class="archive-content-wrapper">
        <div class="archive-intro">
            <h3>Каждый котенок переезжает с полной историей</h3>
            <p>Мы гарантируем юридическую и медицинскую прозрачность каждой сделки.</p>
        </div>

        <div class="archive-grid">
            <div class="archive-card">
                <img src="https://cdn-icons-png.flaticon.com/512/2234/2234731.png" class="card-icon" alt="doc">
                <h4>Родословная WCF</h4>
                <p>Подтверждение чистоты породы и линий.</p>
            </div>
            <div class="archive-card">
                <img src="https://cdn-icons-png.flaticon.com/512/3063/3063174.png" class="card-icon" alt="doc">
                <h4>Ветпаспорт</h4>
                <p>Международная книга здоровья с печатями.</p>
            </div>
            <div class="archive-card">
                <img src="https://cdn-icons-png.flaticon.com/512/3503/3503823.png" class="card-icon" alt="doc">
                <h4>Договор</h4>
                <p>Юридический документ, защищающий стороны.</p>
            </div>
            <div class="archive-card">
                <img src="https://cdn-icons-png.flaticon.com/512/2913/2913520.png" class="card-icon" alt="doc">
                <h4>Тесты</h4>
                <p>Результаты генетических тестов родителей.</p>
            </div>
        </div>
    </section>

    <section class="cta-section">
        <p class="cta-subtitle">ГОТОВЫ НАЙТИ СВОЕГО СПУТНИКА?</p>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="cta-main-button">ПОСМОТРЕТЬ ДОСТУПНЫХ КОТЯТ</a>
        <a href="#" class="cta-secondary-link early-access-btn">Contact for a Private Consultation</a>
    </section>

</main>

<?php get_footer(); ?>
