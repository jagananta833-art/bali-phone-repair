<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Faq;
use App\Models\Media;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ContentController extends Controller
{
    private array $resources = [
        'categories' => ['model' => Category::class, 'label' => 'Categories', 'fields' => ['name', 'slug', 'description', 'meta_title', 'meta_description']],
        'faqs' => ['model' => Faq::class, 'label' => 'FAQs', 'fields' => ['question', 'answer', 'sort_order', 'is_published']],
        'testimonials' => ['model' => Testimonial::class, 'label' => 'Testimonials', 'fields' => ['name', 'role', 'quote', 'sort_order', 'is_published']],
    ];

    public function index(string $resource)
    {
        $config = $this->config($resource);
        $items = $config['model']::query()
            ->when(in_array('sort_order', $config['fields'], true), fn ($query) => $query->orderBy('sort_order'))
            ->latest('id')
            ->get();

        return view('admin.content.index', compact('config', 'items', 'resource'));
    }

    public function create(string $resource)
    {
        $config = $this->config($resource);
        $item = new $config['model']();

        return view('admin.content.form', compact('config', 'item', 'resource'));
    }

    public function store(Request $request, string $resource)
    {
        $config = $this->config($resource);
        $config['model']::create($this->data($request, $resource, $config));

        return redirect()->route('admin.content.index', $resource)->with('ok', $config['label'].' dibuat.');
    }

    public function edit(string $resource, int $id)
    {
        $config = $this->config($resource);
        $item = $config['model']::findOrFail($id);

        return view('admin.content.form', compact('config', 'item', 'resource'));
    }

    public function update(Request $request, string $resource, int $id)
    {
        $config = $this->config($resource);
        $item = $config['model']::findOrFail($id);
        $item->update($this->data($request, $resource, $config, $id));

        return redirect()->route('admin.content.index', $resource)->with('ok', $config['label'].' diperbarui.');
    }

    public function destroy(string $resource, int $id)
    {
        $config = $this->config($resource);
        $config['model']::findOrFail($id)->delete();

        return back()->with('ok', $config['label'].' dihapus.');
    }

    public function media()
    {
        return view('admin.media.index', ['items' => Media::latest()->get()]);
    }

    public function uploadMedia(Request $request)
    {
        $data = $request->validate([
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'alt_text' => ['nullable', 'string', 'max:160'],
        ]);

        $path = $request->file('image')->store('media', 'public');
        Media::create([
            'path' => $path,
            'alt_text' => $data['alt_text'] ?? null,
            'mime_type' => $request->file('image')->getMimeType(),
            'size' => $request->file('image')->getSize(),
        ]);

        return back()->with('ok', 'Gambar diupload.');
    }

    private function config(string $resource): array
    {
        abort_unless(isset($this->resources[$resource]), 404);

        return $this->resources[$resource];
    }

    private function data(Request $request, string $resource, array $config, ?int $id = null): array
    {
        $rules = [];
        if (in_array('slug', $config['fields'], true) && $request->filled('name')) {
            $request->merge([
                'slug' => $request->filled('slug') ? Str::slug((string) $request->input('slug')) : Str::slug((string) $request->input('name')),
            ]);
        }

        foreach ($config['fields'] as $field) {
            $rules[$field] = match ($field) {
                'name', 'question' => ['required', 'string', 'max:160'],
                'slug' => ['required', 'string', 'max:160', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/', Rule::unique(str_replace('-', '_', $resource), 'slug')->ignore($id)],
                'answer', 'description', 'quote' => ['nullable', 'string'],
                'meta_title' => ['nullable', 'string', 'max:70'],
                'meta_description' => ['nullable', 'string', 'max:170'],
                'role' => ['nullable', 'string', 'max:160'],
                'sort_order' => ['nullable', 'integer'],
                'is_published' => ['nullable', 'boolean'],
                default => ['nullable', 'string', 'max:255'],
            };
        }

        if ($resource === 'faqs') {
            $rules['answer'] = ['required', 'string'];
        }

        if ($resource === 'testimonials') {
            $rules['quote'] = ['required', 'string'];
        }

        $data = $request->validate($rules);

        if (in_array('is_published', $config['fields'], true)) {
            $data['is_published'] = $request->boolean('is_published');
        }

        if (in_array('sort_order', $config['fields'], true)) {
            $data['sort_order'] = $data['sort_order'] ?? 0;
        }

        return $data;
    }
}
