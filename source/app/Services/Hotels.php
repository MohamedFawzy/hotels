<?php

namespace App\Services;
use App\Hotel;
use App\Repository\Hotels as HotelsRepository;

/**
 * Class Hotels
 * @package App\Services
 */
class Hotels implements IService
{

    /**
     * @var HotelsRepository
     */
    private $repository;


    /**
     * Hotels constructor.
     * @param HotelsRepository $repository
     */
    public function __construct(HotelsRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @return array
     */
    public function findAll(): array
    {
        $result =  $this->repository->findAll();
        $result['model'] = \App\Transformers\Hotels::transform($result['model']);
        return $result;
    }


    public function store(string $name, string $city, float $price, array $availability):bool
    {
        // hydrate request
        $data = ['name'=>$name, 'city'=>$city, 'price'=>$price, 'availability'=>$availability];
        $hotelsObject = \App\Hydrator\Hotel::hydrate($data);
        return $this->repository->store($hotelsObject);
    }

    /**
     * @param string $id
     * @return int
     */
    public function delete(string $id)
    {
        return Hotel::destroy($id);
    }


}