<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>{{ $title }}</title>
    <meta name="description" content="{{ $description }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
        /* Общие стили */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #fceee9;
            color: #333;
            line-height: 1.6;
        }
        
        /* Стили шапки */
        .cd-site-header {
            background: white;
            box-shadow: 0 2px 15px rgba(113, 96, 89, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .header-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .header-logo-block {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .logo-icon {
            flex-shrink: 0;
        }
        
        .logo-text-group {
            display: flex;
            flex-direction: column;
        }
        
        .logo-main {
            font-size: 1.4rem;
            font-weight: 700;
            color: #716059;
            line-height: 1.2;
        }
        
        .logo-main span {
            color: #F19072;
        }
        
        .logo-sub {
            font-size: 0.7rem;
            color: #8a756d;
            letter-spacing: 1px;
            margin-top: 2px;
        }
        
        .header-nav {
            display: flex;
            gap: 30px;
        }
        
        .nav-link {
            color: #716059;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            transition: color 0.3s;
            padding: 8px 0;
            position: relative;
        }
        
        .nav-link:hover,
        .nav-link.active {
            color: #F19072;
        }
        
        .nav-link.active:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: #F19072;
        }
        
        .btn-header-contact {
            background: #F19072;
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s;
            display: inline-block;
        }
        
        .btn-header-contact:hover {
            background: #e07d5f;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(241, 144, 114, 0.3);
        }
        
        /* Мобильное меню */
        .mobile-menu-toggle {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px;
        }
        
        .hamburger {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        
        .hamburger span {
            width: 25px;
            height: 2px;
            background: #716059;
            transition: 0.3s;
        }
        
        /* Герой-секция */
        .reviews-hero {
            padding: 60px 20px 40px;
            background: linear-gradient(135deg, #fceee9 0%, #f8e1d7 100%);
            text-align: center;
        }
        
        .reviews-hero h1 {
            font-size: 2.8rem;
            color: #716059;
            margin-bottom: 20px;
            font-weight: 700;
        }
        
        .reviews-hero p {
            font-size: 1.2rem;
            color: #8a756d;
            max-width: 700px;
            margin: 0 auto 30px;
            line-height: 1.6;
        }
        
        /* Основной контейнер отзывов */
        .reviews-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px 80px;
        }
        
        /* Сортировка отзывов */
        .reviews-filter {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 40px 0 60px;
            flex-wrap: wrap;
        }
        
        .filter-btn {
            background: #fceee9;
            color: #716059;
            border: none;
            padding: 12px 25px;
            border-radius: 25px;
            font-family: 'Montserrat', sans-serif;
            font-weight: 500;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .filter-btn.active,
        .filter-btn:hover {
            background: #f19072;
            color: white;
        }
        
        /* Сетка отзывов */
        .reviews-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 30px;
            margin-bottom: 60px;
        }
        
        /* Карточка отзыва */
        .review-card {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 8px 25px rgba(113, 96, 89, 0.1);
            transition: all 0.3s ease;
            border: 1px solid #f0e0d9;
        }
        
        .review-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(113, 96, 89, 0.15);
            border-color: #f19072;
        }
        
        /* Заголовок отзыва */
        .review-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .reviewer-avatar {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            overflow: hidden;
            flex-shrink: 0;
            border: 3px solid #fceee9;
        }
        
        .reviewer-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .reviewer-info {
            flex-grow: 1;
        }
        
        .reviewer-name {
            color: #716059;
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .review-date {
            color: #b5a59e;
            font-size: 0.9rem;
        }
        
        /* Рейтинг */
        .review-rating {
            display: flex;
            gap: 5px;
            margin-bottom: 20px;
        }
        
        .star {
            color: #ffc107;
            font-size: 1.2rem;
        }
        
        .star.empty {
            color: #e0e0e0;
        }
        
        /* Текст отзыва */
        .review-text {
            color: #8a756d;
            line-height: 1.7;
            margin-bottom: 20px;
            font-size: 1.05rem;
        }
        
        /* Котята в отзыве */
        .review-kittens {
            display: flex;
            gap: 10px;
            margin-top: 25px;
            flex-wrap: wrap;
        }
        
        .kitten-tag {
            background: #f5f0ee;
            color: #8a756d;
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .kitten-tag:before {
            content: '🐱';
        }
        
        /* Подвал */
        .cd-footer {
            background: #716059;
            color: white;
            padding: 50px 0 20px;
            margin-top: 80px;
        }
        
        .footer-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 40px;
        }
        
        .footer-col {
            display: flex;
            flex-direction: column;
        }
        
        .col-main {
            grid-column: 1;
        }
        
        .footer-logo {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: white;
        }
        
        .footer-logo span {
            color: #F19072;
        }
        
        .footer-tagline {
            font-size: 0.9rem;
            color: #d8c8c0;
            margin-bottom: 20px;
            letter-spacing: 1px;
        }
        
        .footer-about {
            color: #d8c8c0;
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 25px;
        }
        
        .footer-socials {
            display: flex;
            gap: 10px;
        }
        
        .social-btn {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            padding: 8px 15px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s;
        }
        
        .social-btn:hover {
            background: #F19072;
            transform: translateY(-2px);
        }
        
        .footer-title {
            color: white;
            font-size: 1.1rem;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .footer-links {
            list-style: none;
        }
        
        .footer-links li {
            margin-bottom: 12px;
        }
        
        .footer-links a {
            color: #d8c8c0;
            text-decoration: none;
            transition: color 0.3s;
            font-size: 0.95rem;
        }
        
        .footer-links a:hover,
        .footer-links .active-link {
            color: #F19072;
        }
        
        .footer-bottom {
            max-width: 1200px;
            margin: 40px auto 0;
            padding: 20px 20px 0;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }
        
        .copyright-text {
            color: #d8c8c0;
            font-size: 0.9rem;
        }
        
        /* Адаптивность */
        @media (max-width: 768px) {
            .header-nav {
                display: none;
            }
            
            .header-action {
                display: none;
            }
            
            .mobile-menu-toggle {
                display: block;
            }
            
            .reviews-hero h1 {
                font-size: 2.2rem;
            }
            
            .reviews-hero p {
                font-size: 1.1rem;
                padding: 0 10px;
            }
            
            .reviews-grid {
                grid-template-columns: 1fr;
            }
            
            .footer-inner {
                grid-template-columns: 1fr;
                gap: 30px;
            }
            
            .col-main {
                grid-column: 1;
            }
        }
        
        @media (min-width: 769px) and (max-width: 1024px) {
            .reviews-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .footer-inner {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .col-main {
                grid-column: 1 / -1;
            }
        }
        
        /* Мобильное меню */
        .menu-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s;
        }
        
        .mobile-menu {
            position: fixed;
            top: 0;
            right: -100%;
            width: 300px;
            height: 100%;
            background: white;
            z-index: 1000;
            transition: right 0.3s ease;
            display: flex;
            flex-direction: column;
        }
        
        .mobile-menu-header {
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #f0e0d9;
        }
        
        .mobile-menu-logo {
            font-size: 1.2rem;
            font-weight: 700;
            color: #716059;
        }
        
        .mobile-menu-logo span {
            color: #F19072;
        }
        
        .mobile-menu-close {
            background: none;
            border: none;
            font-size: 2rem;
            color: #716059;
            cursor: pointer;
            line-height: 1;
        }
        
        .mobile-nav {
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 15px;
            flex-grow: 1;
        }
        
        .mobile-nav .nav-link {
            padding: 12px 0;
            border-bottom: 1px solid #f0e0d9;
            font-size: 1rem;
        }
        
        .mobile-contact-btn {
            background: #F19072;
            color: white;
            padding: 15px;
            border-radius: 8px;
            text-decoration: none;
            text-align: center;
            font-weight: 600;
            margin-top: auto;
            transition: background 0.3s;
        }
        
        .mobile-contact-btn:hover {
            background: #e07d5f;
        }
        
        /* Активные состояния меню */
        .menu-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        
        .mobile-menu.active {
            right: 0;
        }
        
        .mobile-menu-toggle.active .hamburger span:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }
        
        .mobile-menu-toggle.active .hamburger span:nth-child(2) {
            opacity: 0;
        }
        
        .mobile-menu-toggle.active .hamburger span:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -6px);
        }
        
        /* Верификация */
        .verified-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            color: #4CAF50;
            font-size: 0.9rem;
            margin-left: 10px;
        }
        
        .verified-badge:before {
            content: '✓';
            font-weight: bold;
        }
        
        /* Показать еще */
        .load-more {
            text-align: center;
            margin-top: 60px;
        }
        
        .load-more-btn {
            background: #fceee9;
            color: #716059;
            border: none;
            padding: 15px 30px;
            border-radius: 10px;
            font-family: 'Montserrat', sans-serif;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }
        
        .load-more-btn:hover {
            background: #f19072;
            color: white;
            transform: translateY(-3px);
        }
        
        /* Анимации */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .review-card {
            animation: fadeInUp 0.6s ease-out forwards;
            opacity: 0;
        }
        
        .review-card:nth-child(1) { animation-delay: 0.1s; }
        .review-card:nth-child(2) { animation-delay: 0.2s; }
        .review-card:nth-child(3) { animation-delay: 0.3s; }
        .review-card:nth-child(4) { animation-delay: 0.4s; }
        .review-card:nth-child(5) { animation-delay: 0.5s; }
        .review-card:nth-child(6) { animation-delay: 0.6s; }
    </style>
