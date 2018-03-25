<?php

namespace App\Repository;
use App\Hotel;
use Jenssegers\Mongodb\Eloquent\Builder;
use MongoDB\Collection;

/**
 * Class Hotels
 * @package App\Repository
 */
class Hotels implements IRepository
{

    public function findAll(): array
    {

        $model = Hotel::SearchSortPaginationCriteria();
        $columns = Hotel::$columns;
        $result = ['model'=>$model, 'columns' => $columns];

        return $result;
    }


}