<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ServiceArea extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
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
        'is_published',
        'is_indexable',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'gallery' => 'array',
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
            'is_published' => 'boolean',
            'is_indexable' => 'boolean',
        ];
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class);
    }

    public function faqs(): BelongsToMany
    {
        return $this->belongsToMany(Faq::class)->orderBy('sort_order');
    }

    public function nearbyLocations(): BelongsToMany
    {
        return $this->belongsToMany(
            self::class,
            'nearby_service_area',
            'service_area_id',
            'nearby_service_area_id',
        )->orderBy('sort_order');
    }

    public function relatedArticles(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_service_area')->latest('published_at');
    }

    public function scopePubliclyIndexable($query)
    {
        return $query->where('is_published', true)->where('is_indexable', true);
    }
}
