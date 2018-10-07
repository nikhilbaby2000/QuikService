<?php

namespace App\Models;

use App\Models\Access\Role;
use App\Models\Traits\HasActive;
use App\Models\Traits\DeleteOldFiles;
use App\Models\Traits\UserAccessTrait;
use Illuminate\Notifications\Notifiable;
use App\Models\Traits\UserAccessScopeTrait;
use App\QuikService\Services\OTP\CanSendOTP;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use CanSendOTP,
        DeleteOldFiles,
        HasActive,
        Notifiable,
        SearchableTrait,
        SoftDeletes,
        UserAccessScopeTrait,
        UserAccessTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'mobile', 'profile_picture', 'active', 'email_confirmed', 'mobile_confirmed', 'email_confirmation_token', 'otp'
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
     * The attributes that have files that should be auto deleted on updating or deleting.
     *
     * @var array
     */
    public $deletableFiles = [
        'profile_picture'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_picture_url'
    ];

    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'users.name' => 10,
            'users.username' => 10,
            'users.email' => 10,
            'users.mobile' => 10,
        ],
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

    /**
     * Check if the give otp is valid or not.
     *
     * @param $otp
     * @return bool
     */
    public function isValidOTP($otp)
    {
        return hash_check($otp, $this->otp);
    }

    /**
     * The default file upload path.
     *
     * @return string|null
     */
    public function uploadPath()
    {
        return config('quikservice.user.upload.profile-picture.path');
    }

    /**
     * Get the profile picture url.
     *
     * @return string|null
     */
    public function getProfilePictureUrlAttribute()
    {
        if (empty($this->profile_picture)) {
            return null;
        }

        return Storage::url(file_path($this->uploadPath(), $this->profile_picture));
    }
}
