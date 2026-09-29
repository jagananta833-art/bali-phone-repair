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

    public function sitemap()
    {
        $services = Service::publiclyIndexable()->get();
        $pages = Page::where('is_published', true)->get();
        $posts = Post::where('is_published', true)->get();
        $locations = ServiceArea::publiclyIndexable()->get();

        return response()->view('public.sitemap', compact('services', 'pages', 'posts', 'locations'))->header('Content-Type', 'application/xml');
    }

    public function rss()
    {
        $posts = Post::where('is_published', true)->latest('published_at')->take(20)->get();

        return response()->view('public.rss', compact('posts'))->header('Content-Type', 'application/rss+xml');
    }
}
