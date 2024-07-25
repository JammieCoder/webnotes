<?php

namespace App\Observers;

use App\Models\Module;
use Illuminate\Support\Facades\Storage;

class ModuleObserver
{
    /**
     * Handle the Module "created" event.
     */
    public function created(Module $module): void
    {
        //
    }

    /**
     * Handle the Module "updated" event.
     */
    public function updated(Module $module): void
    {
        //
    }

    /**
     * Handle the Module "deleting" event.
     */
    public function deleting(Module $module): void
    {
       // Archive its corresponding directory when it is deleted
       Storage::deleteDirectory($module->user->id."/".$module->title);

    }

    /**
     * Handle the Module "restored" event.
     */
    public function restored(Module $module): void
    {
        //
    }

    /**
     * Handle the Module "force deleting" event.
     */
    public function forceDeleted(Module $module): void
    {
        //
    }
}
