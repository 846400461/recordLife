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
        factory(App\User::class, 30)->create()->each(function ($u) {
        factory(App\GoodDate::class,20)->create([
            'userId'=>$u->id,
        ]);
    });
    }
}
