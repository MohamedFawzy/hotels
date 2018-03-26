<?php

namespace App\Helper;
use App\Factory\RequestFactory;
use App\Repository\Hotels;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Validation\ValidationException;
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
        $this->factory = new RequestFactory(new Hotels());
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


    /**
     * @return Request
     * @throws ValidationException
     */
    private function validateRequest(): Request
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
            throw new ValidationException($validation);
        }


        return $request;
    }

    public function scopeSearchSortPaginationCriteria($query)
    {


        $request = $this->validateRequest();
        return $query
            ->orderBy($request->column, $request->direction)
            ->where(function($query) use ($request) {
                $this->factory->executeQuery($request, $query);
            })
            ->paginate((int) $request->per_page);

    }
}