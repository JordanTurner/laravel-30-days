<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // database seeders are classes that usually run factories to seed the database with dummy data for quickly scaffolding your application or for testing purposes

        // database seeders don't have to use factories, they can also use raw SQL queries or Eluquent models to seed the database

        User::factory()->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'test@example.com',
        ]);
        
        $this->call(JobSeeder::class);
    }
}
