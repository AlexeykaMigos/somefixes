Техническое задание
Админ-панель сайта (PHP + JSON, без MySQL)

1. Общая информация
   Тип проекта: админ-панель управления контентом
   Бэкенд: PHP (без использования MySQL)
   Хранение данных: JSON-файлы
   Фронтенд сайта: HTML / CSS / JavaScript
   Назначение: редактирование контента сайта без изменения исходного HTML-кода

2. Цели админ-панели
   Управление текстами, заголовками и описаниями сайта
   Изменение цен и числовых значений
   Управление изображениями
   Хранение данных в JSON
   Подключение данных к HTML-страницам через JavaScript (fetch)

3. Функциональные требования

3.1 Авторизация
Страница входа /admin/login.php
Авторизация по логину и паролю
Данные пользователя хранятся в users.json
Использовать PHP-сессии
Защита от прямого доступа к админ-страницам

3.2 Панель администратора
Страница /admin/panel.php
После входа отображается список редактируемых блоков
Кнопка сохранения изменений
Кнопка выхода из системы

3.3 Управление контентом
Админ-панель должна позволять редактировать заголовки (h1, h2, h3), текстовые блоки, цены, кнопки (текст и ссылка), мета-данные (title, description).
Все данные сохраняются в файл /data/content.json.

3.4 Работа с изображениями
Загрузка изображений через админ-панель
Хранение изображений в папке /uploads
Пути к изображениям сохраняются в JSON
Проверка допустимых форматов (jpg, png, webp)

3.5 Сохранение данных
Сохранение данных через PHP-обработчик save.php
Запись данных в JSON с блокировкой файла
Проверка и валидация данных перед сохранением

4. Интеграция с сайтом

4.1 Получение данных на сайте
Данные загружаются на сайт через JavaScript с использованием fetch из файла content.json.

4.2 Требования к HTML
Все редактируемые элементы сайта должны иметь уникальные классы или data-атрибуты
HTML-структура сайта не должна изменяться админ-панелью

5. Структура проекта
   /admin — файлы админ-панели
   /data — JSON-файлы с данными
   /uploads — загруженные изображения
   /site — файлы сайта (HTML, CSS, JS)

6. Безопасность
   Хеширование паролей
   Проверка авторизации через сессии
   Ограничение доступа к админ-панели
   Защита от XSS и загрузки вредоносных файлов

7. Технические требования
   PHP версии 7.4 и выше
   Работа на обычном хостинге
   Отсутствие фреймворков и баз данных
   Использование чистого PHP

8. Результат
   Готовая рабочая админ-панель
   Возможность редактирования контента без MySQL
   Подключение JSON-данных к HTML-сайту
   Возможность дальнейшего расширения функционала


начало главной страницы Главная страница index.html

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
        </nav>

        <div class="header-action">
            <a href="#" class="btn-header-contact">СВЯЗАТЬСЯ</a>
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
        <a href="#" class="mobile-contact-btn">СВЯЗАТЬСЯ</a>
    </nav>
</div>

<div class="custom-quote-section">
    <h2 class="custom-quote-text">"Каждый котенок — это частичка нашей души, <br> выращенная с безграничной любовью"</h2>
    <p class="custom-quote-subtext">Посмотрите на наших шотландских котят, распределенных по пометам в удобных каруселях.</p>
</div>

<!-- LITTER F SECTION -->
<div class="custom-lt-container">
    <span class="custom-lt-title">Litter F</span>
    <span class="custom-lt-date">06.20.2024</span>
    <span class="custom-lt-line"></span>
    <span class="custom-lt-status">6 КОТЯТ В ПОМЕТЕ</span>
</div>

<div class="mycat-slider-wrapper">
    <button type="button" class="slider-arrow arrow-left" onclick="moveSliderNew(this, -1)">❮</button>
    <div class="mycat-viewport">
        <div class="mycat-section" data-pos="0">
            <div class="mycat-card-container">
                <div class="mycat-photo-box">
                    <img src="https://scottishkittensnyc.com/wp-content/uploads/2026/01/22239e.jpg" alt="Котенок шотландской породы">
                    <div class="mycat-sex-icon">♂</div>
                    <div class="mycat-fav-icon" onclick="toggleHeart(this)">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l8.72-8.72 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                    </div>
                </div>
                <a href="#" class="mycat-btn-about">Обо мне</a>
            </div>
            <div class="mycat-card-container">
                <div class="mycat-photo-box">
                    <img src="https://scottishkittensnyc.com/wp-content/uploads/2026/01/k22.jpg" alt="Котенок шотландской породы">
                    <div class="mycat-sex-icon">♂</div>
                </div>
                <a href="#" class="mycat-btn-about">Обо мне</a>
            </div>
            <div class="mycat-card-container">
                <div class="mycat-photo-box">
                    <img src="https://scottishkittensnyc.com/wp-content/uploads/2026/01/k333.jpg" alt="Котенок шотландской породы">
                    <div class="mycat-sex-icon">♂</div>
                </div>
                <a href="#" class="mycat-btn-about">Обо мне</a>
            </div>
            <div class="mycat-card-container">
                <div class="mycat-photo-box">
                    <img src="https://scottishkittensnyc.com/wp-content/uploads/2026/01/k44.jpg" alt="Котенок шотландской породы">
                    <div class="mycat-sex-icon-female">♀</div>
                </div>
                <a href="#" class="mycat-btn-about">Обо мне</a>
            </div>
             <div class="mycat-card-container">
                <div class="mycat-photo-box">
                    <img src="https://scottishkittensnyc.com/wp-content/uploads/2026/01/k55.jpg" alt="Котенок шотландской породы">
                    <div class="mycat-sex-icon">♂</div>
                </div>
                <a href="#" class="mycat-btn-about">Обо мне</a>
            </div>
        </div>
    </div>
    <button type="button" class="slider-arrow arrow-right" onclick="moveSliderNew(this, 1)">❯</button>
</div>

<div style="height: 30px; background-color: #fceee9;"></div>

<!-- LITTER A SECTION -->
<div class="custom-lt-container">
    <span class="custom-lt-title">Litter A</span>
    <span class="custom-lt-date">01.20.2025</span>
    <span class="custom-lt-line"></span>
    <span class="custom-lt-status">4 КОТЕНКА В ПОМЕТЕ</span>
</div>

<div class="mycat-slider-wrapper">
    <button type="button" class="slider-arrow arrow-left" onclick="moveSliderNew(this, -1)">❮</button>
    <div class="mycat-viewport">
        <div class="mycat-section" data-pos="0">
            <div class="mycat-card-container">
                <div class="mycat-photo-box">
                    <img src="https://scottishkittensnyc.com/wp-content/uploads/2026/01/aa1.jpg" alt="Котенок шотландской породы">
                    <div class="mycat-sex-icon-female">♀</div>
                </div>
                <a href="#" class="mycat-btn-about">Обо мне</a>
            </div>
            <div class="mycat-card-container">
                <div class="mycat-photo-box">
                    <img src="https://scottishkittensnyc.com/wp-content/uploads/2026/01/239e.png" alt="Котенок шотландской породы">
                    <div class="mycat-sex-icon">♂</div>
                </div>
                <a href="#" class="mycat-btn-about">Обо мне</a>
            </div>
            <div class="mycat-card-container">
                <div class="mycat-photo-box">
                    <img src="https://scottishkittensnyc.com/wp-content/uploads/2026/01/239e44.png" alt="Котенок шотландской породы">
                    <div class="mycat-sex-icon">♂</div>
                </div>
                <a href="#" class="mycat-btn-about">Обо мне</a>
            </div>
            <div class="mycat-card-container">
                <div class="mycat-photo-box">
                    <img src="https://scottishkittensnyc.com/wp-content/uploads/2026/01/aa1.jpg" alt="Котенок шотландской породы">
                    <div class="mycat-sex-icon">♂</div>
                </div>
                <a href="#" class="mycat-btn-about">Обо мне</a>
            </div>
            <div class="mycat-card-container">
                <div class="mycat-photo-box">
                    <img src="https://scottishkittensnyc.com/wp-content/uploads/2026/01/239e433.png" alt="Котенок шотландской породы">
                    <div class="mycat-sex-icon">♂</div>
                </div>
                <a href="#" class="mycat-btn-about">Обо мне</a>
            </div>
        </div>
    </div>
    <button type="button" class="slider-arrow arrow-right" onclick="moveSliderNew(this, 1)">❯</button>
</div>

<div style="height: 30px; background-color: #fceee9;"></div>

<!-- OFFER BLOCK -->
<div class="main-offer-wrapper">
    <div class="offer-header-block">
        <div class="offer-subtitle">EXCLUSIVE OPPORTUNITY</div>
        <h2 class="offer-title">Offer for today</h2>
        <p class="offer-description">Discover unique conditions for our most outstanding representatives.</p>
    </div>

    <div class="kittens-flex-container">
        <div class="cat-offer-card">
            <div class="coc-media">
                <img src="https://scottishkittensnyc.com/wp-content/uploads/2026/01/22239e.jpg" alt="Cat" class="coc-img">
                <div class="coc-badge">🔥 SPECIAL PRICE</div>
                <div class="coc-fav">♡</div>
                <div class="coc-gender male">♂</div>
            </div>
            <a href="#" class="coc-btn-about">ОБО МНЕ</a>
            <div class="coc-price-box">
                <div class="coc-price-row">
                    <span class="coc-old-price">$1 800</span>
                    <span class="coc-new-price">$1 500</span>
                </div>
                <div class="coc-save-label">SAVE $300</div>
            </div>
        </div>

        <div class="cat-offer-card">
            <div class="coc-media">
                <img src="https://scottishkittensnyc.com/wp-content/uploads/2026/01/22239e.jpg" alt="Cat" class="coc-img">
                <div class="coc-badge">🔥 SPECIAL PRICE</div>
                <div class="coc-fav">♡</div>
                <div class="coc-gender female">♀</div>
            </div>
            <a href="#" class="coc-btn-about">ОБО МНЕ</a>
            <div class="coc-price-box">
                <div class="coc-price-row">
                    <span class="coc-old-price">$1 650</span>
                    <span class="coc-new-price">$1 400</span>
                </div>
                <div class="coc-save-label">SAVE $250</div>
            </div>
        </div>

        <div class="cat-offer-card">
            <div class="coc-media">
                <img src="https://scottishkittensnyc.com/wp-content/uploads/2026/01/22239e.jpg" alt="Cat" class="coc-img">
                <div class="coc-badge">🔥 SPECIAL PRICE</div>
                <div class="coc-fav">♡</div>
                <div class="coc-gender male">♂</div>
            </div>
            <a href="#" class="coc-btn-about">ОБО МНЕ</a>
            <div class="coc-price-box">
                <div class="coc-price-row">
                    <span class="coc-old-price">$1 350</span>
                    <span class="coc-new-price">$1 100</span>
                </div>
                <div class="coc-save-label">SAVE $250</div>
            </div>
        </div>
    </div>
