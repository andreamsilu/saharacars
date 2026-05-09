<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Car;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CarController extends Controller
{
    public function index(): View
    {
        $cars = $this->buildFilteredQuery()
            ->paginate(15)
            ->withQueryString();
        $this->recordSearchHits($cars->pluck('id')->all());

        [$brandOptions, $locationOptions, $sourceCountryOptions, $importStatusOptions] = $this->getFilterOptions();

        return view('cars.index', compact('cars', 'brandOptions', 'locationOptions', 'sourceCountryOptions', 'importStatusOptions'));
    }

    public function bento(): View
    {
        $cars = $this->buildFilteredQuery()
            ->paginate(15)
            ->withQueryString();
        $this->recordSearchHits($cars->pluck('id')->all());

        [$brandOptions, $locationOptions, $sourceCountryOptions, $importStatusOptions] = $this->getFilterOptions();

        return view('cars.bento', compact('cars', 'brandOptions', 'locationOptions', 'sourceCountryOptions', 'importStatusOptions'));
    }

    /**
     * Canonical car URL uses numeric `{car}` binding. Legacy slug URLs redirect here (301).
     */
    public function show(Car $car): View
    {
        if (! $car->is_published) {
            abort(404);
        }

        $related = Car::query()
            ->where('is_published', true)
            ->where('id', '!=', $car->id)
            ->latest()
            ->limit(3)
            ->get();

        $waPhone = preg_replace('/\D+/', '', (string) config('sahara.whatsapp_phone'));
        $listingUrl = route('cars.show', ['car' => $car]);
        $waListingMessage = __('public.cars.wa_listing_intro')
            ."\n\n".__('public.cars.wa_listing_vehicle', ['title' => $car->title])
            .($car->year ? ' ('.$car->year.')' : '')
            ."\n".__('public.cars.wa_listing_link', ['url' => $listingUrl]);

        $legalShort = (string) config('sahara.legal_entity_name');
        $salePlace = $car->location ?: __('public.common.tanzania');
        $pageTitle = $car->title.' '.__('public.cars.for_sale_suffix', ['place' => $salePlace]).' | '.$legalShort;
        $pageDescription = Str::limit(strip_tags((string) ($car->description ?? '')), 155)
            ?: __('public.cars.page_description_fallback', ['company' => $legalShort]);

        return view('cars.show', compact('car', 'related', 'waPhone', 'waListingMessage', 'pageTitle', 'pageDescription'));
    }

    /**
     * Preserve old bookmarked slug URLs while emitting a single canonical (/cars/{id}).
     */
    public function redirectSlugToCar(string $slug): \Illuminate\Http\RedirectResponse
    {
        $car = Car::query()
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return redirect()->route('cars.show', ['car' => $car], 301);
    }

    private function buildFilteredQuery()
    {
        $query = Car::query()
            ->where('is_published', true);

        $q = trim((string) request('q', ''));
        $brand = trim((string) request('brand', ''));
        $location = request('location', '');
        $locations = is_array($location)
            ? array_values(array_filter(array_map(fn ($v) => trim((string) $v), $location)))
            : array_values(array_filter([trim((string) $location)]));
        $priceRange = (string) request('price_range', '');
        $priceMin = request()->integer('price_min');
        $priceMax = request()->integer('price_max');
        $bodyType = trim((string) request('body_type', ''));
        $transmission = trim((string) request('transmission', ''));
        $fuel = trim((string) request('fuel', ''));
        $sourceCountry = trim((string) request('source_country', ''));
        $importStatus = trim((string) request('import_status', ''));
        // `condition` is canonical; `category` kept for legacy query strings only.
        $condition = trim((string) request('condition', request('category', '')));
        $sort = (string) request('sort', 'newest');

        if ($q !== '') {
            $query->where(function ($builder) use ($q): void {
                $builder->where('title', 'like', '%'.$q.'%')
                    ->orWhere('brand', 'like', '%'.$q.'%')
                    ->orWhere('slug', 'like', '%'.$q.'%')
                    ->orWhere('location', 'like', '%'.$q.'%');
            });
        }

        if ($brand !== '') {
            $query->where(function ($builder) use ($brand): void {
                $builder->where('brand', $brand)
                    ->orWhere(function ($fallback) use ($brand): void {
                        $fallback->whereNull('brand')
                            ->where('title', 'like', '%'.$brand.'%');
                    });
            });
        }

        if ($locations !== []) {
            $query->whereIn('location', $locations);
        }

        if ($transmission !== '') {
            $query->where('transmission', 'like', '%'.$transmission.'%');
        }

        if ($bodyType !== '') {
            $query->where('body_type', 'like', '%'.$bodyType.'%');
        }

        if ($fuel !== '') {
            $query->where('fuel', 'like', '%'.$fuel.'%');
        }

        if ($sourceCountry !== '') {
            $query->where('source_country', $sourceCountry);
        }

        if (in_array($importStatus, ['in_tanzania', 'on_order', 'in_transit', 'ready_for_booking'], true)) {
            $query->where('import_status', $importStatus);
        }

        if (in_array($condition, ['brand_new', 'foreign_used', 'local_used'], true)) {
            $query->where('condition', $condition);
        }

        if (is_int($priceMin) && $priceMin > 0) {
            $query->where('price_tzs', '>=', $priceMin);
        }

        if (is_int($priceMax) && $priceMax > 0) {
            $query->where('price_tzs', '<=', $priceMax);
        }

        if ($priceRange !== '') {
            [$min, $max] = match ($priceRange) {
                '20-50' => [20000000, 50000000],
                '50-100' => [50000000, 100000000],
                '100+' => [100000000, null],
                default => [null, null],
            };

            if ($min !== null) {
                $query->where('price_tzs', '>=', $min);
            }

            if ($max !== null) {
                $query->where('price_tzs', '<=', $max);
            }
        }

        if (! in_array($sort, [
            'newest',
            'price_low_high',
            'price_high_low',
            'year_new_old',
            'year_old_new',
            'engine_capacity_high_low',
            'engine_capacity_low_high',
        ], true)) {
            $sort = 'newest';
        }

        match ($sort) {
            'price_low_high' => $query->orderByRaw('CASE WHEN price_tzs IS NULL THEN 1 ELSE 0 END, price_tzs ASC'),
            'price_high_low' => $query->orderByRaw('CASE WHEN price_tzs IS NULL THEN 1 ELSE 0 END, price_tzs DESC'),
            'year_new_old' => $query->orderByRaw('CASE WHEN year IS NULL THEN 1 ELSE 0 END, year DESC'),
            'year_old_new' => $query->orderByRaw('CASE WHEN year IS NULL THEN 1 ELSE 0 END, year ASC'),
            'engine_capacity_low_high' => $query->orderByRaw(
                "CASE WHEN COALESCE(engine_capacity_cc, CAST(REPLACE(REPLACE(LOWER(engine), 'cc', ''), 'l', '') AS DECIMAL(10,2))) IS NULL THEN 1 ELSE 0 END, COALESCE(engine_capacity_cc, CAST(REPLACE(REPLACE(LOWER(engine), 'cc', ''), 'l', '') AS DECIMAL(10,2))) ASC"
            ),
            'engine_capacity_high_low' => $query->orderByRaw(
                "CASE WHEN COALESCE(engine_capacity_cc, CAST(REPLACE(REPLACE(LOWER(engine), 'cc', ''), 'l', '') AS DECIMAL(10,2))) IS NULL THEN 1 ELSE 0 END, COALESCE(engine_capacity_cc, CAST(REPLACE(REPLACE(LOWER(engine), 'cc', ''), 'l', '') AS DECIMAL(10,2))) DESC"
            ),
            default => $query->latest(),
        };

        return $query;
    }

    /**
     * @return array{0: \Illuminate\Support\Collection<int, string>, 1: \Illuminate\Support\Collection<int, string>, 2: \Illuminate\Support\Collection<int, string>, 3: \Illuminate\Support\Collection<int, string>}
     */
    private function getFilterOptions(): array
    {
        $brandOptions = Brand::query()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->pluck('name');

        $locationOptions = Car::query()
            ->where('is_published', true)
            ->whereNotNull('location')
            ->where('location', '!=', '')
            ->select('location')
            ->distinct()
            ->orderBy('location')
            ->pluck('location');

        $sourceCountryOptions = Car::query()
            ->where('is_published', true)
            ->whereNotNull('source_country')
            ->where('source_country', '!=', '')
            ->select('source_country')
            ->distinct()
            ->orderBy('source_country')
            ->pluck('source_country');

        $importStatusOptions = Car::query()
            ->where('is_published', true)
            ->whereNotNull('import_status')
            ->where('import_status', '!=', '')
            ->select('import_status')
            ->distinct()
            ->orderBy('import_status')
            ->pluck('import_status');

        return [$brandOptions, $locationOptions, $sourceCountryOptions, $importStatusOptions];
    }

    /**
     * Track which cars surface in search results to power "most searched" ranking.
     *
     * @param  array<int, mixed>  $carIds
     */
    private function recordSearchHits(array $carIds): void
    {
        $ids = array_values(array_unique(array_map('intval', array_filter($carIds))));
        if ($ids === []) {
            return;
        }

        $now = now();
        $rows = array_map(static fn (int $carId): array => [
            'car_id' => $carId,
            'hits_count' => 1,
            'last_hit_at' => $now,
            'created_at' => $now,
            'updated_at' => $now,
        ], $ids);

        DB::table('car_search_hits')->upsert(
            $rows,
            ['car_id'],
            [
                'hits_count' => DB::raw('car_search_hits.hits_count + 1'),
                'last_hit_at',
                'updated_at',
            ]
        );
    }
}

