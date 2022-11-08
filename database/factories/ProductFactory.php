<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title'=>fake()->sentence(4),
            'slug'=>fake()->unique()->slug,
            'summary'=>fake()->sentence(6),
            'description'=>fake()->paragraphs(4,true),
            'additional_info'=>fake()->paragraphs(4,true),
            'return_cancellation'=>fake()->paragraphs(4,true),
            'stock'=>fake()->numberBetween(2,10),
            'brand_id'=>fake()->randomElement(Brand::pluck('id')->toArray()),
            'vendor_id'=>fake()->randomElement(User::pluck('id')->toArray()),
            'cat_id'=>fake()->randomElement(Category::where('is_parent',1)->pluck('id')->toArray()),
            'child_cat_id'=>fake()->randomElement(Category::where('is_parent',0)->pluck('id')->toArray()),
            'photo'=>fake()->imageUrl(350,350),
            'size_guide'=>fake()->imageUrl(350,350),
            'price'=>fake()->randomFloat(3, 0, 1000),
            'offer_price'=>fake()->randomFloat(100, 0, 1000),
            'discount'=>fake()->randomFloat(5, 0, 70),
            'size'=>fake()->randomElement(['S','M','L','XL']),
            'condition'=>fake()->randomElement(['new','popular','winter']),
            'status'=>fake()->randomElement(['active','inactive']),

        ];
    }
}
