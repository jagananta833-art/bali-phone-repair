<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->boolean('is_indexable')->default(true)->index()->after('is_published');
        });

        Schema::create('faq_service', function (Blueprint $table) {
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();
            $table->foreignId('faq_id')->constrained()->cascadeOnDelete();
            $table->unique(['service_id', 'faq_id']);
        });

        Schema::create('related_service', function (Blueprint $table) {
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();
            $table->foreignId('related_service_id')->constrained('services')->cascadeOnDelete();
            $table->unique(['service_id', 'related_service_id']);
        });

        Schema::create('service_service_area', function (Blueprint $table) {
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();
            $table->foreignId('service_area_id')->constrained()->cascadeOnDelete();
            $table->unique(['service_id', 'service_area_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_service_area');
        Schema::dropIfExists('related_service');
        Schema::dropIfExists('faq_service');

        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('is_indexable');
        });
    }
};
