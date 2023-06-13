<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $adminRole = Role::create(['name' => 'administrador']);
        
        $admin = User::create([
            'name' => 'Melvin Alfaro',
            'email' => 'melvii22n@gmail.com',
            'password' => Hash::make('Mely$220612'),
        ]);
        
        $admin->assignRole($adminRole);
    }
}
