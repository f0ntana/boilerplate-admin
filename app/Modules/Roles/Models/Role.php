<?php

namespace App\Modules\Roles\Models;

use App\Bootstrap\Helpers\Models\Searchable;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    use Searchable;

    const ADMIN = 1;
    const PARTNER = 2;
    const CLIENT = 3;

    protected $searchable = ['name', 'slug'];

    /**
     * The table name
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug'];

    /**
     * Custom Name Mutator
     */
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $this->attributes['slug'] = str_slug($name);
    }

    /**
     * Permissions Relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
