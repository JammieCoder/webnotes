<x-layout>
    <div class="grid grid-cols-8 grid-rows-1">
        <form action="/modules/{{$module->id}}" method="GET">
            @csrf
            <div class="flex flex-col divide-y-2 divide-gray-400 border-2
                border-gray-600 mt-10" x-data='{ checked: @json($filters) }'>
                @foreach($module->topics as $topic)
                    <input name="t{{$topic->id}}" id="t{{$topic->id}}" type="checkbox" x-model="checked['t{{$topic->id}}']" class="hidden"/>
                    <label for="t{{$topic->id}}" x-bind:class="checked['t{{$topic->id}}']?'bg-orange-300':'hover:text-orange-500'"> {{$topic->name}}</label>
                @endforeach
                <hr>
                @for($i=0;$i<=12;$i++)
                    <input name="w{{$i}}" id="w{{$i}}" type="checkbox" x-model="checked['w{{$i}}']" class="hidden"/>
                    <label for="w{{$i}}" x-bind:class="checked['w{{$i}}']?'bg-orange-300':'hover:text-orange-500'"> Week {{$i}}</label>
                @endfor
                <input type="submit" class="bg-green-300 text-center
                border-green-500 hover:bg-green-500 hover:text-white" value=Apply />
            </div>
        </form>
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