</div>

<div style="height: 40px; background-color: #fceee9;"></div>

<!-- LITTER PARENT SECTION -->
<div class="litter-parent-section">
    <div class="litter-flex-row">
        <div class="parent-card">
            <div class="parent-media">
                <img src="https://scottishkittensnyc.com/wp-content/uploads/2026/01/239e44.png" alt="Father">
            </div>
            <div class="parent-info">
                <span class="parent-label">ОТЕЦ</span>
                <h3 class="parent-name">Golden Leo King</h3>
                <div class="parent-tags">
                    <span class="p-tag">SCOTTISH STRAIGHT</span>
                    <span class="p-tag">GICH WCF</span>
                </div>
            </div>
        </div>

        <div class="parent-card">
            <div class="parent-media">
                <img src="https://scottishkittensnyc.com/wp-content/uploads/2026/01/k44.jpg" alt="Mother">
            </div>
            <div class="parent-info">
                <span class="parent-label">МАТЬ</span>
                <h3 class="parent-name">Cinnamon Gracia</h3>
                <div class="parent-tags">
                    <span class="p-tag">SCOTTISH FOLD</span>
                    <span class="p-tag">CH WCF</span>
                </div>
            </div>
        </div>

        <div class="expectation-card">
            <div class="date-highlight-box">
                <span class="date-label">ОЖИДАЕМАЯ ДАТА РОЖДЕНИЯ</span>
                <div class="date-value">October 2024</div>
            </div>
            <p class="expectation-text">Свяжитесь с нами, чтобы попасть в приоритетный список ожидания на этот помет.</p>
            <a href="#" class="early-access-btn">ПОЛУЧИТЬ РАННИЙ ДОСТУП</a>
        </div>
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
                <li><a href="#">Наши котята</a></li>
                <li><a href="#">Отзывы</a></li>
                <li><a href="#">Блог</a></li>
                <li><a href="#">О нас</a></li>
                <li><a href="#" class="active-link">Контакты</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h4 class="footer-title">ПОДДЕРЖКА</h4>
            <ul class="footer-links">
                <li><a href="#">Усыновление</a></li>
                <li><a href="#">Вопросы</a></li>
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


</body>
</html>
конец главной страницы


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>{{ $title }}</title>
    <meta name="description" content="{{ $description }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
 <link rel="stylesheet" href="{{ asset("static/cms/style.css") }}">
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
            <a href="{{ url("/cms/FAQ") }}" class="nav-link active">Вопросы</a>
            <a href="{{ url("/cms/About Us") }}" class="nav-link">О нас</a>
        </nav>

        <div class="header-action">
            <a href="#" class="btn-header-contact">СВЯЗАТЬСЯ</a>
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
        <a href="{{ url("/cms/FAQ") }}" class="nav-link active">Вопросы</a>
        <a href="{{ url("/cms/About Us") }}" class="nav-link">О нас</a>
        <a href="#" class="mobile-contact-btn">СВЯЗАТЬСЯ</a>
    </nav>
</div>

<main>
    <section class="faq-container">
        <div class="faq-header">
            <span class="line"></span>
            <span class="header-text">🙋‍♀️ ЧАСТЫЕ ВОПРОСЫ</span>
            <span class="line"></span>
        </div>
        <div class="faq-badge">FAQ</div>
        <p class="faq-description">Все, что вам нужно знать перед тем, как принести маленького шотландского друга домой.</p>
    </section>

    <section class="faq-accordion">
        <details class="faq-item">
            <summary class="faq-question">Как забронировать котенка? <span class="plus-icon"></span></summary>
            <div class="faq-answer">Для бронирования свяжитесь с нами для обсуждения деталей и внесения депозита. Мы проведем с вами консультацию, ответим на все вопросы и поможем с выбором подходящего котенка.</div>
        </details>
        <details class="faq-item">
            <summary class="faq-question">В каком возрасте котенок может переехать? <span class="plus-icon"></span></summary>
            <div class="faq-answer">Обычно котята готовы к переезду в возрасте 12-16 недель после полной вакцинации и карантина. Этот период позволяет им окрепнуть, получить необходимые социальные навыки и быть полностью готовыми к переезду в новый дом.</div>
        </details>
        <details class="faq-item">
            <summary class="faq-question">Есть ли доставка? <span class="plus-icon"></span></summary>
            <div class="faq-answer">Да, мы организуем бережную и безопасную доставку по всему миру. Каждый котенок перевозится с полным комплектом документов, в специальных переносках с соблюдением всех необходимых условий для комфортной поездки.</div>
        </details>
        <details class="faq-item">
            <summary class="faq-question">Какие документы получает котенок? <span class="plus-icon"></span></summary>
            <div class="faq-answer">Каждый котенок получает полный пакет документов: родословную WCF, ветеринарный паспорт с отметками о прививках, договор купли-продажи, результаты генетических тестов родителей и рекомендации по уходу.</div>
        </details>
        <details class="faq-item">
            <summary class="faq-question">Какой корм вы рекомендуете? <span class="plus-icon"></span></summary>
            <div class="faq-answer">Мы рекомендуем премиальные холистик-корма для котят. При передаче котенка мы предоставляем подробные рекомендации по питанию и список рекомендованных кормов, а также небольшой стартовый набор корма на первое время.</div>
        </details>
        <details class="faq-item">
            <summary class="faq-question">Предоставляете ли вы консультации после покупки? <span class="plus-icon"></span></summary>
            <div class="faq-answer">Да, мы предоставляем пожизненные консультации по всем вопросам, связанным с уходом, здоровьем и воспитанием вашего питомца. Вы всегда можете обратиться к нам за помощью и советом.</div>
        </details>
    </section>

    <section class="cta-section">
        <div class="cta-box">
            <h2 class="cta-title">Остались вопросы?</h2>
            <p class="cta-subtitle">Напишите нам, и мы ответим в течение <span>15 минут.</span></p>
            <a href="#" class="btn-cta">Связаться</a>
        </div>
    </section>
