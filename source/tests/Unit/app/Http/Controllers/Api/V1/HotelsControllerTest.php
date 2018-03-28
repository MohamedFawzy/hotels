<?php
use Tests\TestCase;
use Faker\Generator as Faker;

class HotelsControllerTest extends TestCase
{

    const ROUTE="/api/v1/hotels?column=name&direction=asc&page=1&per_page=15&search_column=id&search_operator=equal&search_input=";

    const INDEX_ROUTE="/api/v1/hotels";

    public function testIndexHttpStatusCode()
    {
        $request = $this->call('GET', self::ROUTE);
        $statusCode = $request->getStatusCode();
        $this->assertEquals(200, $statusCode);
    }


    public function testIndexWithoutParams()
    {
        $request = $this->call('GET', self::INDEX_ROUTE);
        $statusCode = $request->getStatusCode();
        $this->assertEquals(422, $statusCode);
    }


    public function testIndexResponse()
    {
        $response = $this->json('GET', self::ROUTE);

        $response
            ->assertStatus(200)
            ->assertJson([
                'model' =>
                    ['current_page'=>1],
            ]);
    }


    public function testHasAttribute()
    {
        $this->assertClassHasAttribute('service', \App\Http\Controllers\Api\V1\HotelsController::class);
    }


    public function testSaveNewRowSuccessfully()
    {
        $faker = \Faker\Factory::create();

        $dateFrom1 = date('d-m-Y',$faker->dateTimeBetween('now', strtotime('+2 week'))->getTimestamp());

        $dateTo1 =date('d-m-Y',$faker->dateTimeBetween('+3 week', strtotime('+2 month'))->getTimestamp());

        $from  = $dateFrom1;
        $to  = $dateTo1;

        $dateFrom2 = date('d-m-Y',$faker->dateTimeBetween('+1 week', strtotime('+3 week'))->getTimestamp());

        $dateTo2 = date('d-m-Y',$faker->dateTimeBetween('+4 week', strtotime('+2 month'))->getTimestamp());

        $from2  = $dateFrom2;
        $to2  = $dateTo2;

        $data = [
          'name' =>   $faker->name,
            'city' => $faker->city,
            'price' => $faker->randomFloat(2, 50, 200),
            'availability' => [
            [
                'from' => $from,
                'to'   => $to
            ],
            [

                'from' => $from2,
                'to'   => $to2
            ]]
        ];
        $this->post('/api/v1/hotels', $data)->assertStatus(201);

    }



}