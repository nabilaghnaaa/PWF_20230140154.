<x-app-layout>
    <div class="relative min-h-screen bg-[#020617] py-12 px-4 sm:px-6 lg:px-8 overflow-hidden">
        {{-- BACKGROUND GLOW EFFECT --}}
        <div class="absolute top-[-5%] right-[-5%] w-[40%] h-[40%] rounded-full bg-indigo-600/10 blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-[-5%] left-[-5%] w-[30%] h-[30%] rounded-full bg-blue-600/10 blur-[120px] pointer-events-none"></div>

        <div class="relative max-w-2xl mx-auto z-10">
            
            {{-- OTORISASI UTAMA: Cek apakah user boleh update produk ini --}}
            @can('update', $product)
                {{-- HEADER --}}
                <div class="flex items-center gap-4 mb-8">
                    <a href="{{ route('product.show', $product) }}"
                        class="p-2.5 rounded-xl bg-white/[0.03] border border-white/[0.05] text-slate-400 hover:text-white hover:bg-white/[0.08] transition-all group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                    <div>
                        <h2 class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-400 tracking-tighter uppercase">
                            Edit Product
                        </h2>
                        <p class="text-slate-500 text-xs font-mono mt-0.5 tracking-widest uppercase">
                            Modifying: <span class="text-slate-300">{{ $product->name }}</span>
                        </p>
                    </div>
                </div>

                {{-- HIDDEN DELETE FORM (Hanya jika punya izin delete) --}}
                @can('delete', $product)
                <form id="delete-product-form" action="{{ route('product.delete', $product->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                </form>
                @endcan

                {{-- MAIN FORM CARD --}}
                <div class="bg-white/[0.02] backdrop-blur-xl border border-white/[0.05] rounded-3xl p-8 shadow-2xl relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-[2px] bg-gradient-to-r from-transparent via-indigo-500 to-transparent"></div>

                    <form action="{{ route('product.update', $product) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        {{-- NAME INPUT --}}
                        <div class="space-y-2">
                            <label for="name" class="block text-xs font-black uppercase tracking-[0.2em] text-slate-500 ml-1">
                                Product Name <span class="text-indigo-500">*</span>
                            </label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500 group-focus-within:text-indigo-400 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                </div>
                                <input type="text" id="name" name="name"
                                    value="{{ old('name', $product->name) }}"
                                    class="w-full pl-11 pr-4 py-3.5 bg-white/[0.03] border border-white/[0.05] rounded-2xl text-white placeholder-slate-600 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500/50 transition-all outline-none {{ $errors->has('name') ? 'border-red-500/50 bg-red-500/5' : '' }}"
                                    placeholder="Enter product name...">
                            </div>
                            @error('name') <p class="mt-1 text-[10px] font-bold text-red-500 uppercase tracking-wider ml-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- QTY & PRICE GRID --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            {{-- QTY --}}
                            <div class="space-y-2">
                                <label for="qty" class="block text-xs font-black uppercase tracking-[0.2em] text-slate-500 ml-1">
                                    Quantity <span class="text-indigo-500">*</span>
                                </label>
                                <input type="number" id="qty" name="qty" value="{{ old('qty', $product->qty) }}"
                                    class="w-full px-4 py-3.5 bg-white/[0.03] border border-white/[0.05] rounded-2xl text-white focus:ring-2 focus:ring-indigo-500/50 transition-all outline-none {{ $errors->has('qty') ? 'border-red-500/50' : '' }}">
                                @error('qty') <p class="text-[10px] font-bold text-red-500 uppercase tracking-wider ml-1">{{ $message }}</p> @enderror
                            </div>

                            {{-- PRICE --}}
                            <div class="space-y-2">
                                <label for="price" class="block text-xs font-black uppercase tracking-[0.2em] text-slate-500 ml-1">
                                    Price (IDR) <span class="text-indigo-500">*</span>
                                </label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-500 font-bold text-sm pointer-events-none">Rp</span>
                                    <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}"
                                        class="w-full pl-10 pr-4 py-3.5 bg-white/[0.03] border border-white/[0.05] rounded-2xl text-white focus:ring-2 focus:ring-indigo-500/50 transition-all outline-none {{ $errors->has('price') ? 'border-red-500/50' : '' }}">
                                </div>
                                @error('price') <p class="text-[10px] font-bold text-red-500 uppercase tracking-wider ml-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        {{-- CATEGORY SELECT --}}
                        <div class="space-y-2">
                            <label for="category_id" class="block text-xs font-black uppercase tracking-[0.2em] text-slate-500 ml-1">
                                Product Category <span class="text-indigo-500">*</span>
                            </label>
                            <select id="category_id" name="category_id"
                                class="w-full px-4 py-3.5 bg-white/[0.03] border border-white/[0.05] rounded-2xl text-white focus:ring-2 focus:ring-indigo-500/50 transition-all outline-none appearance-none cursor-pointer {{ $errors->has('category_id') ? 'border-red-500/50' : '' }}">
                                @foreach ($categories as $c)
                                    <option value="{{ $c->id }}" {{ old('category_id', $product->category_id) == $c->id ? 'selected' : '' }} class="bg-[#0f172a]">
                                        {{ $c->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id') <p class="text-[10px] font-bold text-red-500 uppercase tracking-wider ml-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- ACTIONS --}}
                        <div class="flex flex-col sm:flex-row items-center justify-between pt-6 gap-4 border-t border-white/[0.05]">
                            
                            {{-- Tombol Delete hanya muncul jika diizinkan policy --}}
                            @can('delete', $product)
                            <button type="submit"
                                onclick="return confirm('Are you sure you want to delete this product?');"
                                form="delete-product-form"
                                class="text-[10px] font-black uppercase tracking-widest text-red-500/70 hover:text-red-500 transition-colors">
                                Delete Record
                            </button>
                            @else
                            <div class="text-[9px] font-black uppercase tracking-widest text-slate-700">Delete Restricted</div>
                            @endcan

                            <div class="flex items-center gap-4 w-full sm:w-auto">
                                <a href="{{ route('product.show', $product) }}"
                                    class="flex-1 sm:flex-none text-center px-6 py-3.5 rounded-2xl border border-white/[0.05] text-slate-400 text-xs font-bold hover:bg-white/[0.05] hover:text-white transition-all uppercase tracking-widest">
                                    Cancel
                                </a>

                                <button type="submit"
                                    class="flex-1 sm:flex-none px-8 py-3.5 bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-500 hover:to-blue-500 text-white text-xs font-black rounded-2xl shadow-lg shadow-indigo-500/20 transition-all transform active:scale-95 uppercase tracking-widest">
                                    Update Protocol
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            @else
                {{-- TAMPILAN JIKA AKSES DITOLAK (Bukan Owner / Admin) --}}
                <div class="bg-red-500/5 backdrop-blur-xl border border-red-500/20 rounded-3xl p-12 shadow-2xl text-center">
                    <div class="w-16 h-16 bg-red-500/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m0 0v2m0-2h2m-2 0H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-black text-white uppercase tracking-tighter mb-2">Access Restricted</h2>
                    <p class="text-slate-500 text-sm mb-8">You are not authorized to modify or delete this asset. Only the creator or system administrators hold management privileges.</p>
                    <a href="{{ route('product.index') }}" class="inline-block px-8 py-3 bg-white/[0.05] text-white text-xs font-black rounded-xl border border-white/[0.1] hover:bg-white/[0.1] transition-all uppercase tracking-widest">
                        Return to Inventory
                    </a>
                </div>
            @endcan

            {{-- DECORATION FOOTER --}}
            <p class="mt-8 text-center text-[10px] font-black uppercase tracking-[0.4em] text-slate-700">
                Security Module Active // Authorization Required
            </p>
        </div>
    </div>
</x-app-layout>