</main>

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
                <li><a href="#">Отзывы</a></li>
                <li><a href="#">Блог</a></li>
                <li><a href="{{ url("/cms/About Us") }}">О нас</a></li>
                <li><a href="#" class="active-link">Контакты</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h4 class="footer-title">ПОДДЕРЖКА</h4>
            <ul class="footer-links">
                <li><a href="{{ url("/cms/Adoption") }}">Усыновление</a></li>
                <li><a href="{{ url("/cms/FAQ") }}" class="active-link">Вопросы</a></li>
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
@if(Auth::check())
<style>
    .admin-toolbar { position: fixed; top: 0; left: 0; right: 0; background: #2d3748; color: white; padding: 8px 20px; display: flex; justify-content: space-between; align-items: center; z-index: 9999; font-size: 14px; font-family: sans-serif; }
    .admin-toolbar a { color: #a0aec0; text-decoration: none; margin-left: 15px; }
    .admin-toolbar a:hover { color: white; }
    .admin-toolbar .btn-save { background: #48bb78; color: white; padding: 4px 12px; border-radius: 4px; cursor: pointer; border: none; }
    [contenteditable="true"]:focus { outline: 2px dashed #EFA39A; background-color: rgba(255, 255, 255, 0.5); }
    body { padding-top: 40px !important; }
</style>
<div class="admin-toolbar">
    <div><strong>Admin Mode</strong> <a href="/admin">Go to Dashboard</a></div>
    <div><button id="save-changes" class="btn-save" style="display:none;">Save Changes</button> <span id="saving-status" style="display:none; margin-right:10px;">Saving...</span></div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const editables = document.querySelectorAll("h1, h2, h3, p, span, blockquote");
        editables.forEach(el => {
            if (el.innerText.trim().length > 0 && !el.children.length) {
                el.contentEditable = true;
                el.addEventListener("input", () => document.getElementById("save-changes").style.display = "block");
            }
        });

        document.getElementById("save-changes").addEventListener("click", async () => {
            const btn = document.getElementById("save-changes");
            const status = document.getElementById("saving-status");
            btn.style.display = "none";
            status.style.display = "inline";
            
            // This is a simplified version, in a real app you would save specific keys
            // For now we just show it works
            status.innerText = "Saved (Simulation)!";
            setTimeout(() => { status.style.display = "none"; status.innerText = "Saving..."; }, 2000);
        });
    });
</script>
@endif
</body>
</html>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
 <link rel="stylesheet" href="{{ asset("static/cms/style.css") }}">
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
            <a href="{{ url("/cms/Adoption") }}" class="nav-link active">Усыновление</a>
            <a href="{{ url("/cms/FAQ") }}" class="nav-link">Вопросы</a>
            <a href="{{ url("/cms/About Us") }}" class="nav-link">О нас</a>
        </nav>

        <div class="header-action">
            <a href="#" class="btn-header-contact">СВЯЗАТЬСЯ</a>
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
        <a href="{{ url("/cms/Adoption") }}" class="nav-link active">Усыновление</a>
        <a href="{{ url("/cms/FAQ") }}" class="nav-link">Вопросы</a>
        <a href="{{ url("/cms/About Us") }}" class="nav-link">О нас</a>
        <a href="#" class="mobile-contact-btn">СВЯЗАТЬСЯ</a>
    </nav>
</div>

<section class="adoption-header">
    <div class="container">
        <div class="guide-subtitle">
            <span class="line"></span>
            <span class="subtitle-text">ПОЛНОЕ РУКОВОДСТВО</span>
            <span class="line"></span>
        </div>
        <h2 class="adoption-title">Путь к усыновлению</h2>
        <p class="adoption-desc">
            От первого взгляда до первого мурлыканья в вашем доме — <br>
            прозрачный пошаговый процесс.
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
                <img src="https://scottishkittensnyc.com/wp-content/uploads/2026/01/photo1.jpg" alt="Кот">
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
        <a href="#" class="cta-main-button">ПОСМОТРЕТЬ ДОСТУПНЫХ КОТЯТ</a>
        <a href="#" class="cta-secondary-link">Свяжитесь для личной консультации</a>
    </section>

</main>

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
                <li><a href="#">Наши котята</a></li>
                <li><a href="#">Отзывы</a></li>
                <li><a href="#">Блог</a></li>
                <li><a href="#">О нас</a></li>
                <li><a href="#" class="active-link">Контакты</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h4 class="footer-title">ПОДДЕРЖКА</h4>
            <ul class="footer-links">
                <li><a href="#">Усыновление</a></li>
                <li><a href="#">Вопросы</a></li>
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
@if(Auth::check())
<style>
    .admin-toolbar { position: fixed; top: 0; left: 0; right: 0; background: #2d3748; color: white; padding: 8px 20px; display: flex; justify-content: space-between; align-items: center; z-index: 9999; font-size: 14px; font-family: sans-serif; }
    .admin-toolbar a { color: #a0aec0; text-decoration: none; margin-left: 15px; }
    .admin-toolbar a:hover { color: white; }
    .admin-toolbar .btn-save { background: #48bb78; color: white; padding: 4px 12px; border-radius: 4px; cursor: pointer; border: none; }
    [contenteditable="true"]:focus { outline: 2px dashed #EFA39A; background-color: rgba(255, 255, 255, 0.5); }
    body { padding-top: 40px !important; }
</style>
<div class="admin-toolbar">
    <div><strong>Admin Mode</strong> <a href="/admin">Go to Dashboard</a></div>
    <div><button id="save-changes" class="btn-save" style="display:none;">Save Changes</button> <span id="saving-status" style="display:none; margin-right:10px;">Saving...</span></div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const editables = document.querySelectorAll("h1, h2, h3, p, span, blockquote");
        editables.forEach(el => {
            if (el.innerText.trim().length > 0 && !el.children.length) {
                el.contentEditable = true;
                el.addEventListener("input", () => document.getElementById("save-changes").style.display = "block");
            }
        });

        document.getElementById("save-changes").addEventListener("click", async () => {
            const btn = document.getElementById("save-changes");
            const status = document.getElementById("saving-status");
            btn.style.display = "none";
            status.style.display = "inline";
            
            // This is a simplified version, in a real app you would save specific keys
            // For now we just show it works
            status.innerText = "Saved (Simulation)!";
            setTimeout(() => { status.style.display = "none"; status.innerText = "Saving..."; }, 2000);
        });
    });
</script>
@endif
</body>
</html>


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
</head>
<body>

<header class="cd-site-header">
    <div class="header-inner">
        <div class="header-logo-block">
            <div class="logo-icon">
                <svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
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
            <a href="{{ url("/cms/About Us") }}" class="nav-link active">О нас</a>
        </nav>

        <div class="header-action">
            <a href="#" class="btn-header-contact">СВЯЗАТЬСЯ</a>
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
        <a href="{{ url("/cms/About Us") }}" class="nav-link active">О нас</a>
        <a href="#" class="mobile-contact-btn">СВЯЗАТЬСЯ</a>
    </nav>
</div>

<section class="cinnamon-section">
    <div class="cinnamon-container">
        <div class="cinnamon-label">
            <span class="leaf-icon">🌿</span>
            <span class="label-text">ДОВЕРИЕ И ЦЕННОСТИ</span>
        </div>
        <h1 class="cinnamon-title">Cinnamon Desire</h1>
        <p class="cinnamon-description">Узнайте историю нашего питомника, нашу миссию и то, как мы создаем идеальные условия для каждого пушистого сердца.</p>
    </div>
</section>

<section class="about-section">
    <div class="about-container">
        <div class="about-image-wrapper">
            <img src="https://scottishkittensnyc.com/wp-content/uploads/2026/01/k22.jpg" alt="Опытный заводчик с котом" class="about-photo">
        </div>
        <div class="about-content">
            <div class="about-badge">ОПЫТ ЗАВОДЧИКА</div>
            <h2 class="about-title">Более 10 лет профессионального пути</h2>
            <div class="about-text">
                <p>Все началось с любви к одной кошке, которая переросла в дело всей жизни. За десятилетие мы прошли путь от хобби до лицензированного питомника <strong>WCF</strong>.</p>
                <p>Наш основатель — сертифицированный фелинолог, который лично контролирует каждую линию разведения.</p>
            </div>
        </div>
    </div>
</section>

<section class="philosophy-section">
    <div class="philosophy-header">
        <h2 class="philosophy-main-title">Наша философия</h2>
        <p class="philosophy-subtitle">Мы не просто ищем дом для животных. Мы создаем новых членов семьи и верим, что шотландская кошка — это воплощение уюта.</p>
    </div>
    <div class="philosophy-grid">
        <div class="philosophy-card">
            <div class="card-icon">✨</div>
            <h3 class="card-title">Гармония</h3>
            <p class="card-description">Поддержание идеального баланса между стандартами шоу-класса и крепким здоровьем.</p>
        </div>
        <div class="philosophy-card">
            <div class="card-icon">🌿</div>
            <h3 class="card-title">Уважение</h3>
            <p class="card-description">Мы ценим природные потребности каждой кошки как уникальной личности.</p>
        </div>
        <div class="philosophy-card">
            <div class="card-icon">🤝</div>
            <h3 class="card-title">Честность</h3>
            <p class="card-description">Прозрачность во всем: от подробных родословных до условий содержания.</p>
        </div>
        <div class="philosophy-card">
            <div class="card-icon">🛡️</div>
            <h3 class="card-title">Ответственность</h3>
            <p class="card-description">Мы обеспечиваем пожизненную поддержку и консультации для каждого выпускника нашего питомника.</p>
        </div>
        <div class="philosophy-card">
            <div class="card-icon">📚</div>
            <h3 class="card-title">Обучение</h3>
            <p class="card-description">Мы обучаем владельцев особенностям здоровья и поведения шотландской породы.</p>
        </div>
    </div>
</section>

<section class="quality-section">
    <div class="quality-container">
        <div class="quality-content">
            <span class="quality-overline">ПОДХОД К РАЗВЕДЕНИЮ</span>
            <h2 class="quality-title">Качество превыше количества</h2>
            <div class="quality-text">
                <p>Наша приверженность качеству означает, что мы тщательно планируем каждую вязку... Мы никогда не ставим количество пометов выше благополучия.</p>
                <p>Каждое племенное животное проходит скрининг на <strong>PKD</strong> и <strong>HCM</strong>.</p>
                <p>Мы обеспечиваем кошкам отдых от <strong>12 до 18 месяцев</strong> для полного восстановления сил.</p>
            </div>
        </div>
        <div class="quality-image-wrapper">
            <img src="https://scottishkittensnyc.com/wp-content/uploads/2026/01/239e.png" alt="Качественное разведение кошек" class="quality-photo">
        </div>
    </div>
</section>

<section class="socialization-section">
    <div class="socialization-container">
        <div class="socialization-image-wrapper">
            <img src="https://scottishkittensnyc.com/wp-content/uploads/2026/01/k44.jpg" alt="Социализация котят" class="socialization-photo">
        </div>
        <div class="socialization-content">
            <span class="socialization-overline">УХОД ЗА КОТЯТАМИ</span>
            <h2 class="socialization-title">Ранняя социализация</h2>
            <div class="socialization-text">
                <p>Социализация — фундамент нашего воспитания. Наши котята растут в самом центре нашего дома... к <strong>4 месяцам</strong> каждый выпускник стал идеально сбалансированным компаньоном.</p>
            </div>
        </div>
    </div>
</section>

<section class="quote-section">
    <div class="quote-container">
        <div class="quote-icon">"</div>
        <blockquote class="quote-text">
            "Мы верим, что наша работа делает мир чуточку добрее, соединяя любящие сердца с их идеальными пушистыми спутниками."
        </blockquote>
        <div class="quote-divider"></div>
    </div>
</section>

<footer class="cd-footer">
    <div class="footer-inner">
        <div class="footer-col" style="flex: 2; max-width: 400px;">
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
                <li><a href="#">Отзывы</a></li>
                <li><a href="#">Блог</a></li>
                <li><a href="{{ url("/cms/About Us") }}" class="active-link">О нас</a></li>
                <li><a href="#">Контакты</a></li>
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
@if(Auth::check())
<style>
    .admin-toolbar { position: fixed; top: 0; left: 0; right: 0; background: #2d3748; color: white; padding: 8px 20px; display: flex; justify-content: space-between; align-items: center; z-index: 9999; font-size: 14px; font-family: sans-serif; }
    .admin-toolbar a { color: #a0aec0; text-decoration: none; margin-left: 15px; }
    .admin-toolbar a:hover { color: white; }
    .admin-toolbar .btn-save { background: #48bb78; color: white; padding: 4px 12px; border-radius: 4px; cursor: pointer; border: none; }
    [contenteditable="true"]:focus { outline: 2px dashed #EFA39A; background-color: rgba(255, 255, 255, 0.5); }
    body { padding-top: 40px !important; }
</style>
<div class="admin-toolbar">
    <div><strong>Admin Mode</strong> <a href="/admin">Go to Dashboard</a></div>
    <div><button id="save-changes" class="btn-save" style="display:none;">Save Changes</button> <span id="saving-status" style="display:none; margin-right:10px;">Saving...</span></div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const editables = document.querySelectorAll("h1, h2, h3, p, span, blockquote");
        editables.forEach(el => {
            if (el.innerText.trim().length > 0 && !el.children.length) {
                el.contentEditable = true;
                el.addEventListener("input", () => document.getElementById("save-changes").style.display = "block");
            }
        });

        document.getElementById("save-changes").addEventListener("click", async () => {
            const btn = document.getElementById("save-changes");
            const status = document.getElementById("saving-status");
            btn.style.display = "none";
            status.style.display = "inline";
            
            // This is a simplified version, in a real app you would save specific keys
            // For now we just show it works
            status.innerText = "Saved (Simulation)!";
            setTimeout(() => { status.style.display = "none"; status.innerText = "Saving..."; }, 2000);
        });
    });
</script>
@endif
</body>
</html>


/* ОБЪЕДИНЕННЫЙ CSS ФАЙЛ ДЛЯ ВСЕХ СТРАНИЦ */
/* ========================================= */

/* ПЕРЕМЕННЫЕ И ОСНОВНЫЕ СТИЛИ */
:root {
    --bg-color: #fceee9;
    --bg-page: #fcf6f2;
    --bg-light: #fdf6f3;
    --bg-accent: #f4ebe6;
    --white: #ffffff;
    --main-brown: #63504d;
    --brand-primary: #F19072;
    --brand-dark: #5B4A43;
    --accent-peach: #F19072;
    --light-peach: #e5b6ab;
    --cta-bg: #716059;
    --cta-button: #f1a99b;
    --text-dark: #52433D;
    --text-main: #5B4A43;
    --text-light: #92837D;
    --text-muted: #8a7a77;
    --line-color: #eee4e0;
    --accent-pink: #fce8e6;
    --check-color: #e5989b;
    --faq-brown: #a68c85;
    --male-color: #73a6f0;
    --female-color: #f0a3b3;
}

* {
    box-sizing: border-box;
    -webkit-font-smoothing: antialiased;
}

body {
    background-color: var(--bg-color);
    margin: 0;
    padding: 0;
    font-family: 'Montserrat', sans-serif;
    color: var(--text-main);
    overflow-x: hidden;
    -webkit-tap-highlight-color: transparent;
}

.container {
    max-width: 1282px;
    margin: 0 auto;
    padding: 0 20px;
}

/* ПЛАВНАЯ ПРОКРУТКА */
html {
    scroll-behavior: smooth;
}

/* ОПТИМИЗАЦИЯ АНИМАЦИЙ */
@media (prefers-reduced-motion: reduce) {
    *,
    *::before,
    *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}

/* ШАПКА (HEADER) - ОБЩИЕ СТИЛИ */
.cd-site-header {
    background: #ffffff;
    padding: 15px 20px;
    border-bottom: 1px solid #f3f0ee;
    position: sticky;
    top: 0;
    z-index: 1000;
    width: 100%;
    transition: transform 0.3s ease;
}

.header-hide {
    transform: translateY(-100%);
}

.header-inner {
    max-width: 1400px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: relative;
}

.header-logo-block {
    display: flex;
    align-items: center;
    gap: 12px;
}

.logo-main {
    font-size: 20px;
    font-weight: 800;
    color: #52433D;
    line-height: 1;
}

.logo-main span {
    color: #F19072;
}

.logo-sub {
    font-size: 9px;
    font-weight: 700;
    letter-spacing: 2px;
    color: #92837D;
    margin-top: 4px;
    text-transform: uppercase;
}

.header-nav {
    display: flex;
    gap: 25px;
}

.nav-link {
    text-decoration: none;
    color: #52433D;
    font-size: 14px;
    font-weight: 700;
    transition: 0.3s;
}

.nav-link:hover {
    color: #F19072;
}

.nav-link.active {
    color: #F19072;
    position: relative;
}

.nav-link.active::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 0;
    width: 100%;
    height: 2px;
    background: #F19072;
}

.btn-header-contact {
    background: #F19072;
    color: #ffffff !important;
    padding: 12px 25px;
    border-radius: 12px;
    font-size: 13px;
    font-weight: 800;
    text-decoration: none !important;
    text-transform: uppercase;
    letter-spacing: 1px;
    box-shadow: 0 4px 15px rgba(241, 144, 114, 0.2);
    transition: 0.3s;
}

.btn-header-contact:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(241, 144, 114, 0.3);
}

/* МОБИЛЬНОЕ МЕНЮ */
.mobile-menu-toggle {
    display: none;
    background: none;
    border: none;
    cursor: pointer;
    padding: 5px;
    z-index: 1001;
    margin-right: 0;
    touch-action: manipulation;
}

.hamburger {
    display: block;
    position: relative;
    width: 28px;
    height: 20px;
}

.hamburger span {
    position: absolute;
    left: 0;
    width: 100%;
    height: 3px;
    background-color: #52433D;
    border-radius: 3px;
    transition: all 0.3s ease;
}

.hamburger span:nth-child(1) {
    top: 0;
}

.hamburger span:nth-child(2) {
    top: 8px;
}

.hamburger span:nth-child(3) {
    top: 16px;
}

.mobile-menu-toggle.active .hamburger span:nth-child(1) {
    transform: rotate(45deg);
    top: 8px;
}

.mobile-menu-toggle.active .hamburger span:nth-child(2) {
    opacity: 0;
}

.mobile-menu-toggle.active .hamburger span:nth-child(3) {
    transform: rotate(-45deg);
    top: 8px;
}

.mobile-menu {
    position: fixed;
    top: 0;
    left: -100%;
    width: 85%;
    max-width: 320px;
    height: 100%;
    background-color: #ffffff;
    z-index: 9999;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: flex-start;
    transition: left 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    box-shadow: 5px 0 30px rgba(0, 0, 0, 0.1);
    overflow-y: auto;
    -webkit-overflow-scrolling: touch;
}

.mobile-menu.active {
    left: 0;
}

.mobile-menu-header {
    position: relative;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    background: #ffffff;
    border-bottom: 1px solid #f3f0ee;
    width: 100%;
}

.mobile-menu-logo {
    font-size: 20px;
    font-weight: 800;
    color: #52433D;
}

.mobile-menu-logo span {
    color: #F19072;
}

.mobile-menu-close {
    background: none;
    border: none;
    cursor: pointer;
    font-size: 28px;
    color: #52433D;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: background-color 0.3s;
    padding: 0;
    touch-action: manipulation;
}

.mobile-menu-close:hover {
    background-color: #f3f0ee;
}

.mobile-nav {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 0;
    width: 100%;
    padding: 20px;
}

.mobile-nav .nav-link {
    font-size: 18px;
    color: #52433D;
    text-align: left;
    width: 100%;
    padding: 18px 0;
    border-bottom: 1px solid #f3f0ee;
    font-weight: 700;
    transition: color 0.3s, padding-left 0.3s;
    touch-action: manipulation;
}

.mobile-nav .nav-link:hover {
    color: #F19072;
    padding-left: 10px;
}

.mobile-nav .nav-link:active {
    background-color: rgba(241, 144, 114, 0.1);
}

.mobile-contact-btn {
    margin: 20px;
    background: #F19072;
    color: #ffffff !important;
    padding: 16px 35px;
    border-radius: 12px;
    font-size: 14px;
    font-weight: 800;
    text-decoration: none !important;
    text-transform: uppercase;
    letter-spacing: 1px;
    width: calc(100% - 40px);
    text-align: center;
    transition: transform 0.3s, box-shadow 0.3s;
    touch-action: manipulation;
}

.mobile-contact-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(241, 144, 114, 0.3);
}

.mobile-contact-btn:active {
    transform: translateY(-1px);
}

.menu-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(61, 49, 43, 0.7);
    z-index: 9998;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s, visibility 0.3s;
}

.menu-overlay.active {
    opacity: 1;
    visibility: visible;
}

/* СТИЛИ СЛАЙДЕРА (ГЛАВНАЯ СТРАНИЦА) */
.mycat-slider-wrapper {
    position: relative;
    max-width: 1460px;
    margin: 0 auto;
    padding: 40px 20px;
    background-color: #fceee9;
    display: flex;
    align-items: center;
    overflow: hidden;
}

.mycat-viewport {
    overflow: hidden;
    width: 100%;
}

.mycat-section {
    display: flex;
    flex-wrap: nowrap;
    gap: 28px;
    transition: transform 0.5s ease-in-out;
    padding: 10px 0;
    will-change: transform;
}

.mycat-card-container {
    flex: 0 0 298px;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.mycat-photo-box {
    position: relative;
    width: 298px;
    height: 373px;
    border-radius: 60px;
    overflow: hidden;
    transition: border-radius 0.4s ease;
    line-height: 0;
}

.mycat-photo-box:hover {
    border-radius: 0px;
}

.mycat-photo-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.mycat-photo-box:hover img {
    transform: scale(1.05);
}

/* СТРЕЛКИ СЛАЙДЕРА */
.slider-arrow {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 44px;
    height: 44px;
    background-color: #6d5a52;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 10;
    border: none;
    font-size: 20px;
    transition: background 0.3s, transform 0.2s;
    touch-action: manipulation;
}

.slider-arrow:hover {
    background-color: rgb(239 163 154);
}

.slider-arrow:active {
    transform: translateY(-50%) scale(0.95);
}

.arrow-left {
    left: 10px;
}

.arrow-right {
    right: 10px;
}

/* ИКОНКИ И КНОПКИ КОТЯТ */
.mycat-sex-icon,
.mycat-sex-icon-female {
    position: absolute;
    bottom: 20px;
    left: 20px;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    border: 2px solid white;
    font-size: 20px;
    z-index: 2;
    user-select: none;
}

.mycat-sex-icon {
    background: var(--male-color);
}

.mycat-sex-icon-female {
    background: var(--female-color);
}

.mycat-fav-icon {
    position: absolute;
    top: 20px;
    right: 20px;
    background: rgba(255, 255, 255, 0.4);
    backdrop-filter: blur(5px);
    width: 44px;
    height: 44px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 3;
    cursor: pointer;
    transition: 0.3s;
    touch-action: manipulation;
}

.mycat-fav-icon svg {
    stroke: #4a3f3a;
    fill: none;
    transition: 0.3s;
}

.mycat-fav-icon.active {
    background-color: rgb(239 163 154) !important;
}

.mycat-fav-icon.active svg {
    stroke: white !important;
    fill: white !important;
}

.mycat-btn-about {
    margin-top: 20px;
    width: 128px;
    height: 44px;
    background-color: #6d5a52;
    color: white !important;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none !important;
    font-size: 14px;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: 0.3s;
    touch-action: manipulation;
}

.mycat-btn-about:hover {
    background-color: rgb(239 163 154) !important;
}

.mycat-btn-about:active {
    transform: scale(0.98);
}

/* ЗАГОЛОВКИ ПОМЕТОВ */
.custom-lt-container {
    display: flex;
    align-items: center;
    padding: 15px 20px;
    background-color: #fceee9;
    max-width: 1460px;
    margin: 0 auto;
    flex-wrap: wrap;
}

.custom-lt-title {
    font-size: 24px;
    font-weight: bold;
    color: #6b5a54;
    margin-right: 15px;
}

.custom-lt-date {
    font-size: 16px;
    color: #8c7a73;
    padding-left: 15px;
    border-left: 1px solid #dcc9c2;
}

.custom-lt-line {
    width: 40px;
    height: 1px;
    background-color: #dcc9c2;
    margin: 0 15px;
}

.custom-lt-status {
    font-size: 12px;
    color: #8c7a73;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-top: 5px;
    width: 100%;
}

/* ЦИТАТА */
.custom-quote-section {
    background-color: #fceee9;
    text-align: center;
    padding: 40px 15px;
}

.custom-quote-text {
    font-size: 28px;
    color: #716059;
    font-style: italic;
    font-weight: 700;
    margin-bottom: 20px;
    line-height: 1.3;
}

.custom-quote-subtext {
    font-size: 14px;
    color: #92837d;
    max-width: 600px;
    margin: 0 auto;
    padding: 0 15px;
}

/* БЛОК ПРЕДЛОЖЕНИЯ (OFFER) */
.main-offer-wrapper {
    background-color: #8b7369;
    padding: 40px 20px;
    border-radius: 40px;
    overflow: hidden;
    max-width: 1312px;
    margin: 30px auto !important;
}

.offer-header-block {
    color: #fff;
    margin-bottom: 30px;
    text-align: center;
}

.offer-subtitle {
    font-size: 11px;
    letter-spacing: 2px;
    font-weight: 700;
    opacity: 0.8;
    margin-bottom: 10px;
}

.offer-title {
    font-size: 32px !important;
    font-weight: 700 !important;
    color: #fff !important;
    margin: 0;
}

.offer-description {
    opacity: 0.8;
    margin-top: 10px;
    font-size: 14px;
}

.kittens-flex-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 30px;
    width: 100%;
}

.cat-offer-card {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
    max-width: 300px;
}

.coc-media {
    position: relative;
    width: 100%;
    height: 350px;
    border: 1px solid #ffffff;
    border-radius: 30px;
    overflow: hidden;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.coc-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.coc-badge {
    position: absolute;
    top: 15px;
    left: 15px;
    background: rgba(255, 255, 255, 0.3);
    backdrop-filter: blur(5px);
    padding: 5px 12px;
    border-radius: 20px;
    color: #fff;
    font-size: 10px;
    font-weight: 700;
}

.coc-fav {
    position: absolute;
    top: 15px;
    right: 15px;
    color: #fff;
    font-size: 20px;
    cursor: pointer;
}

.coc-gender {
    position: absolute;
    bottom: 15px;
    left: 15px;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
}

.coc-gender.male {
    background: var(--male-color);
}

.coc-gender.female {
    background: var(--female-color);
}

.coc-btn-about {
    margin-top: 18px;
    z-index: 2;
    background: #716059;
    color: #fff !important;
    padding: 10px 25px;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 700;
    text-decoration: none !important;
    text-transform: uppercase;
    touch-action: manipulation;
}

.coc-price-box {
    background: #fff;
    width: 100%;
    max-width: 220px;
    text-align: center;
    padding: 8px 10px;
    border-radius: 18px;
    margin-top: 15px;
}

.coc-price-row {
    display: flex;
    justify-content: center;
    align-items: baseline;
    gap: 8px;
}

.coc-old-price {
    text-decoration: line-through;
    color: #b5aaa4;
    font-size: 11px;
}

.coc-new-price {
    font-size: 18px;
    font-weight: 800;
    color: #4a403c;
}

.coc-save-label {
    color: #f19072;
    font-size: 9px;
    font-weight: 700;
    margin-top: 2px;
}

/* БЛОК РОДИТЕЛЕЙ */
.litter-parent-section {
    background-color: #F9EAE3;
    padding: 40px 20px;
    border-radius: 40px;
    max-width: 1312px;
    margin: 30px auto !important;
}

.litter-flex-row {
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
    justify-content: center;
}

.parent-card {
    background: #ffffff;
    border-radius: 30px;
    padding: 20px;
    width: 100%;
    max-width: 350px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.02);
}

.parent-media {
    width: 100%;
    height: 280px;
    border-radius: 25px;
    overflow: hidden;
    margin-bottom: 20px;
}

.parent-media img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.parent-label {
    color: #F19072;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 1px;
}

.parent-name {
    color: #52433D;
    font-size: 20px !important;
    font-weight: 800 !important;
    margin: 5px 0 15px 0 !important;
}

.parent-tags {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.p-tag {
    background: #F3F0EE;
    color: #92837D;
    font-size: 9px;
    font-weight: 700;
    padding: 5px 12px;
    border-radius: 10px;
    text-transform: uppercase;
}

.expectation-card {
    width: 100%;
    max-width: 350px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
}

.date-highlight-box {
    background: #6E5A53;
    padding: 25px 20px;
    border-radius: 30px;
    width: 100%;
    margin-bottom: 25px;
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
}

.date-label {
    color: #F19072;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 2px;
    display: block;
    margin-bottom: 10px;
}

.date-value {
    color: #ffffff;
    font-size: 24px;
    font-weight: 800;
}

.expectation-text {
    color: #92837D;
    font-size: 14px;
    line-height: 1.5;
    font-style: italic;
    margin-bottom: 25px;
    padding: 0 10px;
}

.early-access-btn {
    background: #F19072;
    color: #ffffff !important;
    padding: 15px 30px;
    border-radius: 15px;
    font-size: 11px;
    font-weight: 800;
    text-decoration: none !important;
    letter-spacing: 1px;
    text-transform: uppercase;
    box-shadow: 0 8px 20px rgba(241, 144, 114, 0.3);
    transition: 0.3s ease;
    touch-action: manipulation;
}

.early-access-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 25px rgba(241, 144, 114, 0.4);
}

.early-access-btn:active {
    transform: translateY(-1px);
}

/* ПОДВАЛ (FOOTER) - ОБЩИЕ СТИЛИ */
.cd-footer {
    background-color: #3D312B;
    color: #ffffff;
    padding: 50px 20px 30px 20px;
    width: 100%;
}

.footer-inner {
    max-width: 1400px;
    margin: 0 auto;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    gap: 40px;
}

.footer-col {
    flex: 1;
    min-width: 200px;
}

.col-main {
    flex: 2;
    max-width: 400px;
}

.footer-logo {
    font-size: 32px;
    font-weight: 800;
    letter-spacing: 1px;
    margin-bottom: 5px;
}

.footer-logo span {
    color: #F19072;
}

.footer-tagline {
    font-size: 11px;
    letter-spacing: 3px;
    font-weight: 600;
    color: #92837D;
    margin-bottom: 30px;
}

.footer-about {
    font-size: 14px;
    line-height: 1.6;
    color: #92837D;
    margin-bottom: 30px;
}

.footer-socials {
    display: flex;
    gap: 10px;
}

.social-btn {
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffffff;
    text-decoration: none;
    font-size: 12px;
    font-weight: 700;
    transition: 0.3s;
}

.social-btn:hover {
    background: #F19072;
    border-color: #F19072;
}

.footer-title {
    font-size: 12px;
    letter-spacing: 3px;
    color: #F19072;
    font-weight: 700;
    margin-bottom: 25px;
    text-transform: uppercase;
}

.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    margin-bottom: 15px;
}

.footer-links a {
    text-decoration: none;
    color: #ffffff;
    font-size: 15px;
    font-weight: 600;
    opacity: 0.8;
    transition: 0.3s;
}

.footer-links a:hover {
    opacity: 1;
    color: #F19072;
}

.active-link {
    color: #F19072 !important;
    opacity: 1 !important;
}

.footer-bottom {
    max-width: 1400px;
    margin: 60px auto 0 auto;
    padding-top: 30px;
    border-top: 1px solid rgba(255, 255, 255, 0.05);
    text-align: left;
}

.copyright-text {
    font-size: 10px;
    letter-spacing: 3px;
    font-weight: 700;
    color: #92837D;
    text-transform: uppercase;
}

/* ========================================= */
/* СТИЛИ ДЛЯ СТРАНИЦЫ ABOUT US */
/* ========================================= */

/* БЛОК 1: ТИТУЛЬНЫЙ */
.cinnamon-section {
    padding: 100px 40px;
    text-align: center;
    max-width: 1400px;
    margin: 0 auto;
}

.cinnamon-label {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 15px;
    margin-bottom: 20px;
}

.cinnamon-label::before,
.cinnamon-label::after {
    content: "";
    height: 1px;
    width: 40px;
    background-color: var(--light-peach);
}

.label-text {
    font-size: 14px;
    letter-spacing: 4px;
    color: var(--light-peach);
    text-transform: uppercase;
}

.cinnamon-title {
    font-size: 84px;
    font-weight: 700;
    margin: 0 0 30px 0;
    letter-spacing: -2px;
    line-height: 1.1;
}

.cinnamon-description {
    font-size: 18px;
    line-height: 1.6;
    max-width: 700px;
    margin: 0 auto;
    color: var(--text-muted);
}

/* БЛОК 2: ОПЫТ */
.about-section {
    padding: 80px 40px;
    max-width: 1400px;
    margin: 0 auto;
}

.about-container {
    display: flex;
    align-items: center;
    gap: 80px;
}

.about-image-wrapper {
    flex: 0 0 500px;
}

.about-photo {
    width: 100%;
    border-radius: 40px;
    border: 10px solid #ffffff;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
}

.about-badge {
    display: inline-block;
    padding: 8px 20px;
    border: 1px solid var(--light-peach);
    border-radius: 50px;
    color: var(--light-peach);
    font-size: 11px;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 25px;
}

.about-title {
    font-size: 42px;
    font-weight: 700;
    margin-bottom: 25px;
    line-height: 1.2;
}

.about-text {
    color: var(--text-muted);
    font-size: 18px;
    line-height: 1.6;
}

/* БЛОК 3: ФИЛОСОФИЯ */
.philosophy-section {
    padding: 80px 40px;
    text-align: center;
    max-width: 1400px;
    margin: 0 auto;
}

.philosophy-main-title {
    font-size: 48px;
    font-weight: 700;
    margin-bottom: 20px;
}

.philosophy-subtitle {
    font-size: 18px;
    color: var(--text-muted);
    font-style: italic;
    max-width: 800px;
    margin: 0 auto 60px;
}

.philosophy-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 20px;
}

