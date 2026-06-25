<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        // Staff roles (admin panel). Clients use the portal and need no admin role.
        $superAdmin  = Role::firstOrCreate(['name' => 'super_admin']);
        $admin       = Role::firstOrCreate(['name' => 'admin']);
        $manager     = Role::firstOrCreate(['name' => 'manager']);
        $teamMember  = Role::firstOrCreate(['name' => 'team_member']);
        Role::firstOrCreate(['name' => 'client']); // portal role

        // Give super_admin + admin every generated permission.
        $all = Permission::all();
        $superAdmin->syncPermissions($all);
        $admin->syncPermissions($all);

        // Managers: everything except role management (configure further in UI).
        $manager->syncPermissions(
            $all->reject(fn ($p) => str_contains($p->name, 'Role') || str_contains($p->name, 'role'))
        );

        // Team members start with view-only; refine in the Roles UI.
        $teamMember->syncPermissions(
            $all->filter(fn ($p) => str_starts_with($p->name, 'View'))
        );

        // Promote the primary staff account to super_admin.
        $email = env('ADMIN_EMAIL', 'alsaeed41@gmail.com');
        if ($user = User::where('email', $email)->first()) {
            $user->update(['type' => User::TYPE_STAFF]);
            $user->assignRole('super_admin');
        }

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
