<?php

namespace App\Services;
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


}