</head>
<body>

<header class="cd-site-header">
    <div class="header-inner">
        <div class="header-logo-block">
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
        </div>

        <nav class="header-nav">
            <a href="{{ url("/") }}" class="nav-link">Наши котята</a>
            <a href="{{ url("/cms/Adoption") }}" class="nav-link">Усыновление</a>
            <a href="{{ url("/cms/FAQ") }}" class="nav-link">Вопросы</a>
            <a href="{{ url("/cms/About Us") }}" class="nav-link">О нас</a>
            <a href="{{ url("/cms/Blog") }}" class="nav-link">Блог</a>
            <a href="{{ url("/cms/Reviews") }}" class="nav-link active">Отзывы</a>
            <a href="{{ url("/cms/Contacts") }}" class="nav-link">Контакты</a>
        </nav>

        <div class="header-action">
            <a href="{{ url("/cms/Contacts") }}" class="btn-header-contact">СВЯЗАТЬСЯ</a>
        </div>

        <!-- Кнопка мобильного меню -->
        <button class="mobile-menu-toggle" aria-label="Открыть меню">
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </button>
    </div>
</header>

<!-- Оверлей для мобильного меню -->
<div class="menu-overlay"></div>

<!-- Мобильное меню -->
<div class="mobile-menu">
    <div class="mobile-menu-header">
        <div class="mobile-menu-logo">CINNAMON <span>DESIRE</span></div>
        <button class="mobile-menu-close" aria-label="Закрыть меню">×</button>
    </div>
    
    <nav class="mobile-nav">
        <a href="{{ url("/") }}" class="nav-link">Наши котята</a>
        <a href="{{ url("/cms/Adoption") }}" class="nav-link">Усыновление</a>
        <a href="{{ url("/cms/FAQ") }}" class="nav-link">Вопросы</a>
        <a href="{{ url("/cms/About Us") }}" class="nav-link">О нас</a>
        <a href="{{ url("/cms/Blog") }}" class="nav-link">Блог</a>
        <a href="{{ url("/cms/Reviews") }}" class="nav-link active">Отзывы</a>
        <a href="{{ url("/cms/Contacts") }}" class="nav-link">Контакты</a>
        <a href="{{ url("/cms/Contacts") }}" class="mobile-contact-btn">СВЯЗАТЬСЯ</a>
    </nav>
