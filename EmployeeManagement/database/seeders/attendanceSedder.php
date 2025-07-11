<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EmployeeTimeWatcher;
use Faker\Factory as Faker;

class attendanceSedder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i <= 31; $i++) {
            $empattendance = new EmployeeTimeWatcher();
            if ($i % 2 == 0) {
                $date = $faker->dateTimeBetween('2025-07-01', '2025-07-31')->format('y-m-d');
                $time = $faker->dateTimeBetween('2025-07-01 10:30:00', '2025-07-31 19:30:00')->format('H:i:s');
                $empattendance->user_id = $faker->numberBetween(2, 4);
                $empattendance->entry = "$date $time";
                $empattendance->leave = "$date $time";
                $empattendance->save();
            } else {
                $empattendance->user_id = $faker->numberBetween(2, 4);
                $empattendance->entry = $faker->dateTime();
                $empattendance->leave = $faker->dateTime();
                $empattendance->save();
            }
        }
    }
}
