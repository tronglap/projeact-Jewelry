<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


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
    public function definition(): array
    {
        $name = fake()->name();
        $Slug = Str::slug($name);

        return [
            'name' => $name,
            'slug' => $Slug,
            'price' => fake()->randomFloat(2, 0, 999),
            'shortDescription' => fake()->text(50),
            'quantity' => fake()->randomDigit(),
            'shipping' => fake()->text(10),
            'weight' => fake()->randomFloat(2, 0, 10),
            'image_url' => null,
            'description' => fake()->randomHtml(4, 4),
            'informations' => fake()->randomHtml(4, 4),
            'review' => fake()->randomHtml(4, 4),
            'status' => fake()->boolean,
            'product_category_id' => fake()->randomElement(ProductCategory::pluck('id'))
        ];
    }
}