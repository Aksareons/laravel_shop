<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->numerify('Product ##'),
            'dsc' => $this->faker->paragraphs(3, true),
            'price' => $this->faker->randomFloat(2, 10, 999),
            'barcode' => $this->faker->ean8(),
            'stock' => $this->faker->numberBetween(0, 999),
            'cover' => 'https://t3.ftcdn.net/jpg/04/34/72/82/360_F_434728286_OWQQvAFoXZLdGHlObozsolNeuSxhpr84.jpg'
        ];
    }
}
