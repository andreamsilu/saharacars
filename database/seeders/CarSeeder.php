<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Seed vehicle listings for local/dev usage.
     */
    public function run(): void
    {
        $cars = [
            [
                'brand' => 'Toyota',
                'title' => '2023 Toyota Land Cruiser 300',
                'slug' => '2023-toyota-land-cruiser-300',
                'year' => 2023,
                'location' => 'Dar es Salaam',
                'transmission' => 'Automatic',
                'fuel' => 'Diesel',
                'condition' => 'foreign_used',
                'mileage_km' => 12000,
                'engine' => '3.3L Twin Turbo',
                'engine_capacity_cc' => 3300,
                'price_tzs' => 215000000,
                'description' => 'Premium full-size SUV in excellent condition.',
                'is_featured' => true,
                'is_published' => true,
            ],
            [
                'brand' => 'Porsche',
                'title' => '2021 Porsche 911 Carrera',
                'slug' => '2021-porsche-911-carrera',
                'year' => 2021,
                'location' => 'Arusha',
                'transmission' => 'Automatic',
                'fuel' => 'Petrol',
                'condition' => 'foreign_used',
                'mileage_km' => 4200,
                'engine' => '3.0L Turbo',
                'engine_capacity_cc' => 3000,
                'price_tzs' => 282000000,
                'description' => 'Low mileage sports car with full service history.',
                'is_featured' => true,
                'is_published' => false,
            ],
            [
                'brand' => 'Ford',
                'title' => '2022 Ford Ranger Raptor',
                'slug' => '2022-ford-ranger-raptor',
                'year' => 2022,
                'location' => 'Dodoma',
                'transmission' => 'Automatic',
                'fuel' => 'Diesel',
                'condition' => 'foreign_used',
                'mileage_km' => 25000,
                'engine' => '2.0L Bi-Turbo',
                'engine_capacity_cc' => 2000,
                'price_tzs' => 105000000,
                'description' => 'Performance pickup built for rough terrain.',
                'is_featured' => false,
                'is_published' => true,
            ],
            [
                'brand' => 'Mercedes',
                'title' => '2020 Mercedes-AMG G 63',
                'slug' => '2020-mercedes-amg-g-63',
                'year' => 2020,
                'location' => 'Dar es Salaam',
                'transmission' => 'Automatic',
                'fuel' => 'Petrol',
                'condition' => 'foreign_used',
                'mileage_km' => 18500,
                'engine' => '4.0L V8 Biturbo',
                'engine_capacity_cc' => 4000,
                'price_tzs' => 415000000,
                'description' => 'Luxury SUV with top trim and pristine interior.',
                'is_featured' => true,
                'is_published' => true,
            ],
            [
                'brand' => 'Nissan',
                'title' => '2019 Nissan Patrol LE',
                'slug' => '2019-nissan-patrol-le',
                'year' => 2019,
                'location' => 'Mwanza',
                'transmission' => 'Automatic',
                'fuel' => 'Petrol',
                'condition' => 'local_used',
                'mileage_km' => 36000,
                'engine' => '5.6L V8',
                'engine_capacity_cc' => 5600,
                'price_tzs' => 168000000,
                'description' => 'Reliable family SUV with strong road presence.',
                'is_featured' => false,
                'is_published' => false,
            ],
            [
                'brand' => 'BMW',
                'title' => '2022 BMW X5 xDrive40i',
                'slug' => '2022-bmw-x5-xdrive40i',
                'year' => 2022,
                'location' => 'Zanzibar',
                'transmission' => 'Automatic',
                'fuel' => 'Petrol',
                'condition' => 'foreign_used',
                'mileage_km' => 14000,
                'engine' => '3.0L Turbo',
                'engine_capacity_cc' => 3000,
                'price_tzs' => 238000000,
                'description' => 'Executive SUV with balanced luxury and performance.',
                'is_featured' => false,
                'is_published' => true,
            ],
        ];

        foreach ($cars as $row) {
            Car::updateOrCreate(['slug' => $row['slug']], $row);
        }

        // Backfill older rows created before brand support.
        Car::query()
            ->where(function ($query): void {
                $query->whereNull('brand')->orWhere('brand', '');
            })
            ->whereNotNull('title')
            ->get()
            ->each(function (Car $car): void {
                $parts = preg_split('/\s+/', (string) $car->title);
                $guessedBrand = $parts[1] ?? null;
                if (is_string($guessedBrand) && $guessedBrand !== '') {
                    $car->brand = $guessedBrand;
                    $car->save();
                }
            });

        // Add larger synthetic volume only for non-production data environments.
        if (app()->environment(['local', 'staging', 'testing'])) {
            $target = 80;
            $missing = max(0, $target - Car::query()->count());
            if ($missing > 0) {
                Car::factory($missing)->create();
            }
        }
    }
}
