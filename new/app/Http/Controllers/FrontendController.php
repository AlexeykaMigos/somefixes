<?php

namespace App\Http\Controllers;

use App\Models\Kitten;
use App\Models\Setting;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        return view('index', compact('settings'));
    }

    public function serveCmsPage($page)
    {
        $page = str_replace('.html', '', $page);
        $seoKey = 'seo_' . strtolower(str_replace(' ', '_', $page));
        $settings = Setting::all()->pluck('value', 'key')->toArray();

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
        $kittens = Kitten::all()->map(function ($kitten) {
            $galleryPaths = $kitten->gallery ?? [];
            $featuredMediaUrl = count($galleryPaths) > 0 ? '/storage/' . $galleryPaths[0] : '/a.png';

            // React uses [imageUrl, ...gallery] — so skip first to avoid duplicate
            $galleryUrls = array_map(
                fn($path) => '/storage/' . $path,
                array_slice($galleryPaths, 1)
            );

            // Normalize values
            $name = (string)($kitten->name ?? 'Kitten');
            $price = (int)preg_replace('/[^\d]/', '', $kitten->price ?? '0');
            $oldPrice = (int)preg_replace('/[^\d]/', '', $kitten->old_price ?? '0');
            $breed = (string)($kitten->breed_type ?? 'Scottish Fold');
            $description = (string)($kitten->description ?? '');
            $character = (string)($kitten->character ?? '');
            $tags = $kitten->tags ?? [];
            $hashtags = implode(' ', array_map(fn($t) => (str_starts_with(trim($t), '#') ? '' : '#') . trim($t), $tags));

            return [
                'id' => $kitten->id,
                'date' => $kitten->created_at ? $kitten->created_at->toIso8601String() : now()->toIso8601String(),
                'slug' => str($name)->slug()->toString(),
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
                    'czena' => $price,                                         // цена
                    'old_price' => $oldPrice,
                    'foto' => $featuredMediaUrl,                               // фото
                    'bread' => $breed,                                         // бред (breed)
                    'gender' => (string)($kitten->gender ?? 'Male'),
                    'status' => (string)($kitten->status ?? 'available'),
                    'hashtags' => $hashtags,                                   // хэштеги
                    'gallery' => $galleryUrls,
                    'features' => array_map(fn($f) => (string)$f, $kitten->features ?? []),
                    'exclusive' => false,
                    'column' => '',
                    'transition' => '',

                    // Extra aliases for safety (in case code reads either)
                    'price' => $price,
                    'breed' => $breed,
                    'breed_type' => $breed,
                    'name' => $name,
                    'photo' => $featuredMediaUrl,
                    'age' => (string)($kitten->age ?? ''),
                    'birth_date' => $kitten->birth_date ? \Carbon\Carbon::parse($kitten->birth_date)->format('d.m.Y') : '',
                    'birthday' => $kitten->birth_date ? \Carbon\Carbon::parse($kitten->birth_date)->format('d.m.Y') : '',
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
                                    'full' => ['source_url' => $featuredMediaUrl],
                                    'medium' => ['source_url' => $featuredMediaUrl],
                                ]
                            ]
                        ]
                    ],
                    'wp:term' => [[]],
                ]
            ];
        });

        return response()->json($kittens);
    }

    /**
     * Returns page data. React calls this for multiple page IDs — we return our content for all of them.
     */
    public function getPages(Request $request, $id = null)
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();

        // Core ACF block that React uses
        $acf = [
            'hero_title' => (string)($settings['hero_title'] ?? '"Every kitten is a piece of our soul, raised with boundless love and care"'),
            'hero_subtitle' => (string)($settings['hero_subtitle'] ?? 'Take a look at our Scottish Fold kittens, organized by litters in convenient carousels.'),
            'phone' => (string)($settings['contact_phone'] ?? '+7 (999) 843-68-11'),
            'email' => (string)($settings['contact_email'] ?? 'hello@cinnamon.com'),
            'address' => (string)($settings['contact_address'] ?? 'Moscow, Russia'),
            'about_text' => (string)($settings['about_text'] ?? ''),
            'kittens_section_title' => (string)($settings['kittens_section_title'] ?? 'Our Kittens'),
            // These MUST be arrays — React calls .filter()/.map() on them
            'testimonials' => [],
            'rewards' => [],
            'faq' => [],
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
            // Add top-level fields for direct access in JS
            'contact_address' => (string)($settings['contact_location'] ?? 'Moscow, Russia (Viewing by appointment)'),
            'location' => (string)($settings['contact_location'] ?? 'Moscow, Russia (Viewing by appointment)'),
            'working_hours' => (string)($settings['contact_working_hours'] ?? 'Every day from 10:00 to 21:00'),
        ];

        // Inject any saved inline edits
        foreach ($settings as $key => $value) {
            if (str_starts_with($key, 'edit_') || str_starts_with($key, 'inline_')) {
                $acf[$key] = $value;
            }
        }

        // When React asks for a specific page ID, return a single object
        // When it asks for a list (/pages), return an array with one item
        $pageObject = [
            'id' => (int)($id ?? 37059),
            'slug' => 'home',
            'type' => 'page',
            'acf' => $acf,
        ];

        if ($id !== null) {
            return response()->json($pageObject);
        }

        // List request — return array
        return response()->json([$pageObject]);
    }

    public function saveContent(Request $request)
    {
        $key = $request->input('key');
        $value = $request->input('value');
        if (!$key) return response()->json(['error' => 'Key missing'], 400);
        Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        return response()->json(['success' => true]);
    }
}