</div>

<!-- Герой-секция -->
<div class="reviews-hero">
    <h1>Отзывы наших клиентов</h1>
    <p>Реальные истории счастливых владельцев шотландских кошек из питомника Cinnamon Desire</p>
</div>

<!-- Основной контейнер отзывов -->
<div class="reviews-container">
    
    <!-- Фильтр отзывов -->
    <div class="reviews-filter">
        <button class="filter-btn active" data-filter="all">Все отзывы</button>
        <button class="filter-btn" data-filter="5">⭐ 5 звезд</button>
        <button class="filter-btn" data-filter="4">⭐ 4 звезды</button>
        <button class="filter-btn" data-filter="recent">🕐 Последние</button>
    </div>
    
    <!-- Сетка отзывов -->
    <div class="reviews-grid">
        
        <!-- Отзыв 1 -->
        <div class="review-card" data-rating="5">
            <div class="review-header">
                <div class="reviewer-avatar">
                    <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80" alt="Анна Петрова">
                </div>
                <div class="reviewer-info">
                    <div class="reviewer-name">Анна Петрова
                        <span class="verified-badge">Проверенный отзыв</span>
                    </div>
                    <div class="review-date">12 апреля 2024</div>
                </div>
            </div>
            
            <div class="review-rating">
                <span class="star">⭐</span>
                <span class="star">⭐</span>
                <span class="star">⭐</span>
                <span class="star">⭐</span>
                <span class="star">⭐</span>
            </div>
            
            <div class="review-text">
                Огромное спасибо питомнику Cinnamon Desire за нашего чудесного котика! С первых минут общения с Еленой (владелицей питомника) поняла, что обращаюсь к настоящим профессионалам. Котенок приехал к нам полностью привитый, здоровый и очень социализированный. Уже год радует нас своим игривым характером и нежностью.
            </div>
            
            <div class="review-kittens">
                <span class="kitten-tag">Шотландский вислоухий</span>
                <span class="kitten-tag">Котенок Марсик</span>
            </div>
        </div>
        
        <!-- Отзыв 2 -->
        <div class="review-card" data-rating="5">
            <div class="review-header">
                <div class="reviewer-avatar">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80" alt="Дмитрий Смирнов">
                </div>
                <div class="reviewer-info">
                    <div class="reviewer-name">Дмитрий Смирнов</div>
                    <div class="review-date">28 марта 2024</div>
                </div>
            </div>
            
            <div class="review-rating">
                <span class="star">⭐</span>
                <span class="star">⭐</span>
                <span class="star">⭐</span>
                <span class="star">⭐</span>
                <span class="star">⭐</span>
            </div>
            
            <div class="review-text">
                Покупали кошечку для дочери. От всей семьи выражаем благодарность! Кошка здоровая, ухоженная, с документами. Особенно хочу отметить поддержку после покупки - на все вопросы отвечали быстро и подробно. Прошло 8 месяцев, наша Муся выросла в красивую кошку с прекрасным характером.
            </div>
            
            <div class="review-kittens">
                <span class="kitten-tag">Шотландская прямоухая</span>
                <span class="kitten-tag">Кошечка Муся</span>
            </div>
        </div>
        
        <!-- Отзыв 3 -->
        <div class="review-card" data-rating="5">
            <div class="review-header">
                <div class="reviewer-avatar">
                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80" alt="Мария Иванова">
                </div>
                <div class="reviewer-info">
                    <div class="reviewer-name">Мария Иванова
                        <span class="verified-badge">Проверенный отзыв</span>
                    </div>
                    <div class="review-date">15 февраля 2024</div>
                </div>
            </div>
            
            <div class="review-rating">
                <span class="star">⭐</span>
                <span class="star">⭐</span>
                <span class="star">⭐</span>
                <span class="star">⭐</span>
                <span class="star">⭐</span>
            </div>
            
            <div class="review-text">
                Это уже второй котенок из этого питомника. Первого взяли 3 года назад, и он стал членом семьи. Решили взять ему друга. Как и в первый раз, все было на высшем уровне! Котята выращены с любовью, приучены к лотку и когтеточке. Отдельное спасибо за консультации по уходу и кормлению.
            </div>
            
            <div class="review-kittens">
                <span class="kitten-tag">Шотландский вислоухий</span>
                <span class="kitten-tag">Котенок Симба</span>
            </div>
        </div>
        
        <!-- Отзыв 4 -->
        <div class="review-card" data-rating="5">
            <div class="review-header">
                <div class="reviewer-avatar">
                    <img src="https://images.unsplash.com/photo-1507591064344-4c6ce005-128?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80" alt="Алексей Ковалев">
                </div>
                <div class="reviewer-info">
                    <div class="reviewer-name">Алексей Ковалев</div>
                    <div class="review-date">2 февраля 2024</div>
                </div>
            </div>
            
            <div class="review-rating">
                <span class="star">⭐</span>
                <span class="star">⭐</span>
                <span class="star">⭐</span>
                <span class="star">⭐</span>
                <span class="star">⭐</span>
            </div>
            
            <div class="review-text">
                Долго выбирали питомник, читали отзывы. Не пожалели, что остановились на Cinnamon Desire. Все честно и прозрачно. Приехали, посмотрели котят, родителей. Все чисто, ухоженно. Котенок активный, здоровый. Дали все документы, рекомендации. Спасибо за нашего нового члена семьи!
            </div>
            
            <div class="review-kittens">
                <span class="kitten-tag">Шотландский прямоухий</span>
                <span class="kitten-tag">Котенок Барсик</span>
            </div>
        </div>
        
        <!-- Отзыв 5 -->
        <div class="review-card" data-rating="4">
            <div class="review-header">
                <div class="reviewer-avatar">
                    <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80" alt="Екатерина Соколова">
                </div>
                <div class="reviewer-info">
                    <div class="reviewer-name">Екатерина Соколова</div>
                    <div class="review-date">20 января 2024</div>
                </div>
            </div>
            
            <div class="review-rating">
                <span class="star">⭐</span>
                <span class="star">⭐</span>
                <span class="star">⭐</span>
                <span class="star">⭐</span>
                <span class="star empty">⭐</span>
            </div>
            
            <div class="review-text">
                Хороший питомник, ответственные заводчики. Котенок здоровый, активный. Из минусов - немного завышенная цена по сравнению с другими предложениями. Но качество и гарантии того стоят. Рекомендую тем, кто ищет породистого котенка с документами и хорошей родословной.
            </div>
            
            <div class="review-kittens">
                <span class="kitten-tag">Шотландская вислоухая</span>
                <span class="kitten-tag">Кошечка Лилу</span>
            </div>
        </div>
        
        <!-- Отзыв 6 -->
        <div class="review-card" data-rating="5">
            <div class="review-header">
                <div class="reviewer-avatar">
                    <img src="https://images.unsplash.com/photo-1508214751196-bcfd4ca60f91?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80" alt="Ольга Николаева">
                </div>
                <div class="reviewer-info">
                    <div class="reviewer-name">Ольга Николаева
                        <span class="verified-badge">Проверенный отзыв</span>
                    </div>
                    <div class="review-date">5 января 2024</div>
                </div>
            </div>
            
            <div class="review-rating">
                <span class="star">⭐</span>
                <span class="star">⭐</span>
                <span class="star">⭐</span>
                <span class="star">⭐</span>
                <span class="star">⭐</span>
            </div>
            
            <div class="review-text">
                Мечтала о шотландской кошке много лет. Cinnamon Desire стал идеальным выбором. Весь процесс от выбора котенка до получения его дома был организован безупречно. Кошка адаптировалась за один день! Очень ласковая, умная, играет с детьми. Спасибо за осуществление мечты!
            </div>
            
            <div class="review-kittens">
                <span class="kitten-tag">Шотландская прямоухая</span>
                <span class="kitten-tag">Кошечка Ариэль</span>
            </div>
        </div>
        
    </div>
    
    <!-- Кнопка "Показать еще" -->
    <div class="load-more">
        <button class="load-more-btn">Показать еще отзывы</button>
    </div>
    
