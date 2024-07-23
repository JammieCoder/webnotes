<x-layout >
    <section class="w-1/3 mt-16 relative mx-auto">
        {{Aire::resourceful(new \App\Models\Module())}}
        {{Aire::input("title", "The Module Title")}}
        @if($errors->any())
            <ul>
                @foreach($errors->all() as $error)
                    <li class="text-red-500 text-xs">{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        {{Aire::submit("Create Module")->variant()->orange()}}
        {{Aire::close()}}
    </section>
</x-layout>
