<?php

namespace App\Observers;

use App\Models\Note;
use Illuminate\Support\Facades\Storage;

class NoteObserver
{
    /**
     * Handle the Note "created" event.
     */
    public function created(Note $note): void
    {
        Storage::put($note->filename,"");
    }

    /**
     * Handle the Note "updated" event.
     */
    public function updated(Note $note): void
    {
        //
    }

    /**
     * Handle the Note "deleting" event.
     */
    public function deleting(Note $note): void
    {
        $userId = $note->module->user->id;
        $archiveDir = $userId."/Archive/".strtok($note->filename,$userId);
        Storage::move($note->filename, $archiveDir);
    }

    /**
     * Handle the Note "restored" event.
     */
    public function restored(Note $note): void
    {
        //
    }

    /**
     * Handle the Note "force deleted" event.
     */
    public function forceDeleted(Note $note): void
    {
        //
    }
}
