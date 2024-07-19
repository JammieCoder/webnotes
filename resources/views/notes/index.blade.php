<x-layout>
    <div class="grid grid-cols-8 grid-rows-1">
        <div class="flex flex-col divide-y-2 divide-gray-400 border-2 border-gray-600 mt-10">
            @foreach($topics as $topic)
                <a>{{$topic->name}}</a>
            @endforeach
            <hr>
            @for($i=0;$i<=12;$i++)
                <a>Week {{$i}}</a>
            @endfor
        </div>
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