.philosophy-card {
    background-color: #f9f0ed;
    padding: 40px 25px;
    border-radius: 40px;
    text-align: left;
    transition: 0.3s ease;
    cursor: pointer;
}

.philosophy-card:hover {
    background-color: #ffffff;
    transform: translateY(-8px);
    box-shadow: 0 15px 30px rgba(99, 80, 77, 0.1);
}

.card-icon {
    font-size: 32px;
    margin-bottom: 25px;
}

.card-title {
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 15px;
}

.card-description {
    font-size: 14px;
    line-height: 1.6;
    color: var(--text-muted);
}

/* БЛОК 4: КАЧЕСТВО */
.quality-section {
    padding: 80px 40px;
    max-width: 1400px;
    margin: 0 auto;
}

.quality-container {
    display: flex;
    align-items: center;
    gap: 80px;
}

.quality-overline {
    font-size: 12px;
    letter-spacing: 3px;
    color: var(--light-peach);
    text-transform: uppercase;
    display: block;
    margin-bottom: 20px;
}

.quality-title {
    font-size: 42px;
    font-weight: 700;
    margin-bottom: 30px;
    line-height: 1.2;
}

.quality-text {
    font-size: 16px;
    line-height: 1.7;
    color: var(--text-muted);
}

.quality-photo {
    width: 100%;
    max-width: 600px;
    border-radius: 60px;
    border: 12px solid #ffffff;
    box-shadow: 0 25px 50px rgba(99, 80, 77, 0.15);
}

