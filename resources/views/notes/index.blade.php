<x-layout>
    <div class="grid grid-cols-8 grid-rows-1">
        <form action="/notes?module={{$module}}" method="GET">
            @csrf
            <div class="flex flex-col divide-y-2 divide-gray-400 border-2
                border-gray-600 mt-10" x-data='{ checked: @json($filters) }'>
                @foreach($topics as $topic)
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
            @foreach($notes as $note)
                <section class="">
                    <h2 class="text-center">{{$note->filename}}</h2>
                    <p>{!!$note->content()!!}</p>
                </section>
            @endforeach
        </div>
    </div>
</x-layout>
