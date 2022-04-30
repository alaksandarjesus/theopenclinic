<?php

namespace Database\Seeders;

use App\Models\User\User;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User\UserRoleRelation;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => env('SUPERADMIN_NAME', 'Super Administrator'),
                'username' => env('SUPERADMIN_USERNAME', 'superadmin'),
                'password' => env('SUPERADMIN_PASSWORD', 'Password@123'),
                'email' => env('SUPERADMIN_EMAIL', 'superadmin@example.com'),
                'mobile' => env('SUPERADMIN_MOBILE', '123456789'),
                'gender' => env('SUPERADMIN_GENDER', 'm'),
                'role' => 'Super Administrator'
            ],
           
        ];

        foreach ($users as $user) {
            $row = new User;
            $row->uuid = Str::uuid();
            $row->name = $user['name'];
            $row->username = $user['username'];
            $row->email = $user['email'];
            $row->gender = $user['gender'];
            $row->mobile = $user['mobile'];
            $row->password = $user['password'];
            $row->save();

            $role = Role::where('name', $user['role'])->first();
            $urr_row = new UserRoleRelation;
            $urr_row->user_id = $row->id;
            $urr_row->role_id = $role->id;
            $urr_row->save();

        }
    }
}
