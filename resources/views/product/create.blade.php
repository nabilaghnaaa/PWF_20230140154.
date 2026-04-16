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
                    <h2 class="text-3xl font-black text-white tracking-tight">Add New Product</h2>
                    <p class="text-slate-400 mt-2">Lengkapi detail produk untuk menambahkannya ke inventaris.</p>
                </div>
                <a href="{{ route('product.index') }}" 
                   class="flex items-center gap-2 text-slate-400 hover:text-white transition-colors text-sm font-bold">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Back
                </a>
            </div>

            {{-- FORM CARD --}}
            <div class="bg-white/[0.02] backdrop-blur-xl border border-white/[0.05] rounded-3xl p-8 shadow-2xl">
                <form action="{{ route('product.store') }}" method="POST" class="space-y-6">
                    @csrf

                    {{-- NAME --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Product Name</label>
                        <div class="relative group">
                            <input type="text" name="name" value="{{ old('name') }}" 
                                   class="w-full bg-white/[0.03] border border-white/[0.05] rounded-xl px-5 py-4 text-white placeholder-slate-600 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all"
                                   placeholder="Contoh: Wireless Headphones">
                        </div>
                        @error('name') <p class="mt-2 text-xs text-rose-500">{{ $message }}</p> @enderror
                    </div>

                    {{-- GRID INPUTS --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Quantity</label>
                            <input type="number" name="qty" value="{{ old('qty') }}" 
                                   class="w-full bg-white/[0.03] border border-white/[0.05] rounded-xl px-5 py-4 text-white placeholder-slate-600 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all"
                                   placeholder="0">
                            @error('qty') <p class="mt-2 text-xs text-rose-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Price (Rp)</label>
                            <input type="number" name="price" value="{{ old('price') }}" 
                                   class="w-full bg-white/[0.03] border border-white/[0.05] rounded-xl px-5 py-4 text-white placeholder-slate-600 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all"
                                   placeholder="0">
                            @error('price') <p class="mt-2 text-xs text-rose-500">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    {{-- OWNER --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Assign Owner</label>
                        <select name="user_id" 
                                class="w-full bg-[#020617] border border-white/[0.05] rounded-xl px-5 py-4 text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all appearance-none cursor-pointer">
                            <option value="" class="bg-slate-900">Pilih Owner...</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" class="bg-slate-900" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id') <p class="mt-2 text-xs text-rose-500">{{ $message }}</p> @enderror
                    </div>

                    {{-- SUBMIT BUTTON --}}
                    <div class="pt-4">
                        <button type="submit" 
                                class="w-full py-4 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white font-black tracking-widest uppercase transition-all shadow-[0_0_20px_-5px_rgba(79,70,229,0.5)] hover:shadow-[0_0_30px_-5px_rgba(79,70,229,0.7)]">
                            Save Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>