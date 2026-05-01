<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($settings['seo_home_title'] ?? 'Cinnamon Desire - Premium Scottish Cattery'); ?></title>
    <meta name="description" content="<?php echo e($settings['seo_home_description'] ?? ''); ?>">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/svg" href="<?php echo e(asset('assets/a-DJ2-ArCx.svg')); ?>" />
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
  <script type="module" crossorigin src="<?php echo e(asset('assets/index-zf1JtzCz.js')); ?>"></script>
  <link rel="stylesheet" crossorigin href="<?php echo e(asset('assets/index-BfN9iDYU.css')); ?>">
</head>
<body class="antialiased">
    <div id="root"></div>

    
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
                    .then(function (posts) { buildGalleryMap(posts); })
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
        })();
    </script>

    <?php echo $__env->make('partials.inline-editor', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>
</html>
<?php /**PATH /home/1572919.cloudwaysapps.com/sxqtnguxbk/public_html/new/resources/views/index.blade.php ENDPATH**/ ?>