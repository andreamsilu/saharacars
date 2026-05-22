<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Car;
use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\File;

class PageController extends Controller
{
    public function home(): View
    {
        $settings = $this->marketplaceSettings();

        // Frontend brand options are sourced from admin-managed brands.
        $brandOptions = Brand::query()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->limit(30)
            ->pluck('name');

        // Homepage brand rail is sourced from admin brands to guarantee admin logos.
        $homeBrands = Brand::query()
            ->where('is_featured', true)
            ->whereNotNull('logo_path')
            ->where('logo_path', '!=', '')
            ->withCount(['cars as published_cars_count' => fn ($query) => $query->where('is_published', true)])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get()
            ->map(function (Brand $brand): array {
                return [
                    'name' => trim((string) $brand->name),
                    'logo' => asset('storage/'.$brand->logo_path),
                    'published_count' => (int) $brand->published_cars_count,
                ];
            })
            ->values()
            ->take(20)
            ->all();

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

        $bodyTypeOptions = Car::query()
            ->where('is_published', true)
            ->whereNotNull('body_type')
            ->where('body_type', '!=', '')
            ->select('body_type')
            ->distinct()
            ->orderBy('body_type')
            ->pluck('body_type');

        $transmissionOptions = Car::query()
            ->where('is_published', true)
            ->whereNotNull('transmission')
            ->where('transmission', '!=', '')
            ->select('transmission')
            ->distinct()
            ->orderBy('transmission')
            ->pluck('transmission');

        // Subqueries (not a join) so each car appears once even if car_search_hits has duplicate rows.
        $featuredCars = Car::query()
            ->where('is_published', true)
            ->select('cars.*')
            ->selectSub(function ($query): void {
                $query->from('car_search_hits')
                    ->selectRaw('COALESCE(MAX(hits_count), 0)')
                    ->whereColumn('car_search_hits.car_id', 'cars.id');
            }, 'search_hits_count')
            ->selectSub(function ($query): void {
                $query->from('car_search_hits')
                    ->selectRaw('MAX(last_hit_at)')
                    ->whereColumn('car_search_hits.car_id', 'cars.id');
            }, 'search_hit_last_at')
            ->orderByDesc('search_hits_count')
            ->orderByDesc('search_hit_last_at')
            ->orderByDesc('is_featured')
            ->latest('cars.created_at')
            ->limit(5)
            ->get()
            ->unique('id')
            ->values();

        $publishedCarsQuery = Car::query()->where('is_published', true);
        $totalPublishedCars = (clone $publishedCarsQuery)->count();
        $carsAddedThisWeek = (clone $publishedCarsQuery)
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->count();
        $darReadyCars = (clone $publishedCarsQuery)
            ->where('location', 'like', '%Dar%')
            ->whereIn('import_status', ['in_tanzania', 'ready_for_booking'])
            ->count();

        $latestListings = Car::query()
            ->where('is_published', true)
            ->latest()
            ->limit(10)
            ->get();

        $defaultShortcutChips = [
            ['label' => __('public.catalog.condition.foreign_used'), 'url' => route('cars.index', ['condition' => 'foreign_used'])],
            ['label' => __('public.catalog.condition.brand_new'), 'url' => route('cars.index', ['condition' => 'brand_new'])],
            ['label' => __('public.home.shortcut_from_japan'), 'url' => route('cars.index', ['source_country' => 'Japan'])],
            ['label' => __('public.home.shortcut_from_germany'), 'url' => route('cars.index', ['source_country' => 'Germany'])],
            ['label' => __('public.home.shortcut_under_100m'), 'url' => route('cars.index', ['price_max' => 100000000])],
            ['label' => __('public.home.shortcut_above_100m'), 'url' => route('cars.index', ['price_min' => 100000000])],
        ];

        $homeShortcutChips = $this->parseLabelUrlLines((string) ($settings['home_shortcuts_lines'] ?? ''), $defaultShortcutChips);
        $homeImportFlowSteps = $this->parseLabelDescriptionLines((string) ($settings['home_import_flow_steps'] ?? ''), [
            ['title' => __('public.home.import_step_request_title'), 'description' => __('public.home.import_step_request_body')],
            ['title' => __('public.home.import_step_quote_title'), 'description' => __('public.home.import_step_quote_body')],
            ['title' => __('public.home.import_step_shipment_title'), 'description' => __('public.home.import_step_shipment_body')],
            ['title' => __('public.home.import_step_delivery_title'), 'description' => __('public.home.import_step_delivery_body')],
        ]);

        $homeShortcutsTitle = trim((string) ($settings['home_shortcuts_title'] ?? '')) ?: __('public.home.shortcuts_title_fallback');
        $homeShortcutsSubtitle = trim((string) ($settings['home_shortcuts_subtitle'] ?? '')) ?: __('public.home.shortcuts_subtitle_fallback');
        $homeImportFlowTitle = trim((string) ($settings['home_import_flow_title'] ?? '')) ?: __('public.home.import_flow_title_fallback');
        $homeImportFlowSubtitle = trim((string) ($settings['home_import_flow_subtitle'] ?? '')) ?: __('public.home.import_flow_subtitle_fallback');
        $homeQuickFilterChips = [
            ['label' => __('public.home.quick_filter_automatic'), 'url' => route('cars.index', ['transmission' => 'automatic'])],
            ['label' => __('public.home.quick_filter_diesel'), 'url' => route('cars.index', ['fuel' => 'diesel'])],
            ['label' => __('public.home.quick_filter_budget_mid'), 'url' => route('cars.index', ['price_range' => '20-50'])],
            ['label' => __('public.home.quick_filter_budget_high'), 'url' => route('cars.index', ['price_range' => '50-100'])],
        ];

        $homeAnnouncements = Announcement::query()
            ->activeForHome()
            ->limit(8)
            ->get();

        return view('pages.home', compact(
            'featuredCars',
            'brandOptions',
            'locationOptions',
            'sourceCountryOptions',
            'bodyTypeOptions',
            'transmissionOptions',
            'homeBrands',
            'homeShortcutChips',
            'homeShortcutsTitle',
            'homeShortcutsSubtitle',
            'homeImportFlowTitle',
            'homeImportFlowSubtitle',
            'homeImportFlowSteps',
            'totalPublishedCars',
            'carsAddedThisWeek',
            'darReadyCars',
            'homeQuickFilterChips',
            'latestListings',
            'homeAnnouncements'
        ));
    }

