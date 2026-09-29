<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->index('is_published');
        });

        Schema::table('services', function (Blueprint $table) {
            $table->index(['is_published', 'sort_order']);
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->index(['is_published', 'published_at']);
            $table->index('category_id');
        });

        Schema::table('faqs', function (Blueprint $table) {
            $table->index(['is_published', 'sort_order']);
        });

        Schema::table('testimonials', function (Blueprint $table) {
            $table->index(['is_published', 'sort_order']);
        });

        Schema::table('service_areas', function (Blueprint $table) {
            $table->index(['is_published', 'sort_order']);
        });

        if (! Schema::hasTable('failed_jobs')) {
            Schema::create('failed_jobs', function (Blueprint $table) {
                $table->id();
                $table->string('uuid')->unique();
                $table->text('connection');
                $table->text('queue');
                $table->longText('payload');
                $table->longText('exception');
                $table->timestamp('failed_at')->useCurrent();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('failed_jobs');

        Schema::table('service_areas', function (Blueprint $table) {
            $table->dropIndex(['is_published', 'sort_order']);
        });

        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropIndex(['is_published', 'sort_order']);
        });

        Schema::table('faqs', function (Blueprint $table) {
            $table->dropIndex(['is_published', 'sort_order']);
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->dropIndex(['is_published', 'published_at']);
            $table->dropIndex(['category_id']);
        });

        Schema::table('services', function (Blueprint $table) {
            $table->dropIndex(['is_published', 'sort_order']);
        });

        Schema::table('pages', function (Blueprint $table) {
            $table->dropIndex(['is_published']);
        });
    }
};
