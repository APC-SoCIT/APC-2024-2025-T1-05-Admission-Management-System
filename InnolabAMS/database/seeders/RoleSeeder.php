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
        // Create roles if they don't exist
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $staffRole = Role::firstOrCreate(['name' => 'Staff']);
        $applicantRole = Role::firstOrCreate(['name' => 'Applicant']);

        // Create permissions if they don't exist
        $permissions = [
            'view dashboard',
            'view admissions',
            'view scholarships',
            'view inquiries',
            'view users',
            'view personal information',
            'view educational background',
            'view family information',
            'view additional information'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Assign permissions to roles
        $adminRole->syncPermissions([
            'view dashboard',
            'view admissions',
            'view scholarships',
            'view inquiries',
            'view users'
        ]);

        $staffRole->syncPermissions([
            'view admissions',
            'view scholarships',
            'view inquiries'
        ]);

        $applicantRole->syncPermissions([
            'view personal information',
            'view educational background',
            'view family information',
            'view additional information',
            'view scholarships'
        ]);

        // Create users if they don't exist
        if (!User::where('email', 'admin@example.com')->exists()) {
            $admin = User::create([
                'first_name' => 'Admin',
                'middle_name' => '',
                'last_name' => '',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'Admin'
            ]);
            $admin->assignRole($adminRole);
        }

        if (!User::where('email', 'staff@example.com')->exists()) {
            $staff = User::create([
                'first_name' => 'Staff',
                'middle_name' => '',
                'last_name' => '',
                'email' => 'staff@example.com',
                'password' => Hash::make('password'),
                'role' => 'Staff'
            ]);
            $staff->assignRole($staffRole);
        }

        if (!User::where('email', 'applicant@example.com')->exists()) {
            $applicant = User::create([
                'first_name' => 'Applicant',
                'middle_name' => '',
                'last_name' => '',
                'email' => 'applicant@example.com',
                'password' => Hash::make('password'),
                'role' => 'Applicant'
            ]);
            $applicant->assignRole($applicantRole);
        }
    }
}
