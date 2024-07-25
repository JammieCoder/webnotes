<x-layout>
    <div class="grid grid-cols-8 grid-rows-1">
        <div class="flex flex-col divide-y-2 divide-gray-400 border-2
            border-gray-600 mt-10 col-span-1" x-data='{ checked: @json($filters) }' >
            <div x-data="{ add:false, edit: false  }" class="flex flex-col divide-y-2 divide-gray-400" >
                <button
                    type="button"
                    @click="add=true"
                    x-show="!add"
                    class="flex bg-green-400 items-center text-center text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                    >
                    Add<strong class="">+</strong> Topic
                </button>
                <div x-show="add" class="flex flex-col">
                    <form method="post" action="/topics" class="flex flex-col">
                        @csrf
                        <label for="name">Topic Name:</label>
                        <input id="name" name="name" />
                        <input name="module_id" value="{{$module->id}}" class="hidden" />
                        @if($errors->any())
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li class="text-red-500 text-xs">{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <button type="submit" class="bg-green-400 w-fit px-2 mx-auto">Create</button>
                    </form>
                </div>
                <button
                    type="button"
                    @click="edit=!edit"
                    class="flex items-center bg-red-400 text-center text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                    x-bind:class="edit?'text-black/60 border-6 bg-opacity-60':''"
                    >
                    Edit
                </button>
                    @foreach($module->topics as $topic)
                        <div class="relative flex flex-row">
                            <input name="t{{$topic->id}}" form="filters-form" id="t{{$topic->id}}" type="checkbox" x-model="checked['t{{$topic->id}}']" class="hidden"/>
                            <label class="flex-auto" for="t{{$topic->id}}" x-bind:class="checked['t{{$topic->id}}']?'bg-orange-300':'hover:text-orange-500'"> {{$topic->name}}</label>
                            <button
                                type="button"
                                x-show="edit"
                                @click="document.getElementById('dialog{{$topic->id}}').showModal()"
                                class="bg-red-500 text-2xl leading-6 px-1 flex-none">
                                x
                            </button>
                        </div>
                        <dialog id="dialog{{$topic->id}}">
                            <form method="POST" action="/topics/{{$topic->id}}" class="p-5 border-red-500 border-2">
                                @csrf
                                @method('DELETE')
                                <p>Are you sure you want to delete this topic:</p>
                                <p class="text-center"><strong>{{$topic->name}}</strong></p>
                                <div class="justify-between flex">
                                    <button class="flex
                                        rounded-md px-3 pb-1 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                                        formmethod="dialog">Cancel</button>
                                    <button class="flex
                                        rounded-md px-3 pb-1 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                                        >Confirm</button>
                                </div>
                            </form>
                        </dialog>
                    @endforeach
            </div>
            <hr>
            <form action="/modules/{{$module->id}}" method="GET" id="filters-form" class="relative flex flex-col divide-y-2 divide-gray-400" >
                @csrf
                @for($i=0;$i<=12;$i++)
                    <input name="w{{$i}}" id="w{{$i}}" type="checkbox" x-model="checked['w{{$i}}']" class="hidden"/>
                    <label for="w{{$i}}" x-bind:class="checked['w{{$i}}']?'bg-orange-300':'hover:text-orange-500'"> Week {{$i}}</label>
                @endfor
                <input type="submit" class="bg-green-300 text-center
                border-green-500 hover:bg-green-500 hover:text-white" value=Apply />
            </form>
        </div>
        <div class="col-span-7">
            @if(count($selected_topics) == 0 && count($selected_weeks) > 0 )
                @foreach($weeks_arr as $week)
                    @if($notes->where('week',$week)->count() > 0)
                        <h2 class="text-center text-3xl underline font-bold"/>Week {{$week}}</h2>
                        @foreach($topics as $topic)
                            @if($notes->where('pivot.topic_id',$topic->id)->where('week',$week)->count() > 0)
                                <div class="flex items-center">
                                    <div class="grow border-b border-gray-500"></div>
                                    <h3 class="text-center text-lg"/>{{$topic->name}}</h3>
                                    <div class="grow border-b border-gray-500"></div>
                                </div>
                                @foreach($notes->where('pivot.topic_id',$topic->id)->where('week',$week) as $note)
                                    <h4 class="text-base">{{$note->filename}}</h4>
                                    <section class="border-gray-300 border-2">
                                        {!!$note->content()!!}
                                    </section>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                @endforeach

            @else
                @foreach($topics as $topic)
                    @if($notes->where('pivot.topic_id',$topic->id)->count() > 0)
                        <h2 class="text-center text-3xl underline font-bold"/>{{$topic->name}}</h2>
                        @foreach($weeks_arr as $week)
                            @if($notes->where('pivot.topic_id',$topic->id)->where('week',$week)->count() > 0)
                                <div class="flex items-center">
                                    <div class="grow border-b border-gray-500"></div>
                                    <h3 class="text-center text-lg"/>Week {{$week}}</h3>
                                    <div class="grow border-b border-gray-500"></div>
                                </div>
                                @foreach($notes->where('pivot.topic_id',$topic->id)->where('week',$week) as $note)
                                    <h4 class="text-base">{{$note->filename}}</h4>
                                    <section class="border-gray-300 border-2">
                                        {!!$note->content()!!}
                                    </section>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                @endforeach

            @endif
            @if($notes->count() == 0)
                <h2 class="text-5xl text-center align-middle">No Notes Found</h2>
            @endif
        </div>
    </div>
</x-layout>
