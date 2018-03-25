<?php

use Illuminate\Database\Seeder;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;
use App\Hotel;
class HotelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $output = new ConsoleOutput;
        $bar = new ProgressBar($output);
        $this->command->info("Seeding Orders");
        $bar->setFormat('verbose');
        $bar->start();
        for($i=0; $i<99; $i++) {
            $bar->advance();
            $bar->getProgressPercent();
            $faker = Faker\Factory::create();
            $hotel = new Hotel();
            $hotel->name = $faker->name;
            $hotel->price =$faker->randomFloat(2,50,200);
            $hotel->city = $faker->city;
            $from  = new \MongoDB\BSON\UTCDateTime(new DateTime(date('d-m-Y',$faker->dateTimeBetween('now', strtotime('+2 week'))->getTimestamp())));
            $to  = new \MongoDB\BSON\UTCDateTime(new DateTime(date('d-m-Y',$faker->dateTimeBetween('+3 week', strtotime('+2 month'))->getTimestamp())));


            $hotel->availability = [
                [
                    'from' => $from,
                    'to'   => $to
                ],
                [

                    'from' => $from,
                    'to'   => $to
                ]
            ];
            $result = $hotel->save();
            if($result){
                $this->command->info("\n\n\nNew Record ".$i." inserted to collection");
            }
        }
        $bar->finish();
        $this->command->info("\n\r");

    }
}
