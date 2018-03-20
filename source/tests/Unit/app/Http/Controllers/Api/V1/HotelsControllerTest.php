<?php
use Tests\TestCase;

class HotelsControllerTest extends TestCase
{

    const ROUTE="/api/v1/hotels?column=name&direction=asc&page=1&per_page=15&search_column=id&search_operator=equal&search_input=";

    public function testIndexHttpStatusCode()
    {
        $result     = $this->call('GET', self::ROUTE);
        $statusCode = $result->getStatusCode();
        $this->assertEquals(200, $statusCode);
    }
}