/* БЛОК 5: СОЦИАЛИЗАЦИЯ */
.socialization-section {
    padding: 80px 40px;
    max-width: 1400px;
    margin: 0 auto;
}

.socialization-container {
    display: flex;
    align-items: center;
    gap: 80px;
}

.socialization-photo {
    width: 100%;
    border-radius: 50px;
    border: 10px solid #ffffff;
    box-shadow: 0 20px 40px rgba(99, 80, 77, 0.12);
}

.socialization-title {
    font-size: 40px;
    font-weight: 700;
    margin-bottom: 25px;
}

/* БЛОК 6: ЦИТАТА */
.quote-section {
    padding: 100px 40px;
    text-align: center;
    max-width: 1400px;
    margin: 0 auto;
}

.quote-icon {
    font-size: 60px;
    color: var(--light-peach);
    font-family: serif;
    margin-bottom: 20px;
    opacity: 0.6;
}

.quote-text {
    font-size: 32px;
    font-weight: 700;
    font-style: italic;
    max-width: 800px;
    margin: 0 auto 40px;
    line-height: 1.4;
}

.quote-divider {
    width: 60px;
    height: 2px;
    background-color: var(--light-peach);
    margin: 0 auto;
}

/* ========================================= */
/* СТИЛИ ДЛЯ СТРАНИЦЫ ADOPTION */
/* ========================================= */

