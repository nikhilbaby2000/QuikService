<?php

use App\Models\Access\Role;
use Illuminate\Database\Seeder;
use App\Models\Access\Permission;
use App\QuikService\Constants\Auth\Role as RoleSlug;
use App\QuikService\Constants\Auth\Permission as PermissionSlug;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * List of all the permissions to be created.
     *
     * @var array
     */
    protected $permissions = [];

    /**
     * List of all the roles to be created along with their permissions.
     *
     * @var array
     */
    protected $roles = [
        RoleSlug::SUPER_ADMIN => [
            'name' => 'Super Admin',
            'description' => 'Admin group with unrestricted access',
            'all' => true,
        ],
        RoleSlug::USER => [
            'name' => 'Normal User',
            'description' => 'Normal user with standard access',
            'permissions' => []
        ],
        RoleSlug::PAM_MASTER => [
            'name' => 'PAM Master',
            'description' => 'Main pam user with all pam access',
            'permissions' => []
        ],
        RoleSlug::PAM_SURVEYOR => [
            'name' => 'PAM Surveyor',
            'description' => 'PAM Surveyor with permission to upload inventory',
            'permissions' => []
        ],
        RoleSlug::PAM_LOADING_MANAGER => [
            'name' => 'PAM Loading Manager',
            'description' => 'PAM Loading Manager with standard access to load inventory',
            'permissions' => []
        ],
        RoleSlug::PAM_UNLOADING_MANAGER => [
            'name' => 'PAM Unloading Manager',
            'description' => 'PAM Unloading Manager with standard access to unload inventory',
            'permissions' => []
        ],
        RoleSlug::CORPORATE_MASTER => [
            'name' => 'Corporate Master',
            'description' => 'Main corporate user with all corporate access',
            'permissions' => []
        ],
        RoleSlug::CORPORATE_POC => [
            'name' => 'Corporate POC',
            'description' => 'Main corporate POC user with all corporate access below the master',
            'permissions' => []
        ],
        RoleSlug::CORPORATE_BRANCH_POC => [
            'name' => 'Corporate Branch POC',
            'description' => 'Corporate Branch POC user with standard access',
            'permissions' => []
        ],
        RoleSlug::CORPORATE_EMPLOYEE => [
            'name' => 'Corporate Employee',
            'description' => 'Corporate employees that have attached their account',
            'permissions' => []
        ],
        RoleSlug::PAM_ADMIN => [
            'name' => 'PAM Admin',
            'description' => 'PAM Admin who manages all pam users and actions',
            'permissions' => []
        ],
        RoleSlug::CUSTOMER_SUPPORT => [
            'name' => 'Customer Support',
            'description' => 'Customer Support with permissions to manage Support Tickets',
            'permissions' => []
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {

            foreach ($this->permissions as $permissionSlug => $attributes) {
                // Create permission if it doesn't exist
                Permission::firstOrCreate(['slug' => $permissionSlug], $attributes);
            }

            foreach ($this->roles as $roleSlug => $role) {
                // Create role if it doesn't exist
                $createdRole = Role::firstOrCreate(
                    ['slug' => $roleSlug],
                    array_merge(array_except($role, ['permissions']), ['locked' => true])
                );

                // Sync permissions
                if (isset($role['permissions'])) {
                    $rolePermissions = $role['permissions'];
                    $rolePermissionIds = Permission::whereIn('slug', $rolePermissions)->pluck('id');
                    $createdRole->permissions()->sync($rolePermissionIds);
                }

            }

            /*
             * Delete all unused permissions
             */
            $existingPermissions = Permission::pluck('slug')->toArray();

            $newPermissions = array_keys($this->permissions);

            $permissionsToDelete = array_diff($existingPermissions, $newPermissions);

            Permission::whereIn('slug', $permissionsToDelete)->delete();
        });
    }
}
