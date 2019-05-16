<?php

namespace App\Modules\Users\Models;

use App\Bootstrap\Helpers\Models\Searchable;
use App\Modules\Roles\Models\Role;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable, Searchable;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['role'];

    /**
     * The attributes searchable
     *
     * @var array
     */
    protected $searchable = ['name', 'email'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id',
        'name',
        'email',
        'document',
        'password',
        'active',
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
     * Crypt password
     */
    public function setPasswordAttribute($pass)
    {

        $this->attributes['password'] = Hash::make($pass);
    }

    /**
     * Role Relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
