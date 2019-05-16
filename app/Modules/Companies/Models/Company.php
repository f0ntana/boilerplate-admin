<?php

namespace App\Modules\Companies\Models;

use App\Bootstrap\Helpers\Models\Searchable;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use Searchable;

    protected $searchable = ['name', 'website'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'website', 'active'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'website' => 'string',
        'active' => 'boolean'
    ];
}
