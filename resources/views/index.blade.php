<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings['seo_home_title'] ?? 'Cinnamon Desire - Premium Scottish Cattery' }}</title>
    <meta name="description" content="{{ $settings['seo_home_description'] ?? '' }}">
    <style>
        #root section:has(+ div > section),
        #root section:has(~ div section) {
            margin-bottom: 2rem !important;
        }
        #root section + div section,
        #root section ~ section {
            margin-top: 2rem !important;
        }
    </style>
    <script>
        window.__blogPosts = {!! json_encode($blogPosts ?? []) !!};
        window.__allKittens = {!! json_encode($kittens ?? []) !!};
        window.__cdPreloadedPage = {!! json_encode($pagePayload ?? null) !!};
        window.__cdPreloadedPageIds = {
            37053: window.__cdPreloadedPage,
            37055: window.__cdPreloadedPage,
            37059: window.__cdPreloadedPage,
            37158: window.__cdPreloadedPage,
            37173: window.__cdPreloadedPage,
            37282: window.__cdPreloadedPage
        };
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/svg" href="/assets/a-DJ2-ArCx.svg" />
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700&family=Quicksand:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-main: #F8E6E1;
            --secondary-bg: #EED6CC;
            --accent-coral: #EFA39A;
            --hover-peach: #F4B7A6;
            --text-taupe: #6E5A54;
            --text-muted: #9C8A84;
            --accent-sage: #C7CBBE;
        }
        body { 
            font-family: 'Lexend', sans-serif; 
            background-color: var(--bg-main); 
            color: var(--text-taupe);
            scroll-behavior: smooth;
        }
        h1, h2, h3, .font-heading {
            font-family: 'Quicksand', sans-serif;
            color: var(--text-taupe);
        }
        ::selection {
            background-color: var(--accent-coral);
            color: white;
        }
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }

        /* Beautiful Modal Animations */
        @keyframes modal-fade-in {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes modal-slide-up {
            from { opacity: 0; transform: scale(0.92) translateY(30px); }
            to { opacity: 1; transform: scale(1) translateY(0); }
        }

        /* Target React Modals (Headless UI / Tailwind) */
        [role="dialog"] {
            animation: modal-fade-in 0.3s ease-out;
        }
        [role="dialog"] > div:not([class*="fixed"]), 
        [role="dialog"] [class*="bg-white"],
        [role="dialog"] [class*="rounded-"] {
            animation: modal-slide-up 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        /* Overlay blur enhancement */
        [role="dialog"] [class*="fixed"][class*="inset-0"] {
            backdrop-filter: blur(8px);
            background-color: rgba(110, 90, 84, 0.4) !important;
        }

                /* === NEW MODAL OVERHAUL === */
        
        /* Общий контейнер модалки */
        [role="dialog"] [class*="bg-white"][class*="rounded-"] {
            background-color: #F8E6E1 !important;
            border-radius: 3.5rem !important;
            max-width: 1024px !important; /* max-w-5xl */
            border: none !important;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25) !important;
            padding: 0 !important;
        }

        /* Кнопка закрытия */
        [role="dialog"] button:has(svg[class*="close"]),
        [role="dialog"] button[aria-label*="close"],
        [role="dialog"] .absolute.top-4.right-4 button,
        [role="dialog"] .absolute.top-8.right-8 button {
            top: 2rem !important; /* top-8 */
            right: 2rem !important; /* right-8 */
            width: 3rem !important; /* w-12 */
            height: 3rem !important; /* h-12 */
            background: rgba(255, 255, 255, 0.9) !important;
            backdrop-filter: blur(12px) !important;
            border: 1px solid #D6C1BA !important;
            border-radius: 9999px !important;
            color: #6E5A54 !important;
            font-size: 1.25rem !important;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1) !important;
        }

        /* Разделение на две колонки */
        [role="dialog"] .flex.flex-col.lg\:flex-row {
            background: transparent !important;
        }

        /* ЛЕВАЯ КОЛОНКА */
        [role="dialog"] .lg\:w-1\/2.relative, 
        [role="dialog"] .lg\:w-1\/2.p-8 {
            padding: 2rem !important; /* lg:p-12 в коде, но p-8 для базы */
            border-right: 1px solid #D6C1BA !important;
            background: transparent !important;
        }
        @media (min-width: 1024px) {
            [role="dialog"] .lg\:w-1\/2:first-child { padding: 3rem !important; }
        }

        /* Главное фото в модалке */
        [role="dialog"] .aspect-\[4\/5\] {
            border-radius: 2.5rem !important;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25) !important;
            background: white !important;
            border: none !important;
            margin-bottom: 2rem !important;
        }

        [role="dialog"] .aspect-\[4\/5\] img {
            border-radius: 2.5rem !important;
            object-fit: cover !important;
            height: 100% !important;
        }

        /* Скрытие "фантомных" элементов старого дизайна */
        [role="dialog"] [class*="aspect-[4/5]"]::before,
        [role="dialog"] [class*="aspect-[4/5]"]::after {
            display: none !important;
        }

        /* Статус "Доступен" и "EXCLUSIVE" поверх фото */
        [role="dialog"] .lg\:w-1\/2.relative .absolute.top-6.left-6 {
            display: flex !important;
            flex-direction: column !important;
            gap: 0.75rem !important;
            z-index: 20 !important;
        }

        /* Цена поверх фото */
        [role="dialog"] .lg\:w-1\/2.relative .absolute.bottom-6.right-6 {
            display: block !important;
            z-index: 20 !important;
        }
        [role="dialog"] .lg\:w-1\/2.relative .absolute.bottom-6.right-6 > div {
            background: rgba(255, 255, 255, 0.9) !important;
            backdrop-filter: blur(8px) !important;
            padding: 0.75rem 1.5rem !important;
            border-radius: 1rem !important;
            border: 1px solid #D6C1BA !important;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1) !important;
        }

        /* Сетка характеристик под фото (Дата рождения / Порода) */
        [role="dialog"] .grid.grid-cols-1.sm\:grid-cols-2 {
            gap: 1rem !important;
            margin-top: 1.5rem !important;
        }
        [role="dialog"] .grid.grid-cols-1.sm\:grid-cols-2 > div {
            background: rgba(255, 255, 255, 0.4) !important;
            padding: 1.25rem !important;
            border-radius: 1rem !important;
            border: 1px solid #D6C1BA !important;
        }

        /* Тэги */
        [role="dialog"] .flex.flex-wrap.gap-x-4 {
            margin-top: 1.5rem !important;
        }
        [role="dialog"] .flex.flex-wrap.gap-x-4 span {
            color: #C5A059 !important;
            font-size: 9px !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.1em !important;
        }

        /* ПРАВАЯ КОЛОНКА */
        [role="dialog"] .lg\:w-1\/2.flex.flex-col {
            padding: 2rem !important;
            background: transparent !important;
        }
        @media (min-width: 1024px) {
            [role="dialog"] .lg\:w-1\/2:last-child { padding: 3rem !important; }
        }

        /* Заголовок Имени */
        [role="dialog"] h2 {
            font-size: 1.875rem !important; /* text-3xl */
            color: #6E5A54 !important;
            font-weight: 700 !important;
        }

        /* Блок "Характер" */
        [role="dialog"] h3 {
            font-size: 10px !important;
            color: #9C8A84 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.3em !important;
            margin-bottom: 1rem !important;
        }
        [role="dialog"] .bg-white\/30, 
        [role="dialog"] p[class*="leading-relaxed"] {
            background: rgba(255, 255, 255, 0.3) !important;
            padding: 1.5rem !important;
            border-radius: 1.875rem !important; /* rounded-3xl */
            border: 1px solid rgba(255, 255, 255, 0.5) !important;
            color: #6E5A54 !important;
            font-weight: 500 !important;
        }

        /* Особенности (Тэги-плашки) */
        [role="dialog"] .flex.flex-wrap.gap-2 span {
            background: rgba(255, 255, 255, 0.6) !important;
            border: 1px solid #D6C1BA !important;
            padding: 0.5rem 1rem !important;
            border-radius: 0.75rem !important;
            font-size: 10px !important;
            font-weight: 700 !important;
            color: #6E5A54 !important;
        }

        /* Кнопка "Подать заявку" */
        [role="dialog"] button[class*="bg-[#EFA39A]"],
        [role="dialog"] .mt-16 button {
            background-color: #EFA39A !important;
            color: white !important;
            border-radius: 2rem !important;
            padding: 1.75rem !important;
            font-weight: 700 !important;
            letter-spacing: 0.25em !important;
            text-transform: uppercase !important;
            font-size: 11px !important;
            box-shadow: 0 25px 50px -12px rgba(239, 163, 154, 0.4) !important;
            transition: all 0.3s !important;
            border: none !important;
        }
        [role="dialog"] button:hover {
            background-color: #F4B7A6 !important;
            transform: none !important;
        }

        /* Текст под кнопкой */
        [role="dialog"] .mt-16 p {
            font-size: 9px !important;
            color: #9C8A84 !important;
            text-transform: uppercase !important;
            opacity: 0.7 !important;
            margin-top: 1rem !important;
        }

        /* Homepage Cards Overhaul - APPLY ONLY TO CAROUSEL, NOT MODAL */
        #root div:not([role="dialog"]) [class*="aspect-[4/5]"]:has(img[src*="/storage/kittens/"]):not([data-cd-card-ready="1"]) {
            overflow: hidden !important;
            border-radius: 3rem !important;
            color: transparent !important;
            text-indent: -9999px !important;
        }
        #root div:not([role="dialog"]) [class*="aspect-[4/5]"]:has(img[src*="/storage/kittens/"]):not([data-cd-card-ready="1"]) > *:not(img):not(:has(img)) {
            display: none !important;
        }
        #root div:not([role="dialog"]) [class*="aspect-[4/5]"]:has(img[src*="/storage/kittens/"]):not([data-cd-card-ready="1"]) > div[class*="absolute"] {
            display: none !important;
        }
        #root div:not([role="dialog"]) [class*="aspect-[4/5]"]:has(img[src*="/storage/kittens/"]):not([data-cd-card-ready="1"]) img {
            display: block !important;
            width: 100% !important;
            height: 100% !important;
            object-fit: cover !important;
            border-radius: 3rem !important;
        }
        #root div:not([role="dialog"]) [class*="aspect-[4/5]"][data-name][data-price] {
            background: white !important;
            display: flex !important;
            flex-direction: column !important;
            justify-content: flex-start !important;
            padding: 0 !important;
            border: 1px solid #D6C1BA !important;
            overflow: hidden !important; 
            height: 440px !important; 
            transition: all 0.3s ease !important;
            color: transparent !important;
            text-indent: -9999px;
        }

        /* Inject name with specific padding - ONLY ON HOMEPAGE */
        #root div:not([role="dialog"]) [class*="aspect-[4/5]"][data-name][data-price]::before {
            content: attr(data-name);
            position: absolute;
            top: 320px; 
            left: 24px;
            right: 24px;
            font-size: 18px;
            font-weight: 700;
            color: #6E5A54 !important;
            z-index: 10;
            text-indent: 0 !important;
            display: block !important;
            padding: 12px 0 22px 0 !important;
            font-family: 'Quicksand', sans-serif !important;
            line-height: 1.2;
        }

        /* Adjust price and gender - ONLY ON HOMEPAGE */
        #root div:not([role="dialog"]) [class*="aspect-[4/5]"][data-name][data-price]::after {
            content: attr(data-price);
            position: absolute;
            top: 388px; 
            right: 24px;
            font-size: 22px;
            font-weight: 800;
            color: #EFA39A !important;
            z-index: 10;
            text-indent: 0 !important;
            font-family: 'Quicksand', sans-serif !important;
        }

        /* Gender icon - ONLY ON HOMEPAGE */
        #root div:not([role="dialog"]) [class*="aspect-[4/5]"][data-name][data-price] > div[class*="absolute"] {
            left: 24px !important;
            top: 388px !important; 
            bottom: auto !important;
        }

        /* Disable zoom and add hover opacity - ONLY ON HOMEPAGE */
        #root div:not([role="dialog"]) [class*="aspect-[4/5]"][data-name][data-price]:hover img {
            transform: none !important;
            opacity: 0.5 !important;
        }

        /* Specific fix for Modal Image container - REMOVE EVERYTHING EXCEPT IMAGE */
        [role="dialog"] [class*="aspect-[4/5]"],
        [role="dialog"] .aspect-\[4\/5\] {
            height: auto !important;
            max-height: 85vh !important;
            background: transparent !important; /* Remove white background */
            border: 0 !important;               /* Remove border */
            box-shadow: none !important;        /* Remove shadow */
            text-indent: -9999px !important;
            color: transparent !important;
            font-size: 0 !important;
            overflow: visible !important;
        }
        
        /* Hide EVERYTHING inside this container EXCEPT the img tag */
        [role="dialog"] [class*="aspect-[4/5]"] > div,
        [role="dialog"] [class*="aspect-[4/5]"] > span,
        [role="dialog"] [class*="aspect-[4/5]"] .absolute {
            display: none !important;
            opacity: 0 !important;
            visibility: hidden !important;
        }

        [role="dialog"] [class*="aspect-[4/5]"] img {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
            position: relative !important;
            z-index: 1 !important;
            box-shadow: none !important;
            border-radius: 2rem !important; /* Keep only image rounding */
        }

        [role="dialog"] [class*="aspect-[4/5]"]::before,
        [role="dialog"] [class*="aspect-[4/5]"]::after {
            display: none !important;
        }

        #root div:not([role="dialog"]) [class*="aspect-[4/5]"][data-name][data-price] img {
            width: 100% !important;
            height: 320px !important; 
            object-fit: cover !important; 
            border-radius: 3rem 3rem 0 0 !important;
            margin: 0 !important;
            transition: opacity 0.3s ease !important;
        }

        /* Create a beautiful bottom area for name and price */
        #root div:not([role="dialog"]) [class*="aspect-[4/5]"][data-name][data-price]::after {
            content: attr(data-price);
            position: absolute;
            bottom: 45px; /* Raised significantly from 18px */
            right: 20px;
            font-size: 20px;
            font-weight: 800;
            color: #EFA39A !important;
            z-index: 10;
            text-indent: 0 !important;
            font-family: 'Quicksand', sans-serif !important;
        }

        /* Inject name with specific padding */
        #root div:not([role="dialog"]) [class*="aspect-[4/5]"][data-name][data-price]::before {
            content: attr(data-name);
            position: absolute;
            top: 320px; /* Exactly where the image ends */
            left: 24px;
            right: 24px;
            font-size: 18px;
            font-weight: 700;
            color: #6E5A54 !important;
            z-index: 10;
            text-indent: 0 !important;
            display: block !important;
            padding: 12px 0 22px 0 !important; /* EXACTLY AS REQUESTED */
            font-family: 'Quicksand', sans-serif !important;
            line-height: 1.2;
        }

        /* Adjust price and gender to follow the name's bottom padding */
        #root div:not([role="dialog"]) [class*="aspect-[4/5]"][data-name][data-price]::after {
            content: attr(data-price);
            position: absolute;
            top: 388px; /* Positioned after 320px (img) + 12px (p-top) + ~18px (text) + 22px (p-bottom) */
            right: 24px;
            font-size: 22px;
            font-weight: 800;
            color: #EFA39A !important;
            z-index: 10;
            text-indent: 0 !important;
            font-family: 'Quicksand', sans-serif !important;
        }

        /* Gender icon - align with price */
        #root div:not([role="dialog"]) [class*="aspect-[4/5]"][data-name][data-price] > div[class*="absolute"] {
            left: 24px !important;
            top: 388px !important; 
            bottom: auto !important;
        }

        /* Ensure card height fits all new offsets */
        #root div:not([role="dialog"]) [class*="aspect-[4/5]"][data-name][data-price] {
            height: 440px !important;
        }

        /* Hide the original React elements that cause extra gaps */
        #root div:not([role="dialog"]) [class*="aspect-[4/5]"][data-name][data-price] > div:not([class*="absolute"]):not(.cd-litter-gender):not(.cd-litter-exclusive):not(.cd-card-blur-bg):not(:has(img)) {
            display: none !important;
        }

        #root div:not([role="dialog"]) [class*="aspect-[4/5]"][data-name][data-price] {
            color: transparent !important;
            text-indent: -9999px;
        }

        /* Litter cards: only photo inside the card, CTA stays below */
        #root div:not([role="dialog"]) [class*="aspect-[4/5]"][data-name][data-price] {
            background: transparent !important;
            border: 0 !important;
            height: auto !important;
            color: inherit !important;
            text-indent: 0 !important;
            overflow: hidden !important;
            border-radius: 3rem !important;
            box-shadow: 0 24px 45px rgba(110, 90, 84, 0.18) !important;
        }
        #root div:not([role="dialog"]) [class*="aspect-[4/5]"].cd-main-kitten-card {
            background: #D8C6BF !important;
        }
        #root div:not([role="dialog"]) [class*="aspect-[4/5]"].cd-main-kitten-card > .cd-card-blur-bg {
            position: absolute !important;
            inset: -12% !important;
            z-index: 0 !important;
            background-image: var(--cd-card-bg) !important;
            background-size: cover !important;
            background-position: center center !important;
            filter: blur(24px) !important;
            transform: scale(1.08) !important;
            opacity: 0.62 !important;
            pointer-events: none !important;
        }
        #root div:not([role="dialog"]) [class*="aspect-[4/5]"][data-name][data-price]::before,
        #root div:not([role="dialog"]) [class*="aspect-[4/5]"][data-name][data-price]::after {
            content: none !important;
            display: none !important;
        }
        #root div:not([role="dialog"]) [class*="aspect-[4/5]"][data-name][data-price] > div[class*="absolute"] {
            display: none !important;
        }
        #root div:not([role="dialog"]) [class*="aspect-[4/5]"][data-name][data-price] > div[class*="absolute"][class*="top-6"][class*="right-6"] {
            display: block !important;
            top: 15px !important;
            right: 15px !important;
            left: auto !important;
            bottom: auto !important;
        }
        #root div:not([role="dialog"]) [class*="aspect-[4/5]"][data-name][data-price] > .cd-litter-exclusive {
            position: absolute !important;
            top: 15px !important;
            left: 15px !important;
            z-index: 22 !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 6px !important;
            padding: 8px 14px !important;
            border-radius: 9999px !important;
            background: rgba(110, 90, 84, 0.92) !important;
            color: #FFF7F3 !important;
            font-size: 10px !important;
            font-weight: 700 !important;
            letter-spacing: 0.16em !important;
            text-transform: uppercase !important;
            text-indent: 0 !important;
            box-shadow: 0 10px 24px rgba(72, 48, 42, 0.2) !important;
            backdrop-filter: blur(10px) !important;
        }
        #root div:not([role="dialog"]) [class*="aspect-[4/5]"][data-kitten-id] > .cd-litter-exclusive {
            position: absolute !important;
            top: 15px !important;
            left: 15px !important;
            z-index: 22 !important;
            display: inline-flex !important;
            visibility: visible !important;
            opacity: 1 !important;
            align-items: center !important;
            gap: 6px !important;
            padding: 8px 14px !important;
            border-radius: 9999px !important;
            background: rgba(110, 90, 84, 0.92) !important;
            color: #FFF7F3 !important;
            font-size: 10px !important;
            font-weight: 700 !important;
            letter-spacing: 0.16em !important;
            text-transform: uppercase !important;
            text-indent: 0 !important;
            box-shadow: 0 10px 24px rgba(72, 48, 42, 0.2) !important;
            backdrop-filter: blur(10px) !important;
        }
        #root div:not([role="dialog"]) [class*="aspect-[4/5]"][data-name][data-price] > .cd-litter-gender {
            position: absolute !important;
            left: 15px !important;
            bottom: 15px !important;
            top: auto !important;
            z-index: 22 !important;
            width: 32px !important;
            height: 32px !important;
            border-radius: 9999px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            background: rgba(255, 247, 243, 0.88) !important;
            color: #7C6057 !important;
            border: 1px solid rgba(255, 247, 243, 0.96) !important;
            box-shadow: 0 10px 24px rgba(84, 59, 53, 0.16) !important;
            text-indent: 0 !important;
            backdrop-filter: blur(10px) !important;
            pointer-events: none !important;
        }
        #root div:not([role="dialog"]) [class*="aspect-[4/5]"][data-name][data-price] > .cd-litter-gender svg {
            width: 16px !important;
            height: 16px !important;
            stroke: currentColor !important;
            fill: none !important;
        }
        #root div:not([role="dialog"]) [class*="aspect-[4/5]"][data-kitten-id] > .cd-litter-gender {
            position: absolute !important;
            left: 15px !important;
            bottom: 15px !important;
            top: auto !important;
            z-index: 22 !important;
            width: 32px !important;
            height: 32px !important;
            border-radius: 9999px !important;
            display: flex !important;
            visibility: visible !important;
            opacity: 1 !important;
            align-items: center !important;
            justify-content: center !important;
            background: rgba(255, 255, 255, 0.88) !important;
            border: 1px solid rgba(214, 193, 186, 0.65) !important;
            box-shadow: 0 8px 20px rgba(72, 48, 42, 0.12) !important;
            backdrop-filter: blur(10px) !important;
        }
        #root div:not([role="dialog"]) [class*="aspect-[4/5]"][data-kitten-id] > .cd-litter-gender svg {
            width: 16px !important;
            height: 16px !important;
            stroke: currentColor !important;
            fill: none !important;
        }
        #root div:not([role="dialog"]) [class*="aspect-[4/5]"][data-name][data-price] img {
            display: block !important;
            width: 100% !important;
            height: 100% !important;
            min-height: 0 !important;
            border-radius: 3rem !important;
            opacity: 1 !important;
            transform: none !important;
            transition: none !important;
        }
        #root div:not([role="dialog"]) [class*="aspect-[4/5]"].cd-main-kitten-card img {
            position: relative !important;
            z-index: 1 !important;
            object-fit: contain !important;
            object-position: center center !important;
            transform: scale(0.82) !important;
            background: transparent !important;
        }
        #root div:not([role="dialog"]) [class*="aspect-[4/5]"][data-name][data-price]:hover img {
            opacity: 1 !important;
            transform: none !important;
        }
        #root div:not([role="dialog"]) [class*="aspect-[4/5]"].cd-main-kitten-card:hover img {
            transform: scale(0.82) !important;
        }

        .cd-favorite-btn {
            width: 32px !important;
            height: 32px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            padding: 0 !important;
            border-radius: 9999px !important;
            border: 1px solid rgba(239, 163, 154, 0.42) !important;
            background: rgba(239, 163, 154, 0.22) !important;
            backdrop-filter: blur(14px) !important;
            -webkit-backdrop-filter: blur(14px) !important;
            color: #EFA39A !important;
            box-shadow: 0 10px 24px rgba(171, 107, 98, 0.16) !important;
            z-index: 24 !important;
            cursor: pointer !important;
            pointer-events: auto !important;
            transition: transform 0.2s ease, background-color 0.2s ease, color 0.2s ease !important;
        }
        #cd-special-offer-section [data-kitten-id] {
            overflow: visible !important;
        }
        #cd-special-offer-section [data-kitten-id] img,
        #cd-special-offer-section [data-kitten-id] > div[class*="absolute"],
        #cd-special-offer-section [data-kitten-id] > .cd-offer-badge,
        #cd-special-offer-section [data-kitten-id] > .cd-offer-gender {
            border-radius: inherit !important;
        }
        #cd-special-offer-section .cd-offer-badge {
            position: absolute !important;
            top: 20px !important;
            left: 20px !important;
            z-index: 24 !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 6px !important;
            pointer-events: none !important;
        }
        #cd-special-offer-section .cd-offer-gender {
            position: absolute !important;
            left: 30px !important;
            bottom: 30px !important;
            z-index: 24 !important;
            width: 32px !important;
            height: 32px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            border-radius: 9999px !important;
            background: rgba(255, 255, 255, 0.88) !important;
            border: 1px solid rgba(214, 193, 186, 0.65) !important;
            box-shadow: 0 8px 20px rgba(72, 48, 42, 0.12) !important;
            backdrop-filter: blur(10px) !important;
            -webkit-backdrop-filter: blur(10px) !important;
            color: #7C6057 !important;
            pointer-events: none !important;
            visibility: visible !important;
            opacity: 1 !important;
        }
        #cd-special-offer-section .cd-offer-gender svg {
            width: 16px !important;
            height: 16px !important;
            stroke: currentColor !important;
            fill: none !important;
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }
        #cd-special-offer-section .cd-favorite-btn {
            position: absolute !important;
            top: 20px !important;
            right: 20px !important;
            transform: none !important;
        }
        #root div:not([role="dialog"]) [class*="aspect-[4/5]"][data-name][data-price] > div[class*="absolute"][class*="top-6"][class*="right-6"] {
            top: 15px !important;
            right: 15px !important;
            left: auto !important;
            bottom: auto !important;
            z-index: 30 !important;
            pointer-events: auto !important;
            transform: none !important;
        }
        #root div:not([role="dialog"]) [class*="aspect-[4/5]"][data-name][data-price] > div[class*="absolute"][class*="top-6"][class*="right-6"] > .cd-favorite-btn {
            position: static !important;
            top: auto !important;
            right: auto !important;
        }
        .cd-favorite-btn:hover {
            transform: none !important;
            background: rgba(239, 163, 154, 0.3) !important;
            color: #F4B7A6 !important;
        }
        #cd-special-offer-section .cd-favorite-btn:hover,
        #root div:not([role="dialog"]) [class*="aspect-[4/5]"][data-name][data-price] > div[class*="absolute"][class*="top-6"][class*="right-6"]:hover {
            transform: none !important;
        }
        .cd-favorite-btn svg {
            width: 16px !important;
            height: 16px !important;
            stroke: currentColor !important;
            fill: none !important;
        }
        .cd-favorite-btn.is-active {
            background: rgba(239, 163, 154, 0.96) !important;
            border-color: rgba(239, 163, 154, 1) !important;
            color: #FFF7F3 !important;
            box-shadow: 0 12px 28px rgba(171, 107, 98, 0.28) !important;
        }
