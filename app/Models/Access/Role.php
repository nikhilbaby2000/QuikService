<?php

namespace App\Models\Access;

use App\Models\User;
use App\Models\Access\Traits\RoleTrait;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use RoleTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug', 'name', 'description', 'all'
    ];

    /**
     * The attributes that can be used for sorting with query string filtering.
     *
     * @var array
     */
    public $sortable = [
        'name', 'all', 'locked', 'created_at', 'updated_at'
    ];

    /**
     * The relationships that can be loaded with query string filtering includes.
     *
     * @var array
     */
    public $includes = [
        'users', 'permissions'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'all' => 'boolean',
        'locked' => 'boolean',
    ];

    /**
     * The users associated with the role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user', 'role_id', 'user_id');
    }

    /**
     * The permissions associated with the role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role', 'role_id', 'permission_id');
    }
}
