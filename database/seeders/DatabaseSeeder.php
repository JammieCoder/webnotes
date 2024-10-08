<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Artisan::call("app:wipe-storage");
        $this->call([
            UserSeeder::class,
            ModuleSeeder::class,
            TopicSeeder::class,
            NoteSeeder::class
        ]);
    }
}
