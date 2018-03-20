<?php
use Tests\TestCase;
use Faker\Generator as Faker;

class HotelsControllerTest extends TestCase
{

    //const ROUTE="/api/v1/hotels?column=name&direction=asc&page=1&per_page=15&search_column=id&search_operator=equal&search_input=";


    public function __construct()
    {
        for($i=0; $i<100; $i++){
            $faker = new Faker();
            $hotel = new \App\Hotel();

            $hotel->name = $faker->name;
            $hotel->price = $faker->price;
            $hotel->city = $faker->city;
            $hotel->availability = [
              [
                  'from' => $faker->date('d-m-Y'),
                  'to'   => $faker->date('d-m-Y')
              ]
            ];

            $hotel->save();
        }
    }

    public function testIndexHttpStatusCode()
    {
        $this->assertEquals(5,5);
    }
}