<?php

namespace App\Filters;

class UserFilter extends QueryFilter
{
    /**
     * @param $val
     * @return mixed
     */
    public function name($val)
    {
        return $this->builder
            ->when($val, function ($query, $val) {
                return $query->where('name', 'like', '%' . $val . '%');
            });
    }
}
