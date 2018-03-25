<?php

namespace App\Transformers;


class Hotels
{

    public static function transform($result)
    {
        $response = [];
        $availability=[];
        foreach ($result as $index => $row){
            foreach($row->availability as $key => $value){
                $availability[] = [
                  'from' => $value['from']->toDateTime()->format('d-m-Y'),
                   'to' => $value['to']->toDateTime()->format('d-m-Y'),

                ];
            }
            $response[] = [
                'id' => $row->id,
                'name' => $row->name,
                'price' => $row->price,
                'city' => $row->city,
            //    'availability' => $availability,
            ];
            unset($availability);
        }

        return $response;
    }
}