.cd-favorite-btn.is-active svg {
    color: #FFD700 !important;
    fill: #FFD700 !important;
    filter: drop-shadow(0 1px 2px rgba(0,0,0,0.3));
}
.cd-favorite-btn:not(.is-active) svg {
    color: #999 !important;
    fill: none !important;
}
        #root div:not([role="dialog"]) [class*="aspect-[4/5]"][data-name][data-price] > div[class*="absolute"][class*="bottom-6"]:not([class*="right-6"]) {
            display: none !important;
        }

        .cd-footer-link-active {
            color: #EFA39A !important;
            opacity: 1 !important;
        }

        .cd-footer-link-active span,
        .cd-footer-link-active div {
            color: inherit !important;
        }

        #cd-rewards-page {
            background: #F8E6E1 !important;
        }

        #cd-faq-page {
            background: #F8E6E1 !important;
        }

        .cd-reward-card {
            display: block !important;
            width: 100% !important;
            text-align: left !important;
            background: transparent !important;
            border: 0 !important;
            padding: 0 !important;
            cursor: pointer !important;
        }

        .cd-reward-card img {
            display: block !important;
            width: 100% !important;
            height: 100% !important;
            object-fit: contain !important;
            background: #ffffff !important;
        }

        #cd-reward-lightbox {
            position: fixed !important;
            inset: 0 !important;
            z-index: 2000 !important;
            background: rgba(34, 24, 20, 0.82) !important;
            backdrop-filter: blur(12px) !important;
            -webkit-backdrop-filter: blur(12px) !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            padding: 2rem !important;
        }

        #cd-reward-lightbox img {
            max-width: min(1200px, 94vw) !important;
            max-height: 88vh !important;
            display: block !important;
            border-radius: 2rem !important;
            background: #fff !important;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.24) !important;
        }

        .cd-faq-item {
            background: rgba(255, 255, 255, 0.58) !important;
            border: 1px solid rgba(214, 193, 186, 0.5) !important;
            border-radius: 2rem !important;
            overflow: hidden !important;
            box-shadow: 0 18px 40px rgba(110, 90, 84, 0.08) !important;
        }

        .cd-faq-toggle {
            width: 100% !important;
            background: transparent !important;
            border: 0 !important;
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            gap: 1rem !important;
            padding: 1.1rem 1.75rem !important;
            color: #6E5A54 !important;
            text-align: left !important;
            cursor: pointer !important;
        }

        .cd-faq-toggle span:first-child {
            font-size: 0.84rem !important;
            font-weight: 700 !important;
            line-height: 1.45 !important;
        }

        .cd-faq-icon {
            width: 2.35rem !important;
            height: 2.35rem !important;
            border-radius: 9999px !important;
            border: 1px solid rgba(214, 193, 186, 0.75) !important;
            color: #9C8A84 !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            flex-shrink: 0 !important;
            background: rgba(255, 255, 255, 0.72) !important;
            font-size: 1.2rem !important;
            font-weight: 500 !important;
        }

        .cd-faq-answer {
            display: none;
            padding: 0 1.75rem 1.75rem !important;
            color: #7F6D67 !important;
            font-size: 0.78rem !important;
            line-height: 1.7 !important;
            font-weight: 500 !important;
        }

        .cd-faq-item.is-open .cd-faq-answer {
            display: block !important;
        }

        .cd-faq-item.is-open .cd-faq-icon {
            background: #EFA39A !important;
            border-color: #EFA39A !important;
            color: #fff !important;
        }

        /* Editorial images on Adoption/About pages should adapt to the module, not stretch it */
        #root img[alt="Scottish kitten at home"],
        #root img[alt="Breeder experience"],
        #root img[alt="Approach"],
        #root img[alt="Care"] {
            display: block !important;
            width: 100% !important;
            height: 100% !important;
            object-fit: cover !important;
            object-position: center center !important;
            transform: none !important;
            transition: none !important;
            background: transparent !important;
        }

        #root img[alt="Scottish kitten at home"].group-hover\:scale-105,
        #root img[alt="Breeder experience"].group-hover\:scale-105,
        #root img[alt="Approach"].group-hover\:scale-105,
        #root img[alt="Care"].group-hover\:scale-105 {
            transform: none !important;
        }

        @media (max-width: 768px) {
            #cd-special-offer-section {
                margin-top: 1.5rem !important;
                margin-bottom: 2rem !important;
                padding-left: 1rem !important;
                padding-right: 1rem !important;
            }
            #cd-special-offer-section > div {
                border-radius: 2.25rem !important;
                padding: 1.5rem !important;
            }
            #cd-special-offer-section .relative.z-10.flex.flex-col.md\:flex-row {
                margin-bottom: 1.5rem !important;
                align-items: flex-start !important;
            }
            #cd-special-offer-section h2 {
                font-size: 1.95rem !important;
                line-height: 0.98 !important;
                max-width: 8.5ch !important;
            }
            #cd-special-offer-section p {
                font-size: 0.88rem !important;
                line-height: 1.38 !important;
                max-width: 18.5rem !important;
            }
            #cd-special-offer-section .flex.gap-4 {
                width: 100% !important;
                justify-content: flex-end !important;
            }
            #cd-special-offer-section .w-16.h-16 {
                width: 3rem !important;
                height: 3rem !important;
            }
            #cd-photo-modal .cd-nav {
                width: 48px !important;
                height: 48px !important;
            }
            #cd-photo-modal .cd-prev {
                left: 12px !important;
            }
            #cd-photo-modal .cd-next {
                right: 12px !important;
            }
        }

        /* Fix text overflow in blog posts and all content areas */

        /* Right side (Info) */
        [role="dialog"] .lg\:w-1\/2.overflow-y-auto,
        [role="dialog"] .lg-w-1-2-p-8 {
            padding: 3rem !important;
            background: white !important;
        }

        /* Parents section in modal */
        [role="dialog"] img[src*="/parents/"] {
            object-fit: cover !important;
            border-radius: 16px !important;
        }

        /* Close button in React modal */
        [role="dialog"] button:has(svg[class*="close"]),
        [role="dialog"] button[aria-label*="close"],
        [role="dialog"] .absolute.top-4.right-4 button {
            background: rgba(248, 230, 225, 0.8) !important;
            color: #6E5A54 !important;
            border-radius: 50% !important;
            width: 48px !important;
            height: 48px !important;
            transition: all 0.2s !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            z-index: 60 !important;
            box-shadow: 0 4px 12px rgba(110, 90, 84, 0.1) !important;
        }
        [role="dialog"] button:hover {
            background: #EFA39A !important;
            color: white !important;
            transform: rotate(90deg) !important;
        }

        /* Fix text overflow in blog posts and all content areas */
        #root p, #root h1, #root h2, #root h3, #root h4, #root article, #root section {
            overflow-wrap: break-word;
            word-break: normal; /* Changed from break-word to normal */
            max-width: 100%;
        }
        /* Only break-all for truly long strings like URLs in paragraphs */
        #root p {
            word-break: break-word;
        }
        /* Ensure filters and buttons don't wrap character by character */
        #root button, #root [role="menu"], #root [role="listbox"], #root li {
            word-break: normal !important;
            overflow-wrap: normal !important;
            white-space: nowrap;
        }
        /* Allow wrap in lists but not break-word */
        #root li {
            white-space: normal;
        }
        #root img {
            max-width: 100%;
            height: auto;
        }
    </style>

<script type="importmap">
{
  "imports": {
    "react/": "https://esm.sh/react@^19.2.3/",
    "react": "https://esm.sh/react@^19.2.3",
    "react-dom/": "https://esm.sh/react-dom@^19.2.3/"
  }
}
</script>
  {{-- Patch removeChild to prevent React errors when vanilla JS modifies DOM --}}
  <script>
    // Save original removeChild
    window.__originalRemoveChild = Node.prototype.removeChild;
    Node.prototype.removeChild = function(child) {
      try {
        // Check if child is actually a child of this node
        if (child && this.contains(child)) {
          return window.__originalRemoveChild.call(this, child);
        }
        // Child not found - just return silently (don't throw)
        return child;
      } catch(e) {
        console.warn('Патч removeChild: предотвращена ошибка', e.message);
        return child;
      }
    };
    console.log('DOM-патчи применены');
  </script>
  <script>
    // Determine initial view: first from hash URL, then from sessionStorage
    var hashView = window.location.hash.replace('#', '');
    console.log('СТАРТ: хэш URL =', hashView);
    
    // Priority: hash URL > sessionStorage > default (home)
    if (hashView && hashView !== 'rewards') {
      // Direct access with hash - use it directly
      console.log('ПРЯМОЙ ДОСТУП С ХЭШОМ:', hashView);
      window.__cdTargetView = hashView;
      // Show root immediately for direct hash access
      var rootEl = document.getElementById('root');
      if (rootEl) rootEl.style.visibility = 'visible';
    } else {
      // Check sessionStorage (for navigation from rewards page)
      var cdTargetView = sessionStorage.getItem('cdTargetView');
      console.log('СТАРТ: sessionStorage cdTargetView =', cdTargetView);
      
      if (cdTargetView) {
        sessionStorage.removeItem('cdTargetView');
        console.log('ЗАГРУЗКА: Устанавливаем window.__cdTargetView из sessionStorage =', cdTargetView);
        window.__cdTargetView = cdTargetView;
        // Set hash for React to pick up
        window.location.hash = cdTargetView;
      } else {
        console.log('СТАРТ: целевой вид не задан, будет home');
      }
    }
    console.log('ПРОВЕРКА window.__cdTargetView =', window.__cdTargetView);
  </script>
  <script type="module" crossorigin src="/assets/index-zf1JtzCz.js?v=5"></script>
  <link rel="stylesheet" crossorigin href="/assets/index-BfN9iDYU.css">
