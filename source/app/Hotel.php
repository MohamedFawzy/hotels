<?php

namespace App;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
/**
 * Class Hotel
 * @package App
 * Hotel entity , model
 */
class Hotel extends Eloquent
{
    /** @var string  define database connection string */
    protected $connection = 'mongodb';
    /** @var string define collection name */
    protected $collection="hotels";
}