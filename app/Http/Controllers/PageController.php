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

        $brandOptions = Car::query()
            ->where('is_published', true)
            ->whereNotNull('brand')
            ->where('brand', '!=', '')
            ->select('brand')
            ->distinct()
            ->orderBy('brand')
            ->limit(30)
            ->pluck('brand');

        $homeBrands = Brand::query()
            ->where('is_featured', true)
            ->whereNotNull('logo_path')
            ->where('logo_path', '!=', '')
            ->withCount(['cars as published_cars_count' => fn ($q) => $q->where('is_published', true)])
            ->having('published_cars_count', '>', 0)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get(['name', 'logo_path'])
            ->map(fn (Brand $brand): array => [
                'name' => $brand->name,
                'logo' => asset('storage/'.$brand->logo_path),
            ])
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

        $featuredCars = Car::query()
            ->where('is_published', true)
            ->where('is_featured', true)
            ->latest()
            ->limit(6)
            ->get();

        $publishedCarsQuery = Car::query()->where('is_published', true);
        $totalPublishedCars = (clone $publishedCarsQuery)->count();
        $carsAddedThisWeek = (clone $publishedCarsQuery)
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->count();
        $darReadyCars = (clone $publishedCarsQuery)
            ->where('location', 'like', '%Dar%')
            ->whereIn('import_status', ['in_tanzania', 'ready_for_booking'])
            ->count();

        $todayStart = Carbon::today();
        $todayEnd = Carbon::tomorrow();
        $carsNewTodayCount = (clone $publishedCarsQuery)
            ->where('created_at', '>=', $todayStart)
            ->where('created_at', '<', $todayEnd)
            ->count();

        $newTodayListings = Car::query()
            ->where('is_published', true)
            ->where('created_at', '>=', $todayStart)
            ->where('created_at', '<', $todayEnd)
            ->latest()
            ->limit(6)
            ->get();

        $homeNewListingsIsRecentFallback = $newTodayListings->isEmpty();
        if ($homeNewListingsIsRecentFallback) {
            $newTodayListings = Car::query()
                ->where('is_published', true)
                ->latest()
                ->limit(6)
                ->get();
        }

        $defaultShortcutChips = [
            ['label' => 'Foreign Used', 'url' => route('cars.index', ['condition' => 'foreign_used'])],
            ['label' => 'Brand New', 'url' => route('cars.index', ['condition' => 'brand_new'])],
            ['label' => 'From Japan', 'url' => route('cars.index', ['source_country' => 'Japan'])],
            ['label' => 'From Germany', 'url' => route('cars.index', ['source_country' => 'Germany'])],
            ['label' => 'Under 100M', 'url' => route('cars.index', ['price_max' => 100000000])],
            ['label' => 'Above 100M', 'url' => route('cars.index', ['price_min' => 100000000])],
        ];

        $homeShortcutChips = $this->parseLabelUrlLines((string) ($settings['home_shortcuts_lines'] ?? ''), $defaultShortcutChips);
        $homeImportFlowSteps = $this->parseLabelDescriptionLines((string) ($settings['home_import_flow_steps'] ?? ''), [
            ['title' => 'Request', 'description' => 'Tell us your preferred brand, model, and budget.'],
            ['title' => 'Quote', 'description' => 'We share options, specs, and landed-cost estimates.'],
            ['title' => 'Shipment', 'description' => 'Track status from on-order to in-transit.'],
            ['title' => 'Delivery', 'description' => 'Handover and support from our Dar team.'],
        ]);

        $homeShortcutsTitle = trim((string) ($settings['home_shortcuts_title'] ?? '')) ?: 'Shop by shortcuts';
        $homeShortcutsSubtitle = trim((string) ($settings['home_shortcuts_subtitle'] ?? '')) ?: 'Fast paths for high-intent buyers';
        $homeImportFlowTitle = trim((string) ($settings['home_import_flow_title'] ?? '')) ?: 'From request to delivery';
        $homeImportFlowSubtitle = trim((string) ($settings['home_import_flow_subtitle'] ?? '')) ?: 'Import purchase flow';
        $homeQuickFilterChips = [
            ['label' => 'Automatic', 'url' => route('cars.index', ['transmission' => 'automatic'])],
            ['label' => 'Diesel', 'url' => route('cars.index', ['fuel' => 'diesel'])],
            ['label' => 'Budget 20M-50M', 'url' => route('cars.index', ['price_range' => '20-50'])],
            ['label' => 'Budget 50M-100M', 'url' => route('cars.index', ['price_range' => '50-100'])],
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
            'carsNewTodayCount',
            'newTodayListings',
            'homeNewListingsIsRecentFallback',
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
