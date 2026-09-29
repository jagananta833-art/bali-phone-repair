<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service_areas', function (Blueprint $table) {
            $table->longText('long_description')->nullable()->after('description');
            $table->string('hero_image')->nullable()->after('long_description');
            $table->string('hero_image_alt')->nullable()->after('hero_image');
            $table->json('gallery')->nullable()->after('hero_image_alt');
            $table->string('map_embed_url', 2048)->nullable()->after('gallery');
            $table->decimal('latitude', 10, 7)->nullable()->after('map_embed_url');
            $table->decimal('longitude', 10, 7)->nullable()->after('latitude');
            $table->string('opening_hours')->nullable()->after('longitude');
            $table->string('phone', 40)->nullable()->after('opening_hours');
            $table->string('whatsapp', 40)->nullable()->after('phone');
            $table->string('email')->nullable()->after('whatsapp');
            $table->text('address')->nullable()->after('email');
            $table->string('postcode', 20)->nullable()->after('address');
            $table->string('service_radius')->nullable()->after('postcode');
            $table->string('meta_title', 70)->nullable()->after('service_radius');
            $table->string('meta_description', 170)->nullable()->after('meta_title');
            $table->boolean('is_indexable')->default(false)->index()->after('is_published');
        });

        Schema::create('faq_service_area', function (Blueprint $table) {
            $table->foreignId('service_area_id')->constrained()->cascadeOnDelete();
            $table->foreignId('faq_id')->constrained()->cascadeOnDelete();
            $table->unique(
                ['service_area_id', 'faq_id'],
                'faq_service_area_unique'
            );
        });

        Schema::create('nearby_service_area', function (Blueprint $table) {
            $table->foreignId('service_area_id')->constrained()->cascadeOnDelete();
            $table->foreignId('nearby_service_area_id')->constrained('service_areas')->cascadeOnDelete();
            $table->unique(
                ['service_area_id', 'nearby_service_area_id'],
                'nearby_area_pair_unique'
            );
        });

        Schema::create('post_service_area', function (Blueprint $table) {
            $table->foreignId('service_area_id')->constrained()->cascadeOnDelete();
            $table->foreignId('post_id')->constrained()->cascadeOnDelete();
            $table->unique(
                ['service_area_id', 'post_id'],
                'post_service_area_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('post_service_area');
        Schema::dropIfExists('nearby_service_area');
        Schema::dropIfExists('faq_service_area');

        Schema::table('service_areas', function (Blueprint $table) {
            $table->dropIndex(['is_indexable']);
            $table->dropColumn([
                'long_description',
                'hero_image',
                'hero_image_alt',
                'gallery',
                'map_embed_url',
                'latitude',
                'longitude',
                'opening_hours',
                'phone',
                'whatsapp',
                'email',
                'address',
                'postcode',
                'service_radius',
                'meta_title',
                'meta_description',
                'is_indexable',
            ]);
        });
    }
};
