<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Kitten;
use App\Models\Setting;
use App\Support\FrontendCache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FrontendController extends Controller
{
    private function normalizeMediaUrl(?string $path): string
    {
        $path = trim((string) $path);

        if ($path === '') {
            return '';
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, '//')) {
            return $path;
        }

        if (str_starts_with($path, '/storage/')) {
            return asset(ltrim($path, '/'));
        }

        return asset('storage/' . ltrim($path, '/'));
    }

    public function index(Request $request)
    {
        if (!auth()->check()) {
            $html = Cache::remember(FrontendCache::homeHtmlKey(), now()->addMinutes(10), function () {
                return $this->buildIndexView()->render();
            });

            return response($html);
        }

        return $this->buildIndexView();
    }

    private function buildIndexView()
    {
        $settings = Setting::keyValueArray();
        $blogPosts = $this->getBlogPostsData();
        $kittens = $this->getKittensData();
        $pagePayload = $this->getPageData(37059);

        return view('index', compact('settings', 'blogPosts', 'kittens', 'pagePayload'));
    }

    private function formatBlogPost(BlogPost $post): array
    {
        $imageUrl = $post->image_url;
        if ($imageUrl && !str_starts_with($imageUrl, 'http') && !str_starts_with($imageUrl, '//')) {
            $imageUrl = asset('storage/' . $imageUrl);
        }
        $date = $post->published_at
            ? $post->published_at->format('M j, Y')
            : $post->created_at->format('M j, Y');

        return [
            'id'       => (string) $post->id,
            'title'    => $post->title,
            'excerpt'  => $post->excerpt ?? '',
            'content'  => $post->content ?? '',
            'category' => $post->category,
            'date'     => $date,
            'readTime' => $post->read_time ?? '5 min',
            'imageUrl' => $imageUrl ?? 'https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?q=80&w=1200',
            'author'   => [
                'name'   => $post->author_name ?? 'Admin',
                'role'   => $post->author_role ?? 'Breeder',
                'avatar' => $post->author_avatar ?? ('https://i.pravatar.cc/150?u=' . $post->id),
            ],
        ];
    }

    public function getBlogPosts()
    {
        return response()->json($this->getBlogPostsData());
    }

    private function getBlogPostsData(): array
    {
        return Cache::remember(FrontendCache::BLOG_POSTS_KEY, now()->addMinutes(10), function () {
            return BlogPost::where('status', 'published')
                ->orderByDesc('published_at')
                ->get()
                ->map(fn ($p) => $this->formatBlogPost($p))
                ->values()
                ->toArray();
        });
    }

    public function serveCmsPage($page)
    {
        $page = str_replace('.html', '', $page);
        $seoKey = 'seo_' . strtolower(str_replace(' ', '_', $page));
        $settings = Setting::keyValueArray();

        $title = $settings[$seoKey . '_title'] ?? ($page . ' - Cinnamon Desire');
        $description = $settings[$seoKey . '_description'] ?? '';

        if (view()->exists('cms.' . $page)) {
            return view('cms.' . $page, compact('title', 'description', 'settings'));
        }

        abort(404);
    }

    /**
     * Handle old WordPress ?rest_route= style requests from compiled React.
     * E.g. /cms/index.php?rest_route=/wp/v2/posts
     *      /cms/index.php?rest_route=/wp/v2/pages/37059
     */
    public function wpRestRoute(Request $request)
    {
        $route = $request->query('rest_route', '');

        if (str_contains($route, '/wp/v2/posts')) {
            return $this->getKittens();
        }

        if (str_contains($route, '/wp/v2/pages')) {
            // Вытаскиваем ID страницы из пути: /wp/v2/pages/37059
            preg_match('/\/wp\/v2\/pages\/(\d+)/', $route, $matches);
            $id = $matches[1] ?? null;
            return $this->getPages($request, $id);
        }

        return response()->json(['error' => 'Unknown route'], 404);
    }

    public function getKittens()
    {
        return response()->json($this->getKittensData());
    }

    private function getKittensData(): array
    {
        return Cache::remember(FrontendCache::KITTENS_KEY, now()->addMinutes(10), function () {
            return Kitten::with('litter')->get()->map(function ($kitten) {
            $galleryPaths = $kitten->gallery ?? [];
            $featuredMediaUrl = count($galleryPaths) > 0 ? '/storage/' . $galleryPaths[0] : '/a.png';

            // React uses [imageUrl, ...gallery] — so skip first to avoid duplicate
            $galleryUrls = array_map(
                fn($path) => '/storage/' . $path,
                array_slice($galleryPaths, 1)
            );

            // Normalize values
            $name = (string)($kitten->name ?? 'Kitten');
            // Format price with spaces for display if needed, but JS parses it as int
            $price_raw = preg_replace('/[^\d]/', '', $kitten->price ?? '0');
            $price = (int)$price_raw;
            $oldPrice = (int)preg_replace('/[^\d]/', '', $kitten->old_price ?? '0');
            
            // For display in case some code reads raw string
            $price_display = '$' . number_format($price, 0, '', ' '); 

            $breed = (string)($kitten->breed_type ?? 'Scottish Fold');
            $description = (string)($kitten->description ?? '');
            $character = (string)($kitten->character ?? '');
            $tags = $kitten->tags ?? [];
            $hashtags = implode(' ', array_map(fn($t) => (str_starts_with(trim($t), '#') ? '' : '#') . trim($t), $tags));

            $litter = $kitten->litter;
            $litterName = $litter ? $litter->name : 'Available Now';
            $litterId   = $litter ? $litter->id : 0;
            $litterDate = $litter && $litter->date
                ? $litter->date->format('d.m.Y')
                : ($kitten->birth_date ? $kitten->birth_date->format('d.m.Y') : '');
            $kittenSlug = str($name)->slug()->toString();
            $kittenUuid = 'kitten-' . $kitten->id . ($kittenSlug ? '-' . $kittenSlug : '');

            return [
                'id' => $kitten->id,
                'uuid' => $kittenUuid,
                'date' => $kitten->created_at ? $kitten->created_at->toIso8601String() : now()->toIso8601String(),
                'slug' => $kittenSlug,
                'status' => 'publish',
                'type' => 'post',
                'title' => ['rendered' => $name],
                'content' => ['rendered' => $character ?: $description],
                'excerpt' => ['rendered' => $description],
                'categories' => [],
                'tags' => [],
                // TOP-LEVEL field React reads as main photo
                'featured_image_url' => $featuredMediaUrl,
                'acf' => [
                    // React reads these exact transliterated names:
                    'imya' => $name,                                           // имя
                    'uuid' => $kittenUuid,
                    'czena' => $price,                                         // цена
                    'czena_str' => $price_display,
                    'old_price' => $oldPrice,
                    'foto' => $featuredMediaUrl,                               // фото
                    'bread' => $breed,                                         // бред (breed)
                    'gender' => (string)($kitten->gender ?? 'Male'),
                    'status' => (string)($kitten->status ?? 'available'),
                    'exclusive' => ($kitten->status === 'exclusive'),
                    'hashtags' => $hashtags,                                   // хэштеги
                    'column' => '',
                    'transition' => '',

                    // Extra aliases for safety (in case code reads either)
                    'price' => $price,
                    'price_formatted' => $price_display,
                    'breed' => $breed,
                    'breed_type' => $breed,
                    'name' => $name,
                    'photo' => $featuredMediaUrl,
                    'age' => (string)($kitten->age ?? ''),
                    'birth_date' => $litterDate,
                    'birthday' => $litterDate,
                    'character' => $character,
                    'description' => $description,

                    // Parents
                    'show_parents' => (bool)$kitten->show_parents,
                    'mother_title' => (string)($kitten->mother_title ?? 'Mother'),
                    'mother_name' => (string)($kitten->mother_name ?? ''),
                    'mother_breed' => (string)($kitten->mother_breed ?? ''),
                    'mother_photo' => $kitten->mother_photo ? '/storage/' . $kitten->mother_photo : '',
                    'father_title' => (string)($kitten->father_title ?? 'Father'),
                    'father_name' => (string)($kitten->father_name ?? ''),
                    'father_breed' => (string)($kitten->father_breed ?? ''),
                    'father_photo' => $kitten->father_photo ? '/storage/' . $kitten->father_photo : '',
                ],
                '_embedded' => [
                    'wp:featuredmedia' => [
                        [
                            'source_url' => $featuredMediaUrl,
                            'media_details' => [
                                'sizes' => [
                                    'full'   => ['source_url' => $featuredMediaUrl],
                                    'medium' => ['source_url' => $featuredMediaUrl],
                                ]
                            ]
                        ]
                    ],
                    // React reads litter name from _embedded["wp:term"][0][0].name
                    'wp:term' => [
                        [
                            [
                                'id'       => $litterId,
                                'name'     => $litterName,
                                'taxonomy' => 'category',
                                'slug'     => str($litterName)->slug()->toString(),
                            ],
                        ],
                    ],
                ]
            ];
            })->values()->toArray();
        });
    }

    /**
     * Returns page data. React calls this for multiple page IDs — we return our content for all of them.
     */
    public function getPages(Request $request, $id = null)
    {
        $pageObject = $this->getPageData($id ? (int) $id : null);

        if ($id !== null) {
            return response()->json($pageObject);
        }

        return response()->json([$pageObject]);
    }

    private function getPageData(?int $id = null): array
    {
        return Cache::remember(
            FrontendCache::pageKey($id),
            now()->addMinutes(10),
            function () use ($id) {
                $settings = Setting::keyValueArray();
                $rewardImages = collect($settings['rewards_certificates'] ?? [])
                    ->filter(fn ($path) => filled($path))
                    ->values()
                    ->map(fn ($path, $index) => [
                        'id' => 'reward-' . ($index + 1),
                        'imageUrl' => $this->normalizeMediaUrl($path),
                    ])
                    ->filter(fn ($item) => filled($item['imageUrl']))
                    ->values()
                    ->all();
                $faqItems = collect($settings['faq_items'] ?? [])
                    ->filter(fn ($item) => is_array($item) && filled($item['question'] ?? null) && filled($item['answer'] ?? null))
                    ->values()
                    ->map(fn ($item, $index) => [
                        'id' => 'faq-' . ($index + 1),
                        'question' => (string) ($item['question'] ?? ''),
                        'answer' => (string) ($item['answer'] ?? ''),
                    ])
                    ->all();

                $acf = [
                    'hero_title' => (string)($settings['hero_title'] ?? '"Every kitten is a piece of our soul, raised with boundless love and care"'),
                    'hero_subtitle' => (string)($settings['hero_subtitle'] ?? 'Take a look at our Scottish Fold kittens, organized by litters in convenient carousels.'),
                    'phone' => (string)($settings['contact_phone'] ?? '+7 (999) 843-68-11'),
                    'email' => (string)($settings['contact_email'] ?? 'hello@cinnamon.com'),
                    'address' => (string)($settings['contact_address'] ?? 'Moscow, Russia'),
                    'about_text' => (string)($settings['about_text'] ?? ''),
                    'kittens_section_title' => (string)($settings['kittens_section_title'] ?? 'Our Kittens'),
                    'testimonials' => [],
                    'rewards' => $rewardImages,
                    'faq' => $faqItems,
                    'socials' => [
                        'instagram' => (string)($settings['social_instagram'] ?? '#'),
                        'threads' => (string)($settings['social_threads'] ?? '#'),
                        'whatsapp' => '',
                        'telegram' => '',
                    ],
                    'contacts' => [
                        'title' => 'Contact Us',
                        'sub' => 'We are based in Moscow, but our kittens find loving homes all over the world.',
                        'loc_badge' => 'Location',
                        'loc_val' => (string)($settings['contact_location'] ?? 'Moscow, Russia (Viewing by appointment)'),
                        'hours_badge' => 'Working Hours',
                        'hours_val' => (string)($settings['contact_working_hours'] ?? 'Every day from 10:00 to 21:00'),
                        'form_title' => 'Direct Message',
                    ],
                    'contact_address' => (string)($settings['contact_location'] ?? 'Moscow, Russia (Viewing by appointment)'),
                    'location' => (string)($settings['contact_location'] ?? 'Moscow, Russia (Viewing by appointment)'),
                    'working_hours' => (string)($settings['contact_working_hours'] ?? 'Every day from 10:00 to 21:00'),
                    'rewards_certificates' => $rewardImages,
                    'faq_items' => $faqItems,
                ];

                foreach ($settings as $key => $value) {
                    if (str_starts_with($key, 'edit_') || str_starts_with($key, 'inline_')) {
                        $acf[$key] = $value;
                    }
                }

                return [
                    'id' => (int)($id ?? 37059),
                    'slug' => 'home',
                    'type' => 'page',
                    'acf' => $acf,
                ];
            }
        );
    }

    public function saveContent(Request $request)
    {
        $key = $request->input('key');
        $value = $request->input('value');
        if (!$key) return response()->json(['error' => 'Key missing'], 400);
        Setting::setValue($key, $value);
        return response()->json(['success' => true]);
    }
}
