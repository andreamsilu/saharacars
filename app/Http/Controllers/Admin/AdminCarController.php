<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCarRequest;
use App\Http\Requests\Admin\UpdateCarRequest;
use App\Models\Brand;
use App\Models\Car;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminCarController extends Controller
{
    public function index(): View
    {
        $perPage = request()->integer('per_page', 25);
        if (! in_array($perPage, [10, 25, 50, 100], true)) {
            $perPage = 25;
        }

        $q = trim((string) request('q', ''));
        $status = (string) request('status', 'all');
        $featured = (string) request('featured', 'all');
        $priceMin = request()->integer('price_min');
        $priceMax = request()->integer('price_max');

        $stats = [
            'total' => Car::query()->count(),
            'active' => Car::query()->where('is_published', true)->count(),
            'pending' => Car::query()->where('is_published', false)->count(),
            'flagged' => 0,
        ];

        return view('admin.cars.index', compact(
            'stats',
            'perPage',
            'q',
            'status',
            'featured',
            'priceMin',
            'priceMax'
        ));
    }

    public function data(Request $request): JsonResponse
    {
        $draw = max(1, (int) $request->input('draw', 1));
        $start = max(0, (int) $request->input('start', 0));
        $length = (int) $request->input('length', 25);
        if (! in_array($length, [10, 25, 50, 100], true)) {
            $length = 25;
        }

        $recordsTotal = Car::query()->count();
        $query = $this->buildFilteredCarsQuery($request);
        $recordsFiltered = (clone $query)->count();

        $orderColumnIndex = (int) $request->input('order.0.column', 0);
        $orderDirection = strtolower((string) $request->input('order.0.dir', 'desc')) === 'asc' ? 'asc' : 'desc';
        $orderMap = [
            0 => 'title',
            1 => 'price_tzs',
            2 => 'is_published',
            3 => 'updated_at',
        ];
        $orderColumn = $orderMap[$orderColumnIndex] ?? 'updated_at';

        $cars = $query
            ->orderBy($orderColumn, $orderDirection)
            ->orderBy('id', 'desc')
            ->skip($start)
            ->take($length)
            ->get();

        $data = $cars->map(function (Car $car): array {
            return [
                'id' => $car->id,
                'title' => $car->title,
                'slug' => $car->slug,
                'year' => $car->year,
                'price_tzs' => $car->price_tzs,
                'is_published' => $car->is_published,
                'is_featured' => $car->is_featured,
                'transmission' => $car->transmission,
                'fuel' => $car->fuel,
                'mileage_km' => $car->mileage_km,
                'hero_image_path' => $car->hero_image_path,
                'updated_at' => $car->updated_at?->format('M d, Y'),
                'show_url' => route('admin.cars.show', $car),
                'edit_url' => route('admin.cars.edit', $car),
                'delete_url' => route('admin.cars.destroy', $car),
            ];
        })->all();

        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ]);
    }

    public function create(): View
    {
        $brands = Brand::query()->orderBy('name')->get(['id', 'name']);

        return view('admin.cars.create', compact('brands'));
    }

    public function show(Car $car): View
    {
        return view('admin.cars.show', compact('car'));
    }

    public function store(StoreCarRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $data['slug'] = $this->uniqueSlug($data['slug'] ?? null, $data['title']);
        $data['is_featured'] = (bool) ($data['is_featured'] ?? false);
        $data['is_published'] = (bool) ($data['is_published'] ?? false);
        $data['price_is_negotiable'] = (bool) ($data['price_is_negotiable'] ?? true);
        if (! empty($data['brand_id'])) {
            $brandName = Brand::query()->whereKey($data['brand_id'])->value('name');
            $data['brand'] = is_string($brandName) ? $brandName : ($data['brand'] ?? null);
        } elseif (array_key_exists('brand_id', $data)) {
            $data['brand_id'] = null;
        }

        if ($request->hasFile('hero_image')) {
            $data['hero_image_path'] = $this->storeWithOriginalName($request->file('hero_image'), 'cars');
        }
        $this->storeViewImages($request, $data);

        if ($request->hasFile('gallery_images')) {
            $data['gallery_image_paths'] = collect($request->file('gallery_images'))
                ->map(fn ($file) => $this->storeWithOriginalName($file, 'cars/gallery'))
                ->values()
                ->all();
        }

        $car = Car::create($data);

        return redirect()
            ->route('admin.cars.edit', $car)
            ->with('status', 'Car created.');
    }

    public function edit(Car $car): View
    {
        $brands = Brand::query()->orderBy('name')->get(['id', 'name']);

        return view('admin.cars.edit', compact('car', 'brands'));
    }

    public function update(UpdateCarRequest $request, Car $car): RedirectResponse
    {
        $data = $request->validated();

        $data['slug'] = $this->uniqueSlug($data['slug'] ?? null, $data['title'], $car->id);
        $data['is_featured'] = (bool) ($data['is_featured'] ?? false);
        $data['is_published'] = (bool) ($data['is_published'] ?? false);
        $data['price_is_negotiable'] = (bool) ($data['price_is_negotiable'] ?? true);
        if (! empty($data['brand_id'])) {
            $brandName = Brand::query()->whereKey($data['brand_id'])->value('name');
            $data['brand'] = is_string($brandName) ? $brandName : ($data['brand'] ?? null);
        } elseif (array_key_exists('brand_id', $data)) {
            $data['brand_id'] = null;
        }

        if (($data['remove_hero_image'] ?? false) && $car->hero_image_path) {
            Storage::disk('public')->delete($car->hero_image_path);
            $data['hero_image_path'] = null;
        }
        unset($data['remove_hero_image']);
        $this->removeSelectedImages($car, $data);
        $this->removeViewImages($car, $data);

        if ($request->hasFile('hero_image')) {
            if ($car->hero_image_path) {
                Storage::disk('public')->delete($car->hero_image_path);
            }
            $data['hero_image_path'] = $this->storeWithOriginalName($request->file('hero_image'), 'cars');
        }
        $this->storeViewImages($request, $data, $car);

        if ($request->hasFile('gallery_images')) {
            $existing = [];
            if (array_key_exists('gallery_image_paths', $data)) {
                $existing = is_array($data['gallery_image_paths']) ? $data['gallery_image_paths'] : [];
            } elseif (is_array($car->gallery_image_paths)) {
                $existing = $car->gallery_image_paths;
            }
            $uploaded = collect($request->file('gallery_images'))
                ->map(fn ($file) => $this->storeWithOriginalName($file, 'cars/gallery'))
                ->values()
                ->all();
            $data['gallery_image_paths'] = array_values(array_merge($existing, $uploaded));
        }

        $car->update($data);

        return back()->with('status', 'Car updated.');
    }

    public function destroy(Car $car): RedirectResponse
    {
        if ($car->hero_image_path) {
            Storage::disk('public')->delete($car->hero_image_path);
        }
        $this->deleteViewImages($car);

        if (is_array($car->gallery_image_paths)) {
            foreach ($car->gallery_image_paths as $path) {
                if (is_string($path) && $path !== '') {
                    Storage::disk('public')->delete($path);
                }
            }
        }

        $car->delete();

        return redirect()
            ->route('admin.cars.index')
            ->with('status', 'Car deleted.');
    }

    private function storeViewImages(
        StoreCarRequest|UpdateCarRequest $request,
        array &$data,
        ?Car $existingCar = null
    ): void {
        $map = [
            'front_images' => ['array' => 'front_image_paths', 'single' => 'front_image_path'],
            'rear_images' => ['array' => 'rear_image_paths', 'single' => 'rear_image_path'],
            'side_images' => ['array' => 'side_image_paths', 'single' => 'side_image_path'],
            'interior_images' => ['array' => 'interior_image_paths', 'single' => 'interior_image_path'],
        ];

        foreach ($map as $input => $columns) {
            if (! $request->hasFile($input)) {
                continue;
            }

            $existing = [];
            if (array_key_exists($columns['array'], $data)) {
                $existing = is_array($data[$columns['array']]) ? $data[$columns['array']] : [];
            } elseif ($existingCar) {
                $existingArray = $existingCar->{$columns['array']};
                if (is_array($existingArray)) {
                    $existing = $existingArray;
                } elseif ($existingCar->{$columns['single']}) {
                    $existing = [$existingCar->{$columns['single']}];
                }
            }

            $uploaded = collect($request->file($input))
                ->map(fn ($file) => $this->storeWithOriginalName($file, 'cars/views'))
                ->values()
                ->all();

            $combined = array_values(array_merge($existing, $uploaded));
            $data[$columns['array']] = $combined;

            // Keep legacy single column for compatibility with older UI reads.
            $data[$columns['single']] = $combined[0] ?? null;
        }
    }

    private function removeViewImages(Car $car, array &$data): void
    {
        $map = [
            'remove_front_images' => ['array' => 'front_image_paths', 'single' => 'front_image_path'],
            'remove_rear_images' => ['array' => 'rear_image_paths', 'single' => 'rear_image_path'],
            'remove_side_images' => ['array' => 'side_image_paths', 'single' => 'side_image_path'],
            'remove_interior_images' => ['array' => 'interior_image_paths', 'single' => 'interior_image_path'],
        ];

        foreach ($map as $flag => $columns) {
            if (! ($data[$flag] ?? false)) {
                unset($data[$flag]);
                continue;
            }

            $paths = [];
            $existingArray = $car->{$columns['array']};
            if (is_array($existingArray)) {
                $paths = $existingArray;
            } elseif ($car->{$columns['single']}) {
                $paths = [$car->{$columns['single']}];
            }

            foreach ($paths as $path) {
                if (is_string($path) && $path !== '') {
                    Storage::disk('public')->delete($path);
                }
            }

            $data[$columns['array']] = null;
            $data[$columns['single']] = null;
            unset($data[$flag]);
        }
    }

    private function removeSelectedImages(Car $car, array &$data): void
    {
        $selected = array_values(array_unique(array_filter(
            $data['remove_image_paths'] ?? [],
            fn ($value): bool => is_string($value) && $value !== ''
        )));
        unset($data['remove_image_paths']);

        if ($selected === []) {
            return;
        }

        $map = [
            ['array' => 'front_image_paths', 'single' => 'front_image_path'],
            ['array' => 'rear_image_paths', 'single' => 'rear_image_path'],
            ['array' => 'side_image_paths', 'single' => 'side_image_path'],
            ['array' => 'interior_image_paths', 'single' => 'interior_image_path'],
            ['array' => 'gallery_image_paths', 'single' => null],
        ];

        foreach ($map as $columns) {
            $existing = [];
            if (is_array($car->{$columns['array']})) {
                $existing = $car->{$columns['array']};
            } elseif ($columns['single'] && $car->{$columns['single']}) {
                $existing = [$car->{$columns['single']}];
            }

            if ($existing === []) {
                continue;
            }

            $remaining = array_values(array_filter(
                $existing,
                fn ($path): bool => is_string($path) && $path !== '' && ! in_array($path, $selected, true)
            ));

            foreach ($existing as $path) {
                if (is_string($path) && $path !== '' && ! in_array($path, $remaining, true)) {
                    Storage::disk('public')->delete($path);
                }
            }

            $data[$columns['array']] = $remaining === [] ? null : $remaining;
            if ($columns['single']) {
                $data[$columns['single']] = $remaining[0] ?? null;
            }
        }
    }

    private function deleteViewImages(Car $car): void
    {
        $map = [
            ['array' => 'front_image_paths', 'single' => 'front_image_path'],
            ['array' => 'rear_image_paths', 'single' => 'rear_image_path'],
            ['array' => 'side_image_paths', 'single' => 'side_image_path'],
            ['array' => 'interior_image_paths', 'single' => 'interior_image_path'],
        ];

        foreach ($map as $columns) {
            $paths = [];
            $existingArray = $car->{$columns['array']};
            if (is_array($existingArray)) {
                $paths = $existingArray;
            } elseif ($car->{$columns['single']}) {
                $paths = [$car->{$columns['single']}];
            }

            foreach ($paths as $path) {
                if (is_string($path) && $path !== '') {
                    Storage::disk('public')->delete($path);
                }
            }
        }
    }

    private function uniqueSlug(?string $requestedSlug, string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($requestedSlug ?: $title);
        $slug = $base !== '' ? $base : Str::random(8);

        $i = 2;
        while (
            Car::query()
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->where('slug', $slug)
                ->exists()
        ) {
            $slug = $base.'-'.$i;
            $i++;
        }

        return $slug;
    }

    private function storeWithOriginalName(UploadedFile $file, string $directory): string
    {
        return $file->storeAs($directory, $file->getClientOriginalName(), 'public');
    }

    private function buildFilteredCarsQuery(Request $request)
    {
        $q = trim((string) ($request->input('q', $request->input('search.value', ''))));
        $status = (string) $request->input('status', 'all');
        $featured = (string) $request->input('featured', 'all');
        $priceMin = $request->integer('price_min');
        $priceMax = $request->integer('price_max');

        if (! in_array($status, ['all', 'published', 'draft'], true)) {
            $status = 'all';
        }
        if (! in_array($featured, ['all', 'yes', 'no'], true)) {
            $featured = 'all';
        }

        $carsQuery = Car::query();

        if ($q !== '') {
            $carsQuery->where(function ($query) use ($q): void {
                $query->where('title', 'like', '%'.$q.'%')
                    ->orWhere('slug', 'like', '%'.$q.'%');
            });
        }

        if ($status === 'published') {
            $carsQuery->where('is_published', true);
        } elseif ($status === 'draft') {
            $carsQuery->where('is_published', false);
        }

        if ($featured === 'yes') {
            $carsQuery->where('is_featured', true);
        } elseif ($featured === 'no') {
            $carsQuery->where('is_featured', false);
        }

        if (is_int($priceMin) && $priceMin > 0) {
            $carsQuery->where('price_tzs', '>=', $priceMin);
        }

        if (is_int($priceMax) && $priceMax > 0) {
            $carsQuery->where('price_tzs', '<=', $priceMax);
        }

        return $carsQuery;
    }
}

