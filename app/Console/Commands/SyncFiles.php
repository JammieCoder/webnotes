<?php

namespace App\Console\Commands;

use App\Models\Note;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class SyncFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Fetch all filenames from the database
        $filesInDatabase = Note::pluck('filename')->toArray();
        // Fetch all filenames from the storage directory
        $filesInStorage = Storage::allFiles();

        // Files to create in the filesystem
        $filesToCreate = array_diff($filesInStorage, $filesInDatabase);
        $filesToCreate = array_diff($filesToCreate, ['.gitignore','public/.gitignore']);
        // Files to delete from the filesystem
        $filesToDelete = array_diff($filesInDatabase, $filesInStorage);

        // Create missing files in the filesystem
        foreach ($filesToCreate as $filename) {
            $this->info("Adding note: $filename");
            Note::factory()->create(['filename'=>$filename]);
        }
        // Delete files from the database
        foreach ($filesToDelete as $filename) {
            $this->info("Deleting note: $filename");
            Note::destroy(Note::where('filename',$filename)->get()->first()->id);
        }
        $this->info('Files synchronization completed.');
    }
}
