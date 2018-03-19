<?php

namespace App;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use App\Helper\HotelQueryDecorator;
/**
 * Class Hotel
 * @package App
 * Hotel entity , model
 */
class Hotel extends Eloquent implements IModel
{

    /**
     * columns for hotel entity should return in response
     * @var array
     */
    public static $columns = [
      'id', 'name', 'price',
        'city', 'availability', 'updated_at', 'created_at'
    ];
    use HotelQueryDecorator;
    /** @var string define collection name */
    protected $collection="hotels";
}