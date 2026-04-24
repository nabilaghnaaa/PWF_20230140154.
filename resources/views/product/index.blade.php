<x-app-layout>
    <div class="relative min-h-screen bg-[#020617] py-12 px-4 sm:px-6 lg:px-8 overflow-hidden">
        {{-- BACKGROUND GLOW EFFECT --}}
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-indigo-600/20 blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[30%] h-[30%] rounded-full bg-fuchsia-600/10 blur-[120px] pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto z-10">
            {{-- HEADER SECTION --}}
            <div class="flex flex-col md:flex-row items-center justify-between mb-10 gap-4">
                <div>
                    <h1 class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 tracking-tighter">
                        Product Inventory
                    </h1>
                    <p class="text-slate-500 text-sm mt-1">Manage and monitor your digital assets</p>
                </div>
                
                @can('manage-products')
                    <div class="transform hover:scale-105 transition-transform">
                        <x-add-product :url="route('product.create')" :name="'Product'" />
                    </div>
                @endcan
            </div>

            {{-- ALERT MESSAGES --}}
            @if(session('success'))
                <div class="mb-6 p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm backdrop-blur-md">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 rounded-2xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm backdrop-blur-md">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            {{-- MAIN TABLE AREA --}}
            <div class="bg-white/[0.02] backdrop-blur-xl border border-white/[0.05] rounded-3xl overflow-hidden shadow-2xl">
                <div class="overflow-x-auto custom-scrollbar">
                    <table class="w-full text-left border-collapse">
                        {{-- TABLE HEADER --}}
                        <thead>
                            <tr class="border-b border-white/[0.05] bg-white/[0.02]">
                                <th class="px-8 py-5 text-xs font-black uppercase tracking-widest text-slate-500">No</th>
                                <th class="px-8 py-5 text-xs font-black uppercase tracking-widest text-slate-500">Product Info</th>
                                <th class="px-8 py-5 text-xs font-black uppercase tracking-widest text-slate-500">Stock Status</th>
                                <th class="px-8 py-5 text-xs font-black uppercase tracking-widest text-slate-500">Price</th>
                                <th class="px-8 py-5 text-xs font-black uppercase tracking-widest text-slate-500">Owner</th>
                                <th class="px-8 py-5 text-xs font-black uppercase tracking-widest text-slate-500 text-center">Actions</th>
                            </tr>
                        </thead>

                        {{-- TABLE BODY --}}
                        <tbody class="divide-y divide-white/[0.03]">
                            @forelse ($products as $product)
                            <tr class="group hover:bg-white/[0.04] transition-all">
                                {{-- NO --}}
                                <td class="px-8 py-6">
                                    <span class="text-slate-600 font-mono text-sm group-hover:text-indigo-400 transition-colors">
                                        {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                    </span>
                                </td>

                                {{-- PRODUCT INFO --}}
                                <td class="px-8 py-6">
                                    <div class="flex flex-col">
                                        <span class="text-white font-bold text-base tracking-tight">{{ $product->name }}</span>
                                        <span class="text-slate-500 text-xs font-mono mt-0.5">UID: {{ $product->id }}</span>
                                    </div>
                                </td>

                                {{-- STOCK --}}
                                <td class="px-8 py-6">
                                    @if($product->qty > 10)
                                        <span class="inline-flex items-center px-3 py-1 rounded-md text-[10px] font-black uppercase tracking-wider bg-emerald-500/10 text-emerald-500 border border-emerald-500/20">
                                            Available
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-md text-[10px] font-black uppercase tracking-wider bg-amber-500/10 text-amber-500 border border-amber-500/20">
                                            Low Stock
                                        </span>
                                    @endif
                                </td>

                                {{-- PRICE --}}
                                <td class="px-8 py-6">
                                    <span class="text-indigo-300 font-bold">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </span>
                                </td>

                                {{-- OWNER --}}
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-3">
                                        <div class="h-8 w-8 rounded-lg bg-gradient-to-br from-indigo-600 to-violet-600 flex items-center justify-center text-white text-xs font-black shadow-lg">
                                            {{ strtoupper(substr($product->user->name ?? 'A', 0, 1)) }}
                                        </div>
                                        <span class="text-slate-300 text-sm font-medium">
                                            {{ $product->user->name ?? 'Admin' }}
                                        </span>
                                    </div>
                                </td>

                                {{-- ACTIONS --}}
                                <td class="px-8 py-6">
                                    <div class="flex justify-center items-center gap-3">
                                        {{-- VIEW --}}
                                        <a href="{{ route('product.show', $product->id) }}" 
                                           class="p-2 rounded-xl bg-white/[0.03] border border-white/[0.05] text-slate-400 hover:text-indigo-400 hover:bg-indigo-400/10 transition-all"
                                           title="View Details">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </a>

                                        {{-- EDIT --}}
                                        @can('update', $product)
                                        <a href="{{ route('product.edit', $product) }}" 
                                           class="p-2 rounded-xl bg-white/[0.03] border border-white/[0.05] text-slate-400 hover:text-amber-400 hover:bg-amber-400/10 transition-all"
                                           title="Edit Product">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </a>
                                        @endcan

                                        {{-- DELETE --}}
                                        @can('delete', $product)
                                        <form action="{{ route('product.delete', $product->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" 
                                                    class="p-2 rounded-xl bg-white/[0.03] border border-white/[0.05] text-slate-400 hover:text-red-500 hover:bg-red-500/10 transition-all">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4m-6 4h8"/></svg>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="py-24 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="p-4 rounded-full bg-white/[0.02] mb-4">
                                            <svg class="w-12 h-12 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0l-8 8-8-8"/></svg>
                                        </div>
                                        <p class="text-slate-600 font-medium">No products found in your inventory.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.02);
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(99, 102, 241, 0.2);
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(99, 102, 241, 0.4);
        }
    </style>
</x-app-layout>