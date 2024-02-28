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
            User::firstOrCreate([
                'email' => 'admin@gmail.com',
                'name' => 'admin',
                'password' =>Hash::make('adminadmin'),
                'role' => 1,
                'created_at' => Carbon::now()
            ]);
    }
}
