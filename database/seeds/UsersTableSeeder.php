<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::truncate();
        App\Post::truncate();
        factory(App\User::class, 10)->create()->each(function ($user) {
            factory(App\Post::class)->create(['user_id'=>$user->id]);
        });
    }
}
