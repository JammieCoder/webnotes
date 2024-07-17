<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class WipeStorage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:wipe-storage';

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
        $filesToDelete = array_diff(Storage::allFiles(), ['.gitignore', 'public/.gitignore']);
        Storage::delete($filesToDelete);

        $directories = Storage::allDirectories();
        foreach ($directories as $directory) {
            if (empty(Storage::allFiles($directory))) {
                Storage::deleteDirectory($directory);
            }
        }
    }
}
