<?php

use Illuminate\Database\Seeder;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cat_array = ['phone', 'desktop', 'watch', 'headphones', 'backpack'];
        foreach ($cat_array as $category) {
            factory(App\Models\Category::class)->create(['name' => $category])->each(function($category) {
                $category->products()
                    ->saveMany(factory(App\Models\Product::class, 5)->make())
                    ->each(function($product){
                        $product->reviews()->save(factory(App\Models\Review::class)->make());
                    });
            });;
        }
    }
}
