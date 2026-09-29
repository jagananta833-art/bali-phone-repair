<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $title = (string) $this->input('title');
        $slug = (string) $this->input('slug');

        if ($title !== '') {
            $this->merge(['slug' => $slug !== '' ? Str::slug($slug) : Str::slug($title)]);
        }
    }

    public function rules(): array
    {
        $post = $this->route('post');

        return [
            'category_id' => ['nullable', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:160'],
            'slug' => ['required', 'string', 'max:160', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/', Rule::unique('posts', 'slug')->ignore($post?->id)],
            'excerpt' => ['required', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'featured_image' => ['nullable', 'string', 'max:255', 'regex:/^[A-Za-z0-9._\/-]+$/', 'not_regex:/\.\./'],
            'featured_image_alt' => ['nullable', 'string', 'max:160'],
            'meta_title' => ['nullable', 'string', 'max:70'],
            'meta_description' => ['nullable', 'string', 'max:170'],
            'focus_keyword' => ['nullable', 'string', 'max:120'],
            'canonical_url' => ['nullable', 'url', 'max:255'],
            'published_at' => ['nullable', 'date'],
            'is_published' => ['nullable', 'boolean'],
        ];
    }

    public function prepared(): array
    {
        $data = $this->validated();
        $data['is_published'] = match ($this->input('intent')) {
            'draft' => false,
            'publish' => true,
            default => $this->boolean('is_published'),
        };
        $data['published_at'] = $data['published_at'] ?: now();
        $data['user_id'] = $this->user()?->id;

        return $data;
    }
}
