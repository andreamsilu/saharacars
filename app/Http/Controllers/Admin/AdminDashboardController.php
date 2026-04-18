<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Contracts\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        $carsTotal = Car::query()->count();
        $featuredTotal = Car::query()->where('is_featured', true)->count();
        $publishedTotal = Car::query()->where('is_published', true)->count();
        $draftTotal = Car::query()->where('is_published', false)->count();

        $monthlyRevenue = (int) Car::query()
            ->where('is_published', true)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('price_tzs');

        $recentCars = Car::query()->latest()->limit(8)->get();

        return view('admin.dashboard', [
            'carsTotal' => $carsTotal,
            'featuredTotal' => $featuredTotal,
            'publishedTotal' => $publishedTotal,
            'draftTotal' => $draftTotal,
            'monthlyRevenue' => $monthlyRevenue,
            'recentCars' => $recentCars,
        ]);
    }
}
