<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminBrandController extends Controller
{
    public function index(): View
    {
        $brands = Brand::query()
            ->withCount(['cars as published_cars_count' => fn ($q) => $q->where('is_published', true)])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.brands.index', compact('brands'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:80', 'unique:brands,name'],
            'logo_url' => ['required', 'url', 'max:500'],
            'is_featured' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ]);

        $data['slug'] = $this->uniqueSlug((string) $data['name']);
        $data['is_featured'] = (bool) ($data['is_featured'] ?? true);
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        Brand::query()->create($data);

        return redirect()->route('admin.brands.index')->with('status', 'Brand created.');
    }

    public function update(Request $request, Brand $brand): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:80', 'unique:brands,name,'.$brand->id],
            'logo_url' => ['required', 'url', 'max:500'],
            'is_featured' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ]);

        $nameChanged = trim((string) $brand->name) !== trim((string) $data['name']);
        $data['is_featured'] = (bool) ($data['is_featured'] ?? false);
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);
        if ($nameChanged) {
            $data['slug'] = $this->uniqueSlug((string) $data['name'], $brand->id);
            // Keep legacy cars.brand text in sync for filters/current UI.
            $brand->cars()->update(['brand' => $data['name']]);
        }

        $brand->update($data);

        return redirect()->route('admin.brands.index')->with('status', 'Brand updated.');
    }

    public function destroy(Brand $brand): RedirectResponse
    {
        $brand->delete();

        return redirect()->route('admin.brands.index')->with('status', 'Brand deleted.');
    }

    private function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $base = Str::slug($name);
        $slug = $base !== '' ? $base : Str::random(8);
        $index = 2;

        while (
            Brand::query()
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->where('slug', $slug)
                ->exists()
        ) {
            $slug = $base.'-'.$index;
            $index++;
        }

        return $slug;
    }
}

