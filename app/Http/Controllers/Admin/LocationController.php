<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LocationRequest;
use App\Models\Faq;
use App\Models\Post;
use App\Models\Service;
use App\Models\ServiceArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    public function index(Request $request)
    {
        $items = ServiceArea::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $term = $request->string('search');
                $query->where(fn ($q) => $q->where('name', 'like', "%{$term}%")->orWhere('slug', 'like', "%{$term}%"));
            })
            ->orderBy('sort_order')
            ->paginate(10)
            ->withQueryString();

        return view('admin.locations.index', compact('items'));
    }

    public function create()
    {
        return view('admin.locations.form', $this->formData(new ServiceArea()));
    }

    public function store(LocationRequest $request)
    {
        DB::transaction(function () use ($request): void {
            $location = ServiceArea::create($request->prepared());
            $this->syncRelationships($location, $request->relationshipIds());
        });

        return redirect()->route('admin.locations.index')->with('ok', 'Location created.');
    }

    public function edit(ServiceArea $serviceArea)
    {
        $serviceArea->load(['faqs:id', 'services:id', 'nearbyLocations:id', 'relatedArticles:id']);

        return view('admin.locations.form', $this->formData($serviceArea));
    }

    public function update(LocationRequest $request, ServiceArea $serviceArea)
    {
        DB::transaction(function () use ($request, $serviceArea): void {
            $serviceArea->update($request->prepared());
            $this->syncRelationships($serviceArea, $request->relationshipIds());
        });

        return redirect()->route('admin.locations.index')->with('ok', 'Location updated.');
    }

    public function destroy(ServiceArea $serviceArea)
    {
        $serviceArea->delete();

        return back()->with('ok', 'Location deleted.');
    }

    private function formData(ServiceArea $item): array
    {
        return [
            'item' => $item,
            'faqs' => Faq::orderBy('sort_order')->orderBy('question')->get(),
            'services' => Service::orderBy('sort_order')->orderBy('name')->get(),
            'locations' => ServiceArea::when($item->exists, fn ($query) => $query->whereKeyNot($item->id))
                ->orderBy('sort_order')->orderBy('name')->get(),
            'articles' => Post::latest('published_at')->orderBy('title')->get(),
        ];
    }

    private function syncRelationships(ServiceArea $location, array $relationships): void
    {
        $location->faqs()->sync($relationships['faq_ids']);
        $location->services()->sync($relationships['service_ids']);
        $location->nearbyLocations()->sync(array_values(array_diff(
            $relationships['nearby_location_ids'],
            [$location->id],
        )));
        $location->relatedArticles()->sync($relationships['related_article_ids']);
    }
}
