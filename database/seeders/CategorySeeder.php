<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Faker\Factory as faker;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for($i=1; $i <= 10; $i++)
        {
            $category = new Category;
            $category->category_name = $faker->unique()->words($nb=1,$asText=true);
            $category->status = 'active';
            $category->user_id = $faker->numberBetween(1,10);
            $category->save();
        }
    }
}
