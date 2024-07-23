<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Models\Module;
use App\Models\Note;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //process week and topic filters
        if(is_null($request->filters))
            return redirect()->route('dashboard');
        $filters=array_filter($request->filters,fn($k)=> $k!='_token',
                ARRAY_FILTER_USE_KEY);
        $filters=array_map(fn()=>true, $filters);
        $topics_arr=array_filter($filters,fn($k) => $k[0]=='t',
                ARRAY_FILTER_USE_KEY); //array of topic ids
        $weeks_arr=array_filter($filters,fn($k) => $k[0]=='w',
                ARRAY_FILTER_USE_KEY);
        $topics_arr = array_map(fn($v)=>substr($v,1), array_keys($topics_arr));
        $weeks_arr = array_map(fn($v)=>substr($v,1), array_keys($weeks_arr));


        $module=$request->filters['module'];
        if(is_null($module))
            return redirect()->route('dashboard');
        //Find the relating module record or fail if not found
        $module=Module::findOrFail($module);
        // Check the user owns this module
        Gate::authorize('view', $module);


        // Convert the topic array to Topic objects
        if($topics_arr==[])
            $topics=$module->topics;
        else{
            $topics=new Collection();
            foreach($topics_arr as $topic_id){
                $topics->add(Topic::where('module_id',$module->id)->find($topic_id));
            }
        }

        // Get notes
        $notes = new Collection();
        $weeks=$weeks_arr;
        if($weeks_arr==[])
            $weeks=range(0,12);
        foreach($topics as $topic){
            // For each week (retaining week order)
            foreach($weeks as $week){
                $notes = $notes->merge($topic->notes->where('week',$week));
            }
        }
         return view('notes.index',['notes'=>$notes, 'module'=>$module,
            'filters'=>$filters, 'selected_topics'=>$topics_arr,
                'selected_weeks'=>$weeks_arr, 'topics'=>$topics,
                'weeks_arr'=>$weeks]);
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
