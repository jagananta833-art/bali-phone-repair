<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Validator;
use Illuminate\Validation\Rule;

class ServiceRequest extends FormRequest
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
        $service = $this->route('service');

        return [
            'name' => ['required', 'string', 'max:160'],
            'slug' => ['required', 'string', 'max:160', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/', Rule::unique('services', 'slug')->ignore($service?->id)],
            'short_description' => ['required', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'image' => ['nullable', 'string', 'max:255', 'regex:/^[A-Za-z0-9._\/-]+$/', 'not_regex:/\.\./'],
            'image_alt' => ['nullable', 'string', 'max:160', 'required_with:image'],
            'meta_title' => ['nullable', 'string', 'max:70', 'required_if:is_indexable,1'],
            'meta_description' => ['nullable', 'string', 'max:170', 'required_if:is_indexable,1'],
            'focus_keyword' => ['nullable', 'string', 'max:120'],
            'sort_order' => ['nullable', 'integer'],
            'is_published' => ['nullable', 'boolean'],
            'is_indexable' => ['nullable', 'boolean'],
            'faq_ids' => ['nullable', 'array'],
            'faq_ids.*' => ['integer', 'distinct', Rule::exists('faqs', 'id')],
            'related_service_ids' => ['nullable', 'array'],
            'related_service_ids.*' => ['integer', 'distinct', Rule::exists('services', 'id')],
            'service_area_ids' => ['nullable', 'array'],
            'service_area_ids.*' => ['integer', 'distinct', Rule::exists('service_areas', 'id')],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator): void {
            $service = $this->route('service');
            $relatedIds = array_map('intval', $this->input('related_service_ids', []));

            if ($service && in_array($service->id, $relatedIds, true)) {
                $validator->errors()->add('related_service_ids', 'A service cannot be related to itself.');
            }
        });
    }

    public function prepared(): array
    {
        $data = $this->validated();
        unset($data['faq_ids'], $data['related_service_ids'], $data['service_area_ids']);
        $data['is_published'] = match ($this->input('intent')) {
            'draft' => false,
            'publish' => true,
            default => $this->boolean('is_published'),
        };
        $data['is_indexable'] = $this->boolean('is_indexable');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        return $data;
    }

    /**
     * @return array{faq_ids: array<int>, related_service_ids: array<int>, service_area_ids: array<int>}
     */
    public function relationshipIds(): array
    {
        return [
            'faq_ids' => array_map('intval', $this->validated('faq_ids', [])),
            'related_service_ids' => array_map('intval', $this->validated('related_service_ids', [])),
            'service_area_ids' => array_map('intval', $this->validated('service_area_ids', [])),
        ];
    }
}
