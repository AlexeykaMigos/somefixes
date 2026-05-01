<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="cd-site-header">
    <div class="header-inner">
        <div class="header-logo-block">
            <a href="<?php echo home_url(); ?>" style="text-decoration:none; display:flex; gap:10px; align-items:center;">
                <div class="logo-icon">
                    <svg width="30" height="24" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8.5 0C3.80558 0 0 3.80558 0 8.5C0 13.1944 3.80558 17 8.5 17H12.75V21.25C12.75 23.8734 14.8766 26 17.5 26C20.1234 26 22.25 23.8734 22.25 21.25V17H25.5C30.1944 17 34 13.1944 34 8.5C34 3.80558 30.1944 0 25.5 0H8.5Z" fill="#716059"/>
                        <circle cx="28" cy="20" r="4" fill="#F19072"/>
                    </svg>
                </div>
                <div class="logo-text-group">
                    <div class="logo-main">CINNAMON <span>DESIRE</span></div>
                    <div class="logo-sub">ПИТОМНИК ШОТЛАНДСКИХ КОШЕК</div>
                </div>
            </a>
        </div>

        <nav class="header-nav">
            <a href="<?php echo home_url(); ?>" class="nav-link">Наши котята</a>
            <a href="<?php echo site_url('/adoption'); ?>" class="nav-link">Усыновление</a>
            <a href="<?php echo site_url('/faq'); ?>" class="nav-link">Вопросы</a>
            <a href="<?php echo site_url('/about-us'); ?>" class="nav-link">О нас</a>
        </nav>

        <div class="header-action">
            <a href="#" class="btn-header-contact early-access-btn">Contact</a>
        </div>

        <button class="mobile-menu-toggle" aria-label="Открыть меню">
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </button>
    </div>
</header>

<div class="menu-overlay"></div>

<div class="mobile-menu">
    <div class="mobile-menu-header">
        <div class="mobile-menu-logo">CINNAMON <span>DESIRE</span></div>
        <button class="mobile-menu-close" aria-label="Закрыть меню">×</button>
    </div>
    
    <nav class="mobile-nav">
        <a href="<?php echo home_url(); ?>" class="nav-link">Наши котята</a>
        <a href="<?php echo site_url('/adoption'); ?>" class="nav-link">Усыновление</a>
        <a href="<?php echo site_url('/faq'); ?>" class="nav-link">Вопросы</a>
        <a href="<?php echo site_url('/about-us'); ?>" class="nav-link">О нас</a>
        <a href="#" class="mobile-contact-btn early-access-btn">Contact</a>
    </nav>
</div>
