@props(['note'])
<div class="flex justify-between">
    <h4 class="text-base">{{ltrim(strrchr($note->filename,"/"),"/")}}</h4>
    <div>
        <button
            type="button"
            onclick="document.getElementById('edit-n{{$note->id}}-dialog').showModal()"
            class="rounded-t-md bg-amber-400 px-3 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
            Edit Note
        </button>
        <button
            type="button"
            onclick="document.getElementById('delete-n{{$note->id}}-dialog').showModal()"
            class="rounded-t-md bg-red-400 px-3 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
            Delete Note
        </button>
    </div>
</div>
<dialog id='delete-n{{$note->id}}-dialog' class="p-5 border-red-500 border-2">
    {{Aire::open()->route('notes.destroy', $note)}}
    <p>Are you sure you want to delete this note:</p>
    <p class="text-center"><strong>{{ltrim(strrchr($note->filename,"/"),"/")}}</strong></p>
    <p class="my-2">(Your notes will be moved to your '/Archive' folder)</p>
    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li class="text-red-500 text-xs">{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <div class="justify-between flex">
        <button  type="button" class="flex items-center
            rounded-md px-3 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
            onclick="document.getElementById('delete-n{{$note->id}}-dialog').close()">Cancel</button>
        {{Aire::submit()->variant()->red()}}
    </div>
    {{Aire::close()}}
</dialog>
<dialog id='edit-n{{$note->id}}-dialog' class="p-5 border-red-500 border-2">
    {{Aire::open()->resourceful($note)}}
    {{Aire::input('filename', 'Enter the filename')->value(ltrim(strrchr($note->filename,"/"),"/"))}}
    {{Aire::number('week', 'Enter which week')->value(0)->min(0)->max(12)}}
    {{Aire::select($note->module->topics->mapWithKeys(fn($topic)=>[$topic->id=>$topic->name])->toArray(), 'topics', "Choose the topics it's associated with")
    ->multiple()}}
    <div class="hidden">
        {{Aire::number('module_id', 'Module id')->value($note->module->id)}}
    </div>
    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li class="text-red-500 text-xs">{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <div class="justify-between flex">
        <button  type="button" class="flex items-center
            rounded-md px-3 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
            onclick="document.getElementById('edit-n{{$note->id}}-dialog').close()">Cancel</button>
        {{Aire::submit()->variant()->orange()}}
    </div>
    {{Aire::close()}}
</dialog>
<section class="prose max-w-full w-full border-gray-300 border-2">
    {!! eval('?>'.Blade::compileString($note->content())) !!}
</section>
