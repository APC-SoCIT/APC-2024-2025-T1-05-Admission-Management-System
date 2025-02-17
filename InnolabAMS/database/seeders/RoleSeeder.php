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
        // Check and create roles if they do not exist
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $staffRole = Role::firstOrCreate(['name' => 'Staff']);
        $applicantRole = Role::firstOrCreate(['name' => 'Applicant']);

        // Check and create permissions if they do not exist
        Permission::firstOrCreate(['name' => 'view admissions']);
        Permission::firstOrCreate(['name' => 'view scholarships']);
        Permission::firstOrCreate(['name' => 'view inquiries']);
        Permission::firstOrCreate(['name' => 'view personal information']);
        Permission::firstOrCreate(['name' => 'view educational background']);
        Permission::firstOrCreate(['name' => 'view family information']);
        Permission::firstOrCreate(['name' => 'view additional information']);

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

        // Create default admin user if it does not exist
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password') // Change this to a secure password
            ]
        );

        // Assign roles to users
        if ($admin && !$admin->hasRole('Admin')) {
            $admin->assignRole('Admin');
        }

        // Create default applicant user if it does not exist
        $applicant = User::firstOrCreate(
            ['email' => 'applicant@example.com'],
            [
                'name' => 'Applicant',
                'password' => Hash::make('password') // Change this to a secure password
            ]
        );

        // Assign roles to users
        if ($applicant && !$applicant->hasRole('Applicant')) {
            $applicant->assignRole('Applicant');
        }

        $staff = User::find(2); // Assuming the second user is a staff member
        if ($staff && !$staff->hasRole('Staff')) {
            $staff->assignRole('Staff');
        }
    }
}