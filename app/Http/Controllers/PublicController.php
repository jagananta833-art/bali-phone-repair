<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Faq;
use App\Models\Page;
use App\Models\Post;
use App\Models\Service;
use App\Models\ServiceArea;
use App\Models\Testimonial;

class PublicController extends Controller
{
    public function home()
    {
        return view('public.home', [
            'services' => Service::publiclyIndexable()->orderBy('sort_order')->get(),
            'posts' => Post::with('category')->where('is_published', true)->latest('published_at')->take(3)->get(),
            'faqs' => Faq::where('is_published', true)->orderBy('sort_order')->get(),
            'testimonials' => Testimonial::where('is_published', true)->orderBy('sort_order')->get(),
            'areas' => ServiceArea::where('is_published', true)->orderBy('sort_order')->get(),
        ]);
    }

    public function services()
    {
        return view('public.services', [
            'services' => Service::publiclyIndexable()->orderBy('sort_order')->paginate(12),
            'areas' => ServiceArea::where('is_published', true)->orderBy('sort_order')->get(),
        ]);
    }

    public function service(Service $service)
    {
        abort_unless($service->is_published, 404);

        $service->load([
            'faqs' => fn ($query) => $query->where('is_published', true),
            'relatedServices' => fn ($query) => $query->publiclyIndexable()->whereKeyNot($service->id),
            'serviceAreas' => fn ($query) => $query->where('is_published', true),
        ]);

        return view('public.service', [
            'service' => $service,
        ]);
    }

    public function page(Page $page)
    {
        abort_unless($page->is_published, 404);

        return view('public.page', [
            'page' => $page,
            'services' => Service::publiclyIndexable()->orderBy('sort_order')->take(6)->get(),
        ]);
    }

    public function pageBySlug(string $slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();

        return $this->page($page);
    }

    public function blog()
    {
        return view('public.blog', [
            'posts' => Post::with('category')->where('is_published', true)->latest('published_at')->paginate(9),
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function post(Post $post)
    {
        // 301 Permanent Redirect jika slug merupakan duplikat berakhiran -1, -2, dst
        if (preg_match('/^(.+)-\d+$/', $post->slug, $matches)) {
            $basePost = Post::where('slug', $matches[1])->where('is_published', true)->first();
            if ($basePost && $basePost->id !== $post->id) {
                return redirect()->route('posts.show', $basePost->slug, 301);
            }
        }

        abort_unless($post->is_published, 404);
        $related = Post::where('is_published', true)
            ->whereKeyNot($post->id)
            ->when($post->category_id, fn ($query) => $query->where('category_id', $post->category_id))
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('public.post', compact('post', 'related'));
    }

    public function serviceAreas()
    {
        return view('public.areas', [
            'areas' => ServiceArea::publiclyIndexable()->orderBy('sort_order')->get(),
            'services' => Service::publiclyIndexable()->orderBy('sort_order')->get(),
        ]);
    }

    public function location(ServiceArea $serviceArea)
    {
        abort_unless($serviceArea->is_published, 404);

        $serviceArea->load([
            'services' => fn ($query) => $query->publiclyIndexable(),
            'faqs' => fn ($query) => $query->where('is_published', true),
            'nearbyLocations' => fn ($query) => $query->publiclyIndexable()->whereKeyNot($serviceArea->id),
            'relatedArticles' => fn ($query) => $query->where('is_published', true),
        ]);

        return view('public.location', ['location' => $serviceArea]);
    }

    public function partners()
    {
        $partners = [
            [
                'name' => 'Puco Rooftop',
                'category' => 'Cafe, Rooftop Lounge & Coworking',
                'logo' => 'assets/images/partners/puco-rooftop.webp',
                'location' => 'Bali',
                'benefit' => 'Spacious Coworking space while you work remotely from Bali.',
                'description' => 'Spacious coworking space while you work remotely from Bali. Enjoy an aesthetic rooftop ambience and high-speed Wi-Fi while your device is being serviced.',
                'badge' => 'Verified Partner',
                'highlight' => 'Co-Working Space',
            ],
            [
                'name' => 'Puri Canggu Rooms',
                'category' => 'Boutique Stay & Villa Rooms',
                'logo' => 'assets/images/partners/puri-canggu-rooms.webp',
                'location' => 'Canggu, Bali',
                'benefit' => 'Affordable stay in Canggu. Cashback Voucher',
                'description' => 'Peaceful boutique accommodation in central Canggu. Affordable stay in Canggu with cashback vouchers and priority on-site technician dispatch.',
                'badge' => 'Verified Partner',
                'highlight' => 'Stay',
            ],
            [
                'name' => 'Warung Dangin',
                'category' => 'Authentic Balinese Culinary & Restaurant',
                'logo' => 'assets/images/partners/warung-dangin.webp',
                'location' => 'Bali',
                'benefit' => 'Authentic dining discount voucher for BPR clients',
                'description' => 'Authentic Balinese culinary dishes crafted with heritage recipes. Show your BPR repair invoice or WhatsApp confirmation to claim your dining discount.',
                'badge' => 'Verified Partner',
                'highlight' => 'Dining Benefit',
            ],
        ];

        return view('public.partners', compact('partners'));
    }

    public function sitemap()
    {
        $services = Service::publiclyIndexable()->get();
        $pages = Page::where('is_published', true)->get();
        // Hanya masukkan artikel kanonikal unik (singkirkan slug kloningan berakhiran -1, -2 jika induknya ada)
        $posts = Post::where('is_published', true)->get()->reject(function ($p) {
            if (preg_match('/^(.+)-\d+$/', $p->slug, $m)) {
                return Post::where('slug', $m[1])->where('is_published', true)->exists();
            }
            return false;
        });
        $locations = ServiceArea::publiclyIndexable()->get();

        return response()->view('public.sitemap', compact('services', 'pages', 'posts', 'locations'))->header('Content-Type', 'application/xml');
    }

    public function rss()
    {
        $posts = Post::where('is_published', true)->latest('published_at')->take(20)->get();

        return response()->view('public.rss', compact('posts'))->header('Content-Type', 'application/rss+xml');
    }
}
