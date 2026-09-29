<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\Service;
use App\Models\ServiceArea;
use App\Models\Post;
use Illuminate\Database\Seeder;

class BrowserQaSeeder extends Seeder
{
    public function run(): void
    {
        $faq = Faq::updateOrCreate(
            ['question' => 'Browser QA temporary service question?'],
            [
                'answer' => 'This answer exists only in the disposable browser QA database.',
                'is_published' => true,
                'sort_order' => 99,
            ],
        );

        $published = Service::updateOrCreate(
            ['slug' => 'browser-qa-temp-service'],
            [
                'name' => 'Browser QA Temporary Service',
                'short_description' => 'Temporary service record used only by automated local browser QA.',
                'content' => '<h2>Temporary QA content</h2><p>This record is deleted with the disposable QA database.</p>',
                'image' => 'service-optimized.jpg',
                'image_alt' => 'Temporary browser QA service image',
                'meta_title' => 'Browser QA Temporary Service | Bali Phone Repair',
                'meta_description' => 'Temporary service record used only by automated local browser QA.',
                'focus_keyword' => 'Browser QA Temporary Service',
                'is_published' => true,
                'is_indexable' => true,
                'sort_order' => 90,
            ],
        );

        $draft = Service::updateOrCreate(
            ['slug' => 'browser-qa-draft-service'],
            [
                'name' => 'Browser QA Draft Service',
                'short_description' => 'Disposable unpublished browser QA record.',
                'content' => '<p>Disposable unpublished browser QA content.</p>',
                'meta_title' => 'Browser QA Draft Service | Bali Phone Repair',
                'meta_description' => 'Disposable unpublished browser QA record.',
                'is_published' => false,
                'is_indexable' => true,
                'sort_order' => 91,
            ],
        );

        Service::updateOrCreate(
            ['slug' => 'browser-qa-noindex-service'],
            [
                'name' => 'Browser QA Noindex Service',
                'short_description' => 'Disposable noindex browser QA record.',
                'content' => '<p>Disposable noindex browser QA content.</p>',
                'meta_title' => 'Browser QA Noindex Service | Bali Phone Repair',
                'meta_description' => 'Disposable noindex browser QA record.',
                'is_published' => true,
                'is_indexable' => false,
                'sort_order' => 92,
            ],
        );

        $published->faqs()->sync([$faq->id]);
        $published->relatedServices()->sync(
            Service::whereIn('slug', ['ipad-repair-bali', 'android-repair-bali'])->pluck('id'),
        );
        $published->serviceAreas()->sync(
            ServiceArea::whereIn('slug', ['denpasar', 'sanur'])->pluck('id'),
        );

        Service::where('slug', 'iphone-repair-bali')
            ->firstOrFail()
            ->relatedServices()
            ->syncWithoutDetaching([$draft->id]);

        $nearbyLocation = ServiceArea::updateOrCreate(
            ['slug' => 'browser-qa-nearby-location'],
            [
                'name' => 'Browser QA Nearby Location',
                'description' => 'Temporary nearby location used only by automated local browser QA.',
                'long_description' => '<p>This nearby location exists only in the disposable QA database.</p>',
                'hero_image' => 'service-optimized.jpg',
                'hero_image_alt' => 'Temporary nearby browser QA location',
                'meta_title' => 'Browser QA Nearby Location | Bali Phone Repair',
                'meta_description' => 'Temporary nearby location used only by automated local browser QA.',
                'address' => 'Disposable QA address, Bali',
                'is_published' => true,
                'is_indexable' => true,
                'sort_order' => 90,
            ],
        );

        $location = ServiceArea::updateOrCreate(
            ['slug' => 'browser-qa-location'],
            [
                'name' => 'Browser QA Location',
                'description' => 'Temporary location record used only by automated local browser QA.',
                'long_description' => '<h2>Temporary location content</h2><p>This record is deleted with the disposable QA database.</p>',
                'hero_image' => 'service-optimized.jpg',
                'hero_image_alt' => 'Temporary browser QA location image',
                'gallery' => [['path' => 'service-optimized.jpg', 'alt' => 'Temporary browser QA gallery image']],
                'map_embed_url' => 'https://www.google.com/maps/embed?pb=browser-qa',
                'latitude' => -8.6500000,
                'longitude' => 115.2166670,
                'opening_hours' => 'Mo-Fr 09:00-17:00',
                'phone' => '+62 800 000 000',
                'whatsapp' => '62800000000',
                'email' => 'location@example.test',
                'address' => 'Disposable QA address, Bali',
                'postcode' => '80000',
                'service_radius' => 'Disposable QA service radius.',
                'meta_title' => 'Browser QA Location | Bali Phone Repair',
                'meta_description' => 'Temporary location record used only by automated local browser QA.',
                'is_published' => true,
                'is_indexable' => true,
                'sort_order' => 91,
            ],
        );

        ServiceArea::updateOrCreate(
            ['slug' => 'browser-qa-draft-location'],
            [
                'name' => 'Browser QA Draft Location',
                'description' => 'Disposable draft location.',
                'long_description' => '<p>Disposable draft location.</p>',
                'meta_title' => 'Browser QA Draft Location | Bali Phone Repair',
                'meta_description' => 'Disposable draft location used in local browser QA.',
                'address' => 'Disposable QA address',
                'is_published' => false,
                'is_indexable' => true,
                'sort_order' => 92,
            ],
        );

        ServiceArea::updateOrCreate(
            ['slug' => 'browser-qa-noindex-location'],
            [
                'name' => 'Browser QA Noindex Location',
                'description' => 'Disposable noindex location.',
                'long_description' => '<p>Disposable noindex location.</p>',
                'meta_title' => 'Browser QA Noindex Location | Bali Phone Repair',
                'meta_description' => 'Disposable noindex location used in local browser QA.',
                'address' => 'Disposable QA address',
                'is_published' => true,
                'is_indexable' => false,
                'sort_order' => 93,
            ],
        );

        $location->faqs()->sync([$faq->id]);
        $location->services()->sync(
            Service::whereIn('slug', ['iphone-repair-bali', 'ipad-repair-bali'])->pluck('id'),
        );
        $location->nearbyLocations()->sync([$nearbyLocation->id]);
        $location->relatedArticles()->sync(
            Post::where('is_published', true)->take(1)->pluck('id'),
        );
    }
}
