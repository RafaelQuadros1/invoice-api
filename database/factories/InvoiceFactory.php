<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Invoce;
use Illuminate\Database\Eloquent\Factories\Factory;


class InvoiceFactory extends Factory
{
    protected $model = Invoce::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $paid = $this->faker->boolean();
        return [

            'user_id' => User::all()->random()->value('id'),
            'type' => $this->faker->randomElement(['B', 'C', 'P']),
            'is_paid' => $paid,
            'amount' => $this->faker->randomFloat(2, 10, 1000),
            'payment_date' => $paid ? $this->faker->optional()->dateTimeBetween('-1 year', 'now') : null,

        ];
    }
}
