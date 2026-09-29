<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class LocationRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $name = (string) $this->input('name');
        $slug = (string) $this->input('slug');

        if ($name !== '') {
            $this->merge(['slug' => $slug !== '' ? Str::slug($slug) : Str::slug($name)]);
        }
    }

    public function rules(): array
    {
        $location = $this->route('serviceArea');

        return [
            'name' => ['required', 'string', 'max:160'],
            'slug' => ['required', 'string', 'max:160', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/', Rule::unique('service_areas', 'slug')->ignore($location?->id)],
            'description' => ['required', 'string', 'max:500'],
            'long_description' => ['required_if:is_indexable,1', 'nullable', 'string'],
            'hero_image' => ['nullable', 'string', 'max:255', 'regex:/^[A-Za-z0-9._\/-]+$/', 'not_regex:/\.\./'],
            'hero_image_alt' => ['nullable', 'string', 'max:160', 'required_with:hero_image'],
            'gallery' => ['nullable', 'string'],
            'map_embed_url' => ['nullable', 'url:https', 'max:2048', 'regex:/^https:\/\/(?:www\.)?google\.[^\/]+\/maps\/embed(?:\?|\/)/i'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90', 'required_with:longitude'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180', 'required_with:latitude'],
            'opening_hours' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:40', 'regex:/^\+?[0-9][0-9\s().-]{5,39}$/'],
            'whatsapp' => ['nullable', 'string', 'max:40', 'regex:/^\+?[0-9][0-9\s().-]{5,39}$/'],
            'email' => ['nullable', 'email:rfc', 'max:255'],
            'address' => ['required_if:is_indexable,1', 'nullable', 'string', 'max:1000'],
            'postcode' => ['nullable', 'string', 'max:20'],
            'service_radius' => ['nullable', 'string', 'max:255'],
            'meta_title' => ['required_if:is_indexable,1', 'nullable', 'string', 'max:70'],
            'meta_description' => ['required_if:is_indexable,1', 'nullable', 'string', 'max:170'],
            'sort_order' => ['nullable', 'integer'],
            'is_published' => ['nullable', 'boolean'],
            'is_indexable' => ['nullable', 'boolean'],
            'faq_ids' => ['nullable', 'array'],
            'faq_ids.*' => ['integer', 'distinct', Rule::exists('faqs', 'id')],
            'service_ids' => ['nullable', 'array'],
            'service_ids.*' => ['integer', 'distinct', Rule::exists('services', 'id')],
            'nearby_location_ids' => ['nullable', 'array'],
            'nearby_location_ids.*' => ['integer', 'distinct', Rule::exists('service_areas', 'id')],
            'related_article_ids' => ['nullable', 'array'],
            'related_article_ids.*' => ['integer', 'distinct', Rule::exists('posts', 'id')],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator): void {
            $location = $this->route('serviceArea');
            $nearbyIds = array_map('intval', $this->input('nearby_location_ids', []));

            if ($location && in_array($location->id, $nearbyIds, true)) {
                $validator->errors()->add('nearby_location_ids', 'A location cannot be nearby itself.');
            }

            foreach ($this->galleryEntries() as $index => $entry) {
                if (! preg_match('/^[A-Za-z0-9._\/-]+$/', $entry['path'])
                    || str_contains($entry['path'], '..')
                    || mb_strlen($entry['alt']) > 160) {
                    $validator->errors()->add('gallery', 'Gallery line '.($index + 1).' must use a safe image path and alt text of 160 characters or fewer.');
                }
            }
        });
    }

    public function prepared(): array
    {
        $data = $this->validated();
        unset($data['faq_ids'], $data['service_ids'], $data['nearby_location_ids'], $data['related_article_ids']);
        $data['gallery'] = $this->galleryEntries() ?: null;
        $data['is_published'] = match ($this->input('intent')) {
            'draft' => false,
            'publish' => true,
            default => $this->boolean('is_published'),
        };
        $data['is_indexable'] = $this->boolean('is_indexable');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        return $data;
    }

    public function relationshipIds(): array
    {
        return [
            'faq_ids' => array_map('intval', $this->validated('faq_ids', [])),
            'service_ids' => array_map('intval', $this->validated('service_ids', [])),
            'nearby_location_ids' => array_map('intval', $this->validated('nearby_location_ids', [])),
            'related_article_ids' => array_map('intval', $this->validated('related_article_ids', [])),
        ];
    }

    private function galleryEntries(): array
    {
        return collect(preg_split('/\R/', (string) $this->input('gallery')) ?: [])
            ->map(fn (string $line) => trim($line))
            ->filter()
            ->map(function (string $line): array {
                [$path, $alt] = array_pad(array_map('trim', explode('|', $line, 2)), 2, '');

                return ['path' => $path, 'alt' => $alt];
            })
            ->values()
            ->all();
    }
}
