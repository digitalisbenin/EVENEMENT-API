<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!count(Role::all())) {

            Role::create(
                [
                    'name' => 'Super Admin',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                
            );

            Role::create(
               
                [
                    'name' => 'User',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                
            );

            
        }
    }
}
