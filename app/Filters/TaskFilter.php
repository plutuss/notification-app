<?php

namespace App\Filters;

class TaskFilter extends QueryFilter
{


    public function user_id($val )
    {
        return $this->builder
            ->when($val, function ($q) use ($val) {
                return $q->where('user_id', $val);
            });
    }
}
