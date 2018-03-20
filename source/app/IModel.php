<?php

namespace App;


use Illuminate\Database\Eloquent\Builder;
use MongoDB\Collection;

interface IModel
{


    /**
     * Search Sort , pagination Function should be implemented in any model
     * @param $query
     * @return Collection
     */
    public function scopeSearchSortPaginationCriteria($query);

}