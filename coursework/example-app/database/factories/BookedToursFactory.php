<?php

namespace Database\Factories;

use App\Models\Booked_tours;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booked_tours>
 */
class BookedToursFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Booked_tours::class;
    public function definition()
    {
        return [
            //
        ];
    }
}
