<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings['seo_home_title'] ?? 'Cinnamon Desire - Premium Scottish Cattery' }}</title>
    <meta name="description" content="{{ $settings['seo_home_description'] ?? '' }}">
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
        }
        
        /* Favorites button base */
        .cd-favorite-btn {
            width: 32px !important;
            height: 32px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
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
        
        /* Favorites page styles */
        .cd-favorites-page {
            padding: 3rem 0 4rem;
        }
        .cd-favorites-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }
        .cd-favorites-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }
        .cd-favorites-subtitle {
            color: #9C8A84;
            margin-top: 0.75rem;
        }
        .cd-favorites-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.5rem;
        }
        .cd-favorites-card {
            position: relative;
            padding: 1rem;
            border-radius: 1.75rem;
            background: rgba(255, 255, 255, 0.75);
            border: 1px solid rgba(214, 193, 186, 0.65);
            box-shadow: 0 24px 50px rgba(110, 90, 84, 0.12);
            backdrop-filter: blur(6px);
        }
        .cd-favorites-card .cd-favorite-btn {
            position: absolute;
            top: 12px;
            right: 12px;
            background: rgba(255, 255, 255, 0.9) !important;
        }
        .cd-favorites-image {
            width: 100%;
            aspect-ratio: 1 / 1;
            border-radius: 1.5rem;
            overflow: hidden;
            background: rgba(248, 230, 225, 0.9);
        }
        .cd-favorites-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        .cd-favorites-card-title {
            margin-top: 0.9rem;
            text-align: center;
            font-weight: 600;
            font-size: 1.1rem;
            color: #6E5A54;
        }
        .cd-favorites-meta {
            text-align: center;
            font-size: 0.95rem;
            color: #9C8A84;
            margin-top: 0.25rem;
        }
        .cd-favorites-empty {
            min-height: 60vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 1.5rem;
            text-align: center;
            color: #8E7B74;
        }
    </style>
</head>
<body class="antialiased">
    <div id="root"></div>

    <script type="module" crossorigin src="/assets/index-zf1JtzCz.js?v=6"></script>
    <link rel="stylesheet" crossorigin href="/assets/index-BfN9iDYU.css">
    
    <script>
        // Patch removeChild to prevent React errors
        window.__originalRemoveChild = Node.prototype.removeChild;
        Node.prototype.removeChild = function(child) {
            try {
                if (child && this.contains(child)) {
                    return window.__originalRemoveChild.call(this, child);
                }
                return child;
            } catch(e) {
                console.warn('Patch removeChild: prevented error', e.message);
                return child;
            }
        };
        
        // Determine initial view
        var hashView = window.location.hash.replace('#', '');
        if (hashView && hashView !== 'rewards' && hashView !== 'favorites') {
            window.__cdTargetView = hashView;
        } else if (hashView === 'favorites') {
            window.__cdTargetView = 'home'; // Let React render home with header
            window.__pendingFavorites = true;
        }
        
        // Favorites logic
        (function() {
            var cdFavoriteStoreKey = 'kitten_favorites';
            
            function cdGetFavoriteIds() {
                try {
                    return JSON.parse(localStorage.getItem(cdFavoriteStoreKey) || '[]');
                } catch(e) { return []; }
            }
            
            function cdSetFavoriteIds(ids) {
                try {
                    localStorage.setItem(cdFavoriteStoreKey, JSON.stringify(ids));
                } catch(e) {}
            }
            
            window.cdHandleFavoriteToggle = function(kittenId) {
                if (!kittenId) return false;
                var ids = cdGetFavoriteIds();
                var idx = ids.indexOf(kittenId);
                var isActive = idx === -1;
                if (isActive) {
                    ids.push(kittenId);
                } else {
                    ids.splice(idx, 1);
                }
                cdSetFavoriteIds(ids);
                
                // Update all buttons for this kitten
                document.querySelectorAll('.cd-favorite-btn[data-kitten-id="' + kittenId + '"]').forEach(function(btn) {
                    btn.classList.toggle('is-active', isActive);
                });
                
                return isActive;
            };
            
            window.cdRenderFavoritesPage = function() {
                var root = document.getElementById('root');
                if (!root) return;
                
                var main = root.querySelector('main');
                if (!main) {
                    // Wait for React to render main element
                    setTimeout(function() { window.cdRenderFavoritesPage(); }, 100);
                    return;
                }
                
                var favoriteIds = cdGetFavoriteIds();
                var allKittens = Array.isArray(window.__allKittens) ? window.__allKittens : [];
                
                var html = '<section class="cd-favorites-page"><div class="cd-favorites-inner">';
                html += '<div class="cd-favorites-header"><h1 class="text-4xl md:text-6xl font-bold text-center">My Favorites</h1>';
                html += '<p class="cd-favorites-subtitle">Saved kittens stay synced with your favorites list.</p></div>';
                
                if (!favoriteIds.length) {
                    html += '<div class="cd-favorites-empty"><p class="text-2xl mb-3">No favorites yet</p>';
                    html += '<p>Click the star on any kitten to add it to your favorites.</p></div>';
                } else {
                    var favoriteKittens = allKittens.filter(function(k) {
                        return favoriteIds.includes(k.id) || favoriteIds.includes(String(k.id));
                    });
                    
                    html += '<div class="cd-favorites-grid">';
                    favoriteKittens.forEach(function(k) {
                        var img = k.featured_image_url || (k.acf && (k.acf.foto || k.acf.photo)) || '';
                        var name = (k.acf && k.acf.imya) || (k.title && k.title.rendered) || 'Kitten';
                        var kittenId = k.id;
                        html += '<article class="cd-favorites-card" data-kitten-id="' + kittenId + '">';
                        html += '<button type="button" class="cd-favorite-btn is-active" aria-pressed="true" aria-label="Remove from favorites" data-kitten-id="' + kittenId + '" onclick="cdHandleFavoriteToggle(' + kittenId + '); setTimeout(cdRenderFavoritesPage, 100);">';
                        html += '<svg viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">';
                        html += '<polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>';
                        html += '</button>';
                        if (img) {
                            html += '<div class="cd-favorites-image"><img src="' + img + '" alt="' + name + '" loading="lazy"></div>';
                        }
                        html += '<h3 class="cd-favorites-card-title">' + name + '</h3>';
                        html += '</article>';
                    });
                    html += '</div>';
                }
                
                html += '</div></section>';
                main.innerHTML = html;
                root.style.display = 'block';
            };
        })();
    </script>
</body>
</html>
