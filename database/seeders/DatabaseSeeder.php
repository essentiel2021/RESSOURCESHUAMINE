<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        // $this->call(RoleSeeder::class);
        // $this->call(PermissionSeeder::class);

        // User::find(1)->roles()->attach(1);
        User::find(2)->roles()->attach(3);
        User::find(2)->roles()->attach(2);
        // User::find(3)->roles()->attach(2);

        // User::find(2)->roles()->attach(2);

        // User::factory(10)->create();
    }
}
