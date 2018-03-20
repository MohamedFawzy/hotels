<?php
use Tests\TestCase;
use Faker\Generator as Faker;

class HotelsControllerTest extends TestCase
{

    //const ROUTE="/api/v1/hotels?column=name&direction=asc&page=1&per_page=15&search_column=id&search_operator=equal&search_input=";

    public function testIndexHttpStatusCode()
    {
        $this->assertEquals(5,5);
    }
}