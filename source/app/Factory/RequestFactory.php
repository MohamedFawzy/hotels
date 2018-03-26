<?php

namespace App\Factory;
use App\Repository\Hotels;
use Illuminate\Http\Request;
use Jenssegers\Mongodb\Eloquent\Builder;
/**
 * Class RequestFactory
 * @package App\Factory
 */
class RequestFactory
{

    /**
     * @var Hotels
     */
    private $repository;

    protected $operators = [
        'equal' => '=',
        'not_equal' => '<>',
        'less_than' => '<',
        'greater_than' => '>',
        'less_than_or_equal_to' => '<=',
        'greater_than_or_equal_to' => '>=',
        'in' => 'IN',
        'like' => 'LIKE'
    ];


    /**
     * RequestFactory constructor.
     * @param Hotels $hotels
     */
    public function __construct(Hotels $hotels)
    {
        $this->repository = $hotels;
    }


    /**
     * execute db query
     * @param Request $request
     * @param Builder $builder
     * @return Builder
     */

    public function executeQuery(Request $request, Builder $builder)
    {
        if($request->has('search_input')) {
            if($request->search_operator == 'in') {
                if($request->search_column=='price'){
                    return $this->queryPrice($request, $builder);
                }else if ($request->search_column=='availability'){
                        return $this->queryAvailability($request, $builder);
                }else{
                    return $this->queryIn($request->search_column , $request->search_input, $builder);
                }

            } else if($request->search_operator == 'like') {
                $builder->where($request->search_column, 'LIKE', '%'.$request->search_input.'%');
            }
            else {
                if($request->search_column=='id' && $request->search_input != null){
                    $request->search_column = '_id';
                }
                if($request->search_column=='price'){
                    $request->search_input = (float) $request->search_input;
                }
                $builder->where($request->search_column, $this->operators[$request->search_operator], $request->search_input);
            }
        }

    }


    /**
     * @param string $search_column
     * @param string $search_inputs
     * @param Builder $builder
     * @return Builder
     */
    private function queryIn(string  $search_column ,  string $search_inputs, Builder $builder): Builder
    {
        $search_inputs = explode(',', $search_inputs);
        return $this->repository->queryIn($search_column, $search_inputs, $builder);
    }

    /**
     * @param Request $request
     * @param Builder $builder
     * @return Builder
     */
    private function queryAvailability(Request $request, Builder $builder): Builder
    {
        return $this->repository->availabilityQuery($request, $builder);
    }

    /**
     * @param Request $request
     * @param Builder $query
     * @return Builder
     */
    private function queryPrice(Request $request, Builder $query): Builder
    {
        $search_input = $request->search_input;
        $price = $this->getPrice($search_input);
        return $this->repository->priceQuery($request->search_column,$query, $price);
    }

    /**
     * @param string $search_input
     * @return array
     */
    private function getPrice(string  $search_input)
    {

        $price = explode(',',$search_input) ;
        $search_input=[];
        foreach($price as $value){
            $search_input[] = (float) $value;
        }

        return $search_input;
    }

}