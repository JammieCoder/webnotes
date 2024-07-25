<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Note;
use App\Models\Topic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach(Module::all() as $module){
            $notes = Note::factory(30)->create(['module_id'=>$module->id]);
            foreach($notes as $note){
                $note
                    ->topics()
                    ->attach($module->topics->pluck('id')->random());
            }
        }
    }
}
