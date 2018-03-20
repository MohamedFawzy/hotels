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
                        $query->whereIn($request->search_column, explode(',', $request->search_input));
                    } else if($request->search_operator == 'like') {
                        $query->where($request->search_column, 'LIKE', '%'.$request->search_input.'%');
                    }
                    else {
                        if($request->search_column=='id' && $request->search_input != null){
                            $request->search_column = '_id';
                        }
//                        // @TODO add factory pattern for get data type for request search input and value object for entity hotel
//                        if($request->search_column=='price'){
//                            $request->search_input = (float) $request->search_input;
//                        }
                        $query->where($request->search_column, $this->operators[$request->search_operator], $request->search_input);
                    }
                }
            })
            ->paginate((int) $request->per_page);

    }
}