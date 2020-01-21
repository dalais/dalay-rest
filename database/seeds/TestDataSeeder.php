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
        // create admin user
        factory(App\User::class)->create([
            'name' => 'Admin',
            'email' => 'admin@example.com'
        ]);
        // create random users
        factory(App\User::class, 3)->create();

        // some categories
        $catArray = ['phone', 'desktop', 'watch', 'headphones', 'backpack'];

        // create categories with products
        foreach ($catArray as $category) {
            factory(App\Models\Category::class)->create(['name' => $category])->each(function($category) {
                $category->products()
                    ->saveMany(factory(App\Models\Product::class, 5)->make());
            });;
        }

        $users = \App\User::all();

        // create reviews
        $users->each(function ($user) {
            $allProducts = \App\Models\Product::all();
            foreach ($allProducts as $product) {
                $user->reviews()->save(factory(App\Models\Review::class)->create(
                    ['user_id' => $user->id, 'product_id' => $product->id]
                ));
            }
        });
    }
}
