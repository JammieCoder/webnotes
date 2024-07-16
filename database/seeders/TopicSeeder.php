<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Topic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach(Module::all() as $module){
            Topic::factory(10)->create(['module_id' => $module->id]);
        }
    }
}