</div>

<!-- FOOTER -->
<footer class="cd-footer">
    <div class="footer-inner">
        <div class="footer-col col-main">
            <div class="footer-logo">CINNAMON <span>DESIRE</span></div>
            <div class="footer-tagline">ПИТОМНИК ШОТЛАНДСКИХ КОШЕК</div>
            <p class="footer-about">Питомник с более чем 10-летней историей. Мы выращиваем кошек с любовью и уважением к их природе.</p>
            
            <div class="footer-socials">
                <a href="#" class="social-btn">VK</a>
                <a href="#" class="social-btn">TG</a>
                <a href="#" class="social-btn">WA</a>
            </div>
        </div>

        <div class="footer-col">
            <h4 class="footer-title">РАЗДЕЛЫ</h4>
            <ul class="footer-links">
                <li><a href="{{ url("/") }}">Наши котята</a></li>
                <li><a href="{{ url("/cms/Reviews") }}" class="active-link">Отзывы</a></li>
                <li><a href="{{ url("/cms/Blog") }}">Блог</a></li>
                <li><a href="{{ url("/cms/About Us") }}">О нас</a></li>
                <li><a href="{{ url("/cms/Contacts") }}">Контакты</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h4 class="footer-title">ПОДДЕРЖКА</h4>
            <ul class="footer-links">
                <li><a href="{{ url("/cms/Adoption") }}">Усыновление</a></li>
                <li><a href="{{ url("/cms/FAQ") }}">Вопросы</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h4 class="footer-title">ПОРОДА</h4>
            <ul class="footer-links">
                <li><a href="#">Scottish Fold</a></li>
                <li><a href="#">Scottish Straight</a></li>
                <li><a href="#">WCF Certified</a></li>
            </ul>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="copyright-text">© 2024 CINNAMON DESIRE CATTERY. ALL RIGHTS RESERVED.</div>
    </div>
