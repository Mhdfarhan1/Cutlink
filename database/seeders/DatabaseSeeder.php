<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Administrator PIK-R REQUEST',
                'email' => 'admin@pikrrequestman1tpp.my.id',
                'password' => 'RequestLink2026!',
            ]
        );
    }
}
git remote add origin https://github.com/Mhdfarhan1/Cutlink.git
