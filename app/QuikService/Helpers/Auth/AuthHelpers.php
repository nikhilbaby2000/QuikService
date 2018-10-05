<?php

namespace App\QuikService\Helpers\Auth;

use App\QuikService\Constants\Auth\Role;
use Illuminate\Contracts\Auth\Authenticatable;

trait AuthHelpers
{
    /**
     * Revoke all the active access tokens for a user.
     *
     * @param Authenticatable $user
     */
    protected function revokeActiveTokens(Authenticatable $user)
    {
        if (!method_exists($user, 'tokens')) {
            return;
        }

        $user->tokens()
            ->where('revoked', false)
            ->update(['revoked' => true]);
    }

    /**
     * Get the roles that are allowed to login with OTP.
     *
     * @return array
     */
    protected function otpLoginRoles()
    {
        return [
            Role::USER,
        ];
    }

    /**
     * Check if the given role(s) are in the allowed list.
     *
     * @param string|array $role
     * @param array $allowedList
     * @return bool
     */
    protected function roleAllowed($role, array $allowedList)
    {
        $role = is_string($role) ? [$role] : $role;

        return array_has_all($role, $allowedList);
    }
}
