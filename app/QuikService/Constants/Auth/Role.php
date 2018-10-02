<?php

namespace App\QuikService\Constants\Auth;

class Role
{
    const USER                  = 'user';
    const PAM_MASTER            = 'pam-master';
    const PAM_SURVEYOR          = 'pam-surveyor';
    const PAM_LOADING_MANAGER   = 'pam-loading-manager';
    const PAM_UNLOADING_MANAGER = 'pam-unloading-manager';
    const CORPORATE_MASTER      = 'corporate-master';
    const CORPORATE_POC         = 'corporate-poc';
    const CORPORATE_BRANCH_POC  = 'corporate-branch-poc';
    const CORPORATE_EMPLOYEE    = 'corporate-employee';
    const SUPER_ADMIN           = 'super-admin';
    const PAM_ADMIN             = 'pam-admin';
    const CUSTOMER_SUPPORT      = 'customer-support';

    /**
     * Get all the PAM employee roles.
     *
     * @return array
     */
    public static function pamEmployeeRoles()
    {
        return [
            self::PAM_SURVEYOR,
            self::PAM_LOADING_MANAGER,
            self::PAM_UNLOADING_MANAGER,
        ];
    }

    /**
     * Get all the pam roles.
     *
     * @return array
     */
    public static function pamRoles()
    {
        return array_merge([
            self::PAM_MASTER
        ], self::pamEmployeeRoles());
    }

    /**
     * Get all the corporate roles.
     *
     * @return array
     */
    public static function corporateRoles()
    {
        return [
            self::CORPORATE_MASTER,
            self::CORPORATE_POC,
            self::CORPORATE_BRANCH_POC,
        ];
    }

    /**
     * Get all the admin roles.
     *
     * @return array
     */
    public static function adminRoles()
    {
        return [
            self::SUPER_ADMIN,
            self::PAM_ADMIN,
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
    public static function corporateManageRoles(bool $includeBranchPOC = false, bool $includeAdmin = false)
    {
        $roles = [
            self::CORPORATE_MASTER,
            self::CORPORATE_POC,
        ];

        if ($includeBranchPOC) {
            $roles[] = self::CORPORATE_BRANCH_POC;
        }

        if ($includeAdmin) {
            $roles[] = self::SUPER_ADMIN;
        }

        return $roles;
    }

    /**
     * Get all the corporate hotel manage roles.
     *
     * @return array
     */
    public static function corporateHotelSearchRoles()
    {
        return [
            self::SUPER_ADMIN,
            self::CORPORATE_MASTER,
            self::CORPORATE_POC,
            self::CORPORATE_BRANCH_POC,
            self::CORPORATE_EMPLOYEE,
        ];
    }
}
