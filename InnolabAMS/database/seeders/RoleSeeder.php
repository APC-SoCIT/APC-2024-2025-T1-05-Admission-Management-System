<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

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

        // Assign roles to users
        $admin = User::find(1); // Assuming the first user is the admin
        if ($admin && !$admin->hasRole('Admin')) {
            $admin->assignRole('Admin');
        }

        $staff = User::find(2); // Assuming the second user is a staff member
        if ($staff && !$staff->hasRole('Staff')) {
            $staff->assignRole('Staff');
        }

        $applicant = User::find(3); // Assuming the third user is an applicant
        if ($applicant && !$applicant->hasRole('Applicant')) {
            $applicant->assignRole('Applicant');
        }
    }
}