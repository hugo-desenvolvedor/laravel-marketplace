<?php

use Illuminate\Database\Seeder;

class StoreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stores = \App\Store::all();

        foreach ($stores as $store) {
            // Using the method 'save' instead 'create': 'save' store an object, while 'create' store an array
            $store->products()->save(
                // The method 'make' returns an object with fake data
                factory(\App\Product::class)->make()
            );
        }
    }
}
