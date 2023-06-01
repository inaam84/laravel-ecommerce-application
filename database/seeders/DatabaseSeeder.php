<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();
        \App\Models\Admin::factory(1)->create();
        $this->call(CategoriesTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
    }
}
