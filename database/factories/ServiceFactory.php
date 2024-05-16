<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(3),
            'price' => $this->faker->randomFloat(2, 10, 1000), // Generate random price between 10 and 1000 with 2 decimal places
            'category_id' => $this->faker->numberBetween(1, 5), // Generate a random number between 1 and 6
        ];
    }
}
