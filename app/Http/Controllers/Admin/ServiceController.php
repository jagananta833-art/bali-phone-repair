<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Faq;
use App\Models\Service;
use App\Models\ServiceArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $items = Service::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $term = $request->string('search');
                $query->where(fn ($q) => $q->where('name', 'like', "%{$term}%")->orWhere('slug', 'like', "%{$term}%"));
            })
            ->when($request->filled('status'), fn ($query) => $query->where('is_published', $request->input('status') === 'published'))
            ->orderBy('sort_order')
            ->paginate(10)
            ->withQueryString();

        return view('admin.services.index', compact('items'));
    }

    public function create()
    {
        return view('admin.services.form', $this->formData(new Service()));
    }

    public function store(ServiceRequest $request)
    {
        DB::transaction(function () use ($request): void {
            $service = Service::create($request->prepared());
            $this->syncRelationships($service, $request->relationshipIds());
        });

        return redirect()->route('admin.services.index')->with('ok', 'Layanan dibuat.');
    }

    public function edit(Service $service)
    {
        $service->load(['faqs:id', 'relatedServices:id', 'serviceAreas:id']);

        return view('admin.services.form', $this->formData($service));
    }

    public function update(ServiceRequest $request, Service $service)
    {
        DB::transaction(function () use ($request, $service): void {
            $service->update($request->prepared());
            $this->syncRelationships($service, $request->relationshipIds());
        });

        return redirect()->route('admin.services.index')->with('ok', 'Layanan diperbarui.');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return back()->with('ok', 'Layanan dihapus.');
    }

    private function formData(Service $service): array
    {
        return [
            'item' => $service,
            'faqs' => Faq::orderBy('sort_order')->orderBy('question')->get(),
            'services' => Service::when($service->exists, fn ($query) => $query->whereKeyNot($service->id))
                ->orderBy('sort_order')
                ->get(),
            'serviceAreas' => ServiceArea::orderBy('sort_order')->orderBy('name')->get(),
        ];
    }

    /**
     * @param array{faq_ids: array<int>, related_service_ids: array<int>, service_area_ids: array<int>} $relationships
     */
    private function syncRelationships(Service $service, array $relationships): void
    {
        $service->faqs()->sync($relationships['faq_ids']);
        $service->relatedServices()->sync(array_values(array_diff(
            $relationships['related_service_ids'],
            [$service->id],
        )));
        $service->serviceAreas()->sync($relationships['service_area_ids']);
    }
}
