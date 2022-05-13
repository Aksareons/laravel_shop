<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory()->count(99)->create();

        Product::all()->each(function ($product) {
            $product->slug = Str::slug($product->name, '-');
            $product->save();

            $category = [];
            for($i = 0; $i < 4; $i++){
                array_push($category, rand(1, 5));
            }
            $product->categories()->sync($category);
        });
    }
}
