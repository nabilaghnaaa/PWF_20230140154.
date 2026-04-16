<x-app-layout>
    <div class="relative min-h-screen bg-[#020617] py-16 px-4">
        {{-- BACKGROUND GLOW EFFECT --}}
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
            <div class="absolute top-[-10%] left-[-10%] w-[30%] h-[30%] rounded-full bg-indigo-600/10 blur-[120px]"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[30%] h-[30%] rounded-full bg-fuchsia-600/10 blur-[120px]"></div>
        </div>

        <div class="relative max-w-2xl mx-auto z-10">
            {{-- HEADER --}}
            <div class="mb-8 flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-black text-white tracking-tight">Edit Product</h2>
                    <p class="text-slate-400 mt-2">Update informasi produk: <span class="text-indigo-400 font-bold">{{ $product->name }}</span></p>
                </div>
                <a href="{{ route('product.show', $product) }}" 
                   class="flex items-center gap-2 text-slate-400 hover:text-white transition-colors text-sm font-bold">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Back
                </a>
            </div>

            {{-- FORM CARD --}}
            <div class="bg-white/[0.02] backdrop-blur-xl border border-white/[0.05] rounded-3xl p-8 shadow-2xl">
                
                {{-- FORM DELETE (DIPISAHKAN AGAR AMAN) --}}
                <form id="delete-product-form" action="{{ route('product.delete', $product->id) }}" method="POST" class="hidden">
                    @csrf @method('DELETE')
                </form>

                <form action="{{ route('product.update', $product) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    {{-- NAME --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Product Name</label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}" 
                               class="w-full bg-white/[0.03] border border-white/[0.05] rounded-xl px-5 py-4 text-white placeholder-slate-600 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all">
                        @error('name') <p class="mt-2 text-xs text-rose-500">{{ $message }}</p> @enderror
                    </div>

                    {{-- GRID INPUTS --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Quantity</label>
                            <input type="number" name="qty" value="{{ old('qty', $product->qty) }}" 
                                   class="w-full bg-white/[0.03] border border-white/[0.05] rounded-xl px-5 py-4 text-white placeholder-slate-600 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all">
                            @error('qty') <p class="mt-2 text-xs text-rose-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Price (Rp)</label>
                            <input type="number" name="price" value="{{ old('price', $product->price) }}" 
                                   class="w-full bg-white/[0.03] border border-white/[0.05] rounded-xl px-5 py-4 text-white placeholder-slate-600 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all">
                            @error('price') <p class="mt-2 text-xs text-rose-500">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    {{-- OWNER --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Owner</label>
                        <select name="user_id" 
                                class="w-full bg-[#020617] border border-white/[0.05] rounded-xl px-5 py-4 text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all appearance-none cursor-pointer">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" class="bg-slate-900" {{ old('user_id', $product->user_id) == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id') <p class="mt-2 text-xs text-rose-500">{{ $message }}</p> @enderror
                    </div>

                    {{-- ACTIONS --}}
                    <div class="flex items-center justify-between pt-6 border-t border-white/[0.05]">
                        <button type="button" 
                                onclick="if(confirm('Are you sure?')) document.getElementById('delete-product-form').submit();"
                                class="flex items-center gap-2 text-rose-500 hover:text-rose-400 transition-colors text-sm font-bold">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4m-6 4h8"/></svg>
                            Delete Product
                        </button>

                        <div class="flex gap-3">
                            <a href="{{ route('product.show', $product) }}" class="px-6 py-3 rounded-xl border border-white/[0.1] text-slate-400 hover:text-white transition-all font-bold">Cancel</a>
                            <button type="submit" 
                                    class="px-8 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-bold transition-all shadow-lg shadow-indigo-500/20">
                                Save Changes
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>