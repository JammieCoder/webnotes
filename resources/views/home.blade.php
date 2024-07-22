<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>WebNotes - Home</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        @keyframes typewriter {
            from { width: 0; }
            to { width: 10ch; } /* Adjusted width to match text length */
        }

        @keyframes blink {
            50% { border-color: transparent; }
        }

        .typewriter h1 {
            overflow: hidden;
            border-right: .15em solid orange;
            white-space: nowrap;
            letter-spacing: .15em;
            animation:
                typewriter 2s steps(8, end) forwards,
                blink-caret .75s step-end infinite;
        }

        .typewriter h1.finished {
            border-right: none; /* Remove the cursor after typing */
        }

        .bounce {
            display: inline-block;
            animation: bounce 1s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-6px); }
        }

        .fade-in-up {
            animation: fadeInUp 1s ease-out;
        }
    </style>
</head>
<body class="bg-gray-200 h-screen flex items-center justify-center">
    <div class="w-fit h-fit p-8 bg-orange-300 rounded-lg shadow-lg text-center fade-in-up">
        <div class="typewriter h-max">
            <h1 class="text-4xl font-bold text-gray-800 mx-auto mb-2 content-center" id="title">WebNotes</h1>
        </div>
        <p class="text-gray-600 mb-8">Organize your notes seamlessly with WebNotes.</p>
        <a href="{{ url('/auth/redirect') }}"
           class="inline-block px-6 py-3 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 transition duration-300 ease-in-out transform hover:scale-105">
            Login with Google
        </a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const title = document.getElementById('title');
            title.addEventListener('animationend', () => {
                title.classList.add('finished');
                title.innerHTML = title.textContent.split('').map(char => `<span class="bounce">${char}</span>`).join('');
            });
        });
    </script>
</body>
</html>

