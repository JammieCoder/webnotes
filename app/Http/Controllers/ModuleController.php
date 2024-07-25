<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreModuleRequest;
use App\Http\Requests\UpdateModuleRequest;
use App\Models\Module;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreModuleRequest $request)
    {
        $module = Module::create([
            'user_id'=>Auth::user()->id,
            'title'=>$request->validated()['title'],

        ]);
        // A new directory is created for each of the user's modules
        Storage::makeDirectory(Auth::user()->id.'/'.$module->title);
        return redirect()->action([ModuleController::class, 'show'], $module);
    }

    /**
     * Display the specified resource.
     */
    public function show(Module $module)
    {
      $filters = request()->all();
      $filters['module']=$module->id;
      // Check if the user owns this module
      return redirect()->action([NoteController::class,'index'],
        ['filters'=>$filters]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Module $module)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateModuleRequest $request, Module $module)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Module $module)
    {

       // Delete the module record and all notes within
       foreach($module->notes as $note){
            // must manually delete the notes to trigger the 'deleting' event for each note
            $note->delete();
        }
       $module->delete();

       // Archive the directory
       Storage::deleteDirectory($module->user->id."/".$module->title);


       return redirect()->route('dashboard');
    }
}
