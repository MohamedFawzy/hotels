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
        $availability = new Availability();
        for($i=0; $i<count($request['availability']); $i++){
            $result[$i] = [
                       'from'=> $request['availability'][$i]["from"],
                        'to'=>  $request['availability'][$i]["to"],
                ];
        }
        $entity->setAvailability($result);
        return $entity;
    }
}