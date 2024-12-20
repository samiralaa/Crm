<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class FakerClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $section = ['transport', 'logistic', 'finances'];

        for ($i = 0; $i <= 30; $i++) {
            $client = [
                'full_name' => $faker->name,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'section' => Arr::random($section),
                'budget' => rand(100, 1000),
                'location' => $faker->country,
                'zip' => $faker->postcode,
                'city' => $faker->city,
                'country' => $faker->country,
                'created_at' => $faker->dateTimeBetween($startDate = '-30 days', $endDate = 'now'),
                'updated_at' => \Carbon\Carbon::now(),
                'admin_id' => 1
            ];

            DB::table('clients')->insert($client);
        }
    }
}
