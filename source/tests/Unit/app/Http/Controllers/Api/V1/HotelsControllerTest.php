<?php
use Tests\TestCase;

class HotelsControllerTest extends TestCase
{

    const ROUTE="/api/v1/hotels";

    public function testIndexHttpStatusCode()
    {
        $result     = $this->call('GET', self::ROUTE);
        $statusCode = $result->getStatusCode();
        $this->assertEquals(200, $statusCode);
    }
}