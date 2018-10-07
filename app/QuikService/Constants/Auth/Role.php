<?php

namespace App\QuikService\Constants\Auth;

class Role
{
    const USER                  = 'user';
    const SUPER_ADMIN           = 'super-admin';
    const BRANCH_MANAGER        = 'branch-manager';
    const BUSINESS_MANAGER      = 'business-manager';
    const CUSTOMER_SUPPORT      = 'customer-support';

    /**
     * Get all the admin roles.
     *
     * @return array
     */
    public static function adminRoles()
    {
        return [
            self::SUPER_ADMIN,
            self::BUSINESS_MANAGER,
            self::CUSTOMER_SUPPORT,
        ];
    }

    /**
     * Get all the corporate manage roles.
     *
     * @param bool $includeBranchPOC
     * @param bool $includeAdmin
     * @return array
     */
    public static function businessRoles(bool $includeBranchPOC = false, bool $includeAdmin = false)
    {
        $roles = [
            self::BUSINESS_MANAGER,
        ];

        if ($includeBranchPOC) {
            $roles[] = self::BRANCH_MANAGER;
        }

        if ($includeAdmin) {
            $roles[] = self::SUPER_ADMIN;
        }

        return $roles;
    }
}
