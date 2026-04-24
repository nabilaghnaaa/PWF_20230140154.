<x-app-layout> {{-- Menggunakan layout app-layout component --}}
    <x-slot name="header"> {{-- Slot untuk header section --}}
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"> {{-- Header title styling --}}
            {{ __('Dashboard') }} {{-- Display dashboard title dengan translation helper --}}
        </h2>
    </x-slot>

    <div class="py-12"> {{-- Main content container dengan padding --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> {{-- Max-width container dengan responsive padding --}}

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"> {{-- Card container dengan shadow dan rounded corners --}}
                <div class="p-6 text-gray-900 dark:text-gray-100"> {{-- Card content dengan padding --}}

                    {{ __("You're logged in!") }} {{-- Display welcome message dengan translation helper --}}

                    {{-- TAMBAHAN ROLE --}}
                    <div class="mt-4"> {{-- Role section container dengan top margin --}}
                    {{-- Menampilkan role user yang sedang login--}}
                        <span class="text-sm text-gray-500">Login sebagai:</span> {{-- Role label text --}}

                        {{-- CEK ROLE ADMIN Jika user role = admin--}}
                        @if(Auth::user()->role === 'admin') {{-- Blade directive untuk cek apakah user adalah admin --}}
                            <span class="ml-2 px-2 py-1 text-xs font-bold rounded bg-red-100 text-red-700"> {{-- Admin badge styling --}}
                                ADMIN {{-- Display ADMIN text jika user adalah admin --}}
                            </span>

                        {{-- ROLE USER Jika bukan admin maka dianggap user biasa--}}
                        @else {{-- Else clause untuk user biasa --}}
                            <span class="ml-2 px-2 py-1 text-xs font-bold rounded bg-blue-100 text-blue-700"> {{-- User badge styling --}}
                                USER {{-- Display USER text jika bukan admin --}}
                            </span>
                        @endif {{-- Tutup if block --}}
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout> {{-- Tutup app-layout component --}}