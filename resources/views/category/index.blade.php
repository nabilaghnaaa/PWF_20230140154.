<x-app-layout>
    <div class="relative min-h-screen bg-[#020617] py-12 px-4 sm:px-6 lg:px-8 overflow-hidden">
        {{-- DECORATIVE BACKGROUND GLOW --}}
        <div class="absolute top-[-10%] right-[-10%] w-[50%] h-[50%] rounded-full bg-fuchsia-600/10 blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-indigo-600/10 blur-[120px] pointer-events-none"></div>

        <div class="relative max-w-6xl mx-auto z-10">
            
            {{-- HEADER SECTION --}}
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <div class="h-1 w-12 bg-fuchsia-500 rounded-full"></div>
                        <span class="text-[10px] font-black uppercase tracking-[0.4em] text-fuchsia-500/80">Inventory System v2.4</span>
                    </div>
                    <h1 class="text-5xl font-black text-white tracking-tighter italic">
                        DATA <span class="text-transparent bg-clip-text bg-gradient-to-r from-fuchsia-400 to-rose-400">CATEGORY</span>
                    </h1>
                </div>

                <a href="{{ route('category.create') }}"
                    class="group relative inline-flex items-center gap-3 px-8 py-4 bg-white text-black font-black text-xs uppercase tracking-widest rounded-2xl hover:bg-fuchsia-500 hover:text-white transition-all duration-300 shadow-[0_0_30px_rgba(255,255,255,0.1)] hover:shadow-fuchsia-500/40 overflow-hidden">
                    <span class="relative z-10">Add New Category</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 relative z-10 group-hover:rotate-90 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
                    </svg>
                </a>
            </div>

            {{-- NOTIFICATION SUCCESS --}}
            @if(session('success'))
                <div class="mb-8 flex items-center gap-4 p-5 bg-emerald-500/10 border border-emerald-500/20 rounded-2xl animate-fade-in-down">
                    <div class="p-2 bg-emerald-500/20 rounded-lg">
                        <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <p class="text-emerald-400 text-sm font-bold tracking-wide">{{ session('success') }}</p>
                </div>
            @endif

            {{-- TABLE CONTAINER --}}
            <div class="bg-white/[0.02] backdrop-blur-2xl border border-white/[0.05] rounded-[2.5rem] overflow-hidden shadow-2xl">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-white/[0.05]">
                                <th class="px-8 py-6 text-left text-[10px] font-black uppercase tracking-[0.3em] text-slate-500">No.</th>
                                <th class="px-8 py-6 text-left text-[10px] font-black uppercase tracking-[0.3em] text-slate-500">Classification Name</th>
                                <th class="px-8 py-6 text-left text-[10px] font-black uppercase tracking-[0.3em] text-slate-500">Asset Count</th>
                                <th class="px-8 py-6 text-center text-[10px] font-black uppercase tracking-[0.3em] text-slate-500">Protocol</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/[0.03]">
                            @forelse($categories as $index => $c)
                                <tr class="group hover:bg-fuchsia-500/[0.02] transition-colors">
                                    {{-- NUMBER --}}
                                    <td class="px-8 py-6">
                                        <span class="text-xs font-mono text-slate-600">#{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                    </td>

                                    {{-- NAME --}}
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-4">
                                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-fuchsia-500/20 to-rose-500/20 flex items-center justify-center border border-fuchsia-500/20 text-fuchsia-400 font-bold">
                                                {{ substr($c->name, 0, 1) }}
                                            </div>
                                            <span class="text-sm font-bold text-slate-200 group-hover:text-fuchsia-400 transition-colors uppercase tracking-wider">
                                                {{ $c->name }}
                                            </span>
                                        </div>
                                    </td>

                                    {{-- COUNT --}}
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-2">
                                            <span class="text-lg font-black text-white tracking-tighter">{{ $c->products_count }}</span>
                                            <span class="text-[9px] font-black uppercase tracking-widest text-slate-500">Units</span>
                                        </div>
                                        <div class="w-24 h-1 bg-white/[0.05] rounded-full mt-2 overflow-hidden">
                                            <div class="h-full bg-fuchsia-500" style="width: {{ min(($c->products_count / 50) * 100, 100) }}%"></div>
                                        </div>
                                    </td>

                                    {{-- ACTIONS --}}
                                    <td class="px-8 py-6 text-center">
                                        <div class="flex justify-center items-center gap-3">
                                            <a href="{{ route('category.edit', $c->id) }}"
                                                class="p-3 rounded-xl bg-white/[0.03] border border-white/[0.05] text-slate-400 hover:text-fuchsia-400 hover:bg-fuchsia-400/10 transition-all shadow-lg">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>

                                            <form action="{{ route('category.destroy', $c->id) }}" method="POST"
                                                onsubmit="return confirm('Initiate deletion protocol for this category?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="p-3 rounded-xl bg-white/[0.03] border border-white/[0.05] text-slate-400 hover:text-rose-500 hover:bg-rose-500/10 transition-all shadow-lg">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-8 py-20 text-center">
                                        <div class="flex flex-col items-center gap-4">
                                            <div class="p-6 rounded-full bg-white/[0.02] border border-white/[0.05]">
                                                <svg class="w-12 h-12 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                                </svg>
                                            </div>
                                            <p class="text-xs font-black uppercase tracking-[0.5em] text-slate-600">Database is empty</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- FOOTER DECORATION --}}
            <div class="mt-12 flex justify-between items-center px-4">
                <div class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-700">
                    Showing {{ count($categories) }} Active Clusters
                </div>
                <div class="flex gap-2">
                    <div class="w-2 h-2 rounded-full bg-fuchsia-500/20"></div>
                    <div class="w-2 h-2 rounded-full bg-fuchsia-500/40"></div>
                    <div class="w-2 h-2 rounded-full bg-fuchsia-500/60"></div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes fade-in-down {
            0% { opacity: 0; transform: translateY(-10px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-down {
            animation: fade-in-down 0.5s ease-out;
        }
    </style>
</x-app-layout>