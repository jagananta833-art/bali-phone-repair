<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomepageController extends Controller
{
    /**
     * Konfigurasi 9 Section / Layer Website (ala yourbaliassistant.com)
     */
    public static function getSections(): array
    {
        return [
            'hero' => [
                'layer_num' => 1,
                'layer_tag' => 'Layer 1',
                'title' => 'Hero & Background Visual',
                'description' => 'Kelola headline H1, subheadline, badge lokasi panggilan, WhatsApp template, background mobil layanan, dan 3 kartu teknisi.',
                'anchor' => '',
                'example' => 'Fast & Professional Device Repair in Bali — We come to you across Bali',
                'image_fields' => ['hero_bg_image_file', 'hero_card1_image_file', 'hero_card2_image_file', 'hero_card3_image_file'],
                'text_keys' => [
                    'hero_location_badge', 'hero_title', 'hero_description', 'hero_cta_text', 'hero_cta_message',
                    'hero_card1_tag', 'hero_card2_tag', 'hero_card3_tag',
                ],
            ],
            'trust' => [
                'layer_num' => 2,
                'layer_tag' => 'Layer 2',
                'title' => 'Trust Bar (Keunggulan Cepat)',
                'description' => '4 poin kepercayaan utama yang muncul di bawah hero (On-Site Repair, OEM Parts, Garansi, No Fix No Fee).',
                'anchor' => 'layer-2',
                'example' => 'On-Site Repair / OEM Parts / 30-90 Day Warranty / No Fix No Fee',
                'image_fields' => [],
                'text_keys' => [
                    'trust1_icon', 'trust1_title', 'trust1_subtitle',
                    'trust2_icon', 'trust2_title', 'trust2_subtitle',
                    'trust3_icon', 'trust3_title', 'trust3_subtitle',
                    'trust4_icon', 'trust4_title', 'trust4_subtitle',
                ],
            ],
            'services' => [
                'layer_num' => 3,
                'layer_tag' => 'Layer 3',
                'title' => 'Layanan Servis Unggulan (Services Overview)',
                'description' => 'Judul, subjudul, dan teks pengantar untuk grid layanan perbaikan perangkat utama.',
                'anchor' => 'services',
                'example' => 'Our Core Repair Services — Same-Day Fixes for iPhone, Android & MacBook',
                'collection_route' => 'admin.services.index',
                'collection_label' => 'Buka Master Halaman Layanan',
                'image_fields' => [],
                'text_keys' => ['services_eyebrow', 'services_title', 'services_subtitle'],
            ],
            'how' => [
                'layer_num' => 4,
                'layer_tag' => 'Layer 4',
                'title' => 'Cara Kerja (How It Works - 3 Langkah)',
                'description' => 'Penjelasan 3 tahap servis mudah: 1. Hubungi Kami, 2. Teknisi Datang / Workshop, 3. HP Siap Digunakan.',
                'anchor' => 'cara-kerja',
                'example' => 'Simple, Fast, and Stress-Free — 1. Contact Us -> 2. We Repair -> 3. Ready to Go',
                'image_fields' => [],
                'text_keys' => [
                    'how_eyebrow', 'how_title', 'how_subtitle',
                    'step1_title', 'step1_desc', 'step1_icon',
                    'step2_title', 'step2_desc', 'step2_icon',
                    'step3_title', 'step3_desc', 'step3_icon',
                ],
            ],
            'reviews' => [
                'layer_num' => 5,
                'layer_tag' => 'Layer 5',
                'title' => 'Ulasan & Testimoni Pelanggan',
                'description' => 'Heading ulasan pelanggan, rating Google (4.9★), dan pengantar bukti kepuasan pelanggan.',
                'anchor' => 'ulasan',
                'example' => 'Trusted by 10,000+ Travelers & Locals in Bali',
                'collection_route' => 'admin.content.index',
                'collection_param' => 'testimonials',
                'collection_label' => 'Kelola Daftar Testimoni',
                'image_fields' => [],
                'text_keys' => ['reviews_eyebrow', 'reviews_title', 'reviews_subtitle'],
            ],
            'pricing' => [
                'layer_num' => 6,
                'layer_tag' => 'Layer 6',
                'title' => 'Daftar Harga Transparan (Pricing Table)',
                'description' => 'Tabel perkiraan biaya servis cepat (layar, baterai, port charger, kamera) beserta durasi pengerjaan.',
                'anchor' => 'harga',
                'example' => 'Transparent Pricing & Fast Turnaround — Screen from Rp 350k, Battery from Rp 300k',
                'image_fields' => [],
                'text_keys' => [
                    'pricing_eyebrow', 'pricing_title', 'pricing_subtitle',
                    'pricing_row1_title', 'pricing_row1_duration', 'pricing_row1_price',
                    'pricing_row2_title', 'pricing_row2_duration', 'pricing_row2_price',
                    'pricing_row3_title', 'pricing_row3_duration', 'pricing_row3_price',
                    'pricing_row4_title', 'pricing_row4_duration', 'pricing_row4_price',
                    'pricing_row5_title', 'pricing_row5_duration', 'pricing_row5_price',
                    'pricing_row6_title', 'pricing_row6_duration', 'pricing_row6_price',
                ],
            ],
            'extra' => [
                'layer_num' => 7,
                'layer_tag' => 'Layer 7',
                'title' => 'Layanan Ekstra (Jual-Beli & Rental HP)',
                'description' => '3 kartu promosi bisnis: Jual HP Bekas, Beli Unit Baru, dan Rental iPhone harian/mingguan untuk turis di Bali.',
                'anchor' => 'jual-beli',
                'example' => 'Device Trade-In & Tourist Phone Rental — Rent an iPhone in Bali',
                'image_fields' => ['extra_card1_image_file', 'extra_card2_image_file', 'extra_card3_image_file'],
                'text_keys' => [
                    'extra_eyebrow', 'extra_title', 'extra_subtitle',
                    'extra_card1_badge', 'extra_card1_title', 'extra_card1_desc', 'extra_card1_btn',
                    'extra_card2_badge', 'extra_card2_title', 'extra_card2_desc', 'extra_card2_btn',
                    'extra_card3_badge', 'extra_card3_title', 'extra_card3_desc', 'extra_card3_btn',
                ],
            ],
            'faq' => [
                'layer_num' => 8,
                'layer_tag' => 'Layer 8',
                'title' => 'Tanya Jawab (FAQ)',
                'description' => 'Heading dan pengantar bagian pertanyaan yang sering ditanyakan seputar servis HP di Bali.',
                'anchor' => 'faq',
                'example' => 'Frequently Asked Questions — Got Questions? We Have Answers',
                'collection_route' => 'admin.content.index',
                'collection_param' => 'faqs',
                'collection_label' => 'Kelola Daftar Tanya Jawab (FAQ)',
                'image_fields' => [],
                'text_keys' => ['faq_eyebrow', 'faq_title', 'faq_subtitle'],
            ],
            'contact' => [
                'layer_num' => 9,
                'layer_tag' => 'Layer 9',
                'title' => 'Banner Bawah, Kontak & Alamat Toko',
                'description' => 'Banner ajakan perbaikan, kontak WhatsApp, nomor telepon, alamat outlet Denpasar, jam buka, Google Maps, dan link medsos.',
                'anchor' => 'kontak',
                'example' => 'Ready to Fix Your Phone Today? — Jl. Pulau Misol No.106 Denpasar',
                'image_fields' => [],
                'text_keys' => [
                    'cta_title', 'cta_description', 'cta_btn_text',
                    'business_name', 'phone', 'whatsapp', 'email',
                    'address', 'opening_hours', 'google_maps',
                    'instagram', 'facebook', 'tiktok',
                ],
            ],
        ];
    }

    /**
     * Halaman Hub / Katalog Pilihan Section (Ala yourbaliasistant.com)
     */
    public function index()
    {
        $sections = self::getSections();
        $settings = Setting::pluck('value', 'key')->all();

        return view('admin.homepage.index', compact('sections', 'settings'));
    }

    /**
     * Halaman Edit Khusus 1 Section Tertentu
     */
    public function editSection(string $section)
    {
        $sections = self::getSections();
        abort_unless(isset($sections[$section]), 404);

        $info = $sections[$section];
        $settings = Setting::pluck('value', 'key')->all();

        return view('admin.homepage.section-edit', compact('section', 'info', 'settings', 'sections'));
    }

    /**
     * Simpan Perubahan Khusus 1 Section Tertentu
     */
    public function updateSection(Request $request, string $section)
    {
        $sections = self::getSections();
        abort_unless(isset($sections[$section]), 404);

        $info = $sections[$section];

        // Validasi upload foto jika ada field foto di section ini
        $rules = [];
        foreach ($info['image_fields'] as $imgField) {
            $rules[$imgField] = ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'];
        }
        if (!empty($rules)) {
            $request->validate($rules);
        }

        // Proses upload gambar
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
        if (!file_exists($uploadDir)) {
            @mkdir($uploadDir, 0755, true);
        }

        foreach ($info['image_fields'] as $inputName) {
            if ($request->hasFile($inputName) && isset($uploadMap[$inputName])) {
                $settingKey = $uploadMap[$inputName];
                $file = $request->file($inputName);
                $ext = $file->getClientOriginalExtension() ?: 'jpg';
                $filename = $settingKey . '-' . time() . '-' . Str::random(6) . '.' . $ext;
                $file->move($uploadDir, $filename);
                $relativeUrl = 'assets/bali-phone-repair/uploads/' . $filename;
                Setting::updateOrCreate(['key' => $settingKey], ['value' => $relativeUrl]);
            }
        }

        // Simpan field teks milik section ini
        foreach ($info['text_keys'] as $key) {
            if ($request->has($key)) {
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $request->input($key)]
                );
            }
        }

        return redirect()->route('admin.homepage.sections.edit', $section)
            ->with('ok', $info['title'] . ' berhasil disimpan dan langsung aktif di website!');
    }

    /**
     * Legacy: Tampilan Form Lengkap 9 Layer Sekaligus
     */
    public function edit()
    {
        $settings = Setting::pluck('value', 'key')->all();

        return view('admin.homepage.edit', [
            'settings' => $settings,
        ]);
    }

    /**
     * Legacy: Simpan Form Lengkap 9 Layer Sekaligus
     */
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

        $allTextKeys = [];
        foreach (self::getSections() as $sec) {
            $allTextKeys = array_merge($allTextKeys, $sec['text_keys']);
        }

        foreach ($allTextKeys as $key) {
            if ($request->has($key)) {
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $request->input($key)]
                );
            }
        }

        return redirect()->route('admin.homepage.index')
            ->with('ok', 'Seluruh konten homepage berhasil disimpan.');
    }
}
