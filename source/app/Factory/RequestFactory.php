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
        $search_input=$request->search_input;
        $hotel = new Hotel();
        switch ($request->search_column){
            case 'price':
                if($request->search_operator=='in'){
                    $request->search_input = explode(',',$request->search_input) ;
                    foreach($request->search_input as $value){
                        $search_input[] = (float) $value;
                    }
                }else{
                    $search_input = (float) $request->search_input;
                    $hotel->setPrice($search_input);
                    $search_input = $hotel->getPrice();
                }
                break;
        }

        return $search_input;
    }

}