/* ЗАГОЛОВОК ADOPTION */
.adoption-header {
    text-align: center;
    padding: 100px 0 60px;
    background-color: var(--bg-page);
    width: 100%;
}

.guide-subtitle {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 20px;
    margin-bottom: 25px;
}

.guide-subtitle .line {
    display: block;
    width: 60px;
    height: 1px;
    background-color: #e5989b;
    opacity: 0.6;
}

.guide-subtitle .subtitle-text {
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 0.3em;
    color: #e5989b;
    text-transform: uppercase;
}

.adoption-title {
    font-size: 64px;
    font-weight: 800;
    color: var(--brand-dark);
    margin: 0 0 25px 0;
    line-height: 1.1;
}

.adoption-desc {
    font-size: 18px;
    color: var(--text-light);
    max-width: 700px;
    margin: 0 auto;
    line-height: 1.6;
}

/* КОМПОНЕНТ ЗАГОЛОВКА СЕКЦИИ */
.section-header {
    display: flex;
    align-items: center;
    margin: 80px 0 50px 0;
    width: 100%;
}

.section-header .number {
    font-size: 42px;
    font-weight: 700;
    color: #f3dfdc;
    margin-right: 20px;
    flex-shrink: 0;
}

.section-header .title {
    font-size: 32px;
    font-weight: 700;
    margin: 0;
    white-space: nowrap;
    flex-shrink: 0;
}

.section-header .divider {
    flex-grow: 1;
    height: 1px;
    background-color: var(--line-color);
    margin: 0 30px;
    min-width: 50px;
}

.section-header .badge {
    padding: 12px 28px;
    background: var(--white);
    border-radius: 50px;
    border: 1px solid #f0e6e2;
    color: var(--text-light);
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    flex-shrink: 0;
}

/* СЕКЦИЯ 01: ФИЛОСОФИЯ */
.philosophy-content {
    display: flex;
    gap: 60px;
    align-items: flex-start;
    margin-bottom: 100px;
    width: 100%;
}

.philosophy-text-grid {
    flex: 1.4;
    min-width: 0;
}

.intro-text {
    font-style: italic;
    font-size: 18px;
    color: var(--text-main);
    margin: 0 0 45px 0;
    line-height: 1.5;
}

.features-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 25px;
}

.feature-card {
    background: var(--white);
    padding: 35px;
    border-radius: 30px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.02);
}

.icon-check {
    width: 32px;
    height: 32px;
    background: var(--accent-pink);
    color: var(--check-color);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 25px;
    font-weight: bold;
}

.feature-card h3 {
    font-size: 13px;
    font-weight: 800;
    letter-spacing: 0.05em;
    margin: 0 0 12px 0;
    text-transform: uppercase;
}

.feature-card p {
    font-size: 14px;
    color: var(--text-light);
    margin: 0;
}

.image-container {
    flex: 1;
    min-width: 0;
}

.white-frame {
    background: var(--white);
    padding: 15px;
    border-radius: 50px;
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.04);
}

.white-frame img {
    width: 100%;
    display: block;
    border-radius: 40px;
}

/* СЕКЦИЯ 02: АРХИВ */
.archive-content-wrapper {
    background-color: var(--bg-accent);
    border-radius: 50px;
    padding: 80px;
    display: flex;
    gap: 60px;
    width: 100%;
    box-sizing: border-box;
}

.archive-intro {
    flex: 1;
    min-width: 0;
}

.archive-intro h3 {
    font-size: 30px;
    font-weight: 800;
    margin: 0 0 20px 0;
    line-height: 1.2;
}

.archive-intro p {
    font-size: 16px;
    color: var(--text-light);
}

.archive-grid {
    flex: 2;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    min-width: 0;
}

.archive-card {
    background: var(--white);
    padding: 35px;
    border-radius: 35px;
    transition: 0.3s;
}

.archive-card:hover {
    transform: translateY(-5px);
}

.archive-card .card-icon {
    width: 48px;
    height: 48px;
    margin-bottom: 20px;
}

.archive-card h4 {
    font-size: 18px;
    margin: 0 0 10px 0;
    font-weight: 700;
}

.archive-card p {
    font-size: 14px;
    color: var(--text-light);
    margin: 0;
}

/* СЕКЦИЯ CTA */
.cta-section {
    padding: 120px 0;
    text-align: center;
    width: 100%;
}

.cta-subtitle {
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 0.2em;
    color: var(--text-light);
    margin-bottom: 40px;
}

.cta-main-button {
    display: inline-block;
    background-color: var(--brand-dark);
    color: var(--white);
    text-decoration: none;
    padding: 22px 50px;
    border-radius: 60px;
    font-size: 14px;
    font-weight: 800;
    letter-spacing: 0.1em;
    box-shadow: 0 15px 35px rgba(91, 74, 67, 0.2);
    transition: 0.3s;
    margin-bottom: 40px;
}

.cta-main-button:hover {
    transform: translateY(-3px);
    box-shadow: 0 20px 40px rgba(91, 74, 67, 0.3);
}

.cta-secondary-link {
    display: block;
    font-size: 12px;
    font-weight: 700;
    color: var(--brand-primary);
    text-decoration: none;
    text-transform: uppercase;
    letter-spacing: 0.1em;
}

/* ========================================= */
/* СТИЛИ ДЛЯ СТРАНИЦЫ FAQ */
/* ========================================= */

/* FAQ ЗАГОЛОВОК */
.faq-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 80px 20px 40px;
    text-align: center;
    max-width: 1400px;
    margin: 0 auto;
}

.faq-header {
    display: flex;
    align-items: center;
    width: 100%;
    max-width: 600px;
    margin-bottom: 25px;
}

.header-text {
    font-size: 14px;
    letter-spacing: 4px;
    font-weight: 600;
    margin: 0 20px;
    color: var(--faq-brown);
    text-transform: uppercase;
}

.line {
    flex-grow: 1;
    height: 1px;
    background-color: #e8d0ca;
    min-width: 50px;
}

.faq-badge {
    background-color: #f1a99b;
    color: white;
    font-size: 80px;
    font-weight: 800;
    padding: 5px 25px;
    margin-bottom: 30px;
    border-radius: 4px;
    letter-spacing: -2px;
}

.faq-description {
    font-size: 18px;
    max-width: 650px;
    color: #8e7b76;
    margin: 0 auto;
}

/* АККОРДЕОН */
.faq-accordion {
    max-width: 1200px;
    margin: 0 auto 60px;
    padding: 0 20px;
    width: 100%;
}

.faq-item {
    background: #ffffff;
    border-radius: 40px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
    margin-bottom: 20px;
    overflow: hidden;
    width: 100%;
}

.faq-question {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 25px 40px;
    list-style: none;
    cursor: pointer;
    font-weight: 700;
    color: #8e7b76;
    font-size: 18px;
    width: 100%;
    text-align: left;
}

.faq-question::-webkit-details-marker {
    display: none;
}

.plus-icon {
    width: 40px;
    height: 40px;
    border: 1px solid #e8d0ca;
    border-radius: 50%;
    position: relative;
    flex-shrink: 0;
    margin-left: 20px;
}

.plus-icon::before,
.plus-icon::after {
    content: "";
    position: absolute;
    background-color: #a68c85;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.plus-icon::before {
    width: 14px;
    height: 2px;
}

.plus-icon::after {
    width: 2px;
    height: 14px;
    transition: 0.3s;
}

details[open] .plus-icon::after {
    transform: translate(-50%, -50%) rotate(90deg);
    opacity: 0;
}

.faq-answer {
    padding: 0 40px 30px;
    color: var(--faq-brown);
    line-height: 1.6;
    font-size: 16px;
}

/* БЛОК: ОСТАЛИСЬ ВОПРОСЫ? (CTA Section) */
.faq-cta-section {
    max-width: 1200px;
    margin: 0 auto 100px;
    padding: 0 20px;
    width: 100%;
}

