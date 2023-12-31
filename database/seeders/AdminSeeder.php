<?php

namespace Database\Seeders;

use App\Models\MasterAdmin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=>'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345'),
            // 'isAdmin' => true,
        ]);
        MasterAdmin::create([
            'name'=>'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345'),
            // 'isAdmin' => true,
        ]);
        $this->command->info('Admin user seeded successfully.');
    }
    }
