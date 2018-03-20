<?php

namespace App\Factory;

use App\ValueObject\Hotel;
use Illuminate\Http\Request;

/**
 * Class RequestFactory
 * @package App\Factory
 */
class RequestFactory
{


    public function  changeDataType(Request $request)
    {
        $search_input=null;
        $hotel = new Hotel();
        switch ($request->search_column){
            case 'price':
                $search_input = (float) $request->search_input;
                $hotel->setPrice($search_input);
                $search_input = $hotel->getPrice();
                break;
        }

        return $search_input;
    }

}