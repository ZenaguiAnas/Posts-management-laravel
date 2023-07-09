<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        if($this->command->confirm("Do you want to refresh the database ?", false)){
            $this->command->call("migrate:refresh");
            $this->command->info("The database was refreshed successfuly !");
        }

        $this->call([UsersTableSeeder::class, PostsTableSeeder::class, CommentsTableSeeder::class]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

    }
}
