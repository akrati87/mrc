<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AdminUser;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        AdminUser::updateOrCreate(
            [   'email' => 'admin@admin.com',
                'name' => 'Super Admin',
                'password' => Hash::make('12345678'),
            ]
        );
    }
}
