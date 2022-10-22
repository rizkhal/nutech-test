<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
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
            'name' => $this->faker->unique()->sentence(4),
            'file_name' => $this->createImage(),
            'buy_price' => $this->faker->numberBetween(20000, 1000000),
            'sell_price' => $this->faker->numberBetween(20000, 1000000),
            'stock' => $this->faker->numberBetween(1, 100),
            'created_at' => $this->faker->dateTimeBetween('-1 year', '-6 month'),
            'updated_at' => $this->faker->dateTimeBetween('-5 month', 'now'),
        ];
    }

    public function createImage()
    {
        try {
            // $image = file_get_contents('https://picsum.photos/720/420');
            $image = file_get_contents('https://placekitten.com/720/420');
            $filename = "products/" . Str::uuid() . '.jpg';

            Storage::disk('public')->put($filename, $image);

            return $filename;
        } catch (\Throwable $exception) {
            return null;
        }
    }
}
