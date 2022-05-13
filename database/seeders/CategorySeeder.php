<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Factories\CategoryFactory;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { echo("chto");
        Category::factory()->count(5)->create();
            echo("chto");
        // factory(CategoryFactory::class, 10)->create();
        // $category->create(10
    }
}
