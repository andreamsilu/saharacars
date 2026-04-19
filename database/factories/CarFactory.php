<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Car>
 */
class CarFactory extends Factory
{
    protected $model = Car::class;

    public function definition(): array
    {
        $brand = $this->faker->randomElement([
            'Toyota',
            'Nissan',
            'Mercedes',
            'BMW',
            'Ford',
            'Porsche',
            'Land Rover',
        ]);
        $modelName = $this->faker->randomElement([
            'Land Cruiser 300',
            'Patrol LE',
            'GLE 450',
            'X5 xDrive40i',
            'Ranger Raptor',
            '911 Carrera',
            'Range Rover Sport',
        ]);
        $year = $this->faker->numberBetween(2017, (int) date('Y') + 1);
        $title = $year.' '.$brand.' '.$modelName;

        return [
            'brand' => $brand,
            'model' => $this->faker->optional(0.65)->regexify('[A-Z]{3}-[A-Z0-9]{4}'),
            'body_color' => $this->faker->optional(0.7)->randomElement(['WHITE(P)', 'BLACK(M)', 'BLUE(D)', 'SILVER', 'RED']),
            'body_type' => $this->faker->optional(0.75)->randomElement(['SUV', 'Sedan', 'Pickup', 'Coupe', 'Wagon']),
            'doors' => $this->faker->optional(0.8)->numberBetween(2, 5),
            'seats' => $this->faker->optional(0.8)->numberBetween(2, 8),
            'title' => $title,
            'slug' => Str::slug($title).'-'.$this->faker->unique()->numberBetween(1000, 9999),
            'year' => $year,
            'location' => $this->faker->randomElement([
                'Dar es Salaam',
                'Arusha',
                'Mwanza',
                'Dodoma',
                'Zanzibar',
                'Mbeya',
            ]),
            'transmission' => $this->faker->randomElement(['Automatic', 'Manual']),
            'fuel' => $this->faker->randomElement(['Petrol', 'Diesel', 'Hybrid']),
            'condition' => $this->faker->randomElement(['brand_new', 'foreign_used', 'local_used']),
            'mileage_km' => $this->faker->numberBetween(1000, 120000),
            'engine' => $this->faker->randomElement(['2.0L Turbo', '2.5L', '3.0L Turbo', '4.0L V8']),
            'engine_capacity_cc' => $this->faker->randomElement([2000, 2500, 3000, 4000, 5600]),
            'price_tzs' => $this->faker->numberBetween(35000000, 420000000),
            'description' => $this->faker->sentence(18),
            'hero_image_path' => null,
            'gallery_image_paths' => null,
            'is_featured' => $this->faker->boolean(20),
            'is_published' => $this->faker->boolean(75),
        ];
    }
}