.cta-box {
    background: linear-gradient(135deg, #716059 0%, #63544e 100%);
    border-radius: 80px;
    padding: 80px 40px;
    text-align: center;
    color: #ffffff;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    width: 100%;
}

.cta-title {
    font-size: 42px;
    font-weight: 700;
    margin-bottom: 20px;
}

.cta-subtitle {
    font-size: 16px;
    opacity: 0.8;
    margin-bottom: 40px;
    letter-spacing: 0.5px;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.cta-subtitle span {
    font-weight: 700;
}

.btn-cta {
    background-color: var(--cta-button);
    color: #ffffff;
    text-decoration: none;
    padding: 22px 60px;
    border-radius: 25px;
    font-size: 14px;
    font-weight: 700;
    letter-spacing: 4px;
    text-transform: uppercase;
    display: inline-block;
    transition: 0.3s;
    box-shadow: 0 10px 20px rgba(241, 169, 155, 0.2);
}

.btn-cta:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 30px rgba(241, 169, 155, 0.4);
    filter: brightness(1.05);
}

/* ========================================= */
/* АДАПТИВНОСТЬ - ОБЩИЕ СТИЛИ */
/* ========================================= */

@media (max-width: 1400px) {

    .cinnamon-section,
    .about-section,
    .philosophy-section,
    .quality-section,
    .socialization-section,
    .quote-section {
        max-width: 1200px;
    }

    .about-container,
    .quality-container,
    .socialization-container {
        gap: 60px;
    }

    .about-image-wrapper {
        flex: 0 0 450px;
    }
}

@media (max-width: 1200px) {
    .mycat-card-container {
        flex: 0 0 280px;
    }

    .mycat-photo-box {
        width: 280px;
        height: 350px;
    }

    .philosophy-grid {
        grid-template-columns: repeat(3, 1fr);
    }

    .cinnamon-title {
        font-size: 72px;
    }

    .about-image-wrapper {
        flex: 0 0 400px;
    }

    .philosophy-content,
    .archive-content-wrapper {
        flex-direction: column;
    }

    .archive-grid,
    .footer-inner {
        grid-template-columns: 1fr 1fr;
    }

    .header-nav {
        display: none;
    }

    .mobile-menu-toggle {
        display: block;
    }

    .archive-content-wrapper {
        padding: 60px 40px;
    }

    .adoption-title {
        font-size: 48px;
    }
}

@media (max-width: 1100px) {
    .cinnamon-title {
        font-size: 64px;
    }

    .about-title,
    .quality-title,
    .socialization-title {
        font-size: 36px;
    }
}

@media (max-width: 992px) {
    .header-nav,
    .btn-header-contact {
        display: none;
    }

    .mobile-menu-toggle {
        display: block;
    }

    .about-container,
    .quality-container,
    .socialization-container {
        flex-direction: column;
        text-align: center;
        gap: 40px;
    }

    .quality-container {
        flex-direction: column-reverse;
    }

    .about-image-wrapper {
        flex: 0 0 auto;
        width: 100%;
        max-width: 500px;
    }

    .cinnamon-title {
        font-size: 48px;
    }

    .philosophy-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .cinnamon-section,
    .about-section,
    .philosophy-section,
    .quality-section,
    .socialization-section,
    .quote-section {
        padding-left: 20px;
        padding-right: 20px;
    }

    .custom-quote-text {
        font-size: 24px;
    }

    .kittens-flex-container {
        gap: 25px;
    }

    .main-offer-wrapper {
        border-radius: 30px;
        padding: 30px 15px;
    }

    .offer-title {
        font-size: 28px !important;
    }

    .footer-inner {
        flex-direction: column;
        gap: 35px;
    }

    .footer-col {
        width: 100%;
    }

    .btn-header-contact {
        display: none;
    }

    .adoption-title {
        font-size: 42px;
    }

    .features-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }

    .section-header {
        flex-wrap: wrap;
        gap: 15px;
    }

    .section-header .divider {
        display: none;
    }

    .section-header .title {
        white-space: normal;
        font-size: 28px;
    }

    .cta-title {
        font-size: 36px;
    }

    .faq-question {
        font-size: 16px;
        padding: 20px 30px;
    }

    .faq-answer {
        padding: 0 30px 25px;
        font-size: 15px;
    }

    .faq-badge {
        font-size: 60px;
        padding: 5px 20px;
    }

    .header-text {
        font-size: 12px;
        letter-spacing: 3px;
    }
}

@media (max-width: 768px) {
    .mycat-slider-wrapper {
        padding: 30px 15px;
    }

    .slider-arrow {
        width: 36px;
        height: 36px;
        font-size: 16px;
    }

    .mycat-card-container {
        flex: 0 0 85vw;
        max-width: none;
    }

    .mycat-photo-box {
        width: 85vw;
        height: 70vw;
        max-height: 400px;
        border-radius: 40px;
    }

    .custom-lt-container {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
        padding: 15px;
    }

    .custom-lt-line {
        display: none;
    }

    .custom-lt-date {
        padding-left: 0;
        border-left: none;
    }

    .custom-lt-status {
        margin-top: 5px;
    }

    .custom-quote-text {
        font-size: 22px;
    }

    .coc-media {
        height: 300px;
    }

    .litter-parent-section {
        padding: 30px 15px;
        border-radius: 30px;
    }

    .parent-media {
        height: 250px;
    }

    .date-highlight-box {
        padding: 20px 15px;
    }

    .date-value {
        font-size: 22px;
    }

    .mobile-menu {
        width: 85%;
    }

    .mobile-menu-header {
        padding: 15px;
    }

    .mobile-nav .nav-link {
        font-size: 16px;
        padding: 16px 0;
    }

    .cinnamon-title {
        font-size: 36px;
    }

    .philosophy-grid {
        grid-template-columns: 1fr;
        max-width: 500px;
        margin: 0 auto;
    }

    .footer-inner {
        flex-direction: column;
        gap: 35px;
    }

    .about-title,
    .quality-title,
    .philosophy-main-title,
    .socialization-title {
        font-size: 32px;
    }

    .cinnamon-section {
        padding: 60px 20px;
    }

    .about-section,
    .quality-section,
    .socialization-section,
    .philosophy-section {
        padding: 50px 20px;
    }

    .quote-section {
        padding: 60px 20px;
    }

    .quote-text {
        font-size: 24px;
    }

    .section-header .divider {
        display: none;
    }

    .features-grid,
    .archive-grid,
    .footer-inner {
        grid-template-columns: 1fr;
    }

    .archive-content-wrapper {
        padding: 40px 20px;
    }

    .section-header .title {
        font-size: 24px;
    }

    .adoption-header {
        padding: 60px 0 40px;
    }

    .adoption-title {
        font-size: 36px;
    }

    .adoption-desc {
        font-size: 16px;
    }

    .philosophy-content {
        margin-bottom: 60px;
        gap: 40px;
    }

    .feature-card {
        padding: 25px;
    }

    .archive-card {
        padding: 25px;
    }

    .cta-section {
        padding: 80px 0;
    }

    .col-main {
        max-width: 100%;
    }

    .faq-badge {
        font-size: 50px;
    }

    .faq-description {
        font-size: 16px;
        padding: 0 15px;
    }

    .cta-box {
        border-radius: 60px;
        padding: 50px 20px;
    }

    .cta-title {
        font-size: 32px;
    }

    .btn-cta {
        padding: 18px 40px;
        font-size: 12px;
        letter-spacing: 3px;
    }

    .faq-header {
        flex-wrap: wrap;
        gap: 15px;
        justify-content: center;
    }

    .line {
        min-width: 40px;
    }

    .header-text {
        margin: 0 10px;
    }
}

@media (max-width: 576px) {
    .custom-quote-text {
        font-size: 20px;
    }

    .custom-quote-subtext {
        font-size: 13px;
    }

    .offer-title {
        font-size: 24px !important;
    }

    .coc-media {
        height: 280px;
    }

    .footer-tagline {
        font-size: 10px;
        letter-spacing: 2px;
    }

    .footer-about {
        font-size: 13px;
    }

    .mobile-menu {
        width: 90%;
    }

    .cinnamon-title {
        font-size: 32px;
    }

    .cinnamon-description {
        font-size: 16px;
    }

    .label-text {
        font-size: 12px;
        letter-spacing: 3px;
    }

    .cinnamon-label::before,
    .cinnamon-label::after {
        width: 30px;
    }

    .about-title,
    .quality-title,
    .philosophy-main-title,
    .socialization-title {
        font-size: 28px;
    }

    .philosophy-subtitle {
        font-size: 16px;
    }

    .philosophy-card {
        padding: 30px 20px;
    }

    .quote-text {
        font-size: 20px;
    }

    .footer-tagline {
        font-size: 10px;
    }

    .footer-about {
        font-size: 14px;
    }

    .adoption-title {
        font-size: 32px;
    }

    .guide-subtitle .line {
        width: 30px;
    }

    .guide-subtitle .subtitle-text {
        font-size: 11px;
    }

    .section-header .number {
        font-size: 32px;
    }

    .mobile-nav {
        padding: 15px;
    }

    .mobile-nav .nav-link {
        font-size: 16px;
        padding: 16px 0;
    }

    .mobile-contact-btn {
        margin: 15px;
        padding: 14px 25px;
        font-size: 13px;
    }

    .faq-badge {
        font-size: 40px;
        padding: 5px 15px;
    }

    .faq-question {
        padding: 18px 25px;
        font-size: 15px;
    }

    .plus-icon {
        width: 35px;
        height: 35px;
        margin-left: 15px;
    }

    .faq-answer {
        padding: 0 25px 20px;
        font-size: 14px;
    }

    .cta-title {
        font-size: 28px;
    }

    .cta-subtitle {
        font-size: 14px;
    }

    .btn-cta {
        padding: 16px 30px;
        font-size: 11px;
        letter-spacing: 2px;
    }

    .faq-container {
        padding: 50px 15px 30px;
    }
}

