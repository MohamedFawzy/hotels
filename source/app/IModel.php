<?php

namespace App;


use MongoDB\Collection;

interface IModel
{


    /**
     * Search Sort , pagination Function should be implemented in any model
     * @param $query
     * @return Collection
     */
    public function SearchSortPaginationCriteria($query): Collection;

}