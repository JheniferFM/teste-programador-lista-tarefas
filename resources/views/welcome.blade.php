<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                    @endif
                @endauth
            </div>
        @endif

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                <h1 class="text-4xl font-bold">Welcome to Laravel</h1>
            </div>

            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                        <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M13 16h-1v-4h-1m0-4h.01M12 8v4m0 4v.01M21 12A9 9 0 113 12a9 9 0 0118 0z"/>
                        </svg>

                        <div class="ml-4 text-lg leading-7 font-semibold">
                            <a href="https://laravel.com/docs" class="underline text-gray-900 dark:text-white">Laravel
                                Documentation</a>
                        </div>
                    </div>

                    <div class="ml-12">
                        <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                            Laravel has wonderful documentation covering every aspect of the framework.
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-center text-gray-500 dark:text-gray-400 text-sm">
                Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
            </div>
        </div>
    </div>
</body>

</html>