</footer>

<script>
    // Мобильное меню
    document.addEventListener('DOMContentLoaded', function() {
        const menuToggle = document.querySelector('.mobile-menu-toggle');
        const menuClose = document.querySelector('.mobile-menu-close');
        const menuOverlay = document.querySelector('.menu-overlay');
        const mobileMenu = document.querySelector('.mobile-menu');
        const mobileLinks = document.querySelectorAll('.mobile-nav .nav-link');
        
        // Открытие меню
        menuToggle.addEventListener('click', function() {
            mobileMenu.classList.add('active');
            menuOverlay.classList.add('active');
            menuToggle.classList.add('active');
        });
        
        // Закрытие меню
        function closeMenu() {
            mobileMenu.classList.remove('active');
            menuOverlay.classList.remove('active');
            menuToggle.classList.remove('active');
        }
        
        menuClose.addEventListener('click', closeMenu);
        menuOverlay.addEventListener('click', closeMenu);
        
        // Закрытие меню при клике на ссылку
        mobileLinks.forEach(link => {
            link.addEventListener('click', closeMenu);
        });
        
        // Добавляем активный класс к текущей странице в меню
        const currentPage = window.location.pathname.split('/').pop();
        const navLinks = document.querySelectorAll('.nav-link');
        
        navLinks.forEach(link => {
            if (link.getAttribute('href') === currentPage) {
                link.classList.add('active');
            }
        });
        
        // Фильтрация отзывов
        const filterBtns = document.querySelectorAll('.filter-btn');
        const reviewCards = document.querySelectorAll('.review-card');
        
        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                // Удаляем активный класс у всех кнопок
                filterBtns.forEach(b => b.classList.remove('active'));
                // Добавляем активный класс текущей кнопке
                this.classList.add('active');
                
                const filter = this.dataset.filter;
                
                if (filter === 'all') {
                    // Показываем все отзывы
                    reviewCards.forEach(card => {
                        card.style.display = 'block';
                    });
                } else if (filter === 'recent') {
                    // Показываем последние (все для примера)
                    reviewCards.forEach(card => {
                        card.style.display = 'block';
                    });
                } else {
                    // Фильтруем по рейтингу
                    reviewCards.forEach(card => {
                        const rating = card.dataset.rating;
                        if (rating === filter) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                }
            });
        });
        
        // Кнопка "Показать еще"
        const loadMoreBtn = document.querySelector('.load-more-btn');
        
        loadMoreBtn.addEventListener('click', function() {
            // В реальном сайте здесь загрузка дополнительных отзывов
            // Для примева просто покажем сообщение
            alert('Загрузка дополнительных отзывов...');
            
            // Имитация загрузки
            this.textContent = 'Загрузка...';
            this.disabled = true;
            
            setTimeout(() => {
                this.textContent = 'Все отзывы загружены';
                this.disabled = true;
                this.style.background = '#b5a59e';
            }, 1000);
        });
        
        // Анимация появления отзывов при скролле
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                }
            });
        }, observerOptions);
        
        // Наблюдаем за всеми карточками отзывов
        reviewCards.forEach(card => {
            card.style.animationPlayState = 'paused';
            observer.observe(card);
        });
        
        // Улучшение для мобильных устройств
        if ('ontouchstart' in window) {
            // Увеличение зоны клика для карточек на мобильных
            reviewCards.forEach(card => {
                card.style.cursor = 'pointer';
            });
            
            // Улучшение для кнопок фильтра на мобильных
            filterBtns.forEach(btn => {
                btn.style.padding = '15px 20px';
                btn.style.minHeight = '50px';
            });
        }
    });
</script>


    @include("partials.inline-editor")
</body>
</html>