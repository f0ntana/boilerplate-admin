<?php

namespace App\Modules\Roles\Models;

use App\Bootstrap\Helpers\Models\Searchable;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

    use Searchable;

    protected $searchable = ['name', 'slug'];

    /**
     * The table name
     *
     * @var string
     */
    protected $table = 'permissions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug'];

    /**
     * Roles Relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
