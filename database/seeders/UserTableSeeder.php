<?php

namespace Database\Seeders;

use App\Models\UserTable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['username' => 'User 1', 'service_id' => 1],
            ['username' => 'User 2', 'service_id' => 2],
            ['username' => 'User 3', 'service_id' => 3],
            ['username' => 'User 4', 'service_id' => 4],
            ['username' => 'User 5', 'service_id' => 5],
            ['username' => 'User 6', 'service_id' => 6],
        ];

        foreach ($users as $user) {
            UserTable::create($user);
        }
    }
}
