<?php

namespace Database\Seeders;

use App\Enum\RolesEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pass = Hash::make('P4ssw@rd!');

        $manager= User::create([
                'name' => 'Kali_cto',
                'email' => 'kali_manager@levelUp.tn',
                'password' => $pass,
                'email_verified_at' => now()]);
         $manager->setRole(RolesEnum::MANAGER); 

        $empolyee = User::create([
            'name' => 'Kali_dev',
            'email' => 'kali_employer@levelUp.tn',
            'password' => $pass,
            'email_verified_at' => now()
        ]);

        $empolyee->setRole(RolesEnum::EMPLOYEE); 

        $admin = User::create([
            'name' => 'Kali_vip',
            'email' => 'kali_admin@levelUp.tn',
            'password' => $pass,
            'email_verified_at' => now()
        ]);
        $admin->setRole(RolesEnum::ADMINISTRATOR); 
      
    }
}
