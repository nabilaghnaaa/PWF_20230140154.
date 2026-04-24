<x-app-layout>
    <div class="relative min-h-screen bg-[#020617] py-12 px-4 sm:px-6 lg:px-8 overflow-hidden">
        {{-- BACKGROUND GLOW EFFECT --}}
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-indigo-600/20 blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[30%] h-[30%] rounded-full bg-fuchsia-600/10 blur-[120px] pointer-events-none"></div>

        <div class="relative max-w-3xl mx-auto z-10">
            {{-- HEADER --}}
            <div class="flex flex-col sm:flex-row items-center justify-between mb-8 gap-4">
                <div class="flex items-center gap-4">
                    <a href="{{ route('product.index') }}" 
                       class="p-2.5 rounded-xl bg-white/[0.03] border border-white/[0.05] text-slate-400 hover:text-white hover:bg-white/[0.08] transition-all group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                    <div>
                        <h1 class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400 tracking-tighter">
                            Product Details
                        </h1>
                        <p class="text-slate-500 text-xs font-mono mt-0.5 tracking-widest uppercase">Reference: #{{ $product->id }}</p>
                    </div>
                </div>

                {{-- ACTION BUTTONS --}}
                <div class="flex gap-3">
                    <a href="{{ route('product.edit', $product) }}"
                       class="px-5 py-2 rounded-xl bg-white/[0.03] border border-white/[0.05] text-amber-400 text-sm font-bold hover:bg-amber-500/10 hover:border-amber-500/50 transition-all flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Edit
                    </a>

                    <form action="{{ route('product.delete', $product->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                        @csrf @method('DELETE')
                        <button type="submit"
                                class="px-5 py-2 rounded-xl bg-white/[0.03] border border-white/[0.05] text-red-500 text-sm font-bold hover:bg-red-500/10 hover:border-red-500/50 transition-all flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4m-6 4h8"/></svg>
                            Delete
                        </button>
                    </form>
                </div>
            </div>

            {{-- CONTENT CARD --}}
            <div class="bg-white/[0.02] backdrop-blur-xl border border-white/[0.05] rounded-3xl overflow-hidden shadow-2xl">
                <div class="divide-y divide-white/[0.03]">
                    
                    {{-- ITEM: PRODUCT NAME --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 px-8 py-6 hover:bg-white/[0.01] transition-colors">
                        <div class="text-xs font-black uppercase tracking-widest text-slate-500 mb-1 sm:mb-0">Product Name</div>
                        <div class="sm:col-span-2 text-white font-bold text-lg tracking-tight">
                            {{ $product->name }}
                        </div>
                    </div>

                    {{-- ITEM: QUANTITY --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 px-8 py-6 hover:bg-white/[0.01] transition-colors">
                        <div class="text-xs font-black uppercase tracking-widest text-slate-500 mb-2 sm:mb-0">Stock Quantity</div>
                        <div class="sm:col-span-2 flex items-center gap-3">
                            <span class="text-2xl font-black text-white">{{ $product->qty }}</span>
                            <span class="px-3 py-1 rounded-md text-[10px] font-black uppercase tracking-wider border {{ $product->qty > 10 ? 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20' : 'bg-red-500/10 text-red-500 border-red-500/20' }}">
                                {{ $product->qty > 10 ? 'In Stock' : 'Critical Stock' }}
                            </span>
                        </div>
                    </div>

                    {{-- ITEM: PRICE --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 px-8 py-6 hover:bg-white/[0.01] transition-colors">
                        <div class="text-xs font-black uppercase tracking-widest text-slate-500 mb-1 sm:mb-0">Price Value</div>
                        <div class="sm:col-span-2 text-indigo-400 font-black text-xl">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </div>
                    </div>

                    {{-- ITEM: OWNER --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 px-8 py-6 hover:bg-white/[0.01] transition-colors">
                        <div class="text-xs font-black uppercase tracking-widest text-slate-500 mb-2 sm:mb-0">Product Owner</div>
                        <div class="sm:col-span-2 flex items-center gap-3">
                            <div class="h-9 w-9 rounded-xl bg-gradient-to-br from-indigo-600 to-violet-600 flex items-center justify-center text-white text-sm font-black shadow-lg shadow-indigo-500/20">
                                {{ strtoupper(substr($product->user->name ?? '?', 0, 1)) }}
                            </div>
                            <span class="text-slate-200 font-bold tracking-tight">
                                {{ $product->user->name ?? 'System Admin' }}
                            </span>
                        </div>
                    </div>

                    {{-- ITEM: TIMESTAMPS --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 px-8 py-6 hover:bg-white/[0.01] transition-colors">
                        <div class="text-xs font-black uppercase tracking-widest text-slate-500 mb-2 sm:mb-0">History Log</div>
                        <div class="sm:col-span-2 space-y-2">
                            <div class="flex items-center gap-2 text-xs">
                                <span class="text-slate-600 w-16">Created:</span>
                                <span class="text-slate-400 font-mono">{{ $product->created_at->format('d M Y, H:i') }}</span>
                            </div>
                            <div class="flex items-center gap-2 text-xs">
                                <span class="text-slate-600 w-16">Updated:</span>
                                <span class="text-slate-400 font-mono">{{ $product->updated_at->format('d M Y, H:i') }}</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            
            {{-- FOOTER DECORATION --}}
            <div class="mt-8 text-center">
                <p class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-700">Digital Inventory System v2.0</p>
            </div>
        </div>
    </div>
</x-app-layout>