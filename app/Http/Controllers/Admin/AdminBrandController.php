<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\File;

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
            'logo' => ['required', File::types(['jpg', 'jpeg', 'png', 'webp', 'avif'])->max(5120)],
            'is_featured' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ]);

        $data['slug'] = $this->uniqueSlug((string) $data['name']);
        $data['is_featured'] = (bool) ($data['is_featured'] ?? true);
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        $data['logo_path'] = $this->storeWithOriginalName($request->file('logo'), 'brands');
        unset($data['logo']);
        unset($data['logo_url']);

        Brand::query()->create($data);

        return redirect()->route('admin.brands.index')->with('status', 'Brand created.');
    }

    public function update(Request $request, Brand $brand): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:80', 'unique:brands,name,'.$brand->id],
            'logo' => ['nullable', File::types(['jpg', 'jpeg', 'png', 'webp', 'avif'])->max(5120)],
            'is_featured' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ]);

        if (! $brand->logo_path && ! $request->hasFile('logo')) {
            return back()
                ->withErrors(['logo' => 'Brand logo is required.'])
                ->withInput();
        }

        $nameChanged = trim((string) $brand->name) !== trim((string) $data['name']);
        $data['is_featured'] = (bool) ($data['is_featured'] ?? false);
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);
        if ($nameChanged) {
            $data['slug'] = $this->uniqueSlug((string) $data['name'], $brand->id);
            // Keep legacy cars.brand text in sync for filters/current UI.
            $brand->cars()->update(['brand' => $data['name']]);
        }

        if ($request->hasFile('logo')) {
            if ($brand->logo_path) {
                Storage::disk('public')->delete($brand->logo_path);
            }
            $data['logo_path'] = $this->storeWithOriginalName($request->file('logo'), 'brands');
        }
        unset($data['logo']);
        unset($data['logo_url']);

        $brand->update($data);

        return redirect()->route('admin.brands.index')->with('status', 'Brand updated.');
    }

    public function destroy(Brand $brand): RedirectResponse
    {
        if ($brand->logo_path) {
            Storage::disk('public')->delete($brand->logo_path);
        }

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

    private function storeWithOriginalName(UploadedFile $file, string $directory): string
    {
        return $file->storeAs($directory, $file->getClientOriginalName(), 'public');
    }
}

