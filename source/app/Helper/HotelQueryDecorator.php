<?php

namespace App\Helper;
use MongoDB\Collection;

/**
 * Using design pattern decorator you can get object from models as response and decorate response
 * for pagination , sorting , search
 * Class HotelQueryDecorator
 * @package App\Helper
 */
trait HotelQueryDecorator
{


    public function SearchSortPaginationCriteria($query): Collection
    {

    }
}