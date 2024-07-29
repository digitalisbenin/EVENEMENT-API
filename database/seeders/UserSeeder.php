<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!count(User::all())) {
            $roleSupAdm = Role::where('name', 'Super Admin')->first();
            User::create(
                [
                    'name' => 'Supper Admin',
                    'email' => 'superadmin@eresto.com',
                    'password' => bcrypt('password'),
                    'role_id' => $roleSupAdm->id,
                ],
                
            );
        }
    }
}
