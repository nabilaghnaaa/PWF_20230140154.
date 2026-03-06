<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Instrument Sans', 'ui-sans-serif', 'system-ui'],
                        },
                    }
                }
            }
        </script>
    </head>
    <body class="bg-white text-black flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col font-sans">
        
        <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6">
            @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-6">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-5 py-1.5 border border-gray-300 hover:border-black rounded-sm transition-all font-medium">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-black transition-colors font-medium">
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-5 py-1.5 border border-gray-300 hover:border-black rounded-sm transition-all font-medium">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <div class="flex items-center justify-center w-full lg:grow">
            <main class="w-full max-w-[335px] lg:max-w-2xl">
                <div class="p-12 lg:p-16 bg-white border border-gray-200 rounded-xl shadow-[0_10px_40px_-15px_rgba(0,0,0,0.1)] transition-all hover:shadow-2xl">
                    
                    <div class="mb-8">
                        <h1 class="text-2xl font-semibold text-black mb-1">Regina Rana Nabila</h1>
                        <p class="text-gray-500 text-base font-medium">20230140154</p>
                    </div>

                    <ul class="flex">
                        <li>
                            <a href="https://cloud.laravel.com" target="_blank" 
                               class="inline-block px-8 py-3 bg-black hover:bg-gray-800 text-white font-bold rounded-lg transition-all text-sm shadow-md">
                                Modul Pertemuan 1
                            </a>
                        </li>
                    </ul>
                </div>
            </main>
        </div>

        @if (Route::has('login'))
            <div class="h-20 hidden lg:block"></div>
        @endif
    </body>
</html>