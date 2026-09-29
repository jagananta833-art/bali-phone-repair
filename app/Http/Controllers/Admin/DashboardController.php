<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Faq, Page, Post, Service, ServiceArea, Setting, Testimonial};

class DashboardController extends Controller
{
    public function index()
    {
        $counts = [
            'services' => Service::count(),
            'pages' => Page::count(),
            'posts' => Post::count(),
            'faqs' => Faq::count(),
            'testimonials' => Testimonial::count(),
            'areas' => ServiceArea::count(),
        ];

        $lastUpdated = collect([
            Service::latest('updated_at')->first(),
            Page::latest('updated_at')->first(),
            Post::latest('updated_at')->first(),
            Faq::latest('updated_at')->first(),
            Testimonial::latest('updated_at')->first(),
            ServiceArea::latest('updated_at')->first(),
        ])->filter()->sortByDesc('updated_at')->first();

        $settings = Setting::pluck('value', 'key')->toArray();

        return view('admin.dashboard', [
            'counts' => $counts,
            'recentPosts' => Post::latest('updated_at')->take(5)->get(),
            'recentServices' => Service::orderByDesc('updated_at')->take(5)->get(),
            'lastUpdated' => $lastUpdated,
            'settings' => $settings,
        ]);
    }
}