    /**
     * Public “Why choose us” page — trust, process, and local support.
     */
    public function whyChooseUs(): View
    {
        return view('pages.why-choose-us');
    }

    public function contact(): View
    {
        return view('pages.contact');
    }

    public function orderRequest(): View
    {
        return view('pages.order-request');
    }

    /**
     * Saved cars (titles + slugs stored in localStorage; rendered client-side).
     */
    public function saved(): View
    {
        return view('pages.saved');
    }

    /**
     * @return array<string, mixed>
     */
    private function marketplaceSettings(): array
    {
        $path = storage_path('app/marketplace_settings.json');
        if (! File::exists($path)) {
            return [];
        }

        try {
            $settings = json_decode(File::get($path), true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException) {
            return [];
        }

        return is_array($settings) ? $settings : [];
    }

    /**
     * @param list<array{label:string,url:string}> $fallback
     * @return list<array{label:string,url:string}>
     */
    private function parseLabelUrlLines(string $value, array $fallback): array
    {
        $lines = preg_split('/\R+/', trim($value)) ?: [];
        $items = [];
        foreach ($lines as $line) {
            $line = trim((string) $line);
            if ($line === '') {
                continue;
            }
            [$label, $url] = array_map('trim', array_pad(explode('|', $line, 2), 2, ''));
            if ($label === '' || $url === '') {
                continue;
            }
            $items[] = ['label' => $label, 'url' => $url];
        }

        return $items !== [] ? $items : $fallback;
    }

    /**
     * @param list<array{title:string,description:string}> $fallback
     * @return list<array{title:string,description:string}>
     */
    private function parseLabelDescriptionLines(string $value, array $fallback): array
    {
        $lines = preg_split('/\R+/', trim($value)) ?: [];
        $items = [];
        foreach ($lines as $line) {
            $line = trim((string) $line);
            if ($line === '') {
                continue;
            }
            [$title, $description] = array_map('trim', array_pad(explode('|', $line, 2), 2, ''));
            if ($title === '' || $description === '') {
                continue;
            }
            $items[] = ['title' => $title, 'description' => $description];
        }

        return $items !== [] ? $items : $fallback;
    }

}
