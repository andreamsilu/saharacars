<?php

namespace App\Http\Controllers;

use App\Models\Car;
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

        return view('pages.home', compact('featuredCars', 'brandOptions', 'locationOptions'));
    }

    public function about(): View
    {
        return view('pages.about');
    }

    public function contact(): View
    {
        return view('pages.contact');
    }

    /**
     * Saved cars (titles + slugs stored in localStorage; rendered client-side).
     */
    public function saved(): View
    {
        return view('pages.saved');
    }
}

