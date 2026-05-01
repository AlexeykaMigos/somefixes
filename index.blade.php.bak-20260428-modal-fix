<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings['seo_home_title'] ?? 'Cinnamon Desire - Premium Scottish Cattery' }}</title>
    <meta name="description" content="{{ $settings['seo_home_description'] ?? '' }}">
    <script>
        window.__blogPosts = {!! json_encode($blogPosts ?? []) !!};
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/svg" href="{{ asset('assets/a-DJ2-ArCx.svg') }}" />
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
  <script type="module" crossorigin src="{{ asset('assets/index-zf1JtzCz.js') }}"></script>
  <link rel="stylesheet" crossorigin href="{{ asset('assets/index-BfN9iDYU.css') }}">
</head>
<body class="antialiased">
    <div id="root"></div>

    {{-- Photo viewer: click kitten photo to open fullscreen with zoom --}}
    <style>
        /* Kitten photo — keep full cat visible */
        .kitten-img-contain img,
        [class*="kitten"] img[src*="/storage/"],
        img[src*="/storage/kittens/"] {
            object-fit: contain !important;
            background: #F8E6E1;
            cursor: zoom-in;
        }
        img[src*="/storage/kittens/parents/"] {
            object-fit: cover !important;
            cursor: zoom-in;
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
            transform: rotate(90deg) scale(1.1);
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
        #cd-photo-modal .cd-nav:hover { background: rgba(255,255,255,0.3); transform: translateY(-50%) scale(1.1); }
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
            transform: scale(1.08);
            box-shadow: 0 6px 20px rgba(239, 163, 154, 0.3);
        }
        .cd-modal-nav-btn:active { transform: scale(0.95); }
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

                                    
            }-bold uppercase tracking-[0.25em] rounded-2xl shadow-md hover:bg-[#5F634F] transition-all active:scale-95">обо мне</button>
                                            </div>
                                        </div>
                                    </div>
                                `).join('')}
                            </div>
                        </div>
                    </section>
                `;

                let interval = setInterval(() => {
                    const root = document.getElementById('root');
                    if (!root) return;
                    
                    if (document.getElementById(sectionId)) {
                        clearInterval(interval);
                        return;
                    }

                    const h2s = Array.from(root.querySelectorAll('h2'));
                    const kittensHeading = h2s.find(h => h.textContent.includes('Our Kittens') || h.textContent.includes('Наши котята'));
                    
                    if (kittensHeading) {
                        const kittensSection = kittensHeading.closest('section') || kittensHeading.parentElement.parentElement;
                        const container = kittensSection.parentElement;
                        if (container && container.id !== 'root') {
                           container.insertAdjacentHTML('afterend', specialOfferHtml);
                           clearInterval(interval);
                        } else if (kittensSection) {
                           kittensSection.insertAdjacentHTML('afterend', specialOfferHtml);
                           clearInterval(interval);
                        }
                    }
                }, 1000);
            }
                    }
                }, 1000);
            }

            function fetchGalleryMap() {
                return fetch('/wp-json/wp/v2/posts', { credentials: 'same-origin' })
                    .then(function (r) { return r.json(); })
                    .then(function (posts) { 
                        window.__allKittens = posts;
                        buildGalleryMap(posts); 
                        renderSpecialOffer();
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

            // In-modal Slider Buttons logic
            setInterval(function() {
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
            }, 300);

            document.addEventListener('keydown', function (e) {
                if (!document.getElementById('cd-photo-modal').classList.contains('active')) return;
                if (e.key === 'Escape') cdClosePhoto();
                if (e.key === 'ArrowLeft') cdPrevPhoto();
                if (e.key === 'ArrowRight') cdNextPhoto();
            });

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

            // Run override periodically to catch dynamic React renders
            setInterval(overrideSocialLinks, 1000);
            overrideSocialLinks();
        
            
            }


            window.cdOpenKittenModal = function(id) {
                const kitten = (window.__allKittens || []).find(k => k.id == id);
                if (!kitten) return;
                const name = kitten.acf.imya;
                const cards = Array.from(document.querySelectorAll('h3, h4, span, div'));
                const card = cards.find(c => c.textContent.trim() === name && c.closest('article, section, div[class*="rounded"]'));
                if (card) {
                    card.click();
                } else {
                    const imgs = Array.from(document.querySelectorAll('img'));
                    const img = imgs.find(i => i.src.includes(kitten.featured_image_url.split('/').pop()));
                    if (img) img.click();
                }
            };

            function renderSpecialOffer() { console.log("renderSpecialOffer called"); 
                if (!window.__allKittens || window.__allKittens.length === 0) return;
                const exclusiveKittens = window.__allKittens.filter(k => k.acf && k.acf.exclusive);
                if (exclusiveKittens.length === 0) return;

                const sectionId = 'cd-special-offer-section';
                if (document.getElementById(sectionId)) return;

                const specialOfferHtml = `
                    <section id="${sectionId}" class="mt-32 mb-16 px-6 lg:px-8">
                        <div class="max-w-[1600px] mx-auto bg-[#413632] rounded-[4rem] p-12 md:p-20 shadow-2xl relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full blur-[100px] -translate-y-1/2 translate-x-1/2"></div>
                            <div class="relative z-10 flex flex-col md:flex-row items-end justify-between mb-16 gap-8 text-white">
                                <div class="flex flex-col gap-5">
                                    <h2 class="text-4xl md:text-6xl font-bold tracking-tight">Спецпредложение</h2>
                                    <p class="max-w-xl text-lg opacity-80">Лучшие условия на выдающихся выпускников питомника.</p>
                                </div>
                                <div class="flex gap-4">
                                    <button onclick="document.getElementById('special-offer-scroll').scrollBy({left: -400, behavior: 'smooth'})" class="w-16 h-16 rounded-full border border-white/20 bg-white/10 text-white flex items-center justify-center hover:bg-[#C5A059] transition-all">←</button>
                                    <button onclick="document.getElementById('special-offer-scroll').scrollBy({left: 400, behavior: 'smooth'})" class="w-16 h-16 rounded-full border border-white/20 bg-white/10 text-white flex items-center justify-center hover:bg-[#C5A059] transition-all">→</button>
                                </div>
                            </div>
                            <div id="special-offer-scroll" class="relative z-10 flex overflow-x-auto gap-8 lg:gap-12 pb-6 scrollbar-hide snap-x px-2" style="scroll-behavior: smooth;">
                                ${exclusiveKittens.map(k => `
                                    <div class="flex-shrink-0 w-[260px] sm:w-[280px] md:w-[300px] snap-start relative pb-10 group/item">
                                        <div class="group flex flex-col h-full">
                                            <div onclick="window.cdOpenKittenModal(${k.id})" class="relative aspect-[4/5] rounded-[3rem] border border-[#E8E4DE] overflow-hidden shadow-sm transition-all duration-700 cursor-pointer hover:shadow-2xl hover:-translate-y-2 bg-white">
                                                <img alt="${k.acf.imya}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000" src="${k.featured_image_url}">
                                                <div class="absolute top-6 left-6 flex flex-col gap-3">
                                                    <span class="px-5 py-2.5 rounded-2xl text-[10px] font-bold uppercase tracking-widest bg-[#2C3327] text-white shadow-xl animate-pulse">✨ EXCLUSIVE</span>
                                                </div>
                                                <div class="absolute top-6 right-6">
                                                    <button class="w-12 h-12 rounded-full backdrop-blur-md border border-white/40 flex items-center justify-center transition-all bg-white/30 text-[#2C3327] hover:bg-white/60">
                                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                                    </button>
                                                </div>
                                                <div class="absolute bottom-6 left-6">
                                                    <div class="w-10 h-10 rounded-full backdrop-blur-md border border-white/40 flex items-center justify-center shadow-lg ${k.acf.gender === 'Female' ? 'bg-pink-400/80' : 'bg-blue-400/80'} text-white">
                                                        ${k.acf.gender === 'Female' ? 
                                                            '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="5"></circle><line x1="12" cy="13" x2="12" y2="21"></line><line x1="9" y1="18" x2="15" y2="18"></line></svg>' : 
                                                            '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="14" r="5"></circle><path d="M14 10l5-5"></path><path d="M14 5h5v5"></path></svg>'
                                                        }
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-6 flex justify-center">
                                                <button onclick="window.cdOpenKittenModal(${k.id})" class="px-8 py-4 bg-[#2C3327] text-white text-[10px] font-bold uppercase tracking-[0.25em] rounded-2xl shadow-md hover:bg-[#5F634F] transition-all active:scale-95">обо мне</button>
                                            </div>
                                        </div>
                                    </div>
                                `).join('')}
                            </div>
                        </div>
                    </section>
                `;

                const observer = new MutationObserver(() => {
                    if (document.getElementById(sectionId)) return;
                    const root = document.getElementById('root');
                    if (!root) return;
                    
                    const nodes = Array.from(root.querySelectorAll('*'));
                    const aboutNode = nodes.find(n => n.textContent.includes('A cattery with over 10 years of history') && n.tagName !== 'SCRIPT');
                    
                    if (aboutNode) {
                        const aboutSection = aboutNode.closest('section') || aboutNode.parentElement.parentElement;
                        if (aboutSection) {
                            aboutSection.insertAdjacentHTML('beforebegin', specialOfferHtml);
                        }
                    } else {
                        const h2s = Array.from(root.querySelectorAll('h2'));
                        const kittensHeading = h2s.find(h => h.textContent.includes('Our Kittens') || h.textContent.includes('Наши котята'));
                        if (kittensHeading) {
                            const kittensSection = kittensHeading.closest('section') || kittensHeading.parentElement.parentElement;
                            kittensSection.insertAdjacentHTML('afterend', specialOfferHtml);
                        }
                    }
                });
                observer.observe(document.body, { childList: true, subtree: true });
            }

})();
    </script>

    @include('partials.inline-editor')
</body>
</html>
