<x-app-layout>
    <div class="relative min-h-screen bg-[#020617] py-12 overflow-hidden">
        {{-- BACKGROUND GLOW EFFECT --}}
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-indigo-600/20 blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[30%] h-[30%] rounded-full bg-fuchsia-600/10 blur-[120px] pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 z-10">
            
            {{-- PAGE HEADER --}}
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-6">
                <div>
                    <h1 class="text-4xl sm:text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 drop-shadow-sm tracking-tight">
                        Product Dashboard
                    </h1>
                    <p class="text-slate-400 mt-3 text-lg font-medium">
                        Kelola data inventaris, harga, dan operasional toko anda dengan mudah.
                    </p>
                </div>
                <a href="{{ route('product.create') }}"
                   class="group relative inline-flex items-center gap-3 px-7 py-3.5 rounded-2xl bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white font-bold transition-all duration-300 shadow-[0_0_30px_-5px_rgba(79,70,229,0.4)] hover:shadow-[0_0_40px_-5px_rgba(79,70,229,0.6)] hover:-translate-y-1">
                    <span>Add New Product</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 group-hover:rotate-90 group-hover:scale-110 transition-all duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                </a>
            </div>

            {{-- SUCCESS ALERT --}}
            @if(session('success'))
                <div class="animate-fade-in-down mb-8 flex items-center p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 backdrop-blur-md text-emerald-400 shadow-[0_0_30px_-10px_rgba(16,185,129,0.2)]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            {{-- MAIN CONTENT CARD --}}
            <div class="bg-white/[0.02] backdrop-blur-xl border border-white/[0.05] rounded-3xl p-1 shadow-2xl shadow-black/50">
                <div class="overflow-x-auto rounded-[22px]">
                    <table class="min-w-full text-left border-collapse whitespace-nowrap">
                        <thead class="bg-white/[0.02] border-b border-white/[0.05]">
                            <tr class="text-slate-400 text-xs uppercase tracking-widest font-bold">
                                <th class="px-8 py-6">#</th>
                                <th class="px-6 py-6">Product Details</th>
                                <th class="px-6 py-6">Status</th>
                                <th class="px-6 py-6">Price</th>
                                <th class="px-6 py-6">Owner</th>
                                <th class="px-6 py-6 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/[0.02]">
                            @forelse ($products as $product)
                            <tr class="group hover:bg-white/[0.04] transition-all duration-300">
                                <td class="px-8 py-6 text-slate-500 font-mono font-medium group-hover:text-indigo-400 transition-colors">{{ $loop->iteration }}</td>
                                <td class="px-6 py-6">
                                    <div class="text-slate-200 font-bold text-base group-hover:text-white transition-colors">{{ $product->name }}</div>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="px-2 py-0.5 rounded-md bg-white/[0.05] text-slate-500 text-[10px] font-mono border border-white/[0.05]">
                                            ID: #{{ $product->id }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-6">
                                    @if($product->qty > 10)
                                        <div class="inline-flex items-center gap-2 text-emerald-400 font-bold text-xs bg-emerald-500/10 px-3 py-1.5 rounded-full border border-emerald-500/20 shadow-[0_0_15px_-5px_rgba(16,185,129,0.3)]">
                                            <span class="relative flex h-2 w-2">
                                              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                              <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                                            </span>
                                            IN STOCK ({{ $product->qty }})
                                        </div>
                                    @else
                                        <div class="inline-flex items-center gap-2 text-rose-400 font-bold text-xs bg-rose-500/10 px-3 py-1.5 rounded-full border border-rose-500/20 shadow-[0_0_15px_-5px_rgba(244,63,94,0.3)]">
                                            <span class="relative flex h-2 w-2">
                                              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                                              <span class="relative inline-flex rounded-full h-2 w-2 bg-rose-500"></span>
                                            </span>
                                            LOW STOCK ({{ $product->qty }})
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-6">
                                    <span class="text-slate-300 font-bold tracking-wide">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td class="px-6 py-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-violet-500 to-fuchsia-500 flex items-center justify-center text-xs text-white font-bold shadow-[0_0_15px_-3px_rgba(167,139,250,0.5)] border border-white/10">
                                            {{ substr($product->user->name ?? 'U', 0, 1) }}
                                        </div>
                                        <span class="text-slate-300 text-sm font-semibold">{{ $product->user->name ?? 'Admin' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-6">
                                    <div class="flex justify-center items-center gap-2">
                                        <a href="{{ route('product.show', $product->id) }}" class="p-2.5 rounded-xl bg-white/[0.03] text-slate-400 hover:text-indigo-400 hover:bg-indigo-500/10 border border-transparent hover:border-indigo-500/20 transition-all duration-300" title="View Details">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </a>
                                        
                                        @can('update', $product)
                                        <a href="{{ route('product.edit', $product) }}" class="p-2.5 rounded-xl bg-white/[0.03] text-slate-400 hover:text-amber-400 hover:bg-amber-500/10 border border-transparent hover:border-amber-500/20 transition-all duration-300" title="Edit Product">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>
                                        </a>
                                        @endcan

                                        @can('delete', $product)
                                        <form action="{{ route('product.delete', $product->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-2.5 rounded-xl bg-white/[0.03] text-slate-400 hover:text-rose-400 hover:bg-rose-500/10 border border-transparent hover:border-rose-500/20 transition-all duration-300" title="Delete Product">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                  <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="py-32 text-center">
                                    <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-white/[0.02] border border-white/[0.05] mb-6 shadow-inner">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-12 h-12 text-slate-500">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-bold text-slate-300 mb-2">Belum ada produk</h3>
                                    <p class="text-slate-500 max-w-sm mx-auto">Klik tombol "Add New Product" di atas untuk mulai menambahkan inventaris ke toko anda.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>