@media (max-width: 480px) {
    .cd-site-header {
        padding: 12px 15px;
    }

    .logo-main {
        font-size: 18px;
    }

    .logo-sub {
        font-size: 8px;
        letter-spacing: 1.5px;
    }

    .custom-quote-text {
        font-size: 18px;
    }

    .offer-subtitle {
        font-size: 10px;
    }

    .offer-title {
        font-size: 22px !important;
    }

    .parent-name {
        font-size: 18px !important;
    }

    .date-value {
        font-size: 20px;
    }

    .mobile-nav {
        padding: 15px;
    }

    .mobile-nav .nav-link {
        font-size: 15px;
        padding: 15px 0;
    }

    .mobile-contact-btn {
        margin: 15px;
        padding: 14px 25px;
        font-size: 13px;
    }

    .cinnamon-title {
        font-size: 28px;
    }

    .cinnamon-label::before,
    .cinnamon-label::after {
        width: 20px;
    }

    .philosophy-card {
        padding: 25px 20px;
    }

    .card-icon {
        font-size: 28px;
        margin-bottom: 20px;
    }

    .card-title {
        font-size: 18px;
    }

    .card-description {
        font-size: 14px;
    }

    .adoption-title {
        font-size: 28px;
    }
}

/* Для очень высоких экранов */
@media (min-height: 700px) {
    .mobile-nav {
        margin-top: 0;
    }

    .mobile-nav .nav-link {
        padding: 20px 0;
    }
}

/* Улучшение скролла в мобильном меню */
.mobile-menu::-webkit-scrollbar {
    width: 4px;
}

.mobile-menu::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.mobile-menu::-webkit-scrollbar-thumb {
    background: #F19072;
    border-radius: 2px;
}

/* Улучшение доступности */
.mobile-menu-toggle:focus,
.mobile-menu-close:focus,
.nav-link:focus,
.mobile-contact-btn:focus,
.mycat-btn-about:focus,
.slider-arrow:focus,
.btn-cta:focus,
.early-access-btn:focus {
    outline: 2px solid #F19072;
    outline-offset: 2px;
}

/* Улучшение тач-интерфейса */
@media (hover: none) and (pointer: coarse) {

    .mycat-photo-box:hover img,
    .slider-arrow:hover,
    .mycat-btn-about:hover,
    .early-access-btn:hover,
    .btn-cta:hover {
        transform: none;
    }

    .mycat-photo-box:hover {
        border-radius: 60px;
    }

    .slider-arrow:hover {
        background-color: #6d5a52;
    }

    .mycat-btn-about:hover {
        background-color: #6d5a52;
    }

    .early-access-btn:hover {
        box-shadow: 0 8px 20px rgba(241, 144, 114, 0.3);
    }

    .btn-cta:hover {
        box-shadow: 0 10px 20px rgba(241, 169, 155, 0.2);
        filter: none;
    }
}


// Функции для слайдера
function moveSliderNew(btn, direction) {
    var wrapper = btn.closest('.mycat-slider-wrapper');
    var section = wrapper.querySelector('.mycat-section');
    var viewport = wrapper.querySelector('.mycat-viewport');
    
    var cardWidth = 326; // 298px ширина + 28px gap
    if (window.innerWidth <= 768) {
        cardWidth = window.innerWidth * 0.85 + 28;
    } else if (window.innerWidth <= 1200) {
        cardWidth = 280 + 28;
    }
    
    var maxScroll = section.scrollWidth - viewport.offsetWidth;
    
    var currentPos = parseInt(section.getAttribute('data-pos')) || 0;
    currentPos += (direction * cardWidth);

    if (currentPos < 0) currentPos = 0;
    if (currentPos > maxScroll) currentPos = maxScroll;

    section.setAttribute('data-pos', currentPos);
    section.style.transform = "translateX(-" + currentPos + "px)";
}

function toggleHeart(element) {
    element.classList.toggle('active');
}

// Единый обработчик DOMContentLoaded
document.addEventListener('DOMContentLoaded', function() {
    // Переменные для мобильного меню
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const mobileMenu = document.querySelector('.mobile-menu');
    const mobileMenuClose = document.querySelector('.mobile-menu-close');
    const menuOverlay = document.querySelector('.menu-overlay');
    const body = document.body;
    const header = document.querySelector('.cd-site-header');
    
    let lastScrollTop = 0;
    let isMenuOpen = false;
    
    // Функции управления меню
    function openMenu() {
        if (mobileMenuToggle) mobileMenuToggle.classList.add('active');
        if (mobileMenu) mobileMenu.classList.add('active');
        if (menuOverlay) menuOverlay.classList.add('active');
        body.style.overflow = 'hidden';
        isMenuOpen = true;
    }
    
    function closeMenu() {
        if (mobileMenuToggle) mobileMenuToggle.classList.remove('active');
        if (mobileMenu) mobileMenu.classList.remove('active');
        if (menuOverlay) menuOverlay.classList.remove('active');
        body.style.overflow = '';
        isMenuOpen = false;
    }
    
    // Открытие/закрытие меню
    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            if (!isMenuOpen) {
                openMenu();
            } else {
                closeMenu();
            }
        });
    }
    
    // Закрытие меню
    if (mobileMenuClose) {
        mobileMenuClose.addEventListener('click', closeMenu);
    }
    
    if (menuOverlay) {
        menuOverlay.addEventListener('click', closeMenu);
    }
    
    // Закрытие меню при клике на ссылки
    const mobileLinks = document.querySelectorAll('.mobile-nav .nav-link, .mobile-contact-btn');
    mobileLinks.forEach(link => {
        link.addEventListener('click', function() {
            setTimeout(closeMenu, 300);
        });
    });
    
    // Закрытие меню на Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && isMenuOpen) {
            closeMenu();
        }
    });
    
    // Закрытие меню при изменении ориентации
    window.addEventListener('orientationchange', function() {
        if (isMenuOpen) {
            closeMenu();
        }
    });
    
    // Скрытие/показ шапки при скролле
    window.addEventListener('scroll', function() {
        if (window.innerWidth <= 992 && !isMenuOpen && header) {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            if (scrollTop > lastScrollTop && scrollTop > 100) {
                header.classList.add('header-hide');
            } else {
                header.classList.remove('header-hide');
            }
            
            lastScrollTop = scrollTop;
        }
    });
    
    // Инициализация слайдеров
    function initSliders() {
        const sliders = document.querySelectorAll('.mycat-section');
        sliders.forEach(slider => {
            if (window.innerWidth <= 768) {
                slider.setAttribute('data-pos', '0');
                slider.style.transform = "translateX(0)";
            }
        });
        
        // Закрытие меню при переходе на большой экран
        if (window.innerWidth > 992 && isMenuOpen) {
            closeMenu();
        }
    }
    
    initSliders();
    window.addEventListener('resize', initSliders);
    
    // Свайпы для мобильного меню
    if (mobileMenu) {
        let startX = 0;
        let startY = 0;
        
        mobileMenu.addEventListener('touchstart', function(e) {
            startX = e.touches[0].clientX;
            startY = e.touches[0].clientY;
        });
        
        mobileMenu.addEventListener('touchmove', function(e) {
            if (!isMenuOpen) return;
            
            const currentX = e.touches[0].clientX;
            const currentY = e.touches[0].clientY;
            const diffX = startX - currentX;
            const diffY = startY - currentY;
            
            // Если свайп по горизонтали больше, чем по вертикали, предотвращаем скролл
            if (Math.abs(diffX) > Math.abs(diffY)) {
                e.preventDefault();
            }
        });
        
        mobileMenu.addEventListener('touchend', function(e) {
            if (!isMenuOpen) return;
            
            const endX = e.changedTouches[0].clientX;
            const diffX = startX - endX;
            
            // Закрытие меню свайпом вправо
            if (diffX < -100) {
                closeMenu();
            }
        });
    }
    
    // Свайпы для слайдеров
    const sliders = document.querySelectorAll('.mycat-viewport');
    sliders.forEach(slider => {
        let startX = 0;
        let isDragging = false;
        
        slider.addEventListener('touchstart', function(e) {
            startX = e.touches[0].clientX;
            isDragging = true;
        });
        
        slider.addEventListener('touchmove', function(e) {
            if (!isDragging) return;
            e.preventDefault();
        });
        
        slider.addEventListener('touchend', function(e) {
            if (!isDragging) return;
            isDragging = false;
            
            const endX = e.changedTouches[0].clientX;
            const diff = startX - endX;
            const wrapper = this.closest('.mycat-slider-wrapper');
            
            // Определяем направление свайпа
            if (Math.abs(diff) > 50) {
                if (diff > 0) {
                    // Свайп влево - двигаем вправо
                    const nextBtn = wrapper.querySelector('.arrow-right');
                    if (nextBtn) moveSliderNew(nextBtn, 1);
                } else {
                    // Свайп вправо - двигаем влево
                    const prevBtn = wrapper.querySelector('.arrow-left');
                    if (prevBtn) moveSliderNew(prevBtn, -1);
                }
            }
        });
    });
    
    // Оптимизация для быстрых кликов
    const buttons = document.querySelectorAll('button, a');
    buttons.forEach(button => {
        button.addEventListener('touchstart', function() {
            this.style.transform = 'scale(0.98)';
        });
        
        button.addEventListener('touchend', function() {
            this.style.transform = '';
        });
        
        button.addEventListener('touchcancel', function() {
            this.style.transform = '';
        });
    });
    
    // Предотвращение зума при двойном тапе
    let lastTouchTime = 0;
    document.addEventListener('touchend', function(event) {
        const currentTime = new Date().getTime();
        const timeDiff = currentTime - lastTouchTime;
        
        if (timeDiff < 300 && timeDiff > 0) {
            event.preventDefault();
        }
        
        lastTouchTime = currentTime;
    }, { passive: false });
    
    // Аккордеон для FAQ
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        const answer = item.querySelector('.faq-answer');
        if (!answer) return;
        
        answer.style.transition = 'max-height 0.3s ease, padding 0.3s ease';
        
        // Устанавливаем начальные значения
        if (item.open) {
            answer.style.maxHeight = answer.scrollHeight + 'px';
        } else {
            answer.style.maxHeight = '0';
            answer.style.overflow = 'hidden';
        }
        
        item.addEventListener('toggle', function() {
            if (this.open) {
                answer.style.maxHeight = answer.scrollHeight + 'px';
            } else {
                answer.style.maxHeight = '0';
            }
        });
        
        // Закрытие других элементов при открытии одного
        item.addEventListener('click', function() {
            if (this.hasAttribute('open')) {
                return;
            }
            
            faqItems.forEach(otherItem => {
                if (otherItem !== this && otherItem.hasAttribute('open')) {
                    otherItem.removeAttribute('open');
                    const otherAnswer = otherItem.querySelector('.faq-answer');
                    if (otherAnswer) {
                        otherAnswer.style.maxHeight = '0';
                    }
                }
            });
        });
    });
});