<?php

namespace App\Repository;
/**
 * Class IRepository
 * @package App\Repository
 */

interface IRepository
{

    /**
     * @return array
     */
    public function findAll():array ;

}