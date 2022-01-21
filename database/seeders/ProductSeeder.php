<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Faker\Factory as faker;

class ProductSeeder extends Seeder
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
            $product = new Product();
            $product->name = $faker->words($nb=2,$asText=true);
            $product->price = $faker->numberBetween(10,500);
            $product->status = 'instock';
            $product->quantity = $faker->numberBetween(100,200);
            $product->image = 'fashion_'.$faker->unique()->numberBetween(1,10).'.jpg';
            $product->category_id = $faker->numberBetween(1,20);
            $product->user_id = $faker->numberBetween(1,3);
            $product->save();
        }
    }
}
