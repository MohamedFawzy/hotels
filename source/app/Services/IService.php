<?php

namespace App\Services;

/**
 * Class IService
 * @package App\Services
 */
interface IService
{

    /**
     * @return array
     */
    public function findAll():array ;


    /**
     * @param string $id
     * @return mixed
     */
    public function find(string $id);

    /**
     * @param string $name
     * @param string $city
     * @param float $price
     * @param array $availability
     * @return bool
     */
    public function store(string $name, string $city, float $price, array $availability): bool ;

    /**
     * @param string $id
     * @return mixed
     */
    public function delete(string  $id);

}