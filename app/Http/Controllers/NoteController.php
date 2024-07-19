<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Models\Module;
use App\Models\Note;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $module=$request->module;
        $topics_arr=$request->topics; //array of topic ids
        $weeks=$request->weeks; //array

        //If no module is passed then return to dashboard
        if(is_null($module))
            return redirect()->view('dashboard');
        //Find the relating module record or fail if not found
        $module=Module::findOrFail($module);

        //if no topic filters passed, get them from the module
        if(is_null($topics_arr)|$topics_arr==[])
            $topics=$module->topics;
        else{
            $topics=new Collection();
            foreach($topics_arr as $topic){
                $topics=$topics->merge(Topic::where('module_id',$module->id)->find($topic));
            }
        }

        $notes = new Collection();
        foreach($topics as $topic){
            $notes = $notes->merge($topic->notes()->get());
        }
         return view('notes.index',['notes'=>$notes, 'topics'=>$topics, 'module'=>$module]);
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
    public function store(StoreNoteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoteRequest $request, Note $note)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        //
    }
}
