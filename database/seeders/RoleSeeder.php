<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role as ModelsRole;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsRole::firstOrCreate(['name' => 'Admin']);
        ModelsRole::firstOrCreate(['name' => 'Colaborador']);

        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        $admin->assignRole('Admin');

        $user = User::factory()->create([
            'name' => 'Colab',
            'email' => 'colab@example.com',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole('Colaborador');
    }
}