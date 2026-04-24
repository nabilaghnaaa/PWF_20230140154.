<x-app-layout> {{-- Menggunakan layout app-layout component --}}
    <div class="relative min-h-screen bg-[#020617] py-12 px-4 sm:px-6 lg:px-8 overflow-hidden"> {{-- Main container dengan background dan padding --}}
        {{-- DECORATIVE BACKGROUND GLOW --}}
        <div class="absolute top-[-10%] right-[-10%] w-[50%] h-[50%] rounded-full bg-fuchsia-600/10 blur-[120px] pointer-events-none"></div> {{-- Decorative glow effect di atas kanan --}}
        <div class="absolute bottom-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-indigo-600/10 blur-[120px] pointer-events-none"></div> {{-- Decorative glow effect di bawah kiri --}}

        <div class="relative max-w-6xl mx-auto z-10"> {{-- Container utama dengan max width dan centered --}}
            
            {{-- HEADER SECTION --}}
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12"> {{-- Header section dengan title dan add button --}}
                <div> {{-- Title container --}}
                    <div class="flex items-center gap-3 mb-2"> {{-- Title prefix dengan accent line --}}
                        <div class="h-1 w-12 bg-fuchsia-500 rounded-full"></div> {{-- Accent line --}}
                        <span class="text-[10px] font-black uppercase tracking-[0.4em] text-fuchsia-500/80">Inventory System v2.4</span> {{-- Version label --}}
                    </div>
                    <h1 class="text-5xl font-black text-white tracking-tighter italic">
                        DATA <span class="text-transparent bg-clip-text bg-gradient-to-r from-fuchsia-400 to-rose-400">CATEGORY</span> {{-- Main title dengan gradient --}}
                    </h1>
                </div>

                <a href="{{ route('category.create') }}" {{-- Button untuk navigate ke category.create route --}}
                    class="group relative inline-flex items-center gap-3 px-8 py-4 bg-white text-black font-black text-xs uppercase tracking-widest rounded-2xl hover:bg-fuchsia-500 hover:text-white transition-all duration-300 shadow-[0_0_30px_rgba(255,255,255,0.1)] hover:shadow-fuchsia-500/40 overflow-hidden">
                    <span class="relative z-10">Add New Category</span> {{-- Button text --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 relative z-10 group-hover:rotate-90 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" /> {{-- Plus icon --}}
                    </svg>
                </a>
            </div>

            {{-- NOTIFICATION SUCCESS --}}
            @if(session('success')) {{-- Blade directive untuk menampilkan success message jika ada --}}
                <div class="mb-8 flex items-center gap-4 p-5 bg-emerald-500/10 border border-emerald-500/20 rounded-2xl animate-fade-in-down"> {{-- Success notification container --}}
                    <div class="p-2 bg-emerald-500/20 rounded-lg"> {{-- Icon container --}}
                        <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /> {{-- Checkmark icon --}}
                        </svg>
                    </div>
                    <p class="text-emerald-400 text-sm font-bold tracking-wide">{{ session('success') }}</p> {{-- Display success message --}}
                </div>
            @endif {{-- Tutup if block --}}

            {{-- TABLE CONTAINER --}}
            <div class="bg-white/[0.02] backdrop-blur-2xl border border-white/[0.05] rounded-[2.5rem] overflow-hidden shadow-2xl"> {{-- Table card container --}}
                <div class="overflow-x-auto"> {{-- Scrollable container untuk table --}}
                    <table class="w-full"> {{-- Main table --}}
                        <thead> {{-- Table header --}}
                            <tr class="border-b border-white/[0.05]"> {{-- Header row --}}
                                <th class="px-8 py-6 text-left text-[10px] font-black uppercase tracking-[0.3em] text-slate-500">No.</th> {{-- Column header: No --}}
                                <th class="px-8 py-6 text-left text-[10px] font-black uppercase tracking-[0.3em] text-slate-500">Classification Name</th> {{-- Column header: Name --}}
                                <th class="px-8 py-6 text-left text-[10px] font-black uppercase tracking-[0.3em] text-slate-500">Asset Count</th> {{-- Column header: Count --}}
                                <th class="px-8 py-6 text-center text-[10px] font-black uppercase tracking-[0.3em] text-slate-500">Protocol</th> {{-- Column header: Actions --}}
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/[0.03]"> {{-- Table body --}}
                            @forelse($categories as $index => $c) {{-- Blade loop untuk iterate categories dengan fallback jika kosong --}}
                                <tr class="group hover:bg-fuchsia-500/[0.02] transition-colors"> {{-- Table row dengan hover effect --}}
                                    {{-- NUMBER --}}
                                    <td class="px-8 py-6"> {{-- Number column --}}
                                        <span class="text-xs font-mono text-slate-600">#{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span> {{-- Display index dengan padding 0 --}}
                                    </td>

                                    {{-- NAME --}}
                                    <td class="px-8 py-6"> {{-- Name column --}}
                                        <div class="flex items-center gap-4"> {{-- Name display container --}}
                                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-fuchsia-500/20 to-rose-500/20 flex items-center justify-center border border-fuchsia-500/20 text-fuchsia-400 font-bold">
                                                {{ substr($c->name, 0, 1) }} {{-- Display first letter dari category name --}}
                                            </div>
                                            <span class="text-sm font-bold text-slate-200 group-hover:text-fuchsia-400 transition-colors uppercase tracking-wider">
                                                {{ $c->name }} {{-- Display category name --}}
                                            </span>
                                        </div>
                                    </td>

                                    {{-- COUNT --}}
                                    <td class="px-8 py-6"> {{-- Count column --}}
                                        <div class="flex items-center gap-2"> {{-- Count display container --}}
                                            <span class="text-lg font-black text-white tracking-tighter">{{ $c->products_count }}</span> {{-- Display jumlah products --}}
                                            <span class="text-[9px] font-black uppercase tracking-widest text-slate-500">Units</span> {{-- Units label --}}
                                        </div>
                                        <div class="w-24 h-1 bg-white/[0.05] rounded-full mt-2 overflow-hidden"> {{-- Progress bar container --}}
                                            <div class="h-full bg-fuchsia-500" style="width: {{ min(($c->products_count / 50) * 100, 100) }}%"></div> {{-- Progress bar fill based on count --}}
                                        </div>
                                    </td>

                                    {{-- ACTIONS --}}
                                    <td class="px-8 py-6 text-center"> {{-- Actions column --}}
                                        <div class="flex justify-center items-center gap-3"> {{-- Actions container --}}
                                            <a href="{{ route('category.edit', $c->id) }}" {{-- Edit button yang navigate ke category.edit --}}
                                                class="p-3 rounded-xl bg-white/[0.03] border border-white/[0.05] text-slate-400 hover:text-fuchsia-400 hover:bg-fuchsia-400/10 transition-all shadow-lg">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /> {{-- Edit icon --}}
                                                </svg>
                                            </a>

                                            <form action="{{ route('category.destroy', $c->id) }}" method="POST" {{-- Delete form yang submit ke category.destroy route --}}
                                                onsubmit="return confirm('Initiate deletion protocol for this category?')"> {{-- Confirmation dialog sebelum delete --}}
                                                @csrf {{-- CSRF token untuk security --}}
                                                @method('DELETE') {{-- Spoof DELETE method --}}
                                                <button type="submit" {{-- Delete button --}}
                                                    class="p-3 rounded-xl bg-white/[0.03] border border-white/[0.05] text-slate-400 hover:text-rose-500 hover:bg-rose-500/10 transition-all shadow-lg">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /> {{-- Delete icon --}}
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty {{-- Fallback jika categories kosong --}}
                                <tr> {{-- Empty state row --}}
                                    <td colspan="4" class="px-8 py-20 text-center"> {{-- Span semua column --}}
                                        <div class="flex flex-col items-center gap-4"> {{-- Empty state container --}}
                                            <div class="p-6 rounded-full bg-white/[0.02] border border-white/[0.05]"> {{-- Icon container --}}
                                                <svg class="w-12 h-12 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" /> {{-- Empty database icon --}}
                                                </svg>
                                            </div>
                                            <p class="text-xs font-black uppercase tracking-[0.5em] text-slate-600">Database is empty</p> {{-- Empty state message --}}
                                        </div>
                                    </td>
                                </tr>
                            @endforelse {{-- Tutup forelse block --}}
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- FOOTER DECORATION --}}
            <div class="mt-12 flex justify-between items-center px-4"> {{-- Footer section --}}
                <div class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-700">
                    Showing {{ count($categories) }} Active Clusters {{-- Display jumlah categories --}}
                </div>
                <div class="flex gap-2"> {{-- Decorative dots --}}
                    <div class="w-2 h-2 rounded-full bg-fuchsia-500/20"></div> {{-- Dot 1 --}}
                    <div class="w-2 h-2 rounded-full bg-fuchsia-500/40"></div> {{-- Dot 2 --}}
                    <div class="w-2 h-2 rounded-full bg-fuchsia-500/60"></div> {{-- Dot 3 --}}
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes fade-in-down {
            0% { opacity: 0; transform: translateY(-10px); } {{-- Start state untuk animation --}}
            100% { opacity: 1; transform: translateY(0); } {{-- End state untuk animation --}}
        }
        .animate-fade-in-down {
            animation: fade-in-down 0.5s ease-out; {{-- Apply animation ke element --}}
        }
    </style>
</x-app-layout> {{-- Tutup app-layout component --}}