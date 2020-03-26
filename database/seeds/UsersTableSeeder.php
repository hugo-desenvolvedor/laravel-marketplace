<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @throws Exception
     */
    public function run()
    {
        factory(User::class, 40)->create()->each(
            function ($user) {
                // Using the method 'save' instead 'create': 'save' store an object, while 'create' store an array
                $user->store()->save(
                    // The method 'make' returns an object with fake data
                    factory(\App\Store::class)->make()
                );
            }
        );
    }
}
