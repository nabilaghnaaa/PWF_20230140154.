<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{ __("You're logged in!") }}

                    {{-- TAMBAHAN ROLE --}}
                    <div class="mt-4">
                    {{-- Menampilkan role user yang sedang login--}}
                        <span class="text-sm text-gray-500">Login sebagai:</span>

                        {{-- CEK ROLE ADMIN Jika user role = admin--}}
                        @if(Auth::user()->role === 'admin')
                            <span class="ml-2 px-2 py-1 text-xs font-bold rounded bg-red-100 text-red-700">
                                ADMIN
                            </span>

                        {{-- ROLE USER Jika bukan admin maka dianggap user biasa--}}
                        @else
                            <span class="ml-2 px-2 py-1 text-xs font-bold rounded bg-blue-100 text-blue-700">
                                USER
                            </span>
                        @endif
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>