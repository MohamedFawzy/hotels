<?php

namespace App\Transformers;


class Hotels
{

    public static function transform($result)
    {
        $availability=[];
        foreach ($result as $index => $row){
            foreach($row->availability as $key => $value){
                $availability[] = [
                  'from' => $value['from']->toDateTime()->format('d-m-Y'),
                   'to' => $value['to']->toDateTime()->format('d-m-Y'),

                ];
            }
            $result[$index]->availability = $availability;
            unset($availability);
        }
        return $result;
    }


    /**
     * @param $result
     * @return mixed
     */
    public static function transformRow($result)
    {
        $availability=[];
        foreach($result->availability as $index => $value){
            //dd($value['from']->toDateTime()->format('d-m-Y'));
            $availability[] = [
              'from' => $value['from']->toDateTime()->format('d-m-Y'),
              'to'   => $value['to']->toDateTime()->format('d-m-Y')
            ];
            $result->availability = $availability;
        }
        return $result;
    }
}