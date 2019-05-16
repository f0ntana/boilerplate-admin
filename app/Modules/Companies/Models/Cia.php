<?php

namespace App\Modules\Companies\Models;

use App\Bootstrap\Helpers\Models\Searchable;
use Illuminate\Database\Eloquent\Model;

class Cia extends Model
{
    use Searchable;

    protected $searchable = ['name'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'active'];
}
