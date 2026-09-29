<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'content',
        'image',
        'image_alt',
        'meta_title',
        'meta_description',
        'focus_keyword',
        'is_published',
        'is_indexable',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'is_indexable' => 'boolean',
        ];
    }

    public function faqs(): BelongsToMany
    {
        return $this->belongsToMany(Faq::class)->orderBy('sort_order');
    }

    public function relatedServices(): BelongsToMany
    {
        return $this->belongsToMany(
            self::class,
            'related_service',
            'service_id',
            'related_service_id',
        )->orderBy('sort_order');
    }

    public function serviceAreas(): BelongsToMany
    {
        return $this->belongsToMany(ServiceArea::class)->orderBy('sort_order');
    }

    public function scopePubliclyIndexable($query)
    {
        return $query->where('is_published', true)->where('is_indexable', true);
    }
}
