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
                <div class="flex flex-auto bg-gray-300 divide-x divide-gray-400
                    place-content-center">
                    @foreach(Auth::user()->modules as $module)
                        <a
                            href="{{ url('/modules/'.$module->id) }}"
                            class="flex text-base items-center text-center px-3 pb-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                            >
                            {{$module->title}}
                        </a>
                    @endforeach
                    <a
                        href="{{ url('/modules/create') }}"
                        class="flex text-base items-center text-center px-3 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                        >
                        Add<strong class="text-5xl mb-3">+</strong> Module
                    </a>
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
