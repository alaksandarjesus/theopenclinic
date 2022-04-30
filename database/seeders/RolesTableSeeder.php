<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Str;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['Super Administrator', 'Administrator', 'Doctor', 'Patient', 'Front Desk', 'Pharmacist'];

        foreach($roles as $role){

            $row = new Role;
            $row->name = $role;
            $row->uuid = Str::uuid();
            $row->save();
        }
    }
}
