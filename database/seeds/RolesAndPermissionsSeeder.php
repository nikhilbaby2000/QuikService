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
        RoleSlug::BRANCH_MANAGER => [
            'name' => 'Branch Manager',
            'description' => 'Main Shop user with all Branch access',
            'permissions' => []
        ],
        RoleSlug::BUSINESS_MANAGER => [
            'name' => 'Business Manager',
            'description' => 'Business Owner with access to all Branches',
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
