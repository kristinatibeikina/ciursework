<?php

namespace Database\Seeders;
use App\Models\Role;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run():void
    {
         //\App\Models\User::factory(10)->create();
        Role::factory()
            ->count(2)
            ->sequence(
                ['name' => 'admin'],
                ['name' => 'user'],
            )
            ->create();
         User::factory()->create([
            'name' => 'admin',
             'email' => 'admin@example.com',
             'password'=>'adminadmin',
             'id_role'=>'1'
         ]);


    }
}
