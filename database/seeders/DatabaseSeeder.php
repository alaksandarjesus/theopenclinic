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

        $this->call([
            // Use below for simple basic application, comment below this if used for demo testing

            RolesTableSeeder::class,
            UsersTableSeeder::class,



            // Use below for application with dummy data (only for local testing purpose)
            // DevTableSeeder::class,

        ]);
    }
}
