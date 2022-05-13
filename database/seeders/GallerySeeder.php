<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Gallery;
use Illuminate\Support\Facades\DB;
class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::all()->each(function ($product) {
            $gallery = Gallery::factory()->count(1)->create();
            $product->gallery()->saveMany($gallery);
        });
    }
}
