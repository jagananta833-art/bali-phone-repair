<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Faq;
use App\Models\Page;
use App\Models\Post;
use App\Models\Service;
use App\Models\ServiceArea;
use App\Models\Setting;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $adminEmail = env('ADMIN_EMAIL', 'admin@baliphonerepair.com');
        $adminPassword = env('ADMIN_PASSWORD');

        if (! $adminPassword) {
            $adminPassword = app()->environment(['local', 'testing']) ? 'ChangeMe123!' : Str::password(24);
        }

        $admin = User::updateOrCreate(
            ['email' => $adminEmail],
            ['name' => 'Administrator', 'password' => Hash::make($adminPassword)]
        );

        $settings = [
            'business_name' => 'Bali Phone Repair',
            'phone' => '+6281929164999',
            'whatsapp' => '6281929164999',
            'address' => 'Jl. Pulau Misol No.106, Dauh Puri Kauh, Denpasar, Bali 80113',
            'email' => 'hello@baliphonerepair.com',
            'opening_hours' => 'Mo-Su 09:00-21:00',
            'hero_title' => 'iPhone, Android, MacBook, or laptop issue? We can come to your location.',
            'hero_subtitle' => 'We help with repairs, diagnostics, buying and selling phones and MacBooks, plus MacBook rentals for daily work, events, or urgent needs while you are in Bali.',
            'company_description' => 'Fast device repair, home service, buy and sell, and MacBook rental across Bali.',
            'default_meta_title' => 'Bali Phone Repair - Servis iPhone, Android, MacBook & Rental Device',
            'default_meta_description' => 'Servis iPhone, Android, laptop, MacBook, home service di Bali, jual beli device, dan rental MacBook. Teknisi bisa datang ke villa, hotel, rumah, kantor, atau coworking space.',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        $categories = collect([
            ['name' => 'Device Care', 'slug' => 'device-care', 'description' => 'Practical device care and troubleshooting guidance.'],
            ['name' => 'Repair Guide', 'slug' => 'repair-guide', 'description' => 'Repair and diagnostics articles.'],
        ])->mapWithKeys(fn ($data) => [$data['slug'] => Category::updateOrCreate(['slug' => $data['slug']], $data)]);

        $services = [
            [
                'iPhone Repair Bali',
                'iphone-repair-bali',
                'iPhone screen, battery, charging, camera, speaker, microphone, water exposure, and software diagnostics in Bali.',
                'change-screen-optimized.jpg',
                'iPhone screen repair documentation',
                '<p>iPhone repair starts with checking the model, symptoms, previous repair history, and whether important data needs extra care. Common requests include cracked screen, battery health warnings, charging port issues, camera problems, no sound, microphone issues, water exposure, stuck logo, and iOS software problems.</p><p>Send the iPhone model, photos of the damage, battery health screenshot if relevant, and your Bali location. The team can then suggest whether the next step is a parts check, software diagnosis, or in-person inspection.</p>',
            ],
            [
                'MacBook Repair Bali',
                'macbook-repair-bali',
                'MacBook screen, battery, keyboard, trackpad, fan, charging, software, and data support for Bali customers.',
                'macbook-laptop-repair-optimized.jpg',
                'MacBook repair service documentation',
                '<p>MacBook repair requires careful diagnosis because one symptom can come from battery, charger, logic board, keyboard, trackpad, fan, macOS, or storage issues. Tell us the model year, chip type if known, cycle count, recent liquid exposure, and whether the issue appears before or after login.</p><p>Typical MacBook requests include battery service, screen damage, keyboard and trackpad problems, overheating, fan noise, charger issues, macOS reinstall, slow performance, and data backup before repair.</p>',
            ],
            [
                'iPad Repair Bali',
                'ipad-repair-bali',
                'iPad screen, battery, charging, button, speaker, and software diagnosis for common iPad problems in Bali.',
                'service-optimized.jpg',
                'Device repair service documentation',
                '<p>iPad repair often starts by checking the exact model number because parts and repair approach differ between iPad, iPad Air, iPad mini, and iPad Pro. Common issues include cracked glass, touch problems, battery drain, no charging, button problems, speaker issues, and software lockups.</p><p>Before booking, send the iPad model number from the back cover or settings, photos of the screen, and a short note about when the problem started.</p>',
            ],
            [
                'Android Repair Bali',
                'android-repair-bali',
                'Android diagnostics for screen, battery, charging, speaker, software, and component issues in Bali.',
                'android-buy-sell-optimized.jpg',
                'Android phone service documentation',
                '<p>Android repair depends heavily on brand and model, so the first step is identifying the device, issue, and part availability. Common requests include broken screen, weak battery, charging port trouble, speaker or microphone issues, camera errors, boot loops, and software problems.</p><p>Send the brand, model, photos, and whether the device has been dropped, exposed to water, or repaired before. This helps the team give a more useful estimate before inspection.</p>',
            ],
            [
                'Laptop Repair Bali',
                'laptop-repair-bali',
                'Laptop troubleshooting for power, keyboard, storage, software, overheating, and performance issues in Bali.',
                'keyboard-trackpad-fan-optimized.jpg',
                'Laptop keyboard and trackpad service documentation',
                '<p>Laptop repair covers Windows laptops and selected hardware or software issues such as no power, keyboard problems, overheating, storage failure, slow performance, battery issues, display problems, and OS reinstall needs.</p><p>Send the laptop brand, model, symptoms, charger condition, and whether you need data backup before repair. For business or travel situations, explain your deadline so the team can recommend the most practical option.</p>',
            ],
            [
                'Data Recovery Bali',
                'data-recovery-bali',
                'Data recovery assessment for phones, MacBooks, laptops, and storage devices where recovery may still be possible.',
                'software-dan-data-optimized.jpg',
                'Device software and data service documentation',
                '<p>Data recovery is handled as an assessment first, not a guaranteed result. The chance of recovery depends on device condition, storage health, encryption, water damage, prior repair attempts, and whether the device still powers on.</p><p>Stop using the device if files are missing or storage seems unstable. Send the device type, what data is needed, what happened before the data loss, and whether the device still turns on.</p>',
            ],
        ];

        foreach ($services as $index => [$name, $slug, $summary, $image, $imageAlt, $content]) {
            Service::updateOrCreate(['slug' => $slug], [
                'name' => $name,
                'short_description' => $summary,
                'content' => $content,
                'image' => $image,
                'image_alt' => $imageAlt,
                'meta_title' => $name.' | Bali Phone Repair',
                'meta_description' => $summary,
                'focus_keyword' => $name,
                'sort_order' => $index,
                'is_published' => true,
                'is_indexable' => true,
            ]);
        }

        foreach ([
            ['about', 'About Bali Phone Repair', 'Device repair support in Bali for phones, tablets, laptops, MacBooks, device trade, and rental needs.', '<p>Bali Phone Repair helps customers in Bali understand device problems before repair work starts. The process is practical: share the device model, symptoms, photos, and location, then confirm the next diagnostic step.</p><p>The website CMS keeps services, guides, service areas, FAQs, and business information editable without changing the approved homepage design.</p>'],
            ['contact', 'Contact Bali Phone Repair', 'Contact Bali Phone Repair by WhatsApp for repair, home service, buy and sell, or MacBook rental inquiries.', '<p>For the fastest response, send your device model, issue details, clear photos or video, and your Bali location by WhatsApp. If the device contains important data, mention it before any repair decision.</p><p>Opening hours and service availability can change by schedule, area, and part availability, so confirm before visiting or booking home care.</p>'],
            ['privacy-policy', 'Privacy Policy', 'How Bali Phone Repair handles basic website and contact information.', '<p>Contact details shared through this website are used to respond to service inquiries. Do not submit sensitive passwords or private account credentials.</p>'],
            ['terms-and-conditions', 'Terms and Conditions', 'Website and service inquiry terms.', '<p>Information on this website is for service inquiry and general guidance. Final diagnosis depends on physical device condition and part availability.</p>'],
        ] as [$slug, $title, $excerpt, $content]) {
            Page::updateOrCreate(['slug' => $slug], [
                'title' => $title,
                'excerpt' => $excerpt,
                'content' => $content,
                'meta_title' => $title.' | Bali Phone Repair',
                'meta_description' => $excerpt,
                'focus_keyword' => $title,
                'is_published' => true,
            ]);
        }

        foreach ([
            ['Denpasar', 'denpasar', 'Service inquiries and device diagnostics for customers around Denpasar.'],
            ['Canggu', 'canggu', 'Device repair inquiries for Canggu residents, remote workers, and travelers.'],
            ['Seminyak', 'seminyak', 'Phone, laptop, and MacBook repair inquiry support around Seminyak.'],
            ['Ubud', 'ubud', 'Repair consultation and device troubleshooting inquiries for Ubud.'],
            ['Kuta', 'kuta', 'Device repair support and WhatsApp diagnosis inquiries around Kuta.'],
            ['Sanur', 'sanur', 'Phone and laptop repair inquiries for Sanur and nearby areas.'],
        ] as $index => [$name, $slug, $description]) {
            ServiceArea::updateOrCreate(['slug' => $slug], ['name' => $name, 'description' => $description, 'sort_order' => $index, 'is_published' => true]);
        }

        foreach ([
            ['Can your technician come to my location?', 'Yes. Send your location first so we can check the service area, schedule, and estimated arrival time.'],
            ['Is the repair price fixed?', 'The final price depends on the device model, damage condition, part quality, and stock availability. We always share an estimate before starting.'],
            ['Is my data safe during repair?', 'We focus on the hardware or software issue you approve. For data-sensitive cases, tell us first so we can recommend the safest handling.'],
            ['Can you repair laptops other than MacBook?', 'Yes, for common issues such as battery, keyboard, overheating, software, storage, and initial diagnostics.'],
            ['How does MacBook rental work?', 'Send the rental date, duration, usage needs, and location. We will confirm available units, deposit, and rental terms via WhatsApp.'],
        ] as $index => [$question, $answer]) {
            Faq::updateOrCreate(['question' => $question], ['answer' => $answer, 'sort_order' => $index, 'is_published' => true]);
        }

        $pilotService = Service::where('slug', 'iphone-repair-bali')->firstOrFail();
        $pilotService->faqs()->sync(Faq::whereIn('question', [
            'Can your technician come to my location?',
            'Is the repair price fixed?',
            'Is my data safe during repair?',
        ])->pluck('id'));
        $pilotService->relatedServices()->sync(Service::whereIn('slug', [
            'ipad-repair-bali',
            'android-repair-bali',
        ])->pluck('id'));
        $pilotService->serviceAreas()->sync(ServiceArea::whereIn('slug', [
            'denpasar',
            'seminyak',
            'sanur',
        ])->pluck('id'));

        Testimonial::updateOrCreate(['name' => 'Andang Kumala'], [
            'role' => 'Customer',
            'quote' => 'Fast response, clear estimate, and the technician explained the repair before starting. Very helpful for home service in Bali.',
            'sort_order' => 0,
            'is_published' => true,
        ]);

        Testimonial::updateOrCreate(['name' => 'Rizky S.'], [
            'role' => 'Customer',
            'quote' => 'Recommended. The team helped check my phone issue quickly and the process was easy through WhatsApp.',
            'sort_order' => 1,
            'is_published' => true,
        ]);

        Post::updateOrCreate(['slug' => 'iphone-battery-drains-fast-in-bali'], [
            'category_id' => $categories['device-care']->id,
            'user_id' => $admin->id,
            'title' => 'Why Your iPhone Battery Drains Fast in Bali',
            'excerpt' => 'Common reasons an iPhone battery may drain faster in Bali and when diagnostics are useful.',
            'content' => '<p>Heat, background apps, poor signal, battery age, and charging habits can all affect battery life. Start by checking Battery Health and recent app usage before replacing parts.</p>',
            'featured_image' => 'replace-the-battery-optimized.jpg',
            'meta_title' => 'iPhone Battery Drains Fast in Bali | Bali Phone Repair',
            'meta_description' => 'Learn common reasons iPhone batteries drain fast in Bali and when to request diagnostics.',
            'focus_keyword' => 'iPhone battery Bali',
            'is_published' => true,
            'published_at' => now()->subDays(4),
        ]);

        Post::updateOrCreate(['slug' => 'macbook-keyboard-trackpad-issues'], [
            'category_id' => $categories['repair-guide']->id,
            'user_id' => $admin->id,
            'title' => 'MacBook Keyboard and Trackpad Issues: What to Check First',
            'excerpt' => 'Simple checks before requesting MacBook keyboard or trackpad service in Bali.',
            'content' => '<p>Restart the MacBook, check external input devices, inspect for liquid exposure, and note whether the issue happens before or after login. This helps narrow the diagnosis.</p>',
            'featured_image' => 'keyboard-trackpad-fan-optimized.jpg',
            'meta_title' => 'MacBook Keyboard and Trackpad Repair Bali | Bali Phone Repair',
            'meta_description' => 'What to check before requesting MacBook keyboard or trackpad repair support in Bali.',
            'focus_keyword' => 'MacBook repair Bali',
            'is_published' => true,
            'published_at' => now()->subDays(2),
        ]);

        Post::updateOrCreate(['slug' => 'draft-example-not-public'], [
            'category_id' => $categories['repair-guide']->id,
            'user_id' => $admin->id,
            'title' => 'Draft Example Not Public',
            'excerpt' => 'This seeded draft verifies public draft protection.',
            'content' => '<p>This post should return 404 publicly.</p>',
            'is_published' => false,
            'published_at' => null,
        ]);
    }
}
