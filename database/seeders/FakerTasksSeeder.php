<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class FakerTasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $employeeIds = \App\Models\EmployeesModel::all()->pluck('id')->toArray();
        $rowRand = rand(30,100);

        for ($i = 0; $i<$rowRand; $i++) {
            $tasks = [
                'name' => 'test_task',
                'employee_id' => $faker->randomElement($employeeIds),
                'duration' => rand(1,30),
                'completed' => rand(0,1),
                'created_at' => \Carbon\Carbon::today()->subDays(rand(0, 365)),
                'updated_at' => \Carbon\Carbon::now(),
                'admin_id' => 1
            ];

            DB::table('tasks')->insert($tasks);
        }
    }
}
