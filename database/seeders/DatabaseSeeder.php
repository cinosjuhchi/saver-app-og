<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Folder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'username' => 'cino123',
            'password' => bcrypt('123'),
        ]);

        Folder::create([
            'title' => 'parent',
            'slug' => 'parent',
            'status' => 'active',
            'parent_folder_id' => null,
            ]);
    }
}
