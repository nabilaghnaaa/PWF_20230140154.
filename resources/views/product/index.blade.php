<x-app-layout>
    <div class="relative min-h-screen bg-[#020617] py-12 px-4 sm:px-6 lg:px-8 overflow-hidden">
        {{-- BACKGROUND GLOW EFFECT --}}
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-indigo-600/20 blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[30%] h-[30%] rounded-full bg-fuchsia-600/10 blur-[120px] pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto z-10">
            {{-- HEADER SECTION --}}
            <div class="flex flex-col md:flex-row items-center justify-between mb-10 gap-4">
                <div>
                    <h1 class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 tracking-tighter uppercase italic">
                        Product <span class="text-white">Inventory</span>
                    </h1>
                    <p class="text-slate-500 text-[11px] font-bold uppercase tracking-[0.3em] mt-1 ml-1">Asset Control & Resource Management</p>
                </div>
                
                @can('manage-products')
                    <div class="transform hover:scale-105 transition-transform">
                        <x-add-product :url="route('product.create')" :name="'Product'" />
                    </div>
                @endcan
            </div>

            {{-- ALERT MESSAGES --}}
            @if(session('success'))
                <div class="mb-6 p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm backdrop-blur-md animate-fade-in">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span class="font-bold tracking-wide uppercase text-[11px]">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            {{-- NEW: ERROR/UNAUTHORIZED ALERT --}}
            @if(session('error'))
                <div class="mb-6 p-4 rounded-2xl bg-red-500/10 border border-red-500/30 text-red-400 text-sm backdrop-blur-md animate-fade-in relative overflow-hidden group">
                    {{-- Efek cahaya merah di pojok --}}
                    <div class="absolute -top-10 -right-10 w-24 h-24 bg-red-600/20 blur-3xl rounded-full"></div>
                    
                    <div class="flex items-start gap-4 relative z-10">
                        <div class="flex-shrink-0 w-10 h-10 bg-red-500/20 rounded-xl flex items-center justify-center border border-red-500/40 shadow-[0_0_15px_rgba(239,68,68,0.2)]">
                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 15c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <h4 class="text-red-500 font-black text-[10px] uppercase tracking-[0.2em] mb-1">Access Protocol Violation</h4>
                            <p class="text-red-400/80 text-[11px] font-medium leading-relaxed tracking-wide">
                                {{ session('error') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- MAIN TABLE AREA --}}
            <div class="bg-white/[0.02] backdrop-blur-xl border border-white/[0.05] rounded-[2.5rem] overflow-hidden shadow-2xl relative">
                {{-- Decorative Line --}}
                <div class="absolute top-0 left-0 w-full h-[1px] bg-gradient-to-r from-transparent via-indigo-500/50 to-transparent"></div>

                <div class="overflow-x-auto custom-scrollbar">
                    <table class="w-full text-left border-collapse">
                        {{-- TABLE HEADER --}}
                        <thead>
                            <tr class="border-b border-white/[0.05] bg-white/[0.02]">
                                <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-slate-500">No.</th>
                                <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-slate-500">Resource Info</th>
                                <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-slate-500">Category</th>
                                <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-slate-500 text-center">Status</th>
                                <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-slate-500 text-right">Valuation</th>
                                <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-slate-500">Deployer</th>
                                <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-slate-500 text-center">Protocol</th>
                            </tr>
                        </thead>

                        {{-- TABLE BODY --}}
                        <tbody class="divide-y divide-white/[0.03]">
                            @forelse ($products as $product)
                            <tr class="group hover:bg-indigo-500/[0.02] transition-all">
                                {{-- NO --}}
                                <td class="px-8 py-6 text-center">
                                    <span class="text-slate-600 font-mono text-xs group-hover:text-indigo-400 transition-colors">
                                        {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                    </span>
                                </td>

                                {{-- PRODUCT INFO --}}
                                <td class="px-8 py-6">
                                    <div class="flex flex-col">
                                        <span class="text-slate-100 font-bold text-sm tracking-widest uppercase">{{ $product->name }}</span>
                                        <span class="text-slate-500 text-[9px] font-mono mt-1 uppercase">ID: {{ $product->id }}</span>
                                    </div>
                                </td>

                                {{-- CATEGORY (NEW) --}}
                                <td class="px-8 py-6">
                                    @if($product->category)
                                        <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest bg-fuchsia-500/10 text-fuchsia-400 border border-fuchsia-500/20 group-hover:bg-fuchsia-500/20 transition-all shadow-[0_0_15px_rgba(217,70,239,0.1)]">
                                            {{ $product->category->name }}
                                        </span>
                                    @else
                                        <span class="text-slate-700 text-[10px] font-black uppercase tracking-widest italic">Uncategorized</span>
                                    @endif
                                </td>

                                {{-- STOCK STATUS --}}
                                <td class="px-8 py-6 text-center">
                                    <div class="flex flex-col items-center gap-1">
                                        <span class="text-white font-black text-sm">{{ $product->qty }}</span>
                                        @if($product->qty > 10)
                                            <div class="h-1 w-8 rounded-full bg-emerald-500/30">
                                                <div class="h-full w-full bg-emerald-500 rounded-full shadow-[0_0_8px_rgba(16,185,129,0.5)]"></div>
                                            </div>
                                        @else
                                            <div class="h-1 w-8 rounded-full bg-amber-500/30">
                                                <div class="h-full w-[40%] bg-amber-500 rounded-full shadow-[0_0_8px_rgba(245,158,11,0.5)] animate-pulse"></div>
                                            </div>
                                        @endif
                                    </div>
                                </td>

                                {{-- PRICE --}}
                                <td class="px-8 py-6 text-right">
                                    <span class="text-indigo-400 font-mono font-bold text-sm">
                                        {{ number_format($product->price, 0, ',', '.') }}
                                    </span>
                                    <span class="text-[9px] font-black text-slate-600 ml-1 uppercase">IDR</span>
                                </td>

                                {{-- OWNER --}}
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-3 group/user">
                                        <div class="h-7 w-7 rounded-lg bg-white/[0.03] border border-white/[0.1] group-hover/user:border-indigo-500/50 flex items-center justify-center text-indigo-400 text-[10px] font-black transition-all">
                                            {{ strtoupper(substr($product->user->name ?? 'A', 0, 1)) }}
                                        </div>
                                        <span class="text-slate-400 text-[10px] font-bold uppercase tracking-widest">
                                            {{ $product->user->name ?? 'Admin' }}
                                        </span>
                                    </div>
                                </td>

                                {{-- ACTIONS --}}
                                <td class="px-8 py-6">
                                    <div class="flex justify-center items-center gap-2">
                                        {{-- VIEW --}}
                                        <a href="{{ route('product.show', $product->id) }}" 
                                           class="p-2.5 rounded-xl bg-white/[0.03] border border-white/[0.05] text-slate-500 hover:text-indigo-400 hover:bg-indigo-400/10 transition-all group/btn shadow-lg"
                                           title="Detail Access">
                                            <svg class="w-4 h-4 group-hover/btn:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </a>

                                        {{-- EDIT --}}
                                        @can('update', $product)
                                        <a href="{{ route('product.edit', $product) }}" 
                                           class="p-2.5 rounded-xl bg-white/[0.03] border border-white/[0.05] text-slate-500 hover:text-amber-400 hover:bg-amber-400/10 transition-all group/btn shadow-lg"
                                           title="Modify Record">
                                            <svg class="w-4 h-4 group-hover/btn:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </a>
                                        @endcan

                                        {{-- DELETE --}}
                                        @can('delete', $product)
                                        <form action="{{ route('product.delete', $product->id) }}" method="POST" onsubmit="return confirm('Terminate this product record?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" 
                                                    class="p-2.5 rounded-xl bg-white/[0.03] border border-white/[0.05] text-slate-500 hover:text-red-500 hover:bg-red-500/10 transition-all group/btn shadow-lg">
                                                <svg class="w-4 h-4 group-hover/btn:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4m-6 4h8"/></svg>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="py-32 text-center relative">
                                    <div class="flex flex-col items-center">
                                        <div class="relative mb-6">
                                            <div class="absolute inset-0 bg-indigo-500/20 blur-3xl rounded-full"></div>
                                            <div class="relative p-6 rounded-3xl bg-white/[0.02] border border-white/[0.05]">
                                                <svg class="w-16 h-16 text-slate-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0l-8 8-8-8"/></svg>
                                            </div>
                                        </div>
                                        <p class="text-slate-600 font-black uppercase tracking-[0.5em] text-[10px]">No Neural Data Found</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- DECORATIVE FOOTER INFO --}}
            <div class="mt-8 flex justify-between items-center px-6">
                <div class="flex items-center gap-3">
                    <div class="flex gap-1">
                        <div class="w-1.5 h-1.5 rounded-full bg-indigo-500 shadow-[0_0_8px_rgba(99,102,241,0.5)]"></div>
                        <div class="w-1.5 h-1.5 rounded-full bg-slate-800"></div>
                        <div class="w-1.5 h-1.5 rounded-full bg-slate-800"></div>
                    </div>
                    <span class="text-[9px] font-black uppercase tracking-[0.3em] text-slate-600 italic">System Stable // Ready to Serve</span>
                </div>
                <div class="text-[9px] font-black uppercase tracking-widest text-slate-700">
                    Showing {{ count($products) }} Records
                </div>
            </div>
        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; height: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(99, 102, 241, 0.2); border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: rgba(99, 102, 241, 0.5); }
        
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in { animation: fade-in 0.4s ease-out forwards; }
    </style>
</x-app-layout>