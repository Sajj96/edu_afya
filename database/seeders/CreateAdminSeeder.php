<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $super_admin = User::firstOrNew(['email'=>'admin@example.com']);
        $super_admin->name = 'Super Admin';
        $super_admin->location = 'Tabata';
        $super_admin->phonenumber = '+255717000000';
        $super_admin->password = Hash::make('Admin123');
        $super_admin->city = 'Dar';
        $super_admin->save();
        $super_admin->assignRole(User::ROLE_SUPER_ADMIN);
    }
}
