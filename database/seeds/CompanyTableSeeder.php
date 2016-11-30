<?php

use Illuminate\Database\Seeder;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();


        foreach(range(1,30) as $index)
        {
            \App\Company::create([
                'companyName' => $faker->company,
                'contactName' => $faker->name,
                'contactTel'  => $faker->phoneNumber,
                'contactMobile' => $faker->phoneNumber,
                'contactEmail' => $faker->safeEmail,
                'city' => $faker->city,
                'country' => $faker->country,
                'address' => $faker->address
            ]);
        }
    }
}
