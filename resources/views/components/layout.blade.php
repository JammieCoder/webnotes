<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite('resources/css/app.css')
    </head>
    <body class="font-sans antialiased bg-gray-200">
        <header class="">
            <nav class="flex flex-col">
                @if (Route::has('login'))
                    <div class="flex justify-end text-xs bg-orange-300">
                        @auth
                            <a
                                href="{{ url('/dashboard') }}"
                                class="rounded-md px-3 pb-1 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                                >
                                Dashboard
                            </a>
                        @else
                            <a
                                href="{{ route('login') }}"
                                class="rounded-md px-3 pb-1 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                                >
                                Log in
                            </a>

                                @if (Route::has('register'))
                                    <a
                                        href="{{ route('register') }}"
                                        class="rounded-md px-3 pb-1 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                                        >
                                        Register
                                    </a>
                                @endif
                            @endauth
                    </div>
                @endif
                <div class="flex flex-auto bg-gray-300 divide-x divide-gray-400">
                    @foreach(\App\Models\Module::all() as $module)
                        <a
                            href="{{ url('/modules/'.$module->id) }}"
                            class="text-base text-center px-3 pb-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                            >
                            {{$module->title}}
                        </a>
                    @endforeach
                </div>
            </nav>
        </header>

        <main class="mt-6">
            {{$slot}}
        </main>

        <footer class="py-16 text-center text-sm text-black dark:text-white/70">
        </footer>

    </body>
</html>
