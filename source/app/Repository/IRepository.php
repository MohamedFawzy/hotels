<?php

namespace App\Repository;
use App\ValueObject\Entity;

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


    public function store(Entity $entity);

}