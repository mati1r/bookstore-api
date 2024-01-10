<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $paymentMethods = $this->faker->randomElement(['karta VISA', 'płatność BLIK']);

        return [
            'method' => $paymentMethods
        ];
    }

    public function visa()
    {
        return $this->state(function (array $attributes) {
            return [
                'method' => 'karta VISA',
            ];
        });
    }

    public function blik()
    {
        return $this->state(function (array $attributes) {
            return [
                'method' => 'płatność BLIK',
            ];
        });
    }
}
