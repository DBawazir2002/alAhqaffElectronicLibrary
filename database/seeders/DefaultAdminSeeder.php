<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (config('admin.admin_name')) {
            User::firstOrCreate([
                'email' => config('admin.admin_email'),
                'name' => config('admin.admin_name'),
                'password' =>Hash::make(config('admin.admin_password')),
                'role' => config('admin.admin_role'),
                'created_at' => Carbon::now()
            ]);
        }
    }
}
