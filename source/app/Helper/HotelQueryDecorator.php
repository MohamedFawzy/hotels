<?php

namespace App\Helper;
use App\Factory\RequestFactory;
use Validator;
/**
 * Using design pattern decorator you can get object from models as response and decorate response
 * for pagination , sorting , search
 * Class HotelQueryDecorator
 * @package App\Helper
 */
trait HotelQueryDecorator
{

    private $factory;

    private $request;

    /**
     * HotelQueryDecorator constructor.
     */
    public function __construct()
    {
        $this->factory = new RequestFactory();
    }

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


    public function scopeSearchSortPaginationCriteria($query)
    {
        $request = app()->make('request');
        $validation = Validator::make($request->only([
            'column', 'direction', 'per_page',
            'search_column', 'search_operator', 'search_input'
        ]), [
            'column' => 'required|alpha_dash|in:'.implode(',', self::$columns),
            'direction' => 'required|in:asc,desc',
            'per_page' => 'integer|min:1',
            'search_column' => 'required|alpha_dash|in:'.implode(',', self::$columns),
            'search_operator' => 'required|alpha_dash|in:'.implode(',', array_keys($this->operators)),
            'search_input' => 'max:255'
        ]);

        if($validation->fails()) {
            throw new \Illuminate\Validation\ValidationException($validation);
        }

        $request->search_input = $this->factory->changeDataType($request);
        return $query
            ->orderBy($request->column, $request->direction)
            ->where(function($query) use ($request) {
                if($request->has('search_input')) {
                    if($request->search_operator == 'in') {
                        if($request->search_column=='price'){
                            $query->whereBetween($request->search_column, $request->search_input);
                        }else if ($request->search_column=='availability'){
                            if(!is_array($request->search_input)){
                                $request->search_input = explode(',', $request->search_input);
                            }
                            $from = new \MongoDB\BSON\UTCDateTime(new \DateTime($request->search_input[0]));
                            $to = new \MongoDB\BSON\UTCDateTime(new \DateTime($request->search_input[1]));
                            $query->where('availability', 'elemMatch', array('from' => array('$gte'=>$from), 'to' => array('$lte'=>$to)));
                        }else{
                            $query->whereIn($request->search_column, explode(',', $request->search_input));
                        }

                    } else if($request->search_operator == 'like') {
                        $query->where($request->search_column, 'LIKE', '%'.$request->search_input.'%');
                    }
                    else {
                        if($request->search_column=='id' && $request->search_input != null){
                            $request->search_column = '_id';
                        }
                        $query->where($request->search_column, $this->operators[$request->search_operator], $request->search_input);
                    }
                }
            })
            ->paginate((int) $request->per_page);

    }
}