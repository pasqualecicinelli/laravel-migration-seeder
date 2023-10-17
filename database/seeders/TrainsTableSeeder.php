<?php

namespace Database\Seeders;

use App\Models\Train;
use Faker\Generator as Faker;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrainsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        for ($i = 0; $i < 10; $i++) {

            $train = new Train();

            $train->company_name = $faker->company();
            $train->departure_station = $faker->city();
            $train->arrival_station = $faker->city();

            /*  Genera per 'departure_time' una faker data e un orario compreso dal giorno prima al giorno Attuale 
                Genera per 'arrival_time' una faker data e un orario del giorno Attuale */

            $train->departure_time = $faker->dateTimeBetween('-1 day', '+1 day');
            $train->arrival_time = $faker->dateTimeBetween('+1 day', '+1 day');
            $train->train_code = $faker->randomNumber(5, true);
            $train->number_of_carriages = $faker->randomNumber(1, true);
            $train->in_time = $faker->boolean();
            $train->deleted = $faker->boolean();

            $train->save();
        }

    }
}