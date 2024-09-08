<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EventsModel>
 */
class EventsModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Workshop Penanganan Laundry Satuan & Teknik Pengangkatan Noda Satuan',
            'poster' => fake()->name() . fake()->fileExtension(),
            'date' => now(),
            'start_time' => '10:00:00',
            'end_time' => '12:00:00',
            'max_participants' => 50,
            'status' => fake()->randomElement(['selesai', 'sedang berjalan'])
        ];
    }
}