</head>
<body class="antialiased">
    <div id="root" style="visibility:hidden"></div>
    <script>
      console.log('React bundle loaded (v3)');
      // Show root immediately for default home view (no hash)
      var rootEl = document.getElementById('root');
      if (rootEl && (!window.location.hash || window.location.hash === '#')) {
        rootEl.style.visibility = 'visible';
      }
    </script>

    {{-- Photo viewer: click kitten photo to open fullscreen with zoom --}}
    <style>
        /* Blog/knowledge-base 2-column layout fix */
        /* Force flex-row so posts list is on left and TOPICS on right */
        #blog > div,
        [id="blog"] ~ * .flex.flex-col.gap-16,
        section .flex.flex-col.gap-16,
        .flex.flex-col.gap-16:has(aside) {
            flex-direction: row !important;
        }
        /* TOPICS sidebar: fixed width on right, no sticky float */
        .flex.gap-16 > aside {
            width: 25% !important;
            flex-shrink: 0 !important;
            order: 9999 !important;
            position: relative !important;
            top: 0 !important;
        }
        /* Posts list: takes remaining width */
        .flex.gap-16 > div:has(h3) {
            flex: 1 !important;
        }

        /* Modal/fullscreen kitten photo — keep full cat visible */
        .kitten-img-contain img,
        #cd-photo-modal img[src*="/storage/kittens/"],
        [role="dialog"] img[src*="/storage/kittens/"] {
            object-fit: contain !important;
            background: #F8E6E1;
            cursor: zoom-in;
        }
        img[src*="/storage/kittens/parents/"] {
            object-fit: cover !important;
            cursor: zoom-in;
        }
        /* Homepage kitten cards must fit the module, not stretch it */
        #root div:not([role="dialog"]) [class*="aspect-[4/5]"][data-kitten-id] img,
        #root div:not([role="dialog"]) [class*="aspect-[4/5]"][data-name][data-price] img {
            width: 100% !important;
            height: 100% !important;
            object-fit: cover !important;
            object-position: center center !important;
        }
        #cd-photo-modal {
            position: fixed; inset: 0; z-index: 999999;
            background: rgba(0,0,0,0.92);
            display: none; align-items: center; justify-content: center;
            padding: 20px;
        }
        #cd-photo-modal.active { 
            display: flex; 
            animation: modal-fade-in 0.3s ease-out;
        }
        #cd-photo-modal img {
            max-width: 95vw; max-height: 92vh;
            object-fit: contain;
            border-radius: 14px;
            box-shadow: 0 30px 60px rgba(0,0,0,0.5);
            transition: transform 0.25s ease;
            animation: modal-slide-up 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        #cd-photo-modal .cd-close {
            position: absolute; top: 30px; right: 30px;
            background: rgba(255, 255, 255, 0.15);
            color: white; border: 0;
            width: 54px; height: 54px;
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            cursor: pointer; transition: all 0.2s;
            backdrop-filter: blur(8px);
            z-index: 1000000;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        }
        #cd-photo-modal .cd-close:hover { 
            background: rgba(239, 163, 154, 0.8); 
            transform: rotate(90deg);
        }
        #cd-photo-modal .cd-close svg { width: 28px; height: 28px; }
        #cd-photo-modal .cd-nav {
            position: absolute; top: 50%; transform: translateY(-50%);
            background: rgba(255,255,255,0.15); color: white; border: 0;
            width: 60px; height: 60px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; transition: all 0.2s;
            backdrop-filter: blur(4px);
        }
        #cd-photo-modal .cd-nav:hover { background: rgba(255,255,255,0.3); transform: translateY(-50%); }
        #cd-photo-modal .cd-prev { left: 30px; }
        #cd-photo-modal .cd-next { right: 30px; }
        #cd-photo-modal .cd-counter {
            position: absolute; bottom: 30px; left: 50%; transform: translateX(-50%);
            color: white; background: rgba(0,0,0,0.6);
            padding: 8px 20px; border-radius: 24px; font-size: 15px;
            backdrop-filter: blur(4px);
        }
        /* Modal Slider Navigation (Inside Info Modal) */
        .cd-modal-nav-btn {
            width: 44px; height: 44px; border-radius: 50%; 
            background: rgba(255, 255, 255, 0.9); 
            border: 1px solid #D6C1BA;
            cursor: pointer; pointer-events: auto; 
            display: flex; align-items: center; justify-content: center; 
            color: #6E5A54; box-shadow: 0 4px 15px rgba(110, 90, 84, 0.15); 
            transition: all 0.2s ease;
            backdrop-filter: blur(4px);
        }
        .cd-modal-nav-btn:hover { 
            background: #EFA39A; color: white; border-color: #EFA39A;
            transform: none;
            box-shadow: 0 6px 20px rgba(239, 163, 154, 0.3);
        }
        .cd-modal-nav-btn:active { transform: none; }
        .cd-modal-nav-btn svg { width: 24px; height: 24px; }
    </style>

    <div id="cd-photo-modal" onclick="if(event.target.id==='cd-photo-modal') cdClosePhoto()">
        <button class="cd-close" onclick="cdClosePhoto()" aria-label="Close">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
        <button class="cd-nav cd-prev" onclick="cdPrevPhoto()">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
        </button>
        <img id="cd-photo-modal-img" src="" alt="">
        <button class="cd-nav cd-next" onclick="cdNextPhoto()">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
        </button>
        <div class="cd-counter" id="cd-photo-counter">1 / 1</div>
    </div>

    <script>
        (function() {
            // Normalize all API calls to our Laravel root API
            function normalizeUrl(url) {
                if (typeof url !== 'string') return url;
                if (url.includes('cms/index.php') || url.includes('rest_route=')) {
                    try {
                        const u = new URL(url, window.location.origin);
                        let restRoute = u.searchParams.get('rest_route');
                        if (restRoute) {
                            u.searchParams.delete('rest_route');
                            let newPath = restRoute;
                            if (!newPath.startsWith('/wp-json/')) {
                                newPath = '/wp-json' + (newPath.startsWith('/') ? '' : '/') + newPath;
                            }
                            const search = u.search;
                            return newPath + search;
                        }
                    } catch(e) {}
                }
                if (url.startsWith('wp-json/')) return '/' + url;
                return url;
            }

            // Override Fetch
            const originalFetch = window.fetch;
            window.fetch = function() {
                if (arguments[0]) arguments[0] = normalizeUrl(arguments[0]);
                return originalFetch.apply(this, arguments);
            };

            // Override XMLHttpRequest
            const originalOpen = XMLHttpRequest.prototype.open;
            XMLHttpRequest.prototype.open = function() {
                if (arguments[1]) arguments[1] = normalizeUrl(arguments[1]);
                return originalOpen.apply(this, arguments);
            };

            // Expose kittens to window for the card fixer
            const originalFetchKittens = window.fetch;
            window.fetch = async function() {
                if (arguments[0]) arguments[0] = normalizeUrl(arguments[0]);
                const requestUrl = typeof arguments[0] === 'string'
                    ? arguments[0]
                    : (arguments[0] && arguments[0].url ? arguments[0].url : '');

                if (requestUrl.includes('/wp/v2/posts') && Array.isArray(window.__allKittens)) {
                    return new Response(JSON.stringify(window.__allKittens), {
                        status: 200,
                        headers: { 'Content-Type': 'application/json' }
                    });
                }

                if (requestUrl.includes('/wp/v2/pages')) {
                    const pageMatch = requestUrl.match(/\/wp\/v2\/pages\/(\d+)/);
                    const pageId = pageMatch ? pageMatch[1] : '37059';
                    const pagePayload = (window.__cdPreloadedPageIds && window.__cdPreloadedPageIds[pageId])
                        ? { ...window.__cdPreloadedPageIds[pageId], id: Number(pageId) }
                        : (window.__cdPreloadedPage ? { ...window.__cdPreloadedPage, id: Number(pageId) } : null);

                    if (pagePayload) {
                        return new Response(JSON.stringify(pageMatch ? pagePayload : [pagePayload]), {
                            status: 200,
                            headers: { 'Content-Type': 'application/json' }
                        });
                    }
                }

                const res = await originalFetchKittens.apply(this, arguments);
                if (requestUrl.includes('/wp/v2/posts')) {
                    const clone = res.clone();
                    clone.json().then(data => {
                        if (Array.isArray(data)) {
                            window.__allKittens = data;
                            cdScheduleMaintenance(20);
                        }
                    });
                }
                return res;
            };

            // Card Fixer: inject names and metadata into kitten cards when data is available
            function cdHydrateKittenCards() {
                document.querySelectorAll('[class*="aspect-[4/5]"]').forEach(function(card) {
                    if (!window.__allKittens) return;
                    if (card.dataset.kittenId && card.dataset.kittenUuid && card.dataset.name) {
                        card.dataset.cdCardReady = '1';
                        return;
                    }

                    var img = card.querySelector('img');
                    var imgPath = img && img.src ? urlPath(fullUrl(img.src)) : '';
                    var priceText = card.textContent.trim().replace(/[^\d]/g, '');
                    var kitten = null;

                    if (imgPath) {
                        kitten = window.__allKittens.find(function(k) {
                            var mainImg = k.featured_image_url || (k.acf && k.acf.foto) || '';
                            return urlPath(fullUrl(mainImg)) === imgPath;
                        });
                    }

                    if (!kitten && priceText) {
                        kitten = window.__allKittens.find(function(k) {
                            return k.acf && k.acf.czena && String(k.acf.czena) === priceText;
                        });
                    }

                    if (kitten) {
                        card.dataset.name = (kitten.acf && kitten.acf.imya) || (kitten.title && kitten.title.rendered) || '';
                        card.dataset.price = kitten.acf.czena_str || ('$' + kitten.acf.czena);
                        card.dataset.kittenId = String(kitten.id);
                        card.dataset.kittenUuid = cdKittenUuidFromKitten(kitten);
                        card.dataset.kittenStatus = (kitten.acf && kitten.acf.status) ? String(kitten.acf.status) : '';
                        card.dataset.kittenExclusive = kitten.acf && kitten.acf.exclusive ? '1' : '0';
                        card.dataset.kittenGender = (kitten.acf && kitten.acf.gender) ? String(kitten.acf.gender) : '';
                        card.dataset.cdCardReady = '1';
                        card.classList.add('cd-main-kitten-card');
                        if (img && img.src) {
                            card.style.setProperty('--cd-card-bg', 'url("' + String(img.src).replace(/"/g, '\\"') + '")');
                            var blurBg = card.querySelector('.cd-card-blur-bg');
                            if (!blurBg) {
                                blurBg = document.createElement('div');
                                blurBg.className = 'cd-card-blur-bg';
                                card.insertBefore(blurBg, card.firstChild);
                            }
                        }
                    }
                });
            }

            function cdFavoriteButtonSvg() {
                return '<svg viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>';
            }

            function cdGenderIconSvg(gender) {
                var isGirl = String(gender || '').toLowerCase() === 'female' || String(gender || '').toLowerCase() === 'girl';
                return isGirl
                    ? '<svg viewBox="0 0 24 24" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4.5"></circle><line x1="12" y1="12.5" x2="12" y2="20"></line><line x1="9" y1="17" x2="15" y2="17"></line></svg>'
                    : '<svg viewBox="0 0 24 24" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9.5" cy="14.5" r="4.5"></circle><path d="M13.2 10.8L19 5"></path><path d="M14.5 5H19v4.5"></path></svg>';
            }

            var cdFavoriteStoreKey = 'kitten_favorites';
            var cdLegacyFavoriteStoreKey = 'cd-favorite-kitten-ids';

            function cdKittenUuidFromKitten(kitten) {
                if (!kitten || kitten.id == null) return '';
                if (kitten.uuid) return String(kitten.uuid);
                if (kitten.acf && kitten.acf.uuid) return String(kitten.acf.uuid);
                var slug = kitten.slug ? String(kitten.slug).trim() : '';
                return slug ? ('kitten-' + String(kitten.id) + '-' + slug) : ('kitten-' + String(kitten.id));
            }

            function cdNormalizeFavoriteValue(value) {
                var str = String(value == null ? '' : value).trim();
                if (/^\d+$/.test(str)) return Number(str);
                return str;
            }

            function cdMigrateLegacyFavorites() {
                try {
                    var legacyRaw = localStorage.getItem(cdLegacyFavoriteStoreKey);
                    if (!legacyRaw) return;
                    var legacyIds = JSON.parse(legacyRaw);
                    if (!Array.isArray(legacyIds) || legacyIds.length === 0) {
                        localStorage.removeItem(cdLegacyFavoriteStoreKey);
                        return;
                    }
                    var currentIds = cdGetFavoriteIds();
                    var merged = Array.from(new Set(currentIds.concat(legacyIds.map(cdNormalizeFavoriteValue))));
                    localStorage.setItem(cdFavoriteStoreKey, JSON.stringify(merged));
                    localStorage.removeItem(cdLegacyFavoriteStoreKey);
                } catch (_) {}
            }

            function cdGetFavoriteIds() {
                try {
                    var raw = localStorage.getItem(cdFavoriteStoreKey);
                    var parsed = raw ? JSON.parse(raw) : [];
                    return Array.isArray(parsed) ? parsed.map(cdNormalizeFavoriteValue) : [];
                } catch (_) {
                    return [];
                }
            }

            function cdSetFavoriteIds(ids) {
                try {
                    localStorage.setItem(cdFavoriteStoreKey, JSON.stringify(Array.from(new Set((ids || []).map(cdNormalizeFavoriteValue)))));
                } catch (_) {}
            }

            function cdIsFavoriteId(kittenId) {
                if (!kittenId) return false;
                var normalizedId = cdNormalizeFavoriteValue(kittenId);
                return cdGetFavoriteIds().includes(normalizedId);
            }

            function cdToggleFavoriteIdInStore(kittenId) {
                if (!kittenId) return false;
                var normalizedId = cdNormalizeFavoriteValue(kittenId);
                var ids = cdGetFavoriteIds();
                var exists = ids.includes(normalizedId);
                var nextIds = exists ? ids.filter(function(x) { return x !== normalizedId; }) : ids.concat([normalizedId]);
                cdSetFavoriteIds(nextIds);
                return !exists;
            }

            function cdApplyFavoriteState(btn, kittenId) {
                if (!btn || !kittenId) return;
                var active = cdIsFavoriteId(kittenId);
                btn.classList.toggle('is-active', active);
                btn.setAttribute('aria-pressed', active ? 'true' : 'false');
            }

            function cdSyncFavoriteButtons(kittenId) {
                if (!kittenId) return;
                document.querySelectorAll('.cd-favorite-btn[data-kitten-id="' + String(kittenId) + '"]').forEach(function(btn) {
                    cdApplyFavoriteState(btn, kittenId);
                });
            }

            function cdSetFavoriteButtonsState(kittenId, active) {
                if (!kittenId) return;
                document.querySelectorAll('.cd-favorite-btn[data-kitten-id="' + String(kittenId) + '"]').forEach(function(btn) {
                    btn.classList.toggle('is-active', !!active);
                    btn.setAttribute('aria-pressed', active ? 'true' : 'false');
                });
            }

            function cdHandleFavoriteToggle(kittenId) {
                if (!kittenId) return false;
                var isActive = cdToggleFavoriteIdInStore(kittenId);
                
                // Immediately update all buttons for this kitten
                var buttons = document.querySelectorAll('.cd-favorite-btn[data-kitten-id="' + kittenId + '"]');
                buttons.forEach(function(btn) {
                    if (isActive) {
                        btn.classList.add('is-active');
                    } else {
                        btn.classList.remove('is-active');
                    }
                });

                // Force re-run maintenance to ensure buttons are properly initialized
                setTimeout(function() {
                    cdRunMaintenance();
                }, 50);

                if (window.__cdCurrentView === 'rewards' || window.location.hash === '#rewards') {
                    setTimeout(cdRenderRewardsPage, 0);
                }

                try {
                    window.dispatchEvent(new CustomEvent('cd:favorites-changed', {
                        detail: { kittenId: String(kittenId), active: isActive }
                    }));
                } catch (_) {}

                return isActive;
            }

            function cdKittenIdFromCard(card) {
                if (!card) return '';
                if (card.dataset && card.dataset.kittenId) return String(card.dataset.kittenId);
                var kitten = cdFindKittenFromTrigger(card);
                if (kitten && kitten.id != null) {
                    card.dataset.kittenId = String(kitten.id);
                    card.dataset.kittenUuid = cdKittenUuidFromKitten(kitten);
                    return String(kitten.id);
                }
                return '';
            }

            function cdGetReactFavoriteButtonByKey(kittenId, kittenUuid) {
                if (!kittenId && !kittenUuid) return null;
                var buttons = Array.from(document.querySelectorAll('#root button'));
                for (var i = 0; i < buttons.length; i++) {
                    var btn = buttons[i];
                    if (btn.closest('#cd-special-offer-section')) continue;
                    var card = btn.closest('[data-kitten-id], [data-name][data-price], [class*="aspect-[4/5]"]');
                    if (!card) continue;
                    var id = card.dataset.kittenId || cdKittenIdFromCard(card);
                    var uuid = card.dataset.kittenUuid || btn.dataset.kittenUuid || '';
                    if (kittenUuid && uuid && String(uuid) !== String(kittenUuid)) continue;
                    if (!kittenUuid && String(id) !== String(kittenId)) continue;
                    var svg = btn.querySelector('svg polygon');
                    if (!svg) continue;
                    return btn;
                }
                return null;
            }

            function cdNormalizeViewText(text) {
                return String(text || '')
                    .replace(/\s+/g, ' ')
                    .trim()
                    .toLowerCase();
            }

            function cdMapViewKeyFromText(text) {
                var normalized = cdNormalizeViewText(text);
                if (!normalized) return '';
                if (normalized === 'our kittens') return 'home';
                if (normalized === 'adoption') return 'adoption';
                if (normalized === 'faq') return 'faq';
                if (normalized === 'about us') return 'about';
                if (normalized === 'contacts' || normalized === 'contact us') return 'contacts';
                if (normalized === 'blog') return 'blog';
                if (normalized === 'testimonials') return 'testimonials';
                if (normalized === 'rewards') return 'rewards';
                if (normalized === 'my favorites') return 'favorites';
                return '';
            }

            function cdMapViewKeyToFooterLabel(view) {
                var normalized = cdNormalizeViewText(view);
                if (!normalized) return '';
                if (normalized === 'home') return 'our kittens';
                if (normalized === 'adoption') return 'adoption';
                if (normalized === 'faq') return 'faq';
                if (normalized === 'about') return 'about us';
                if (normalized === 'contacts') return 'contacts';
                if (normalized === 'blog') return 'blog';
                if (normalized === 'testimonials') return 'testimonials';
                if (normalized === 'rewards') return 'rewards';
                return '';
            }

            function cdIsFooterNavLink(node) {
                if (!node) return false;
                var label = cdMapViewKeyFromText(node.textContent || '');
                if (!label) return false;
                var block = node.closest('footer, section, div');
                if (!block) return false;
                var containerText = cdNormalizeViewText(block.textContent || '');
                return containerText.includes('sections') || containerText.includes('support');
            }

function cdIsHeaderNavLink(node) {
                if (!node) return false;
                var text = cdNormalizeViewText(node.textContent || '');
                var ariaLabel = (node.getAttribute('aria-label') || '').toLowerCase();
                
                // Check if it's the favorites button (star icon)
                if (ariaLabel === 'my favorites' || (text === '' && node.querySelector && node.querySelector('svg'))) {
                    var header = node.closest('header, [role="banner"]');
                    console.log('cdIsHeaderNavLink: found favorites, header:', !!header);
                    return !!header;
                }
                
                var label = cdMapViewKeyFromText(node.textContent || '');
                if (!label) return false;
                if (text === 'contact us' || text === 'contacts') return false;
                // Check if button is inside header (with or without nav wrapper)
                // Also check if it's a direct child of header navigation
                var header = node.closest('header, [role="banner"]');
                if (header) return true;
                // Fallback: check if it's in the main navigation area
                return !!node.closest('nav, [role="navigation"]');
            }

            function cdIsAccentColor(colorValue) {
                var value = String(colorValue || '').replace(/\s+/g, '').toLowerCase();
                return value === 'rgb(239,163,154)' || value === 'rgba(239,163,154,1)';
            }

            function cdInferCurrentViewFromHeader() {
                var headerNodes = Array.from(document.querySelectorAll('#root header nav button, #root header nav a'));
                for (var i = 0; i < headerNodes.length; i++) {
                    var node = headerNodes[i];
                    if (!cdIsHeaderNavLink(node)) continue;
                    var label = cdMapViewKeyFromText(node.textContent || '');
                    if (!label) continue;
                    var style = window.getComputedStyle(node);
                    if (cdIsAccentColor(style.color) || cdIsAccentColor(style.borderBottomColor)) {
                        return label;
                    }
                }
                return '';
            }

            function cdFindFooterNavLinks() {
                return Array.from(document.querySelectorAll('#root a, #root button')).filter(function(node) {
                    return cdIsFooterNavLink(node);
                });
            }

            function cdSyncFooterActiveLinks() {
                var currentView = window.__cdCurrentView || cdInferCurrentViewFromHeader() || 'home';
                var activeLabel = cdMapViewKeyToFooterLabel(currentView);
                if (!activeLabel) return;

                cdFindFooterNavLinks().forEach(function(node) {
                    var nodeLabel = cdNormalizeViewText(node.textContent || '');
                    var isActive = nodeLabel === activeLabel;
                    node.classList.toggle('cd-footer-link-active', isActive);
                    node.classList.remove('text-[#EFA39A]');
                    node.style.color = isActive ? '#EFA39A' : 'rgba(214, 193, 186, 0.8)';
                    node.style.opacity = '1';
                    if (isActive) {
                        node.setAttribute('aria-current', 'page');
                    } else {
                        node.removeAttribute('aria-current');
                    }
                });
            }

            function cdNormalizeRewardItem(item, index) {
                var imageUrl = '';
                if (typeof item === 'string') {
                    imageUrl = item;
                } else if (item && typeof item === 'object') {
                    imageUrl = item.imageUrl || item.image || item.url || item.src || '';
                }
                imageUrl = fullUrl(imageUrl || '');
                if (!imageUrl) return null;
                return {
                    id: (item && item.id) ? String(item.id) : 'reward-' + (index + 1),
                    imageUrl: imageUrl,
                };
            }

            async function cdFetchRewardsData() {
                if (Array.isArray(window.__cdRewardsData)) return window.__cdRewardsData;

                try {
                    var response = await fetch('/wp-json/wp/v2/pages/37059');
                    var page = await response.json();
                    var rewards = (((page || {}).acf || {}).rewards) || (((page || {}).acf || {}).rewards_certificates) || [];
                    window.__cdRewardsData = (Array.isArray(rewards) ? rewards : [])
                        .map(cdNormalizeRewardItem)
                        .filter(Boolean);
                } catch (error) {
                    console.error('[CD] Rewards fetch failed:', error);
                    window.__cdRewardsData = [];
                }

                return window.__cdRewardsData;
            }

            async function cdFetchFaqData(force) {
                if (!force && Array.isArray(window.__cdFaqData)) return window.__cdFaqData;
                try {
                    var response = await fetch('/wp-json/wp/v2/pages/37059');
                    var page = await response.json();
                    var faq = (((page || {}).acf || {}).faq) || (((page || {}).acf || {}).faq_items) || [];
                    window.__cdFaqData = (Array.isArray(faq) ? faq : []).filter(function(item) {
                        return item && item.question && item.answer;
                    });
                } catch (error) {
                    console.error('[CD] FAQ fetch failed:', error);
                    window.__cdFaqData = [];
                }

                return window.__cdFaqData;
            }

            function cdBuildRewardsMarkup(items) {
                var cards = items.map(function(item) {
                    return `
                        <button type="button" class="cd-reward-card" data-reward-image="${item.imageUrl}">
                            <div class="bg-white rounded-[2rem] border border-[#EADDD7] p-4 shadow-[0_24px_55px_rgba(97,73,65,0.12)] h-full">
                                <div class="aspect-[4/3] rounded-[1.4rem] overflow-hidden bg-white flex items-center justify-center">
                                    <img src="${item.imageUrl}" alt="Certificate ${item.id}">
                                </div>
                            </div>
                        </button>
                    `;
                }).join('');

                if (!cards) {
                    cards = `
                        <div class="col-span-full bg-white/50 border border-white/70 rounded-[2.5rem] px-8 py-16 text-center text-[#8E7B74] shadow-sm">
                            No certificates uploaded yet.
                        </div>
                    `;
                }

                return `
                    <section id="cd-rewards-page" class="min-h-screen pt-20 md:pt-28 pb-24">
                        <div class="max-w-[1600px] mx-auto px-6 lg:px-8">
                            <div class="text-center mb-14 md:mb-20">
                                <div class="inline-flex items-center gap-4 mb-5">
                                    <span class="h-px w-10 bg-[#D8B39D]"></span>
                                    <span class="text-[11px] font-bold uppercase tracking-[0.35em] text-[#C89A8C]">Recognition</span>
                                    <span class="h-px w-10 bg-[#D8B39D]"></span>
                                </div>
                                <h1 class="text-4xl md:text-6xl font-bold tracking-tight text-[#312A25] mb-5">Our Rewards</h1>
                                <p class="max-w-2xl mx-auto text-[#8A7770] text-sm md:text-base leading-relaxed font-medium">
                                    Certificates and awards confirming high standards of breeding and recognition by professional associations.
                                </p>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6 md:gap-8">
                                ${cards}
                            </div>
                        </div>
                    </section>
                `;
            }

            function cdBuildFaqMarkup(items) {
                var list = items.map(function(item, index) {
                    return `
                        <article class="cd-faq-item${index === 0 ? ' is-open' : ''}">
                            <button type="button" class="cd-faq-toggle" aria-expanded="${index === 0 ? 'true' : 'false'}">
                                <span>${item.question}</span>
                                <span class="cd-faq-icon">${index === 0 ? '−' : '+'}</span>
                            </button>
                            <div class="cd-faq-answer">${item.answer}</div>
                        </article>
                    `;
                }).join('');

                if (!list) {
                    list = `
                        <div class="bg-white/50 border border-white/70 rounded-[2.5rem] px-8 py-16 text-center text-[#8E7B74] shadow-sm">
                            No FAQ items added yet.
                        </div>
                    `;
                }

                return `
                    <section id="cd-faq-page" class="min-h-screen pt-20 md:pt-28 pb-24">
                        <div class="max-w-[1280px] mx-auto px-6 lg:px-8">
                            <div class="text-center mb-14 md:mb-20">
                                <div class="inline-flex items-center gap-4 mb-5">
                                    <span class="h-px w-10 bg-[#D8B39D]"></span>
                                    <span class="text-[11px] font-bold uppercase tracking-[0.35em] text-[#C89A8C]">Common Questions</span>
                                    <span class="h-px w-10 bg-[#D8B39D]"></span>
                                </div>
                                <h1 class="text-4xl md:text-6xl font-bold tracking-tight text-[#312A25] mb-5">FAQ</h1>
                                <p class="max-w-2xl mx-auto text-[#8A7770] text-sm md:text-base leading-relaxed font-medium">
                                    Everything you need to know before bringing a little Scottish friend home.
                                </p>
                            </div>
                            <div class="space-y-5">
                                ${list}
                            </div>
                        </div>
                    </section>
                `;
            }

            function cdCloseRewardLightbox() {
                var overlay = document.getElementById('cd-reward-lightbox');
                if (overlay) overlay.remove();
                document.body.style.overflow = '';
            }

            function cdOpenRewardLightbox(src) {
                if (!src) return;
                cdCloseRewardLightbox();
                var overlay = document.createElement('div');
                overlay.id = 'cd-reward-lightbox';
                overlay.innerHTML = '<img src="' + src + '" alt="Certificate preview">';
                overlay.addEventListener('click', function(e) {
                    if (e.target === overlay) cdCloseRewardLightbox();
                });
                document.addEventListener('keydown', function rewardEscHandler(e) {
                    if (e.key !== 'Escape') return;
                    document.removeEventListener('keydown', rewardEscHandler, true);
                    cdCloseRewardLightbox();
                }, true);
                document.body.appendChild(overlay);
                document.body.style.overflow = 'hidden';
            }

            function cdBindRewardsPage() {
                var page = document.getElementById('cd-rewards-page');
                if (!page) return;

                page.querySelectorAll('.cd-reward-card[data-reward-image]').forEach(function(card) {
                    card.addEventListener('click', function() {
                        cdOpenRewardLightbox(this.dataset.rewardImage || '');
                    });
                });
            }

            function cdCaptureMainSnapshot() {
                var main = document.querySelector('#root main');
                if (!main) return;
                if (!window.__cdMainSnapshot || window.__cdCurrentView !== 'rewards') {
                    window.__cdMainSnapshot = main.innerHTML;
                }
            }

            function cdRestoreFromRewardsView() {
                var main = document.querySelector('#root main');
                if (main && window.__cdMainSnapshot) {
                    main.innerHTML = window.__cdMainSnapshot;
                    window.__cdMainSnapshot = null;
                }
                window.__cdCurrentView = null;
                history.replaceState(null, '', window.location.pathname + window.location.search);
            }

            function cdBindFaqPage() {
                var page = document.getElementById('cd-faq-page');
                if (!page) return;

                page.querySelectorAll('.cd-faq-toggle').forEach(function(btn) {
                    btn.addEventListener('click', function() {
                        var item = this.closest('.cd-faq-item');
                        if (!item) return;
                        var willOpen = !item.classList.contains('is-open');
                        page.querySelectorAll('.cd-faq-item').forEach(function(node) {
                            node.classList.remove('is-open');
                            var toggle = node.querySelector('.cd-faq-toggle');
                            var icon = node.querySelector('.cd-faq-icon');
                            if (toggle) toggle.setAttribute('aria-expanded', 'false');
                            if (icon) icon.textContent = '+';
                        });
                        if (willOpen) {
                            item.classList.add('is-open');
                            this.setAttribute('aria-expanded', 'true');
                            var icon = item.querySelector('.cd-faq-icon');
                            if (icon) icon.textContent = '−';
                        }
                    });
                });
            }

            function cdBuildNativeFaqItems(items) {
                return items.map(function(item, index) {
                    var isOpen = index === 0;
                    return `
                        <div class="bg-white border transition-all duration-500 rounded-[2.5rem] overflow-hidden ${isOpen ? 'border-[#EFA39A] shadow-xl' : 'border-[#D6C1BA]/30 shadow-sm hover:border-[#D6C1BA]'}">
                            <button class="w-full flex items-center justify-between px-8 py-4 md:px-12 md:py-7 text-left group" type="button" aria-expanded="${isOpen ? 'true' : 'false'}">
                                <span class="text-base md:text-[1.2rem] font-bold transition-colors duration-300 ${isOpen ? 'text-[#EFA39A]' : 'text-[#6E5A54]'}">${item.question}</span>
                                <div class="w-12 h-12 rounded-full border flex items-center justify-center transition-all duration-500 shrink-0 ml-6 ${isOpen ? 'bg-[#EFA39A] border-[#EFA39A] text-white rotate-180' : 'border-[#D6C1BA] text-[#6E5A54] group-hover:bg-[#F8E6E1]'}">
                                    <span class="text-2xl font-light">${isOpen ? '−' : '+'}</span>
                                </div>
                            </button>
                            <div class="transition-all duration-500 ease-in-out ${isOpen ? 'max-h-[800px] opacity-100' : 'max-h-0 opacity-0'}">
                                <div class="px-8 pb-10 md:px-12 md:pb-14 border-t border-[#D6C1BA]/10 pt-8">
                                    <p class="text-[#6E5A54] text-[0.9rem] md:text-base leading-relaxed font-medium">${item.answer}</p>
                                </div>
                            </div>
                        </div>
                    `;
                }).join('');
            }

            function cdBindNativeFaqAccordion(container) {
                if (!container) return;
                var items = Array.from(container.children);
                items.forEach(function(item) {
                    var button = item.querySelector('button');
                    if (!button) return;
                    button.addEventListener('click', function() {
                        var shouldOpen = !item.className.includes('border-[#EFA39A]');
                        items.forEach(function(node) {
                            var btn = node.querySelector('button');
                            var title = btn && btn.querySelector('span');
                            var iconWrap = btn && btn.querySelector('div');
                            var icon = iconWrap && iconWrap.querySelector('span');
                            var body = node.querySelector('.transition-all.duration-500.ease-in-out');
                            node.className = 'bg-white border transition-all duration-500 rounded-[2.5rem] overflow-hidden border-[#D6C1BA]/30 shadow-sm hover:border-[#D6C1BA]';
                            if (title) title.className = 'text-base md:text-[1.2rem] font-bold transition-colors duration-300 text-[#6E5A54]';
                            if (iconWrap) iconWrap.className = 'w-12 h-12 rounded-full border flex items-center justify-center transition-all duration-500 shrink-0 ml-6 border-[#D6C1BA] text-[#6E5A54] group-hover:bg-[#F8E6E1]';
                            if (icon) icon.textContent = '+';
                            if (body) body.className = 'transition-all duration-500 ease-in-out max-h-0 opacity-0';
                            if (btn) btn.setAttribute('aria-expanded', 'false');
                        });
                        if (!shouldOpen) return;
                        var title = button.querySelector('span');
                        var iconWrap = button.querySelector('div');
                        var icon = iconWrap && iconWrap.querySelector('span');
                        var body = item.querySelector('.transition-all.duration-500.ease-in-out');
                        item.className = 'bg-white border transition-all duration-500 rounded-[2.5rem] overflow-hidden border-[#EFA39A] shadow-xl';
                        if (title) title.className = 'text-base md:text-[1.2rem] font-bold transition-colors duration-300 text-[#EFA39A]';
                        if (iconWrap) iconWrap.className = 'w-12 h-12 rounded-full border flex items-center justify-center transition-all duration-500 shrink-0 ml-6 bg-[#EFA39A] border-[#EFA39A] text-white rotate-180';
                        if (icon) icon.textContent = '−';
                        if (body) body.className = 'transition-all duration-500 ease-in-out max-h-[800px] opacity-100';
                        button.setAttribute('aria-expanded', 'true');
                    });
                });
            }

            async function cdPatchReactFaqPage() {
                var faq = await cdFetchFaqData(true);
                if (!Array.isArray(faq) || !faq.length) return;

                var container = Array.from(document.querySelectorAll('#root main div')).find(function(node) {
                    var cls = String(node.className || '');
                    if (!(cls.includes('space-y-6') && cls.includes('max-w-5xl') && node.querySelector('button'))) {
                        return false;
                    }
                    var surroundingText = cdNormalizeViewText((node.parentElement && node.parentElement.textContent) || node.textContent || '');
                    return surroundingText.includes('still have questions') || surroundingText.includes('common questions');
                });

                if (!container) return;
                var firstQuestion = container.querySelector('button span');
                var expectedFirst = cdNormalizeViewText((faq[0] && faq[0].question) || '');
                var currentFirst = cdNormalizeViewText((firstQuestion && firstQuestion.textContent) || '');
                if (container.dataset.cdFaqPatched === '1' && currentFirst === expectedFirst && container.children.length === faq.length) {
                    return;
                }
                container.innerHTML = cdBuildNativeFaqItems(faq);
                container.dataset.cdFaqPatched = '1';
                cdBindNativeFaqAccordion(container);
            }

            async function cdRenderRewardsPage() {
                var main = document.querySelector('#root main');
                if (!main) return;
                cdCaptureMainSnapshot();
                var rewards = await cdFetchRewardsData();
                if (window.__cdCurrentView !== 'rewards' && window.location.hash !== '#rewards') return;
                main.innerHTML = cdBuildRewardsMarkup(rewards);
                cdBindRewardsPage();
                window.scrollTo({ top: 0, behavior: 'smooth' });
                cdSyncFooterActiveLinks();
            }

            async function cdRenderFaqPage() {
                var main = document.querySelector('#root main');
                if (!main) return;
                var faq = await cdFetchFaqData(true);
                if (window.__cdCurrentView !== 'faq') return;
                main.innerHTML = cdBuildFaqMarkup(faq);
                cdBindFaqPage();
                window.scrollTo({ top: 0, behavior: 'smooth' });
                cdSyncFooterActiveLinks();
            }

// Global flag to prevent React from overwriting favorites page
            window.__favoritesActive = false;
            
            // Protect favorites content from React overwrites
            var cdFavoritesObserver = new MutationObserver(function(mutations) {
                if (!window.__favoritesActive) return;
                
                mutations.forEach(function(mutation) {
                    if (mutation.type === 'childList') {
                        // Check if our favorites content is being removed
                        var root = document.getElementById('root');
                        if (root && !root.querySelector('[data-favorites-page]')) {
                            // React is trying to overwrite - restore our content
                            console.log('React tried to overwrite favorites - restoring!');
                            setTimeout(cdRenderFavoritesPage, 10);
                        }
                    }
                });
            });
            
            // Start observing when favorites is active
            function cdStartFavoritesProtection() {
                var root = document.getElementById('root');
                if (root) {
                    cdFavoritesObserver.observe(root, { childList: true, subtree: true });
                }
            }
            
            function cdStopFavoritesProtection() {
                cdFavoritesObserver.disconnect();
            }
                var root = document.getElementById('root');
                if (!root) return;
                
                var favoriteIds = cdGetFavoriteIds();
                console.log('cdRenderFavoritesPage: favoriteIds:', favoriteIds);
                
                // Clear everything and build full page structure
                root.innerHTML = '';
                
                // Re-create main element
                var main = document.createElement('main');
                root.appendChild(main);
                
                if (!favoriteIds || favoriteIds.length === 0) {
                    main.innerHTML = '<div class="min-h-screen pt-20 md:pt-28 pb-24 flex items-center justify-center"><div class="text-center text-[#8E7B74]"><p class="text-2xl mb-4">No favorites yet</p><p>Click on the star icon on any kitten to add it to your favorites</p></div></div>';
                } else {
                    var allKittens = window.__allKittens || [];
                    var favoriteKittens = allKittens.filter(function(k) {
                        return favoriteIds.includes(k.id) || favoriteIds.includes(String(k.id));
                    });
                    
                    if (favoriteKittens.length > 0) {
                        var cardsHtml = favoriteKittens.map(function(k) {
                            var img = k.featured_image_url || (k.acf && k.acf.photo) || '';
                            var name = (k.acf && k.acf.imya) || (k.title && k.title.rendered) || 'Kitten';
                            var kittenId = k.id;
                            return '<div class="bg-white rounded-2xl p-4 shadow-lg relative"><button type="button" class="cd-favorite-btn is-active absolute top-2 right-2 w-8 h-8 flex items-center justify-center rounded-full bg-white shadow-md" data-kitten-id="' + kittenId + '" onclick="cdHandleFavoriteToggle(' + kittenId + '); setTimeout(cdRenderFavoritesPage, 100);"><svg viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5" style="color:#FFD700; fill:#FFD700; filter:drop-shadow(0 1px 2px rgba(0,0,0,0.3));"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg></button><img src="' + img + '" alt="' + name + '" class="w-48 h-48 object-cover rounded-xl"><p class="text-center mt-2 font-bold">' + name + '</p></div>';
                        }).join('');
                        main.innerHTML = '<div class="min-h-screen pt-20 md:pt-28 pb-24"><div class="max-w-[1600px] mx-auto px-6"><h1 class="text-4xl md:text-6xl font-bold text-center mb-8">My Favorites</h1><div class="flex flex-wrap gap-4 justify-center">' + cardsHtml + '</div></div></div>';
                    } else {
                        main.innerHTML = '<div class="min-h-screen pt-20 md:pt-28 pb-24"><div class="max-w-[1600px] mx-auto px-6"><h1 class="text-4xl md:text-6xl font-bold text-center mb-8">My Favorites</h1><p class="text-center text-[#8A7770]">Your favorite kittens: ' + favoriteIds.join(', ') + '</p></div></div>';
                    }
                }
                
                // Make sure root is visible
                root.style.visibility = 'visible';
            }
                
                if (!main) {
                    console.log('cdRenderFavoritesPage: main still not found');
                    return;
                }
                
                var favoriteIds = cdGetFavoriteIds();
                console.log('cdRenderFavoritesPage: favoriteIds:', favoriteIds);
                
                var content = '';
                if (!favoriteIds || favoriteIds.length === 0) {
                    content = '<div class="min-h-screen pt-20 md:pt-28 pb-24 flex items-center justify-center"><div class="text-center text-[#8E7B74]"><p class="text-2xl mb-4">No favorites yet</p><p>Click on the star icon on any kitten to add it to your favorites</p></div></div>';
                } else {
                    // Try to find the actual kittens
                    var allKittens = window.__allKittens || [];
                    console.log('cdRenderFavoritesPage: allKittens count:', allKittens.length);
                    
                    var favoriteKittens = allKittens.filter(function(k) {
                        return favoriteIds.includes(k.id) || favoriteIds.includes(String(k.id));
                    });
                    console.log('cdRenderFavoritesPage: favoriteKittens count:', favoriteKittens.length);
                    
                    if (favoriteKittens.length > 0) {
                        var cardsHtml = favoriteKittens.map(function(k) {
                            var img = k.featured_image_url || (k.acf && k.acf.photo) || '';
                            var name = (k.acf && k.acf.imya) || (k.title && k.title.rendered) || 'Kitten';
                            var kittenId = k.id;
                            return '<div class="bg-white rounded-2xl p-4 shadow-lg relative"><button type="button" class="cd-favorite-btn is-active absolute top-2 right-2 w-10 h-10 flex items-center justify-center rounded-full bg-pink-50 shadow-md border-2 border-pink-200" data-kitten-id="' + kittenId + '" onclick="cdHandleFavoriteToggle(' + kittenId + '); setTimeout(cdRenderFavoritesPage, 100);"><svg viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6" style="color:#EFA39A; fill:#EFA39A;"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg></button><img src="' + img + '" alt="' + name + '" class="w-48 h-48 object-cover rounded-xl"><p class="text-center mt-2 font-bold">' + name + '</p></div>';
                        }).join('');
                        content = '<div class="min-h-screen pt-20 md:pt-28 pb-24"><div class="max-w-[1600px] mx-auto px-6"><h1 class="text-4xl md:text-6xl font-bold text-center mb-8">My Favorites</h1><div class="flex flex-wrap gap-4 justify-center">' + cardsHtml + '</div></div></div>';
                    } else {
                        content = '<div class="min-h-screen pt-20 md:pt-28 pb-24"><div class="max-w-[1600px] mx-auto px-6"><h1 class="text-4xl md:text-6xl font-bold text-center mb-8">My Favorites</h1><p class="text-center text-[#8A7770]">Your favorite kittens: ' + favoriteIds.join(', ') + '</p></div></div>';
                    }
                }
                
                // Update main content only
                main.innerHTML = content;
            }

            function cdEnsureRewardsNavLink() {
                var sectionLists = Array.from(document.querySelectorAll('#root ul'));
                var sectionsList = sectionLists.find(function(list) {
                    var text = cdNormalizeViewText(list.textContent || '');
                    return text.includes('our kittens') && text.includes('blog') && text.includes('about us');
                });
                if (!sectionsList) return;

                var hasRewards = Array.from(sectionsList.querySelectorAll('button, a')).some(function(node) {
                    return cdNormalizeViewText(node.textContent || '') === 'rewards';
                });

                if (hasRewards) return;

                var li = document.createElement('li');
                li.innerHTML = '<button type="button" class="hover:text-white transition-colors text-left">Rewards</button>';
                sectionsList.appendChild(li);
            }

            window.__cdLeadSource = {
                source: '',
                kittenName: '',
            };

            function cdSetLeadSource(source, kittenName) {
                window.__cdLeadSource = {
                    source: String(source || '').trim(),
                    kittenName: String(kittenName || '').trim(),
                };
                cdHydrateLeadSourceFields();
            }

            function cdGetLeadSourceText() {
                var data = window.__cdLeadSource || {};
                return data.source || 'Website';
            }

            function cdGetLeadKittenName() {
                var data = window.__cdLeadSource || {};
                return data.kittenName || '';
            }

            function cdInferLeadSourceFromNode(node) {
                if (!node) return 'Website';
                if (node.closest('#cd-special-offer-section')) return 'Special Offer';

                var upcomingSection = Array.from(document.querySelectorAll('#root section, #root div')).find(function(el) {
                    var txt = (el.textContent || '').toLowerCase();
                    return txt.includes('upcoming litter')
                        || txt.includes('estimated month')
                        || txt.includes('get early access');
                });
                if (upcomingSection && upcomingSection.contains(node)) return 'Upcoming Litter';

                var ourKittens = Array.from(document.querySelectorAll('#root h1, #root h2, #root h3')).find(function(el) {
                    var txt = (el.textContent || '').toLowerCase().trim();
                    return txt === 'our kittens';
                });
                if (ourKittens && (ourKittens.parentElement && ourKittens.parentElement.contains(node))) return 'Our Kittens';

                var trigger = node.closest('button, a');
                var txt = ((trigger && trigger.textContent) || '').trim();
                if (txt) return txt;

                return 'Website';
            }

            function cdHydrateLeadSourceFields() {
                document.querySelectorAll('form').forEach(function(form) {
                    if (form.closest('#cd-photo-modal')) return;
                    var sourceText = cdGetLeadSourceText();
                    var kittenName = cdGetLeadKittenName();

                    var sourceInput = form.querySelector('input[name="lead_source"]');
                    if (!sourceInput) {
                        sourceInput = document.createElement('input');
                        sourceInput.type = 'hidden';
                        sourceInput.name = 'lead_source';
                        form.appendChild(sourceInput);
                    }
                    sourceInput.value = sourceText;

                    var kittenInput = form.querySelector('input[name="kitten_name"]');
                    if (!kittenInput) {
                        kittenInput = document.createElement('input');
                        kittenInput.type = 'hidden';
                        kittenInput.name = 'kitten_name';
                        form.appendChild(kittenInput);
                    }
                    kittenInput.value = kittenName;
                });
            }

            function cdEnsureKittenCardMeta(card, kittenId) {
                if (!card || card.closest('#cd-special-offer-section')) return;
                var kitten = (window.__allKittens || []).find(function(k) { return String(k.id) === String(kittenId); });
                if (!kitten) return;
                card.dataset.cdCardReady = '1';
                card.style.position = 'relative';
                card.classList.add('cd-main-kitten-card');
                var cardImg = card.querySelector('img');
                if (cardImg && cardImg.src) {
                    card.style.setProperty('--cd-card-bg', 'url("' + String(cardImg.src).replace(/"/g, '\\"') + '")');
                    var blurBg = card.querySelector('.cd-card-blur-bg');
                    if (!blurBg) {
                        blurBg = document.createElement('div');
                        blurBg.className = 'cd-card-blur-bg';
                        card.insertBefore(blurBg, card.firstChild);
                    }
                }

                var gender = (kitten.acf && kitten.acf.gender) ? String(kitten.acf.gender) : 'Male';
                var isExclusive = !!(kitten.acf && kitten.acf.exclusive);
                card.dataset.kittenStatus = (kitten.acf && kitten.acf.status) ? String(kitten.acf.status) : '';
                card.dataset.kittenExclusive = isExclusive ? '1' : '0';
                card.dataset.kittenGender = gender;

                var genderNode = card.querySelector('.cd-litter-gender');
                if (!genderNode) {
                    genderNode = document.createElement('div');
                    genderNode.className = 'cd-litter-gender';
                    card.appendChild(genderNode);
                }
                genderNode.innerHTML = cdGenderIconSvg(gender);
                genderNode.style.color = String(gender).toLowerCase() === 'female' ? '#E56B83' : '#7C6057';
                genderNode.style.cssText = [
                    'position:absolute',
                    'left:15px',
                    'bottom:15px',
                    'top:auto',
                    'z-index:22',
                    'width:32px',
                    'height:32px',
                    'border-radius:9999px',
                    'display:flex',
                    'align-items:center',
                    'justify-content:center',
                    'background:rgba(255,255,255,0.88)',
                    'border:1px solid rgba(214,193,186,0.65)',
                    'box-shadow:0 8px 20px rgba(72,48,42,0.12)',
                    'backdrop-filter:blur(10px)',
                    '-webkit-backdrop-filter:blur(10px)',
                    'pointer-events:none'
                ].join(';');
                var genderSvg = genderNode.querySelector('svg');
                if (genderSvg) {
                    genderSvg.style.width = '16px';
                    genderSvg.style.height = '16px';
                    genderSvg.style.stroke = 'currentColor';
                    genderSvg.style.fill = 'none';
                    genderSvg.style.display = 'block';
                }

                var badgeNode = card.querySelector('.cd-litter-exclusive');
                if (isExclusive) {
                    if (!badgeNode) {
                        badgeNode = document.createElement('div');
                        badgeNode.className = 'cd-litter-exclusive';
                        card.appendChild(badgeNode);
                    }
                    badgeNode.textContent = 'Exclusive';
                    badgeNode.style.cssText = [
                        'position:absolute',
                        'top:15px',
                        'left:15px',
                        'z-index:22',
                        'display:inline-flex',
                        'align-items:center',
                        'gap:6px',
                        'padding:8px 14px',
                        'border-radius:9999px',
                        'background:rgba(110,90,84,0.92)',
                        'color:#FFF7F3',
                        'font-size:10px',
                        'font-weight:700',
                        'letter-spacing:0.16em',
                        'text-transform:uppercase',
                        'box-shadow:0 10px 24px rgba(72,48,42,0.2)',
                        'backdrop-filter:blur(10px)',
                        '-webkit-backdrop-filter:blur(10px)',
                        'pointer-events:none'
                    ].join(';');
                } else if (badgeNode) {
                    badgeNode.remove();
                }
            }

            function ensureFavoriteButtons() {
                document.querySelectorAll('#root div:not([role="dialog"]) [class*="aspect-[4/5]"]').forEach(function(card) {
                    if (card.closest('#cd-v2-modal-overlay, #cd-photo-modal, [role="dialog"]')) return;
                    if (!card.querySelector('img[src*="/storage/kittens/"], img[src*="/storage/"]')) return;
                    var kittenId = cdKittenIdFromCard(card);
                    if (!kittenId) return;
                    cdEnsureKittenCardMeta(card, kittenId);
                    var reactFavBtn = card.querySelector('div[class*="top-6"][class*="right-6"] > button, .absolute.top-6.right-6 button');
                    if (!reactFavBtn) return;
                    var kittenUuid = card.dataset.kittenUuid || '';
                    var reactFavWrap = reactFavBtn.parentElement;
                    if (reactFavWrap) {
                        reactFavWrap.style.top = '15px';
                        reactFavWrap.style.right = '15px';
                        reactFavWrap.style.left = 'auto';
                        reactFavWrap.style.bottom = 'auto';
                        reactFavWrap.style.transform = 'none';
                    }
                    reactFavBtn.dataset.kittenId = kittenId;
                    if (kittenUuid) reactFavBtn.dataset.kittenUuid = kittenUuid;
                    reactFavBtn.classList.add('cd-favorite-btn');
                    reactFavBtn.setAttribute('aria-label', 'Add to favorites');
                    reactFavBtn.innerHTML = cdFavoriteButtonSvg();
                    cdApplyFavoriteState(reactFavBtn, kittenId);
                });
                // Also process buttons in special offer section without cd-favorite-btn class
                document.querySelectorAll('#cd-special-offer-section button').forEach(function(btn) {
                    // Find parent card to get kitten id
                    var card = btn.closest('[data-kitten-id]');
                    if (!card) return;
                    var kittenId = card.dataset.kittenId;
                    if (!kittenId) return;
                    
                    if (!btn.classList.contains('cd-favorite-btn')) {
                        btn.classList.add('cd-favorite-btn');
                        btn.dataset.kittenId = kittenId;
                    }
                    cdApplyFavoriteState(btn, kittenId);
                });
                // Also handle existing cd-favorite-btn in special offer
                document.querySelectorAll('#cd-special-offer-section .cd-favorite-btn[data-kitten-id]').forEach(function(btn) {
                    cdApplyFavoriteState(btn, btn.dataset.kittenId);
                });
            }

            function cdSyncExclusiveCardsVisibility() {
                document.querySelectorAll('#root [data-kitten-id], #root [data-name][data-price]').forEach(function(card) {
                    if (card.closest('#cd-special-offer-section')) return;
                    var litterRow = card.closest('[class*="group/row"]');
                    if (!litterRow) return;
                    var isExclusive = String(card.dataset.kittenExclusive || '') === '1'
                        || String(card.dataset.kittenStatus || '').toLowerCase() === 'exclusive';
                    var wrapper = card.closest('.flex-shrink-0') || card.closest('.snap-start') || card.parentElement;
                    if (!wrapper) return;
                    wrapper.style.display = isExclusive ? 'none' : '';
                });

                document.querySelectorAll('#root [class*="group/row"]').forEach(function(sectionRow) {
                    if (sectionRow.closest('#cd-special-offer-section')) return;

                    var cards = Array.from(sectionRow.querySelectorAll('[data-kitten-id], [data-name][data-price]')).filter(function(card) {
                        return !card.closest('#cd-special-offer-section');
                    });
                    if (cards.length === 0) return;

                    var hasNonExclusive = cards.some(function(card) {
                        var isExclusive = String(card.dataset.kittenExclusive || '') === '1'
                            || String(card.dataset.kittenStatus || '').toLowerCase() === 'exclusive';
                        return !isExclusive;
                    });

                    sectionRow.style.display = hasNonExclusive ? '' : 'none';
                });
            }

            cdMigrateLegacyFavorites();
            cdSetFavoriteIds(cdGetFavoriteIds());

            let currentPhotos = [];
            let currentIdx = 0;

            /** pathname like /storage/kittens/gallery/foo.jpeg */
            function urlPath(u) {
                try { return new URL(u, location.origin).pathname; } catch (_) { return u || ''; }
            }

            function fullUrl(pathOrUrl) {
                if (!pathOrUrl) return '';
                if (pathOrUrl.startsWith('http')) return pathOrUrl;
                return location.origin + (pathOrUrl.startsWith('/') ? pathOrUrl : '/' + pathOrUrl);
            }

            /** featured pathname -> ordered full URLs for this kitten */
            const galleryByFeaturedPath = new Map();
            let galleryMapReady = false;

            function buildGalleryMap(posts) {
                galleryByFeaturedPath.clear();
                (posts || []).forEach(function (p) {
                    const acf = p.acf || {};
                    const main = p.featured_image_url || acf.foto || '';
                    const mainPath = urlPath(fullUrl(main));
                    const extra = Array.isArray(acf.gallery) ? acf.gallery : [];
                    const urls = [];
                    if (mainPath) urls.push(fullUrl(mainPath));
                    extra.forEach(function (g) {
                        var u = typeof g === 'string' ? g : (g && g.url);
                        var fp = urlPath(fullUrl(u));
                        if (fp) urls.push(fullUrl(fp));
                    });
                    var seen = new Set();
                    var uniq = urls.filter(function (x) {
                        var k = urlPath(x);
                        if (!k || seen.has(k)) return false;
                        seen.add(k);
                        return true;
                    });
                    uniq.forEach(function (u) {
                        galleryByFeaturedPath.set(urlPath(u), uniq);
                    });
                });
                galleryMapReady = true;
            }

            function fetchGalleryMap() {
                return fetch('/wp-json/wp/v2/posts', { credentials: 'same-origin' })
                    .then(function (r) { return r.json(); })
                    .then(function (posts) { 
                        window.__allKittens = posts;
                        buildGalleryMap(posts); 
                        renderSpecialOffer();
                        cdSyncExclusiveCardsVisibility();
                        cdScheduleMaintenance(20);
                    })
                    .catch(function () { galleryMapReady = true; });
            }

            function collectPhotosForDetail(clickedImg) {
                var card = clickedImg.closest('[role="dialog"], .fixed.inset-0, section, article, div');
                if (!card) return [clickedImg.src];
                
                // 1. Try to find all unique images in the modal
                var imgs = Array.from(card.querySelectorAll('img[src*="/storage/kittens/"]'));
                var urls = [];
                var seen = new Set();
                imgs.forEach(function (i) {
                    var k = urlPath(i.src);
                    if (k && !seen.has(k)) { seen.add(k); urls.push(i.src); }
                });

                // 2. FALLBACK: Use the pre-fetched gallery map if the modal hasn't fully rendered thumbnails yet
                if (urls.length <= 1) {
                    var path = urlPath(clickedImg.src);
                    var mapped = galleryByFeaturedPath.get(path);
                    if (mapped && mapped.length > 1) {
                        return mapped;
                    }
                }

                return urls.length ? urls : [clickedImg.src];
            }

            function openPhoto(url, list) {
                currentPhotos = list && list.length ? list : [url];
                currentIdx = Math.max(0, currentPhotos.findIndex(function (u) { return urlPath(u) === urlPath(url); }));
                if (currentIdx < 0) currentIdx = 0;
                updateModal();
                document.getElementById('cd-photo-modal').classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            function updateModal() {
                var img = document.getElementById('cd-photo-modal-img');
                img.src = currentPhotos[currentIdx];
                document.getElementById('cd-photo-counter').textContent =
                    (currentIdx + 1) + ' / ' + currentPhotos.length;
                document.querySelector('#cd-photo-modal .cd-prev').style.display = currentPhotos.length > 1 ? 'block' : 'none';
                document.querySelector('#cd-photo-modal .cd-next').style.display = currentPhotos.length > 1 ? 'block' : 'none';
            }

            window.cdClosePhoto = function() {
                document.getElementById('cd-photo-modal').classList.remove('active');
                document.body.style.overflow = '';
            };
            window.cdPrevPhoto = function(e) {
                if (e) e.stopPropagation();
                currentIdx = (currentIdx - 1 + currentPhotos.length) % currentPhotos.length;
                updateModal();
            };
            window.cdNextPhoto = function(e) {
                if (e) e.stopPropagation();
                currentIdx = (currentIdx + 1) % currentPhotos.length;
                updateModal();
            };

            /* Detail / other views: click photo opens lightbox */
            document.addEventListener('click', function (e) {
                var img = e.target.closest('img[src*="/storage/kittens/"]');
                if (!img) return;
                
                // IF NOT IN MODAL, let React handle it to open "About Me"
                var inModal = img.closest('[role="dialog"], .fixed.inset-0, .modal');
                if (!inModal) return; 

                // IF IN MODAL, open lightbox
                e.preventDefault();
                e.stopPropagation();
                openPhoto(img.src, collectPhotosForDetail(img));
            }, true);

            // In-modal Slider Buttons logic for legacy dialogs
            function cdEnsureLegacyModalSlider() {
                var modal = document.querySelector('[role="dialog"]');
                if (!modal || modal.querySelector('.cd-modal-slider-nav')) return;

                // Find the main large image in the modal
                var allKittenImgs = Array.from(modal.querySelectorAll('img[src*="/storage/kittens/"]'));
                if (allKittenImgs.length <= 1) return; // Need at least 2 images for a slider

                // The largest image is usually the main one
                var mainImg = allKittenImgs.reduce((a, b) => (a.offsetWidth > b.offsetWidth ? a : b));
                if (!mainImg || mainImg.offsetWidth < 100) return;

                // Find the best wrapper (the one with relative positioning or the immediate parent)
                var wrapper = mainImg.closest('.relative') || mainImg.parentElement;
                if (!wrapper) return;

                var nav = document.createElement('div');
                nav.className = 'cd-modal-slider-nav';
                nav.style.cssText = 'position:absolute; inset:0; pointer-events:none; display:flex; align-items:center; justify-content:space-between; padding:0 15px; z-index:50;';
                
                var arrowLeft = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>';
                var arrowRight = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>';

                var prev = document.createElement('button');
                prev.className = 'cd-modal-nav-btn';
                prev.innerHTML = arrowLeft;
                prev.style.pointerEvents = 'auto';
                prev.onclick = function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var thumbs = Array.from(modal.querySelectorAll('button img[src*="/storage/kittens/"]'));
                    if (!thumbs.length) return;
                    var currentSrc = urlPath(mainImg.src);
                    var idx = thumbs.findIndex(function(t) { return urlPath(t.src) === currentSrc; });
                    var prevIdx = (idx - 1 + thumbs.length) % thumbs.length;
                    thumbs[prevIdx].closest('button').click();
                };

                var next = document.createElement('button');
                next.className = 'cd-modal-nav-btn';
                next.innerHTML = arrowRight;
                next.style.pointerEvents = 'auto';
                next.onclick = function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var thumbs = Array.from(modal.querySelectorAll('button img[src*="/storage/kittens/"]'));
                    if (!thumbs.length) return;
                    var currentSrc = urlPath(mainImg.src);
                    var idx = thumbs.findIndex(function(t) { return urlPath(t.src) === currentSrc; });
                    var nextIdx = (idx + 1) % thumbs.length;
                    thumbs[nextIdx].closest('button').click();
                };

                nav.appendChild(prev);
                nav.appendChild(next);
                
                // Ensure wrapper is relative
                if (getComputedStyle(wrapper).position === 'static') {
                    wrapper.style.position = 'relative';
                }
                wrapper.appendChild(nav);
            }

            document.addEventListener('keydown', function (e) {
                if (!document.getElementById('cd-photo-modal').classList.contains('active')) return;
                if (e.key === 'Escape') cdClosePhoto();
                if (e.key === 'ArrowLeft') cdPrevPhoto();
                if (e.key === 'ArrowRight') cdNextPhoto();
            });

            // === V2 Modal Rebuilder ===
            // Открываем только нашу v2-модалку и не даем React показать старую.

            // Поиск котёнка по URL изображения
            function cdFindKittenByImg(src) {
                if (!src || !window.__allKittens) return null;
                var srcPath = '';
                try { srcPath = new URL(src, location.origin).pathname; } catch(e) { srcPath = src; }
                return window.__allKittens.find(function(k) {
                    var fp = k.featured_image_url || '';
                    if (!fp) return false;
                    try { return new URL(fp, location.origin).pathname === srcPath; } catch(e) { return false; }
                }) || null;
            }

            // Поиск котёнка по имени
            function cdFindKittenByName(name) {
                if (!name || !window.__allKittens) return null;
                var lc = name.toLowerCase().trim();
                return window.__allKittens.find(function(k) {
                    var n = ((k.acf && k.acf.imya) || (k.title && k.title.rendered) || '').toLowerCase().trim();
                    return n === lc;
                }) || null;
            }

            function cdBuildV2Modal(kitten) {
                var name     = (kitten.acf && kitten.acf.imya) || (kitten.title && kitten.title.rendered) || 'Kitten';
                var gender   = (kitten.acf && kitten.acf.gender) || 'Male';
                var isGirl   = gender === 'Female';
                var price    = (kitten.acf && kitten.acf.czena_str) || ('$' + ((kitten.acf && kitten.acf.czena) || ''));
                var mainImg  = kitten.featured_image_url || '';
                var birth    = (kitten.acf && (kitten.acf.birth_date || kitten.acf.birthday)) || '';
                var breed    = (kitten.acf && (kitten.acf.breed || kitten.acf.bread || kitten.acf.breed_type)) || 'Scottish Fold';
                var character= (kitten.acf && kitten.acf.character) || '';
                var descr    = (kitten.acf && kitten.acf.description) || (kitten.excerpt && kitten.excerpt.rendered) || '';
                var exclusive= (kitten.acf && kitten.acf.exclusive) || false;
                var status   = (kitten.acf && kitten.acf.status) || 'available';
                var rawTags  = (kitten.acf && kitten.acf.hashtags) || '';
                var hashtags = rawTags ? rawTags.split(' ').filter(function(h){ return h.trim(); }) : [];
                var motherTitle = (kitten.acf && kitten.acf.mother_title) || 'Mother';
                var motherName  = (kitten.acf && kitten.acf.mother_name) || '';
                var motherBreed = (kitten.acf && kitten.acf.mother_breed) || '';
                var motherPhoto = (kitten.acf && kitten.acf.mother_photo) || '';
                var fatherTitle = (kitten.acf && kitten.acf.father_title) || 'Father';
                var fatherName  = (kitten.acf && kitten.acf.father_name) || '';
                var fatherBreed = (kitten.acf && kitten.acf.father_breed) || '';
                var fatherPhoto = (kitten.acf && kitten.acf.father_photo) || '';
                var showParents = !!(kitten.acf && kitten.acf.show_parents)
                    || !!motherName || !!motherBreed || !!motherPhoto
                    || !!fatherName || !!fatherBreed || !!fatherPhoto;

                // Gallery
                var galleryRaw = (kitten.acf && Array.isArray(kitten.acf.gallery)) ? kitten.acf.gallery : [];
                var galleryUrls = galleryRaw.map(function(g){
                    return typeof g === 'string' ? '/storage/' + g : (g && g.url ? g.url : '');
                }).filter(Boolean);
                var allImgs = [mainImg].concat(galleryUrls).filter(Boolean);

                // Gender styles
                var genderStyle = isGirl
                    ? 'background:#fff1f2;color:#e11d48;border:1px solid #fecdd3'
                    : 'background:#eff6ff;color:#2563eb;border:1px solid #bfdbfe';
                var genderLabel = isGirl ? 'Girl' : 'Boy';
                var statusLabel = (status === 'reserved') ? 'Reserved' : 'Available';
                var statusStyle = (status === 'reserved')
                    ? 'background:#6E5A54;color:white'
                    : 'background:#10b981;color:white';
                var exclusiveBadgeHtml = exclusive
                    ? 'background:#6E5A54;color:white'
                    : '';

                // Thumbnails — нативный aspect-ratio:1 без Tailwind
                var thumbsHtml = allImgs.slice(0, 5).map(function(src, i){
                    var active = i === 0 ? 'border-color:#EFA39A' : 'border-color:transparent';
                    return '<div class="v2t" data-src="' + src + '" style="aspect-ratio:1;overflow:hidden;border-radius:1rem;border:2px solid transparent;transition:all 0.2s;cursor:pointer;' + active + '">'
                         + '<img src="' + src + '" alt="thumb" style="width:100%;height:100%;object-fit:cover;display:block" onerror="this.parentElement.style.display=\'none\'">'
                         + '</div>';
                }).join('');

                // Hashtags
                var hashHtml = hashtags.map(function(h){
                    return '<span style="font-size:9px;font-weight:700;color:#C5A059;text-transform:uppercase;letter-spacing:.1em">' + h + '</span>';
                }).join('');

                var parents = [];
                if (showParents) {
                    if (motherName || motherBreed || motherPhoto) {
                        parents.push({
                            title: motherTitle,
                            name: motherName,
                            breed: motherBreed,
                            photo: motherPhoto,
                        });
                    }
                    if (fatherName || fatherBreed || fatherPhoto) {
                        parents.push({
                            title: fatherTitle,
                            name: fatherName,
                            breed: fatherBreed,
                            photo: fatherPhoto,
                        });
                    }
                }

                var parentsHtml = parents.length
                    ? '<div style="display:flex;flex-direction:column;gap:.9rem">'
                        + '<h3 style="font-size:10px;font-weight:700;color:#9C8A84;text-transform:uppercase;letter-spacing:.3em;margin:0">Mother and Father</h3>'
                        + '<div style="display:grid;grid-template-columns:repeat(' + Math.min(parents.length, 2) + ', minmax(0, 1fr));gap:1rem">'
                        + parents.map(function(parent) {
                            var parentImage = parent.photo
                                ? '<div style="aspect-ratio:1.05;overflow:hidden;border-radius:1.5rem;background:rgba(255,255,255,.5);margin-bottom:.9rem"><img src="' + parent.photo + '" alt="' + (parent.name || parent.title) + '" style="width:100%;height:100%;object-fit:cover;display:block" onerror="this.parentElement.style.display=\'none\'"></div>'
                                : '';
                            return '<div style="background:rgba(255,255,255,.32);padding:1rem;border-radius:1.75rem;border:1px solid rgba(255,255,255,.5)">'
                                + parentImage
                                + '<span style="display:block;font-size:9px;font-weight:700;color:#9C8A84;text-transform:uppercase;letter-spacing:.18em;margin-bottom:.45rem">' + parent.title + '</span>'
                                + '<div style="font-size:1rem;font-weight:700;color:#6E5A54;line-height:1.35">' + (parent.name || '—') + '</div>'
                                + (parent.breed ? '<div style="margin-top:.35rem;font-size:.92rem;color:#8C736B;line-height:1.45">' + parent.breed + '</div>' : '')
                                + '</div>';
                        }).join('')
                        + '</div>'
                    + '</div>'
                    : '';

                return (
                    // Инлайн стили с !important для гарантированного оверрайда любых React стилей
                    '<style>'
                    + '#cd-v2-modal-overlay .v2wrap{position:relative!important}'
                    + '#cd-v2-modal-overlay .v2badge{position:absolute!important;top:1.25rem!important;left:1.25rem!important;z-index:20!important;display:flex!important;flex-direction:column!important;gap:.5rem!important;pointer-events:none!important}'
                    + '#cd-v2-modal-overlay .v2price{position:absolute!important;bottom:1.25rem!important;right:1.25rem!important;z-index:20!important}'
                    + '#cd-v2-modal-overlay .v2photo{width:100%!important;aspect-ratio:4/5!important;object-fit:cover!important;display:block!important;border-radius:2.5rem!important}'
                    + '@media (max-width: 900px){#cd-v2-modal-overlay .v2layout{grid-template-columns:1fr!important}#cd-v2-modal-overlay .v2left{padding:1.25rem!important;border-right:none!important;border-bottom:1px solid #D6C1BA!important}#cd-v2-modal-overlay .v2right{padding:1.25rem!important}#cd-v2-modal-overlay .v2title{font-size:2.1rem!important;padding-right:2.5rem!important}#cd-v2-modal-overlay .v2meta{grid-template-columns:1fr 1fr!important}#cd-v2-modal-overlay .v2head{padding-right:0!important}#cd-v2-modal-overlay .v2close{top:1rem!important;right:1rem!important}}'
                    + '</style>'

                    // Кнопка закрытия (абсолютная, над всем)
                    + '<button id="v2-close" class="v2close" style="position:absolute;top:1.5rem;right:1.5rem;z-index:200;width:3rem;height:3rem;background:rgba(255,255,255,.9);backdrop-filter:blur(12px);border:1px solid #D6C1BA;border-radius:9999px;display:flex;align-items:center;justify-content:center;font-size:1.25rem;color:#6E5A54;cursor:pointer;box-shadow:0 8px 24px rgba(0,0,0,.12);transition:all .2s;flex-shrink:0">✕</button>'

                    // Двухколоночный лейаут: ЧИСТЫЙ CSS GRID без Tailwind
                    + '<div class="v2layout" style="display:grid;grid-template-columns:1fr 1fr;width:100%">'

                    // ─── ЛЕВАЯ КОЛОНКА ───
                    + '<div class="v2left" style="padding:2rem 2.5rem;border-right:1px solid #D6C1BA;display:flex;flex-direction:column;gap:1.5rem">'

                    // Главное фото — wrapper с position:relative через class v2wrap
                    +   '<div class="v2wrap" style="border-radius:2.5rem;box-shadow:0 25px 50px -12px rgba(0,0,0,.2);overflow:hidden;flex-shrink:0">'
                    +     '<img id="v2-main" class="v2photo" src="' + mainImg + '" alt="' + name + '" style="background:#F8E6E1">'
                    +     '<div class="v2badge">'
                    + (exclusive
                        ? '<span style="padding:.5rem 1rem;border-radius:1rem;font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.1em;' + exclusiveBadgeHtml + ';box-shadow:0 10px 20px rgba(0,0,0,.2);pointer-events:auto">Exclusive</span>'
                        : '<span style="padding:.5rem 1rem;border-radius:1rem;font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.1em;box-shadow:0 10px 20px rgba(0,0,0,.2);pointer-events:auto;' + statusStyle + '">' + statusLabel + '</span>'
                    )
                    +     '</div>'
                    +     '<div class="v2price">'
                    +       '<div style="background:rgba(255,255,255,.92);backdrop-filter:blur(8px);padding:.625rem 1.25rem;border-radius:1rem;box-shadow:0 10px 20px rgba(0,0,0,.12);border:1px solid #D6C1BA">'
                    +         '<span style="font-size:1.125rem;font-weight:700;color:#6E5A54">' + price + '</span>'
                    +       '</div>'
                    +     '</div>'
                    +   '</div>'

                    // Галерея миниатюр
                    + (allImgs.length > 1 ? '<div style="display:grid;grid-template-columns:repeat(5,1fr);gap:.75rem">' + thumbsHtml + '</div>' : '')

                    // Инфо-карточки
                    +   '<div class="v2meta" style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">'
                    +     '<div style="background:rgba(255,255,255,.4);padding:1.25rem;border-radius:1rem;border:1px solid #D6C1BA">'
                    +       '<span style="font-size:8px;font-weight:700;color:#9C8A84;text-transform:uppercase;letter-spacing:.1em;display:block;margin-bottom:.25rem">Birth Date</span>'
                    +       '<span style="font-size:14px;font-weight:700;color:#6E5A54">' + (birth || '—') + '</span>'
                    +     '</div>'
                    +     '<div style="background:rgba(255,255,255,.4);padding:1.25rem;border-radius:1rem;border:1px solid #D6C1BA">'
                    +       '<span style="font-size:8px;font-weight:700;color:#9C8A84;text-transform:uppercase;letter-spacing:.1em;display:block;margin-bottom:.25rem">Breed</span>'
                    +       '<span style="font-size:14px;font-weight:700;color:#6E5A54">' + breed + '</span>'
                    +     '</div>'
                    +   '</div>'

                    // Хэштеги
                    + (hashHtml ? '<div style="display:flex;flex-wrap:wrap;gap:.5rem 1rem">' + hashHtml + '</div>' : '')

                    + '</div>'  // конец левой колонки

                    // ─── ПРАВАЯ КОЛОНКА ───
                    + '<div class="v2right" style="padding:2rem 2.5rem 2rem 2.5rem;display:flex;flex-direction:column">'
                    +   '<div style="flex:1;display:flex;flex-direction:column;gap:2rem">'

                    // Имя + пол (padding-right чтобы не перекрывалось кнопкой закрытия)
                    +     '<div style="display:flex;flex-direction:column;gap:.75rem">'
                    +       '<div class="v2head" style="display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap;padding-right:3.5rem">'
                    +         '<h2 class="v2title" style="font-size:1.875rem;font-weight:700;color:#6E5A54;font-family:Quicksand,sans-serif;margin:0;line-height:1.2">' + name + '</h2>'
                    +         '<div style="' + genderStyle + ';padding:.5rem 1rem;border-radius:.75rem;font-size:9px;font-weight:700;text-transform:uppercase;letter-spacing:.1em;white-space:nowrap">' + genderLabel + '</div>'
                    +       '</div>'
                    + (descr ? '<p style="font-size:1rem;font-weight:500;color:#EFA39A;font-style:italic;margin:0">' + descr + '</p>' : '')
                    +     '</div>'

                    // Характер
                    + (character ?
                        '<div style="display:flex;flex-direction:column;gap:.75rem">'
                        + '<h3 style="font-size:10px;font-weight:700;color:#9C8A84;text-transform:uppercase;letter-spacing:.3em;margin:0">Character</h3>'
                        + '<p style="background:rgba(255,255,255,.3);padding:1.5rem;border-radius:1.875rem;border:1px solid rgba(255,255,255,.5);color:#6E5A54;font-weight:500;line-height:1.6;margin:0">' + character + '</p>'
                        + '</div>'
                    : '')
                    + parentsHtml

                    +   '</div>'

                    // CTA кнопка
                    +   '<div style="margin-top:2rem;padding-top:2rem;border-top:1px solid #D6C1BA">'
                    +     '<button id="v2-apply" style="width:100%;padding:1.5rem 1rem;background:#EFA39A;color:white;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.25em;border-radius:2rem;box-shadow:0 20px 40px rgba(239,163,154,.35);border:none;cursor:pointer;transition:all .3s;display:block;margin-bottom:1rem">'
                    +       'Apply for Adoption'
                    +     '</button>'
                    +     '<p style="font-size:9px;font-weight:700;color:#9C8A84;text-transform:uppercase;letter-spacing:.1em;opacity:.7;text-align:center;margin:0">This questionnaire helps us find the perfect match for both the kitten and your family.</p>'
                    +   '</div>'

                    + '</div>'  // конец правой колонки
                    + '</div>'  // конец grid
                );
            }

            // Показываем v2-оверлей для конкретного котёнка
            function cdShowV2Overlay(kitten) {
                var prev = document.getElementById('cd-v2-modal-overlay');
                if (prev) prev.remove();

                var overlay = document.createElement('div');
                overlay.id = 'cd-v2-modal-overlay';
                overlay.style.cssText = 'position:fixed;top:0;left:0;right:0;bottom:0;z-index:2147483647;display:flex;align-items:center;justify-content:center;background:rgba(110,90,84,0.65);backdrop-filter:blur(4px)';

                var modalWin = document.createElement('div');
                modalWin.style.cssText = 'position:relative;background:#F8E6E1;border-radius:3.5rem;max-width:min(1024px,95vw);width:95vw;max-height:92vh;overflow-y:auto;box-shadow:0 25px 50px -12px rgba(0,0,0,.3)';
                try {
                    modalWin.innerHTML = cdBuildV2Modal(kitten);
                } catch(e2) {
                    console.error('[CD] cdBuildV2Modal error:', e2.message);
                    modalWin.innerHTML = '<div style="padding:2rem;color:red">Build error: ' + e2.message + '</div>';
                }
                overlay.appendChild(modalWin);
                document.body.appendChild(overlay);
                console.log('[CD] overlay appended, id check:', document.getElementById('cd-v2-modal-overlay') ? 'found' : 'NOT FOUND');

                document.body.style.overflow = 'hidden';

                function cdCloseV2() {
                    overlay.remove();
                    document.body.style.overflow = '';
                }

                var closeBtn = modalWin.querySelector('#v2-close');
                if (closeBtn) closeBtn.addEventListener('click', cdCloseV2);

                overlay.addEventListener('click', function(e) {
                    if (e.target === overlay) cdCloseV2();
                });

                document.addEventListener('keydown', function escH(e) {
                    if (e.key === 'Escape') {
                        document.removeEventListener('keydown', escH, true);
                        overlay.remove();
                        document.body.style.overflow = '';
                    }
                }, true);

                var applyBtn = modalWin.querySelector('#v2-apply');
                if (applyBtn) {
                    applyBtn.addEventListener('click', function() {
                        var kittenNameForLead = (kitten.acf && kitten.acf.imya) || (kitten.title && kitten.title.rendered) || 'Kitten';
                        var leadSource = 'Kitten Modal / Apply for Adoption';
                        cdSetLeadSource(leadSource, kittenNameForLead);
                        var subject = 'Adoption Inquiry - ' + kittenNameForLead;
                        var body = [
                            'Source: ' + leadSource,
                            'Kitten: ' + kittenNameForLead,
                            'Page: ' + window.location.href,
                            '',
                            'Hello, I would like to know more about this kitten.'
                        ].join('\n');
                        window.open('mailto:info@cinnamondesire.com?subject=' + encodeURIComponent(subject) + '&body=' + encodeURIComponent(body), '_blank');
                    });
                    applyBtn.addEventListener('mouseenter', function() { this.style.background='#F4B7A6'; });
                    applyBtn.addEventListener('mouseleave', function() { this.style.background='#EFA39A'; });
                }

                var mainImgEl = modalWin.querySelector('#v2-main');
                var thumbs = Array.from(modalWin.querySelectorAll('.v2t'));
                thumbs.forEach(function(thumb) {
                    thumb.addEventListener('click', function() {
                        if (mainImgEl) mainImgEl.src = this.dataset.src;
                        thumbs.forEach(function(t){ t.style.borderColor='transparent'; t.style.transform=''; });
                        this.style.borderColor='#EFA39A'; this.style.transform='';
                    });
                });
            }

            function cdIsAboutButton(btn) {
                if (!btn) return false;
                var text = (btn.textContent || '').trim().toLowerCase();
                return text === 'about me' || text === 'обо мне';
            }

            function cdFindKittenFromTrigger(node) {
                for (var depth = 0, el = node; depth < 8 && el && el !== document.body; depth++, el = el.parentElement) {
                    if (el.dataset && el.dataset.name) {
                        var byDataName = cdFindKittenByName(el.dataset.name);
                        if (byDataName) return byDataName;
                    }

                    if (el.querySelector) {
                        var namedCard = el.querySelector('[data-name]');
                        if (namedCard && namedCard.dataset && namedCard.dataset.name) {
                            var byNestedName = cdFindKittenByName(namedCard.dataset.name);
                            if (byNestedName) return byNestedName;
                        }

                        var heading = el.querySelector('h2, h3, h4');
                        if (heading) {
                            var byHeading = cdFindKittenByName(heading.textContent);
                            if (byHeading) return byHeading;
                        }

                        var img = el.querySelector('img[src*="/storage/kittens/"], img[src*="/storage/"]');
                        if (img && img.src) {
                            var byImg = cdFindKittenByImg(img.src);
                            if (byImg) return byImg;
                        }
                    }
                }

                return null;
            }

            function cdHideReactDialogs() {
                document.querySelectorAll('[role="dialog"]').forEach(function(dialog) {
                    if (dialog.id === 'cd-v2-modal-overlay' || dialog.closest('#cd-v2-modal-overlay')) return;
                    dialog.style.display = 'none';
                    dialog.setAttribute('aria-hidden', 'true');
                });
            }

            // Use mousedown for faster response, but prevent duplicate calls
            var cdLastFavoriteClick = null;
            document.addEventListener('mousedown', function(e) {
                var btn = e.target.closest('button');
                if (!btn) return;
                
                var card = btn.closest('[data-kitten-id]');
                var kittenId = card ? card.dataset.kittenId : null;
                if (!kittenId) return;
                
                // Check if favorite button
                var parent = btn.parentElement;
                var isFavoriteBtn = btn.classList.contains('cd-favorite-btn') || 
                    (parent && (parent.classList.contains('top-') || parent.classList.contains('right-'))) ||
                    (btn.innerHTML && btn.innerHTML.includes('stroke'));
                
                if (!isFavoriteBtn) return;
                
                // Prevent duplicate clicks within 200ms
                var clickKey = kittenId + '_' + Date.now();
                if (cdLastFavoriteClick === clickKey) return;
                cdLastFavoriteClick = clickKey;
                
                if (!btn.classList.contains('cd-favorite-btn')) {
                    btn.classList.add('cd-favorite-btn');
                    btn.dataset.kittenId = kittenId;
                }
                
                e.preventDefault();
                e.stopPropagation();
                
                // Call immediately on mousedown
                cdHandleFavoriteToggle(kittenId);
            }, true);

            document.addEventListener('click', function(e) {
                var trigger = e.target.closest('button, a');
                if (!trigger) return;

                var clickedView = '';
                
                console.log('Click trigger:', trigger.tagName, 'text:', trigger.textContent.trim().substring(0, 20), 'header:', !!trigger.closest('header'), 'svg:', !!trigger.querySelector('svg'));
                
                // Special check for favorites button (text '1' or '2' etc with svg - it's the count badge)
                var text = trigger.textContent.trim();
                console.log('Special check: text:', text, 'has svg:', !!(trigger.querySelector && trigger.querySelector('svg')));
                if (/^[0-9]+$/.test(text) && trigger.querySelector && trigger.querySelector('svg')) {
                    // This is likely the favorites button with badge count
                    clickedView = 'favorites';
                    console.log('Favorites button detected by special check');
                }
                
                // First try standard navigation link check
                if (cdIsHeaderNavLink(trigger) || cdIsFooterNavLink(trigger)) {
                    clickedView = cdMapViewKeyFromText(trigger.textContent || '');
                    console.log('Кнопка найдена, text:', trigger.textContent, '-> clickedView:', clickedView);
                }
                
                // Fallback: direct text check for navigation items
                if (!clickedView) {
                    var btnText = cdNormalizeViewText(trigger.textContent || '');
                    var ariaLabel = (trigger.getAttribute('aria-label') || '').toLowerCase();
                    console.log('Fallback check, btnText:', btnText, 'ariaLabel:', ariaLabel);
                    
                    // Check if this is a button without text but has svg (likely favorites star)
                    if (!btnText && trigger.querySelector && trigger.querySelector('svg')) {
                        var header = trigger.closest('header');
                        if (header) {
                            clickedView = 'favorites';
                            console.log('Found favorites button (svg in header)');
                        }
                    }
                    
                    // Also check aria-label directly
                    if (!clickedView && ariaLabel === 'my favorites') {
                        clickedView = 'favorites';
                    }
                    
                    // Check text as well
                    if (!clickedView && (btnText === 'adoption' || btnText === 'our kittens' || btnText === 'faq' || btnText === 'about us' || btnText === 'contacts' || btnText === 'blog' || btnText === 'testimonials' || btnText === 'rewards' || btnText === 'my favorites')) {
                        clickedView = cdMapViewKeyFromText(trigger.textContent || '');
                    }
                }
                
if (clickedView) {
                    console.log('ОБРАБОТКА КЛИКА:', clickedView, '| __cdCurrentView=', window.__cdCurrentView, '| hash=', window.location.hash);
                    var wasOnRewards = (window.__cdCurrentView === 'rewards' || window.location.hash === '#rewards');
                    var wasOnFavorites = (window.__cdCurrentView === 'favorites' || window.location.hash === '#favorites');
                    console.log('wasOnRewards:', wasOnRewards, '| wasOnFavorites:', wasOnFavorites, '| clickedView !== rewards:', clickedView !== 'rewards');
                    
                    if ((wasOnRewards || wasOnFavorites) && clickedView !== 'rewards' && clickedView !== 'favorites') {
                        // Navigate away from rewards/favorites - clear DOM and reload
                        console.log('УХОДИМ С', wasOnRewards ? 'REWARDS' : 'FAVORITES', 'НА:', clickedView);
                        var root = document.getElementById('root');
                        if (root) root.innerHTML = '';
                        if (wasOnRewards) cdRestoreFromRewardsView();
                        
                        // Store target view and reload - React will pick it up on remount
                        sessionStorage.setItem('cdTargetView', clickedView);
                        window.__cdTargetView = clickedView;
                        console.log('СОХРАНИЛИ В sessionStorage:', clickedView);
                        
                        // Reload without hash so React remounts with correct view
                        var targetUrl = window.location.pathname + window.location.search;
                        console.log('ПЕРЕЗАГРУЗКА НА:', targetUrl);
                        window.location.href = targetUrl;
                        return;
                    }

                    window.__cdCurrentView = clickedView;
                    console.log('Переключаем на вид:', clickedView, 'текущий hash:', window.location.hash);
                    
                    if (clickedView === 'rewards') {
                        window.location.hash = 'rewards';
                        setTimeout(cdRenderRewardsPage, 40);
                    } else if (clickedView === 'favorites') {
                        console.log('НАЖАТА КНОПКА My Favorites! clickedView=', clickedView);
                        // Just update main content
                        window.location.hash = 'favorites';
                        setTimeout(cdRenderFavoritesPage, 100);
                    } else if (!clickedView && (/^[0-9]+$/.test(trigger.textContent.trim()) || trigger.textContent.trim() === '')) {
                        // This could be the favorites button in header
                        var header = trigger.closest('header');
                        if (header) {
                            clickedView = 'favorites';
                            console.log('Favorites from header button!');
                            window.location.hash = 'favorites';
                            setTimeout(cdRenderFavoritesPage, 100);
                        }
                    } else if (clickedView === 'home') {
                        // Home - clear custom content and reload
                        var root = document.getElementById('root');
                        if (root) root.innerHTML = '';
                        // Clear the custom favorites page content
                        sessionStorage.setItem('cdTargetView', 'home');
                        window.location.href = window.location.pathname + window.location.search;
                    } else {
                        // Set hash for non-rewards views
                        window.location.hash = clickedView;
                        if (window.location.hash === '#rewards') {
                            history.replaceState(null, '', window.location.pathname + window.location.search);
                        }
                        // Force update favorite buttons immediately after view change
                        cdRunMaintenance();
                        ensureFavoriteButtons();
                        cdScheduleMaintenance(60);
                        setTimeout(function() { cdScheduleMaintenance(60); }, 220);
                    }
                    }

                var kitten = cdFindKittenFromTrigger(e.target);
                var kittenName = kitten ? ((kitten.acf && kitten.acf.imya) || (kitten.title && kitten.title.rendered) || '') : '';
                var text = (trigger.textContent || '').trim().toLowerCase();

                if (cdIsAboutButton(trigger)) {
                    cdSetLeadSource(cdInferLeadSourceFromNode(trigger) + ' / About Me', kittenName);
                    return;
                }

                if (
                    text.includes('contact us') ||
                    text.includes('apply for adoption') ||
                    text.includes('get early access') ||
                    text.includes('send message') ||
                    text.includes('direct message')
                ) {
                    cdSetLeadSource(cdInferLeadSourceFromNode(trigger), kittenName);
                }
            }, true);

            document.addEventListener('submit', function(e) {
                var form = e.target;
                if (!form || !(form instanceof HTMLFormElement)) return;
                cdHydrateLeadSourceFields();

                var sourceText = cdGetLeadSourceText();
                var kittenName = cdGetLeadKittenName();
                var messageField = form.querySelector('textarea[name="message"], textarea[name="question"], textarea');
                var prefixLines = ['[Source: ' + sourceText + ']'];
                if (kittenName) prefixLines.push('[Kitten: ' + kittenName + ']');
                var prefix = prefixLines.join(' ') + '\n';

                if (messageField && typeof messageField.value === 'string' && !messageField.value.startsWith('[Source: ')) {
                    messageField.value = prefix + messageField.value;
                }
            }, true);

            document.addEventListener('click', function(e) {
                if (e.target.closest('#cd-v2-modal-overlay, #cd-photo-modal, [role="dialog"]')) return;
                if (e.target.closest('.cd-favorite-btn')) return;

                var aboutBtn = e.target.closest('button');
                if (cdIsAboutButton(aboutBtn)) return;

                var specialOfferCard = e.target.closest('#cd-special-offer-section [data-kitten-id]');
                var litterCard = e.target.closest('[data-name][data-price]');
                if (!specialOfferCard && !litterCard) return;

                e.preventDefault();
                e.stopPropagation();
                if (typeof e.stopImmediatePropagation === 'function') {
                    e.stopImmediatePropagation();
                }
            }, true);

            document.addEventListener('click', function(e) {
                if (e.target.closest('#cd-v2-modal-overlay, #cd-photo-modal, [role="dialog"]')) return;
                if (e.target.closest('.cd-favorite-btn')) return;

                var aboutBtn = e.target.closest('button');
                if (!cdIsAboutButton(aboutBtn)) return;

                var kitten = cdFindKittenFromTrigger(e.target);
                if (!kitten) return;

                e.preventDefault();
                e.stopPropagation();
                if (typeof e.stopImmediatePropagation === 'function') {
                    e.stopImmediatePropagation();
                }

                cdShowV2Overlay(kitten);
                requestAnimationFrame(cdHideReactDialogs);
                setTimeout(cdHideReactDialogs, 80);
            }, true);

            fetchGalleryMap();

            // Global Social Links Override
            function overrideSocialLinks() {
                fetch('/wp-json/wp/v2/pages/37059')
                    .then(r => r.json())
                    .then(data => {
                        const socials = data.acf?.socials || {};
                        if (!socials.instagram && !socials.threads) return;

                        document.querySelectorAll('a[href*="instagram.com"]').forEach(a => {
                            if (socials.instagram && socials.instagram !== '#') {
                                // If the link already contains the full URL or we have a full URL in settings
                                a.href = socials.instagram;
                            }
                        });
                        document.querySelectorAll('a[href*="threads.net"], a[href*="threads.com"]').forEach(a => {
                            if (socials.threads && socials.threads !== '#') {
                                a.href = socials.threads;
                            }
                        });
                    })
                    .catch(e => console.error('Social override failed', e));
            }

            var cdMaintenanceTimer = null;
            function cdRunMaintenance() {
                renderSpecialOffer();
                cdHydrateKittenCards();
                ensureFavoriteButtons();
                cdSyncExclusiveCardsVisibility();
                cdHydrateLeadSourceFields();
                cdEnsureLegacyModalSlider();
                cdEnsureRewardsNavLink();
                cdSyncFooterActiveLinks();
                cdPatchReactFaqPage();
            }

            function cdScheduleMaintenance(delay) {
                if (cdMaintenanceTimer) {
                    clearTimeout(cdMaintenanceTimer);
                }
                cdMaintenanceTimer = setTimeout(cdRunMaintenance, typeof delay === 'number' ? delay : 80);
            }

            overrideSocialLinks();
            cdRunMaintenance();
            setTimeout(cdRunMaintenance, 250);
            setTimeout(cdRunMaintenance, 1000);

            var cdFooterObserver = new MutationObserver(function() {
                cdScheduleMaintenance(120);
            });
            cdFooterObserver.observe(document.getElementById('root'), {
                childList: true,
                subtree: true
            });

            // Handle initial hash on page load
            // Check sessionStorage first (set when navigating from rewards page)
            var targetView = sessionStorage.getItem('cdTargetView');
            if (targetView) {
                sessionStorage.removeItem('cdTargetView');
                console.log('Восстановление вида из sessionStorage:', targetView);
                window.__cdCurrentView = targetView;
                
                // Find and click React's navigation button
                function findAndClickNavButton() {
                    var viewTexts = {
                        'adoption': ['Adoption', 'ADOPTION'],
                        'our-kittens': ['Our kittens', 'OUR KITTENS', 'Kittens'],
                        'faq': ['FAQ', 'Faq', 'faq'],
                        'blog': ['Blog', 'BLOG', 'blog'],
                        'about': ['About', 'ABOUT', 'about'],
                        'contacts': ['Contact', 'CONTACT', 'contact', 'Contacts']
                    };
                    
                    var possibleTexts = viewTexts[targetView] || [targetView];
                    var allElements = document.querySelectorAll('*');
                    
                    console.log('Поиск кнопки для:', targetView, 'варианты текста:', possibleTexts);
                    
                    for (var i = 0; i < allElements.length; i++) {
                        var el = allElements[i];
                        var text = (el.textContent || '').trim();
                        
                        for (var j = 0; j < possibleTexts.length; j++) {
                            if (text === possibleTexts[j]) {
                                // Check if it's clickable (button or link)
                                if (el.tagName === 'BUTTON' || el.tagName === 'A' || el.onclick) {
                                    console.log('Найдена кнопка:', text, 'клик...');
                                    el.click();
                                    return true;
                                }
                            }
                        }
                    }
                    
                    return false;
                }
                
                // Try to find and click the button multiple times
                var attempts = 0;
                var maxAttempts = 50;
                
                function tryNavigate() {
                    attempts++;
                    if (findAndClickNavButton()) {
                        console.log('Успешно переключено на:', targetView);
                        return;
                    }
                    
                    if (attempts < maxAttempts) {
                        setTimeout(tryNavigate, 100);
                    } else {
                        console.log('Не удалось переключить вид на:', targetView);
                        // Fallback: just set hash and hope React picks it up
                        window.location.hash = targetView;
                    }
                }
                
                // Start trying after React should have rendered
                setTimeout(tryNavigate, 500);
            } else if (window.location.hash) {
                // Handle hash-based navigation (e.g., direct link to #rewards)
                var initialHash = window.location.hash.replace('#', '');
                if (initialHash === 'rewards') {
                    window.__cdCurrentView = 'rewards';
                    document.getElementById('root').style.visibility = 'visible';
                    setTimeout(cdRenderRewardsPage, 80);
                } else if (initialHash === 'home' || initialHash === '') {
                    // Home page - just show root
                    document.getElementById('root').style.visibility = 'visible';
} else if (initialHash === 'favorites') {
                    window.__cdCurrentView = 'favorites';
                    window.__onFavoritesPage = true;
                    // Clear root COMPLETELY before React can mount
                    var root = document.getElementById('root');
                    if (root) {
                        root.innerHTML = '<main id="main-favorites"></main>';
                    }
                    document.getElementById('root').style.visibility = 'visible';
                    // Render after React has a chance to mount (but we've cleared root so React renders nothing useful)
                    setTimeout(cdRenderFavoritesPage, 50);
                    // Also set up a re-render check in case React overwrites
                    setTimeout(function() {
                        if (window.location.hash === '#favorites' && window.__onFavoritesPage) {
                            cdRenderFavoritesPage();
                        }
                    }, 500);
                    setTimeout(function() {
                        if (window.location.hash === '#favorites' && window.__onFavoritesPage) {
                            cdRenderFavoritesPage();
                        }
                    }, 1500);
                }
                    document.getElementById('root').style.visibility = 'visible';
                    setTimeout(cdRenderFavoritesPage, 200);
                }
                    }
                    document.getElementById('root').style.visibility = 'visible';
                    setTimeout(cdRenderFavoritesPage, 100);
                } else if (initialHash && initialHash !== 'rewards') {
                    window.__cdCurrentView = initialHash;
                    console.log('Попытка переключения на вид из хэша:', initialHash);
                    
                    setTimeout(function() {
                        var allElements = document.querySelectorAll('button, a, [role="button"]');
                        var viewText = initialHash === 'adoption' ? 'Adoption' : 
                                      initialHash === 'our-kittens' ? 'Our kittens' : 
                                      initialHash === 'faq' ? 'FAQ' : 
                                      initialHash === 'blog' ? 'Blog' : 
                                      initialHash === 'about' ? 'About' : '';
                        
                        console.log('Поиск кнопки для:', viewText, 'всего элементов:', allElements.length);
                        
                        // Debug: log all button texts
                        var allBtns = [];
                        for (var j = 0; j < allElements.length; j++) {
                            var txt = (allElements[j].textContent || '').trim();
                            if (txt) allBtns.push(txt);
                        }
                        console.log('Все тексты кнопок:', allBtns.join(', '));
                        
                        var found = false;
                        if (viewText) {
                            for (var i = 0; i < allElements.length; i++) {
                                var el = allElements[i];
                                var btnText = (el.textContent || '').trim();
                                if (btnText === viewText || 
                                    btnText.toLowerCase() === viewText.toLowerCase()) {
                                    console.log('Найдена кнопка:', btnText, '- клик!');
                                    el.click();
                                    // Update hash to match clicked view
                                    var hashMap = {
                                        'Adoption': 'adoption',
                                        'Our Kittens': 'our-kittens',
                                        'FAQ': 'faq',
                                        'Blog': 'blog',
                                        'About Us': 'about',
                                        'About': 'about'
                                    };
                                    if (hashMap[btnText]) {
                                        console.log('Установка хэша:', hashMap[btnText]);
                                        window.location.hash = hashMap[btnText];
                                    }
                                    found = true;
                                    break;
                                }
                            }
                        }
                        // Show root regardless of whether button was found
                        document.getElementById('root').style.visibility = 'visible';
                        if (!found) {
                            console.log('Не найдена кнопка для хэша:', initialHash, '- показываем как есть');
                        }
                    }, 500);
                }
            }
            
            // Handle hash changes from browser back/forward buttons
            window.addEventListener('hashchange', function() {
                var newHash = window.location.hash.replace('#', '');
                if (newHash === 'rewards') {
                    window.__cdCurrentView = 'rewards';
                    setTimeout(cdRenderRewardsPage, 40);
                } else if (newHash) {
                    window.__cdCurrentView = newHash;
                    var root = document.getElementById('root');
                    if (root && root.innerHTML === '') {
                        // Root was cleared, need to reload
                        location.reload();
                    } else {
                        cdScheduleMaintenance(60);
                    }
                } else {
                    // Left rewards page via browser navigation
                    if (window.__cdCurrentView === 'rewards') {
                        window.__cdCurrentView = 'home';
                        var root = document.getElementById('root');
                        if (root) root.innerHTML = '';
                        location.reload();
                    }
                }
            });

            window.cdOpenKittenModal = function(id) {
                const kitten = (window.__allKittens || []).find(k => k.id == id);
                if (!kitten) return;
                cdShowV2Overlay(kitten);
            };

            function renderSpecialOffer() {
                const sectionId = 'cd-special-offer-section';
                const existingSection = document.getElementById(sectionId);
                const root = document.getElementById('root');
                if (!root) {
                    return;
                }

                if (!window.__allKittens || window.__allKittens.length === 0) {
                    if (existingSection) existingSection.remove();
                    return;
                }

                const exclusiveKittens = window.__allKittens.filter(k => k.acf && k.acf.exclusive);
                if (exclusiveKittens.length === 0) {
                    if (existingSection) existingSection.remove();
                    return;
                }
                
                // Debug: log gender for exclusive kittens
                console.log('Exclusive kittens gender:', exclusiveKittens.map(k => ({id: k.id, gender: k.acf && k.acf.gender})));
                
                // Debug: check if gender element exists in DOM after render
                setTimeout(() => {
                    const genderElements = document.querySelectorAll('#cd-special-offer-section .cd-offer-gender');
                    console.log('Gender elements in DOM:', genderElements.length);
                    genderElements.forEach((el, i) => {
                        console.log('Gender element ' + i + ' HTML:', el.innerHTML.substring(0, 100));
                        const style = window.getComputedStyle(el);
                        console.log('Gender element ' + i + ' styles:', {
                            display: style.display,
                            position: style.position,
                            left: style.left,
                            bottom: style.bottom,
                            color: style.color,
                            width: style.width,
                            height: style.height
                        });
                        const svg = el.querySelector('svg');
                        if (svg) {
                            const svgStyle = window.getComputedStyle(svg);
                            console.log('SVG styles:', {
                                width: svgStyle.width,
                                height: svgStyle.height,
                                stroke: svgStyle.stroke,
                                fill: svgStyle.fill,
                                display: svgStyle.display
                            });
                        }
                    });
                }, 500);

                const formatOfferPrice = (value) => {
                    const num = parseInt(String(value || 0).replace(/[^\d]/g, ''), 10);
                    if (!num) return '';
                    return '$' + num.toLocaleString('en-US');
                };

                const specialOfferHtml = `
                    <section id="${sectionId}" class="mt-32 mb-16 px-6 lg:px-8">
                        <div class="max-w-[1600px] mx-auto rounded-[4rem] p-12 md:p-20 shadow-[0_35px_80px_rgba(120,86,76,0.24)] relative overflow-hidden border border-[#B99588]/60" style="background:linear-gradient(180deg,#A58579 0%,#A07D71 100%);">
                            <div class="absolute top-0 left-0 right-0 h-40 bg-gradient-to-b from-white/8 to-transparent"></div>
                            <div class="absolute top-0 right-0 w-[30rem] h-[30rem] bg-white/6 rounded-full blur-[120px] -translate-y-1/2 translate-x-1/3"></div>
                            <div class="absolute bottom-0 left-0 w-80 h-80 bg-[#8F6F64]/25 rounded-full blur-[110px] translate-y-1/2 -translate-x-1/3"></div>
                            
                            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between mb-16 gap-8 text-white">
                                <div class="flex flex-col gap-4 md:gap-5">
                                    <div class="flex items-center gap-4 text-[#F7E8E1]">
                                        <span class="block w-10 h-px bg-[#EED8D0]/80"></span>
                                        <span class="text-[11px] font-bold uppercase tracking-[0.45em]">Exclusive Opportunity</span>
                                    </div>
                                    <h2 class="max-w-[10ch] text-[2.2rem] leading-[0.96] md:text-[3.6rem] lg:text-[4rem] font-bold tracking-tight text-[#FFF9F6]">Offer for today</h2>
                                    <p class="max-w-[28rem] md:max-w-[36rem] text-[0.88rem] leading-[1.42] md:text-[1.08rem] md:leading-[1.3] text-[#F7ECE7]/92 font-medium" style="max-width: 630px;">Discover unique conditions for our most outstanding representatives. These special companions are ready to bring joy to your home at an exceptional price.</p>
                                </div>
                                <div class="flex gap-4">
                                    <button onclick="document.getElementById('special-offer-scroll').scrollBy({left: -400, behavior: 'smooth'})" class="w-16 h-16 rounded-full border border-white/20 bg-white/10 text-white flex items-center justify-center hover:bg-white/20 transition-all shadow-[0_12px_28px_rgba(78,55,48,0.18)] backdrop-blur-md">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                                    </button>
                                    <button onclick="document.getElementById('special-offer-scroll').scrollBy({left: 400, behavior: 'smooth'})" class="w-16 h-16 rounded-full border border-white/20 bg-white/10 text-white flex items-center justify-center hover:bg-white/20 transition-all shadow-[0_12px_28px_rgba(78,55,48,0.18)] backdrop-blur-md">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                                    </button>
                                </div>
                            </div>
                            <div id="special-offer-scroll" class="relative z-10 flex overflow-x-auto gap-8 lg:gap-12 pb-6 scrollbar-hide snap-x px-2" style="scroll-behavior: smooth;">
                                ${exclusiveKittens.map(k => {
                                    const priceNum = parseInt(String(k.acf?.czena || 0).replace(/[^\d]/g, ''), 10);
                                    const oldPriceNumRaw = parseInt(String(k.acf?.old_price || 0).replace(/[^\d]/g, ''), 10);
                                    const oldPriceNum = oldPriceNumRaw > priceNum ? oldPriceNumRaw : Math.round(priceNum * 1.18);
                                    const saveNum = Math.max(oldPriceNum - priceNum, 0);
                                    const formattedPrice = formatOfferPrice(priceNum);
                                    const formattedOldPrice = formatOfferPrice(oldPriceNum);
                                    const formattedSave = formatOfferPrice(saveNum);

                                    const kittenUuid = cdKittenUuidFromKitten(k);

                                    return `
                                    <div class="flex-shrink-0 w-[240px] sm:w-[260px] md:w-[280px] snap-start relative pb-4 group/item">
                                        <div class="group flex flex-col h-full">
                                            <div data-kitten-id="${k.id}" data-kitten-uuid="${kittenUuid}" class="relative aspect-[4/5] rounded-[2.5rem] border border-[#E6D6D0]/65 overflow-hidden shadow-[0_24px_45px_rgba(72,48,42,0.22)] transition-all duration-700 hover:shadow-[0_34px_60px_rgba(72,48,42,0.28)] bg-[#D6B8AC]/10">
                                                <img alt="${k.acf.imya}" class="w-full h-full object-contain transition-transform duration-1000" src="${k.featured_image_url}">
                                                <div class="absolute inset-0 bg-gradient-to-t from-[#6F564C]/15 via-transparent to-transparent"></div>
                                                <div class="cd-offer-badge">
                                                    <span class="px-5 py-2.5 rounded-2xl text-[10px] font-bold uppercase tracking-[0.28em] bg-[#E4B6AF] text-[#FFF8F5] shadow-[0_12px_26px_rgba(88,58,51,0.18)]">🔥 Special Price</span>
                                                </div>
                                                <button type="button" class="cd-favorite-btn" data-kitten-id="${k.id}" data-kitten-uuid="${kittenUuid}" aria-label="Add to favorites">
                                                    <svg viewBox="0 0 24 24" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                                </button>
                                                <div class="cd-offer-gender" style="display:flex !important;visibility:visible !important;opacity:1 !important;left:30px !important;bottom:30px !important;">${cdGenderIconSvg(k.acf.gender)}</div>
                                            </div>
                                            <div class="mt-6 flex justify-center">
                                                <button onclick="window.cdOpenKittenModal(${k.id})" class="px-10 py-4 bg-[#8B7066] text-[#FFF7F3] text-[11px] font-bold uppercase tracking-[0.28em] rounded-[1.2rem] shadow-[0_12px_24px_rgba(72,48,42,0.2)] hover:bg-[#7E655C] transition-all">About me</button>
                                            </div>
                                            <div class="mt-3 bg-white rounded-[1rem] px-4 py-2 shadow-[0_18px_34px_rgba(72,48,42,0.14)] border border-[#F2E7E1]/90">
                                                <div class="flex items-end justify-center gap-2">
                                                    ${formattedOldPrice ? `<span class="text-[0.6rem] font-semibold text-[#C6B7B0] line-through translate-y-[-1px]">${formattedOldPrice}</span>` : ''}
                                                    <span class="text-[1.2rem] leading-none font-bold tracking-tight text-[#7C6057]">${formattedPrice}</span>
                                                </div>
                                                ${formattedSave ? `<div class="mt-1 text-center text-[7px] font-bold uppercase tracking-[0.22em] text-[#D7A39E]">Save ${formattedSave}</div>` : ''}
                                            </div>
                                        </div>
                                    </div>
                                `;
                                }).join('')}
                            </div>
                        </div>
                    </section>
                `;

                const nodes = Array.from(root.querySelectorAll('h2, h3, h4, p, span'));
                const upcomingNode = nodes.find(n => {
                    const txt = (n.textContent || '').toLowerCase();
                    return txt.includes('upcoming litter')
                        || txt.includes('ожидаемые пометы')
                        || txt.includes('upcoming-letter')
                        || txt.includes('upcoming kittens');
                });

                if (!upcomingNode) {
                    if (existingSection) existingSection.remove();
                    return;
                }

                const ancestorChain = [];
                let current = upcomingNode;
                while (current && current !== root) {
                    if (current.nodeType === 1) {
                        ancestorChain.push(current);
                    }
                    current = current.parentElement;
                }

                const headingRow = ancestorChain.find(el => {
                    const txt = (el.textContent || '').toLowerCase();
                    return txt.includes('upcoming litter')
                        && (txt.includes('coming soon') || txt.includes('ожидаемые') || txt.includes('kittens in litter'));
                });

                const upcomingSection = ancestorChain.find(el => {
                    const txt = (el.textContent || '').toLowerCase();
                    return txt.includes('estimated month')
                        || txt.includes('get early access')
                        || txt.includes('sire (father)')
                        || txt.includes('dam (mother)');
                });

                const anchor = upcomingSection
                    || (headingRow ? (headingRow.parentElement || headingRow) : null)
                    || upcomingNode.closest('div')
                    || upcomingNode.parentElement
                    || upcomingNode;
                if (!anchor || !anchor.parentElement) return;

                if (!existingSection) {
                    anchor.insertAdjacentHTML('beforebegin', specialOfferHtml);
                    return;
                }

                if (existingSection.nextElementSibling !== anchor) {
                    anchor.parentElement.insertBefore(existingSection, anchor);
                }
            }

        })();
    </script>

    @include('partials.inline-editor')
</body>
</html>
