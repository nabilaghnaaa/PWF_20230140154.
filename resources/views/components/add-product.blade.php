@props([ {{-- Blade props directive untuk menerima parameter dari component --}}
    'url', {{-- Parameter url - untuk href link button --}}
    'name' {{-- Parameter name - untuk teks button --}}
]) {{-- Tutup props --}}

<a href="{{ $url }}" {{-- Link button dengan dynamic URL dari prop --}}
    class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition duration-150 shadow-sm"> {{-- Button styling dengan Tailwind --}}
    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"> {{-- SVG icon container --}}
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /> {{-- Plus icon untuk "add" --}}
    </svg>
    Add {{ $name }} {{-- Display "Add [name]" text dengan parameter --}}
</a> {{-- Tutup link tag --}}