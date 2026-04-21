<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Brand;
use Illuminate\Contracts\View\View;

class PageController extends Controller
{
    public function home(): View
    {
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

        $featuredCars = Car::query()
            ->where('is_published', true)
            ->where('is_featured', true)
            ->latest()
            ->limit(6)
            ->get();

        return view('pages.home', compact('featuredCars', 'brandOptions', 'locationOptions', 'homeBrands'));
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

}
