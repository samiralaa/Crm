<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    
        $this->call(AdminAccSeeder::class);
        $this->call(FakerClientSeeder::class);
        $this->call(FakerCompaniesSeeder::class);
        $this->call(FakerEmployeesSeeder::class);
        $this->call(FakerDealsSeeder::class);
        $this->call(FakerProductsSeeder::class);
        $this->call(FakerSalesSeeder::class);
        $this->call(FakerTasksSeeder::class);
        $this->call(SettingsSeeder::class);
       

    }
}
