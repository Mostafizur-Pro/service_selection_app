<?php

namespace Database\Seeders;

use App\Models\ServiceName;
use Illuminate\Database\Seeder;

class ServiceNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = ['Service 1', 'Service 2', 'Service 3', 'Service 4', 'Service 5', 'Service 6'];

        foreach ($services as $service) {
            ServiceName::create(['name' => $service]);
        }
    }
}
