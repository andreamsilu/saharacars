<?php

namespace Database\Factories;

use App\Models\Inquiry;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Inquiry>
 */
class InquiryFactory extends Factory
{
    protected $model = Inquiry::class;

    public function definition(): array
    {
        return [
            'full_name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'subject' => $this->faker->randomElement([
                'Request test drive',
                'Price negotiation',
                'Vehicle availability',
                'Financing options',
                'Inspection request',
            ]),
            'message' => $this->faker->paragraph(2),
            'ip_address' => $this->faker->ipv4(),
            'user_agent' => $this->faker->userAgent(),
            'read_at' => $this->faker->boolean(45) ? now()->subHours($this->faker->numberBetween(1, 96)) : null,
            'status' => Inquiry::STATUS_PENDING,
        ];
    }

    public function orderRequest(): static
    {
        return $this->state(fn (): array => [
            'inquiry_type' => 'order_request',
            'subject' => 'Order Request',
            'phone' => $this->faker->numerify('255#########'),
            'preferred_brand' => $this->faker->randomElement(['Toyota', 'Mercedes-Benz', 'BMW', null]),
            'preferred_model' => $this->faker->optional()->words(2, true),
            'status' => $this->faker->randomElement([Inquiry::STATUS_PENDING, Inquiry::STATUS_DONE]),
        ]);
    }
}
