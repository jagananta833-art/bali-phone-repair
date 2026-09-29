<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomepageController extends Controller
{
    public function edit()
    {
        $settings = Setting::pluck('value', 'key')->all();

        return view('admin.homepage.edit', [
            'settings' => $settings,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'hero_bg_image_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'hero_card1_image_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'hero_card2_image_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'hero_card3_image_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'extra_card1_image_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'extra_card2_image_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'extra_card3_image_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
        ]);

        $uploadMap = [
            'hero_bg_image_file' => 'hero_bg_image',
            'hero_card1_image_file' => 'hero_card1_image',
            'hero_card2_image_file' => 'hero_card2_image',
            'hero_card3_image_file' => 'hero_card3_image',
            'extra_card1_image_file' => 'extra_card1_image',
            'extra_card2_image_file' => 'extra_card2_image',
            'extra_card3_image_file' => 'extra_card3_image',
        ];

        $uploadDir = public_path('assets/bali-phone-repair/uploads');
        if (! file_exists($uploadDir)) {
            @mkdir($uploadDir, 0755, true);
        }

        foreach ($uploadMap as $inputName => $settingKey) {
            if ($request->hasFile($inputName)) {
                $file = $request->file($inputName);
                $ext = $file->getClientOriginalExtension() ?: 'jpg';
                $filename = $settingKey . '-' . time() . '-' . Str::random(6) . '.' . $ext;
                $file->move($uploadDir, $filename);
                $relativeUrl = 'assets/bali-phone-repair/uploads/' . $filename;
                Setting::updateOrCreate(['key' => $settingKey], ['value' => $relativeUrl]);
            }
        }

        $textKeys = [
            // Layer 1 - Hero
            'hero_location_badge',
            'hero_title',
            'hero_description',
            'hero_cta_text',
            'hero_cta_message',
            'hero_card1_tag',
            'hero_card1_tag_icon',
            'hero_card2_tag',
            'hero_card2_tag_icon',
            'hero_card3_tag',
            'hero_card3_tag_icon',

            // Layer 2 - Trust Bar
            'trust1_icon', 'trust1_title', 'trust1_subtitle',
            'trust2_icon', 'trust2_title', 'trust2_subtitle',
            'trust3_icon', 'trust3_title', 'trust3_subtitle',
            'trust4_icon', 'trust4_title', 'trust4_subtitle',

            // Layer 3 - Services
            'services_eyebrow', 'services_title', 'services_subtitle',

            // Layer 4 - How It Works
            'how_eyebrow', 'how_title', 'how_subtitle',
            'step1_title', 'step1_desc', 'step1_icon',
            'step2_title', 'step2_desc', 'step2_icon',
            'step3_title', 'step3_desc', 'step3_icon',

            // Layer 5 - Reviews
            'reviews_eyebrow', 'reviews_title', 'reviews_subtitle',

            // Layer 6 - Pricing Table
            'pricing_eyebrow', 'pricing_title', 'pricing_subtitle',
            'pricing_row1_title', 'pricing_row1_duration', 'pricing_row1_price',
            'pricing_row2_title', 'pricing_row2_duration', 'pricing_row2_price',
            'pricing_row3_title', 'pricing_row3_duration', 'pricing_row3_price',
            'pricing_row4_title', 'pricing_row4_duration', 'pricing_row4_price',
            'pricing_row5_title', 'pricing_row5_duration', 'pricing_row5_price',
            'pricing_row6_title', 'pricing_row6_duration', 'pricing_row6_price',

            // Layer 7 - Extra Services
            'extra_eyebrow', 'extra_title', 'extra_subtitle',
            'extra_card1_badge', 'extra_card1_title', 'extra_card1_desc', 'extra_card1_btn',
            'extra_card2_badge', 'extra_card2_title', 'extra_card2_desc', 'extra_card2_btn',
            'extra_card3_badge', 'extra_card3_title', 'extra_card3_desc', 'extra_card3_btn',

            // Layer 8 - FAQ
            'faq_eyebrow', 'faq_title', 'faq_subtitle',

            // Layer 9 - Bottom CTA & Contact
            'cta_title', 'cta_description', 'cta_btn_text',
            'business_name', 'phone', 'whatsapp', 'email',
            'address', 'opening_hours', 'google_maps',
            'instagram', 'facebook', 'tiktok',
        ];

        foreach ($textKeys as $key) {
            if ($request->has($key)) {
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $request->input($key)]
                );
            }
        }

        return redirect()->route('admin.homepage.edit')
            ->with('ok', 'Konten homepage per-layer berhasil disimpan dan langsung aktif di website.');
    }
}
