<?php

namespace App\Models;

use App\Models\Access\Role;
use App\Models\Traits\HasActive;
use App\Models\Traits\UserAccessScopeTrait;
use App\Models\Traits\UserAccessTrait;
use App\QuikService\Services\OTP\CanSendOTP;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use CanSendOTP,
//        DeleteOldFiles,
        HasActive,
        Notifiable,
//        SearchableTrait,
        SoftDeletes,
        UserAccessScopeTrait,
        UserAccessTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'mobile', 'active', 'email_confirmed', 'mobile_confirmed', 'email_confirmation_token', 'otp'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'active' => 'boolean',
        'email_confirmed' => 'boolean',
        'mobile_confirmed' => 'boolean',
    ];


    /**
     * The roles associated with the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    /**
     * The OTP associated with the user's mobile number.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function otp()
    {
        return $this->otp;
    }

    public function isValidOTP($otp)
    {
        return hash_check($otp, $this->otp);
    }

}
