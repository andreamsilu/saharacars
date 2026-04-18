<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Contracts\View\View;

class CarController extends Controller
{
    public function index(): View
    {
        $cars = $this->buildFilteredQuery()
            ->paginate(12)
            ->withQueryString();

        return view('cars.index', compact('cars'));
    }

    public function bento(): View
    {
        $cars = $this->buildFilteredQuery()
            ->paginate(12)
            ->withQueryString();

        return view('cars.bento', compact('cars'));
    }

    public function show(string $slug): View
    {
        $car = Car::query()
            ->where('is_published', true)
            ->where('slug', $slug)
            ->firstOrFail();

        $related = Car::query()
            ->where('is_published', true)
            ->where('id', '!=', $car->id)
            ->latest()
            ->limit(3)
            ->get();

        return view('cars.show', compact('car', 'related'));
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
        $transmission = trim((string) request('transmission', ''));
        $fuel = trim((string) request('fuel', ''));
        $category = trim((string) request('category', request('condition', '')));
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

        if ($fuel !== '') {
            $query->where('fuel', 'like', '%'.$fuel.'%');
        }

        if (in_array($category, ['brand_new', 'foreign_used', 'local_used'], true)) {
            $query->where('condition', $category);
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
}

