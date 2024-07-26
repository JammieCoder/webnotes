<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>WebNotes</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite('resources/css/app.css')
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    <body class="font-sans antialiased bg-gray-200">
        <header class="">
            <nav class="flex flex-col">
                <div class="flex justify-end text-xs bg-orange-300">
                    <a
                        href="{{ url('/dashboard') }}"
                        class="rounded-md px-3 pb-1 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                        >
                        Dashboard
                    </a>
                        <form method="POST" action="/">
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="rounded-md px-3 pb-1 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                                >
                                Logout
                            </button>
                        </form>
                </div>
                <div class="flex flex-auto h-14 relative bg-gray-300 divide-x divide-gray-400
                    place-content-center" x-data="{ add: false, edit: false }">
                    @foreach(Auth::user()->modules as $module)
                        <div class="relative flex">
                            <a
                                href="{{ url('/modules/'.$module->id) }}"
                                class="flex text-base items-center text-center px-3 pb-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                                >
                                {{$module->title}}
                            </a>
                            <button
                                type="button"
                                x-show="edit"
                                @click="document.getElementById('dialog{{$module->id}}').showModal()"
                                class="rounded-3xl leading-6 bg-red-500
                                absolute top-0 right-0 text-2xl">
                                x
                            </button>
                            <dialog id="dialog{{$module->id}}">
                                <form method="POST" action="/modules/{{$module->id}}" class="p-5 border-red-500 border-2">
                                    @csrf
                                    @method('DELETE')
                                    <p>Are you sure you want to delete this module:</p>
                                    <p class="text-center"><strong>{{$module->title}}</strong></p>
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
                        </div>
                    @endforeach
                    <button
                        type="button"
                        @click="add=true"
                        x-show="!add"
                        class="flex text-base items-center text-center px-3 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                        >
                        Add<strong class="text-5xl mb-3">+</strong> Module
                    </button>
                    <form x-show="add" method="post" action="/modules" class="flex flex-row">
                        @csrf
                        <label for="name">Module Title:</label>
                        <input id="title" name="title" />
                        @if($errors->any())
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li class="text-red-500 text-xs">{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <button type="submit" class="bg-green-400 w-fit px-2 mx-auto">Create</button>
                    </form>
                    <button
                        type="button"
                        @click="edit=!edit"
                        class="flex absolute right-0 h-14
                        text-base items-center border-2 bg-red-400 text-center px-3 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                        x-bind:class="edit?'text-black/60 border-6 bg-opacity-60':''"
                        >
                        Edit Modules
                    </button>
                </div>
            </nav>
        </header>

        <main class="">
            {{$slot}}
        </main>

        <footer class="py-16 text-center text-sm text-black dark:text-white/70">
        </footer>

    </body>
</html>
