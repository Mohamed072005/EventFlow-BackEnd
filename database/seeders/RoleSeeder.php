<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class RoleSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['user', 'organizer', 'admin'];
        foreach ($roles as $role) {
            Role::firstOrCreate([
                'id' => Str::uuid(),
                'role_name' => $role,
            ]);
        }
        //
    }
}
