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
    <link rel="stylesheet" href="{{ asset("static/cms/style.css") }}">
    <style>
        /* Дополнительные стили для страницы контактов */
        .contacts-hero {
            padding: 40px 16px 30px;
            background: linear-gradient(135deg, #fceee9 0%, #f8e1d7 100%);
            text-align: center;
        }
        
        .contacts-hero h1 {
            font-size: 1.8rem;
            color: #716059;
            margin-bottom: 16px;
            font-weight: 600;
            line-height: 1.3;
        }
        
        .contacts-hero p {
            font-size: 1rem;
            color: #8a756d;
            margin: 0 auto 30px;
            line-height: 1.5;
            padding: 0 8px;
        }
        
        /* Быстрые контакты для мобильных */
        .mobile-quick-contacts {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
            margin-top: 25px;
            padding: 0 10px;
        }
        
        .quick-contact-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 18px;
            background: white;
            border-radius: 50px;
            color: #716059;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            box-shadow: 0 3px 10px rgba(113, 96, 89, 0.1);
            transition: all 0.3s;
            flex: 1;
            min-width: 140px;
            max-width: 180px;
        }
        
        .quick-contact-btn svg {
            width: 18px;
            height: 18px;
            fill: #f19072;
        }
        
        .quick-contact-btn:hover {
            background: #f19072;
            color: white;
            transform: translateY(-2px);
        }
        
        .quick-contact-btn:hover svg {
            fill: white;
        }
        
        .contacts-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 16px;
            display: flex;
            flex-direction: column;
            gap: 30px;
        }
        
        .contact-info-card {
            background: white;
            border-radius: 16px;
            padding: 25px 20px;
            box-shadow: 0 4px 15px rgba(113, 96, 89, 0.08);
            position: relative;
            overflow: hidden;
        }
        
        .contact-info-card:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #f19072, #ffb8a3);
        }
        
        .contact-info-card h2 {
            color: #716059;
            font-size: 1.4rem;
            margin-bottom: 25px;
            padding-bottom: 12px;
            border-bottom: 1px solid #f0e0d9;
            position: relative;
        }
        
        .contact-info-card h2:after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 60px;
            height: 2px;
            background: #f19072;
        }
        
        .contact-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 22px;
            padding-bottom: 22px;
            border-bottom: 1px solid #f8f0ec;
        }
        
        .contact-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .contact-icon {
            width: 44px;
            height: 44px;
            background: #fceee9;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            flex-shrink: 0;
        }
        
        .contact-icon svg {
            width: 20px;
            height: 20px;
            fill: #716059;
        }
        
        .contact-details h3 {
            color: #716059;
            margin-bottom: 6px;
            font-size: 1rem;
            font-weight: 600;
        }
        
        .contact-details p {
            color: #8a756d;
            line-height: 1.5;
            font-size: 0.95rem;
        }
        
        .contact-link {
            color: #f19072;
            text-decoration: none;
            transition: color 0.3s;
            display: block;
            margin-bottom: 4px;
            word-break: break-all;
        }
        
        .contact-link:last-child {
            margin-bottom: 0;
        }
        
        .contact-link:hover {
            color: #716059;
            text-decoration: underline;
        }
        
        /* Мобильная оптимизация форм */
        .contact-form-card {
            background: white;
            border-radius: 16px;
            padding: 25px 20px;
            box-shadow: 0 4px 15px rgba(113, 96, 89, 0.08);
            position: relative;
            overflow: hidden;
        }
        
        .contact-form-card:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #f19072, #ffb8a3);
        }
        
        .contact-form-card h2 {
            color: #716059;
            font-size: 1.4rem;
            margin-bottom: 25px;
            padding-bottom: 12px;
            border-bottom: 1px solid #f0e0d9;
            position: relative;
        }
        
        .contact-form-card h2:after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 60px;
            height: 2px;
            background: #f19072;
        }
        
        .form-group {
            margin-bottom: 18px;
        }
        
        .form-group label {
            display: block;
            color: #716059;
            margin-bottom: 6px;
            font-weight: 500;
            font-size: 0.95rem;
        }
        
        .form-input, .form-textarea {
            width: 100%;
            padding: 14px 16px;
            border: 1.5px solid #e8d8d1;
            border-radius: 10px;
            font-family: 'Montserrat', sans-serif;
            font-size: 1rem;
            color: #716059;
            transition: all 0.3s;
            -webkit-appearance: none;
            appearance: none;
        }
        
        .form-input:focus, .form-textarea:focus {
            outline: none;
            border-color: #f19072;
            box-shadow: 0 0 0 3px rgba(241, 144, 114, 0.1);
        }
        
        .form-textarea {
            min-height: 130px;
            resize: vertical;
            line-height: 1.5;
        }
        
        .submit-btn {
            background: linear-gradient(135deg, #f19072 0%, #ff9c7c 100%);
            color: white;
            border: none;
            padding: 16px 24px;
            border-radius: 10px;
            font-family: 'Montserrat', sans-serif;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            width: 100%;
            margin-top: 10px;
            box-shadow: 0 4px 12px rgba(241, 144, 114, 0.25);
        }
        
        .submit-btn:hover {
            background: linear-gradient(135deg, #e07d5f 0%, #f58a6a 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(241, 144, 114, 0.35);
        }
        
        .submit-btn:active {
            transform: translateY(0);
        }
        
        .map-container {
            max-width: 1200px;
            margin: 10px auto 40px;
            padding: 0 16px;
        }
        
        .map-placeholder {
            background: white;
            border-radius: 16px;
            padding: 25px 20px;
            text-align: center;
            color: #716059;
            box-shadow: 0 4px 15px rgba(113, 96, 89, 0.08);
            border-top: 4px solid #f19072;
        }
        
        .map-placeholder h3 {
            margin-bottom: 15px;
            font-size: 1.3rem;
            color: #716059;
        }
        
        .map-placeholder p {
            color: #8a756d;
            line-height: 1.5;
            margin-bottom: 15px;
            font-size: 0.95rem;
        }
        
        .map-actions {
            display: flex;
            gap: 10px;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 20px;
        }
        
        .map-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 20px;
            background: #fceee9;
            border-radius: 8px;
            color: #716059;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.3s;
            flex: 1;
            justify-content: center;
            min-width: 140px;
        }
        
        .map-btn:hover {
            background: #f19072;
            color: white;
        }
        
        .working-hours {
            background: #fef9f7;
            border-radius: 12px;
            padding: 20px;
            margin-top: 25px;
            text-align: left;
            border-left: 4px solid #f19072;
        }
        
        .working-hours h4 {
            color: #716059;
            margin-bottom: 15px;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .working-hours h4:before {
            content: '🕐';
            font-size: 1.2rem;
        }
        
        .hours-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .hours-list li {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #f0e0d9;
            font-size: 0.95rem;
        }
        
        .hours-list li:last-child {
            border-bottom: none;
        }
        
        .day {
            color: #716059;
            font-weight: 500;
        }
        
        .time {
            color: #8a756d;
            font-weight: 500;
        }
        
        .social-contacts {
            display: flex;
            gap: 12px;
            margin-top: 25px;
            flex-wrap: wrap;
        }
        
        .social-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            background: #fceee9;
            border-radius: 50%;
            color: #716059;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s;
            position: relative;
        }
        
        .social-link:hover {
            background: #f19072;
            color: white;
            transform: translateY(-3px) scale(1.05);
        }
        
        /* Call-to-action для мобильных */
        .mobile-call-action {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            padding: 12px 16px;
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            display: none;
        }
        
        .mobile-call-action.show {
            display: block;
            animation: slideUp 0.3s ease-out;
        }
        
        @keyframes slideUp {
            from { transform: translateY(100%); }
            to { transform: translateY(0); }
        }
        
        .call-action-buttons {
            display: flex;
            gap: 10px;
        }
        
        .call-action-btn {
            flex: 1;
            padding: 14px;
            border-radius: 10px;
            border: none;
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        
        .call-action-btn.primary {
            background: linear-gradient(135deg, #f19072 0%, #ff9c7c 100%);
            color: white;
        }
        
        .call-action-btn.secondary {
            background: #fceee9;
            color: #716059;
        }
        
        /* Адаптивность для планшетов и десктопов */
        @media (min-width: 768px) {
            .contacts-hero {
                padding: 60px 20px 40px;
            }
            
            .contacts-hero h1 {
                font-size: 2.5rem;
                margin-bottom: 20px;
            }
            
            .contacts-hero p {
                font-size: 1.1rem;
                max-width: 600px;
                margin-bottom: 40px;
            }
            
            .contacts-container {
                grid-template-columns: 1fr 1fr;
                gap: 40px;
                padding: 40px 20px;
                display: grid;
            }
            
            .contact-info-card, .contact-form-card {
                padding: 35px 30px;
            }
            
            .contact-info-card h2, .contact-form-card h2 {
                font-size: 1.6rem;
            }
            
            .mobile-call-action {
                display: none !important;
            }
        }
        
        /* Особенности для очень маленьких экранов */
        @media (max-width: 360px) {
            .contacts-hero {
                padding: 30px 12px 25px;
            }
            
            .contacts-hero h1 {
                font-size: 1.6rem;
            }
            
            .quick-contact-btn {
                min-width: 100%;
                max-width: 100%;
            }
            
            .contact-icon {
                width: 40px;
                height: 40px;
                margin-right: 12px;
            }
            
            .contact-details h3 {
                font-size: 0.95rem;
            }
            
            .contact-details p {
                font-size: 0.9rem;
            }
            
            .call-action-buttons {
                flex-direction: column;
            }
        }
        
        /* Анимации для улучшения UX */
        .contact-item, .form-group, .map-placeholder, .working-hours {
            animation: fadeInUp 0.5s ease-out forwards;
            opacity: 0;
        }
        
        .contact-item:nth-child(1) { animation-delay: 0.1s; }
        .contact-item:nth-child(2) { animation-delay: 0.2s; }
        .contact-item:nth-child(3) { animation-delay: 0.3s; }
        .working-hours { animation-delay: 0.4s; }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Улучшение скролла на мобильных */
        html {
            scroll-behavior: smooth;
        }
        
        /* Улучшение тач-интерфейса */
        button, .submit-btn, .quick-contact-btn, .map-btn, .social-link {
            -webkit-tap-highlight-color: transparent;
            touch-action: manipulation;
        }
        
        /* Оптимизация для iOS */
        input, textarea, button {
            -webkit-appearance: none;
            border-radius: 0;
        }
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
            <a href="{{ url("/cms/Contacts") }}" class="nav-link active">Контакты</a>
        </nav>

        <div class="header-action">
            <a href="#contact-form" class="btn-header-contact">СВЯЗАТЬСЯ</a>
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
       
        <a href="tel:+79991234567" class="mobile-contact-btn">ПОЗВОНИТЬ</a>
    </nav>
</div>

<!-- Основной контент страницы -->
<div class="contacts-hero">
    <h1>Свяжитесь с нами</h1>
    <p>Мы всегда рады ответить на ваши вопросы, рассказать о наших котятах и помочь с выбором нового друга</p>
    
    <div class="mobile-quick-contacts">
        <a href="tel:+79991234567" class="quick-contact-btn">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
            </svg>
            Позвонить
        </a>
        
        <a href="https://wa.me/79998765432" class="quick-contact-btn" target="_blank">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M12.032 2c-5.509 0-9.974 4.486-9.974 10.019 0 2.188.709 4.216 1.912 5.868L2 22l4.204-1.104c1.552.851 3.332 1.347 5.214 1.347 5.509 0 9.974-4.486 9.974-10.019S17.541 2 12.032 2zm5.788 13.271c-.249.698-1.521 1.276-2.096 1.352-.544.071-1.232.079-1.956-.393-.522-.341-1.279-.788-2.29-1.256-1.695-.785-2.803-2.639-2.888-2.762-.085-.123-.708-.967-.708-1.844s.457-1.278.643-1.634c.187-.356.415-.534.708-.534.178 0 .356 0 .512.006.178.006.416-.064.656.499.249.587.855 2.03.934 2.177.079.148.159.356.053.57-.107.213-.159.356-.321.534-.164.178-.338.394-.484.53-.164.148-.333.311-.143.604.187.292.838 1.246 1.802 2.02 1.234.985 2.286 1.302 2.588 1.445.302.143.479.119.656-.071.178-.19.763-.851.967-1.145.204-.294.408-.247.656-.159.249.087 1.575.743 1.845.879.271.136.457.204.522.322.065.118.065.674-.184 1.371z"/>
            </svg>
            WhatsApp
        </a>
        
        <a href="mailto:info@cinnamondesire.ru" class="quick-contact-btn">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
            </svg>
            Email
        </a>
    </div>
</div>

<div class="contacts-container">
    <!-- Контактная информация -->
    <div class="contact-info-card">
        <h2>Наши контакты</h2>
        
        <div class="contact-item">
            <div class="contact-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                </svg>
            </div>
            <div class="contact-details">
                <h3>Email</h3>
                <p><a href="mailto:info@cinnamondesire.ru" class="contact-link">info@cinnamondesire.ru</a></p>
                <p><a href="mailto:support@cinnamondesire.ru" class="contact-link">support@cinnamondesire.ru</a></p>
            </div>
        </div>
        
        <div class="contact-item">
            <div class="contact-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                </svg>
            </div>
            <div class="contact-details">
                <h3>Телефон</h3>
                <p><a href="tel:+79991234567" class="contact-link">+7 (999) 123-45-67</a></p>
                <p><a href="tel:+79998765432" class="contact-link">+7 (999) 876-54-32</a> (WhatsApp/Telegram)</p>
            </div>
        </div>
        
        <div class="contact-item">
            <div class="contact-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                </svg>
            </div>
            <div class="contact-details">
                <h3>Адрес питомника</h3>
                <p>г. Москва, ул. Кошачья, д. 15</p>
                <p><em>Посещение только по предварительной записи</em></p>
            </div>
        </div>
        
        <div class="working-hours">
            <h4>Часы работы</h4>
            <ul class="hours-list">
                <li><span class="day">Пн-Пт</span><span class="time">10:00-19:00</span></li>
                <li><span class="day">Суббота</span><span class="time">11:00-17:00</span></li>
                <li><span class="day">Воскресенье</span><span class="time">11:00-16:00</span></li>
            </ul>
        </div>
        
        <div class="social-contacts">
            <a href="https://vk.com/cinnamondesire" class="social-link" target="_blank" aria-label="ВКонтакте">VK</a>
            <a href="https://t.me/cinnamondesire" class="social-link" target="_blank" aria-label="Telegram">TG</a>
            <a href="https://wa.me/79998765432" class="social-link" target="_blank" aria-label="WhatsApp">WA</a>
            <a href="https://instagram.com/cinnamondesire" class="social-link" target="_blank" aria-label="Instagram">IG</a>
        </div>
    </div>
    
    <!-- Форма обратной связи -->
    <div class="contact-form-card">
        <h2 id="contact-form">Написать нам</h2>
        <form id="contactForm" onsubmit="return submitContactForm(event)">
            <div class="form-group">
                <label for="name">Ваше имя *</label>
                <input type="text" id="name" class="form-input" placeholder="Иван Иванов" required>
            </div>
            
            <div class="form-group">
                <label for="phone">Телефон *</label>
                <input type="tel" id="phone" class="form-input" placeholder="+7 (999) 123-45-67" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" id="email" class="form-input" placeholder="ivan@example.com" required>
            </div>
            
            <div class="form-group">
                <label for="message">Сообщение *</label>
                <textarea id="message" class="form-textarea" placeholder="Расскажите, какого котенка вы ищете, или задайте вопрос..." required></textarea>
            </div>
            
            <button type="submit" class="submit-btn">ОТПРАВИТЬ СООБЩЕНИЕ</button>
        </form>
    </div>
</div>

<!-- Карта (заглушка) -->
<div class="map-container">
    <div class="map-placeholder">
        <h3>Мы находимся здесь</h3>
        <p>г. Москва, ул. Кошачья, д. 15</p>
        <p>Для навигации используйте карты:</p>
        
        <div class="map-actions">
            <a href="https://yandex.ru/maps" class="map-btn" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#716059" style="margin-right: 5px;">
                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                </svg>
                Яндекс.Карты
            </a>
            <a href="https://google.com/maps" class="map-btn" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#716059" style="margin-right: 5px;">
                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                </svg>
                Google Maps
            </a>
        </div>
    </div>
</div>

<!-- Мобильный CTA (появляется при скролле) -->
<div class="mobile-call-action" id="mobileCTA">
    <div class="call-action-buttons">
        <button class="call-action-btn primary" onclick="window.location.href='tel:+79991234567'">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="white" style="margin-right: 5px;">
                <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
            </svg>
            Позвонить
        </button>
        <button class="call-action-btn secondary" onclick="window.location.href='#contact-form'">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="#716059" style="margin-right: 5px;">
                <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
            </svg>
            Написать
        </button>
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

<script src="{{ asset("static/cms/script.js") }}"></script>
<script>
    // Функция для обработки отправки формы
    function submitContactForm(event) {
        event.preventDefault();
        
        // Получаем данные формы
        const name = document.getElementById('name').value;
        const phone = document.getElementById('phone').value;
        const email = document.getElementById('email').value;
        const message = document.getElementById('message').value;
        
        // Валидация телефона
        const phoneRegex = /^[\+]?[7-8]?[0-9\s\-\(\)]{10,}$/;
        if (!phoneRegex.test(phone.replace(/[\s\-\(\)]/g, ''))) {
            alert('Пожалуйста, введите корректный номер телефона');
            document.getElementById('phone').focus();
            return false;
        }
        
        // Валидация email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            alert('Пожалуйста, введите корректный email адрес');
            document.getElementById('email').focus();
            return false;
        }
        
        // Показываем успешное сообщение
        const submitBtn = document.querySelector('.submit-btn');
        const originalText = submitBtn.textContent;
        
        submitBtn.textContent = 'Отправка...';
        submitBtn.disabled = true;
        
        // Имитация отправки
        setTimeout(() => {
            alert(`Спасибо, ${name}! Ваше сообщение отправлено. Мы свяжемся с вами в ближайшее время по телефону ${phone} или email ${email}.`);
            
            submitBtn.textContent = 'Сообщение отправлено!';
            submitBtn.style.background = 'linear-gradient(135deg, #4CAF50 0%, #45a049 100%)';
            
            // Очищаем форму через 2 секунды
            setTimeout(() => {
                document.getElementById('contactForm').reset();
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
                submitBtn.style.background = 'linear-gradient(135deg, #f19072 0%, #ff9c7c 100%)';
            }, 2000);
        }, 1500);
        
        return false;
    }
    
    // Управление мобильным CTA
    let lastScrollTop = 0;
    const mobileCTA = document.getElementById('mobileCTA');
    
    window.addEventListener('scroll', function() {
        if (window.innerWidth < 768) {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            // Показываем CTA при скролле вниз, скрываем при скролле вверх
            if (scrollTop > lastScrollTop && scrollTop > 300) {
                mobileCTA.classList.add('show');
            } else if (scrollTop < lastScrollTop) {
                mobileCTA.classList.remove('show');
            }
            
            lastScrollTop = scrollTop;
            
            // Скрываем CTA когда пользователь достиг формы
            const formElement = document.getElementById('contact-form');
            if (formElement) {
                const formPosition = formElement.getBoundingClientRect().top;
                if (formPosition < window.innerHeight * 0.8) {
                    mobileCTA.classList.remove('show');
                }
            }
        }
    });
    
    // Автоматический формат телефона
    document.getElementById('phone')?.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        
        if (value.startsWith('7') || value.startsWith('8')) {
            value = value.substring(1);
        }
        
        if (value.length > 0) {
            value = '+7 (' + value.substring(0, 3);
            if (value.length > 7) value += ') ' + value.substring(7, 10);
            if (value.length > 12) value += '-' + value.substring(12, 14);
            if (value.length > 15) value += '-' + value.substring(15, 17);
        }
        
        e.target.value = value;
    });
    
    // Добавляем активный класс к ссылке в меню
    document.addEventListener('DOMContentLoaded', function() {
        const currentPage = window.location.pathname.split('/').pop();
        const navLinks = document.querySelectorAll('.nav-link');
        
        navLinks.forEach(link => {
            if (link.getAttribute('href') === currentPage) {
                link.classList.add('active');
            }
        });
        
        // Обработка кнопки связи в мобильном меню
        const mobileContactBtn = document.querySelector('.mobile-contact-btn');
        if (mobileContactBtn) {
            mobileContactBtn.addEventListener('click', function(e) {
                if (this.getAttribute('href') === '#contact-form') {
                    e.preventDefault();
                    document.querySelector('.mobile-menu').classList.remove('active');
                    document.querySelector('.menu-overlay').classList.remove('active');
                    document.querySelector('.mobile-menu-toggle').classList.remove('active');
                    
                    // Прокрутка к форме
                    const formElement = document.getElementById('contact-form');
                    if (formElement) {
                        formElement.scrollIntoView({ behavior: 'smooth' });
                    }
                }
            });
        }
        
        // Обработка кнопки связи в основном хедере
        const headerContactBtn = document.querySelector('.btn-header-contact');
        if (headerContactBtn) {
            headerContactBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const formElement = document.getElementById('contact-form');
                if (formElement) {
                    formElement.scrollIntoView({ behavior: 'smooth' });
                }
            });
        }
        
        // Анимация появления элементов при загрузке
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
        
        // Наблюдаем за всеми анимируемыми элементами
        document.querySelectorAll('.contact-item, .form-group, .map-placeholder, .working-hours').forEach(el => {
            el.style.animationPlayState = 'paused';
            observer.observe(el);
        });
        
        // Улучшение для тач-устройств
        if ('ontouchstart' in window) {
            document.body.classList.add('touch-device');
            
            // Увеличиваем зону клика для кнопок на мобильных
            document.querySelectorAll('button, a').forEach(el => {
                el.style.minHeight = '44px';
                el.style.minWidth = '44px';
            });
        }
    });
    
    // Функция для копирования email в буфер обмена
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            alert('Email скопирован в буфер обмена: ' + text);
        }).catch(err => {
            console.error('Ошибка копирования: ', err);
        });
    }
</script>


    @include("partials.inline-editor")
</body>
</html>