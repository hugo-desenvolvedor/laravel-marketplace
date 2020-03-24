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
        factory(User::class, 40)->create();
    }
}
