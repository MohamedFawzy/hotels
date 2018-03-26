<?php

namespace App\Hydrator;
use App\ValueObject\Hotel as HotelEntity;
use App\ValueObject\Availability;

class Hotel
{

    public static function hydrate(array $request)
    {
        $entity = new HotelEntity();
        $entity->setName($request['name']);
        $entity->setPrice((float) $request['price']);
        $entity->setCity($request['city']);
        $result =[];
        if($request['availability'] != null){
            $availability = new Availability();
            $result[]= [
                $availability->setFrom($request['availability']['from']),
                $availability->setTo($request['availability']['to']),
            ];

        }
        $entity->setAvailability($result);
        return $entity;
    }
}