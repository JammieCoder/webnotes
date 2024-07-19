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
        $notes = Note::factory(300)->create();
        foreach($notes as $note){
            $note
                ->topics()
                ->attach(rand(1,Topic::count()));
            Storage::put($note->filename,'');
        }
    }
}
