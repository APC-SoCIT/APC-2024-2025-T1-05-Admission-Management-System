<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Create roles
        $adminRole = Role::create(['name' => 'Admin']);
        $staffRole = Role::create(['name' => 'Staff']);
        $applicantRole = Role::create(['name' => 'Applicant']);

        // Create permissions
        Permission::create(['name' => 'view admissions']);
        Permission::create(['name' => 'view scholarships']);
        Permission::create(['name' => 'view inquiries']);
        Permission::create(['name' => 'view personal information']);
        Permission::create(['name' => 'view educational background']);
        Permission::create(['name' => 'view family information']);
        Permission::create(['name' => 'view additional information']);

        // Assign permissions to roles
        $adminRole->givePermissionTo(['view admissions', 'view scholarships', 'view inquiries']);
        $staffRole->givePermissionTo(['view admissions', 'view scholarships', 'view inquiries']);
        $applicantRole->givePermissionTo([
            'view personal information',
            'view educational background',
            'view family information',
            'view additional information',
            'view scholarships'
        ]);

        // Create admin user and assign role
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), 
            'role' => 'Admin'
        ]);
        $admin->assignRole($adminRole);

        // Create staff user and assign role
        $staff = User::create([
            'name' => 'Staff',
            'email' => 'staff@example.com',
            'password' => Hash::make('password'),
            'role' => 'Staff'
        ]);
        $staff->assignRole($staffRole);

        // Create applicant user and assign role
        $applicant = User::create([
            'name' => 'Applicant',
            'email' => 'applicant@example.com',
            'password' => Hash::make('password'),
            'role' => 'Applicant'
        ]);
        $applicant->assignRole($applicantRole);
    }
}