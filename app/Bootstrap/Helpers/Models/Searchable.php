<?php

namespace App\Bootstrap\Helpers\Models;

trait Searchable
{

    public function scopeSearch($query, $search)
    {
        $searchable = $this->searchable ?? [];
        return $query->where(function ($query) use ($searchable, $search) {
            foreach ($searchable as $filter) {
                if (str_contains($filter, '.')) {
                    $nested = explode('.', $filter);
                    for ($i = 0; $i < substr_count($filter, '.'); $i = $i + 2) {
                        $query->orWhereHas($nested[$i], function ($query) use ($nested, $search, $i) {
                            $query->where($nested[$i + 1], 'like', "%$search%");
                        });
                    }
                    continue;
                }
                $query->orWhere($filter, 'like', "%$search%");
            }
        });
    }

}
