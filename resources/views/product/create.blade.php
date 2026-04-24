<x-app-layout>
    <div class="relative min-h-screen bg-[#020617] py-12 px-4 sm:px-6 lg:px-8 overflow-hidden">
        {{-- BACKGROUND GLOW EFFECT - Diselaraskan dengan Index --}}
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-indigo-600/20 blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[30%] h-[30%] rounded-full bg-fuchsia-600/10 blur-[120px] pointer-events-none"></div>

        <div class="relative max-w-3xl mx-auto z-10">
            
            {{-- HEADER SECTION --}}
            <div class="flex items-center gap-6 mb-10">
                <a href="{{ route('product.index') }}"
                    class="p-3 rounded-2xl bg-white/[0.03] border border-white/[0.05] text-slate-400 hover:text-indigo-400 hover:bg-indigo-400/10 transition-all group shadow-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
                <div>
                    <h1 class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 tracking-tighter">
                        Add New Asset
                    </h1>
                    <p class="text-slate-500 text-sm mt-1 font-medium">Register a new product into the digital inventory</p>
                </div>
            </div>

            {{-- MAIN FORM CARD - Glassmorphism style --}}
            <div class="bg-white/[0.02] backdrop-blur-2xl border border-white/[0.05] rounded-[2.5rem] p-10 shadow-2xl overflow-hidden relative">
                {{-- Decorative Line --}}
                <div class="absolute top-0 left-0 w-full h-[2px] bg-gradient-to-r from-transparent via-indigo-500/50 to-transparent"></div>

                <form action="{{ route('product.store') }}" method="POST" class="space-y-8">
                    @csrf

                    {{-- PRODUCT NAME --}}
                    <div class="group">
                        <label for="name" class="block text-[10px] font-black uppercase tracking-[0.3em] text-slate-500 mb-3 ml-1 group-focus-within:text-indigo-400 transition-colors">
                            Product Nomenclature
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-500 group-focus-within:text-indigo-400 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                            </div>
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                class="w-full pl-14 pr-6 py-4 bg-white/[0.03] border border-white/[0.08] rounded-2xl text-white placeholder-slate-600 focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-500/50 transition-all outline-none {{ $errors->has('name') ? 'border-red-500/50 bg-red-500/5' : '' }}"
                                placeholder="Enter asset name...">
                        </div>
                        @error('name') <p class="mt-2 text-[10px] font-bold text-red-500 uppercase tracking-widest ml-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- QTY & PRICE GRID --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        {{-- QTY --}}
                        <div class="group">
                            <label for="qty" class="block text-[10px] font-black uppercase tracking-[0.3em] text-slate-500 mb-3 ml-1 group-focus-within:text-indigo-400">
                                Stock Units
                            </label>
                            <input type="number" id="qty" name="qty" value="{{ old('qty') }}"
                                class="w-full px-6 py-4 bg-white/[0.03] border border-white/[0.08] rounded-2xl text-white focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-500/50 transition-all outline-none {{ $errors->has('qty') ? 'border-red-500/50' : '' }}"
                                placeholder="0">
                            @error('qty') <p class="mt-2 text-[10px] font-bold text-red-500 uppercase tracking-widest ml-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- PRICE --}}
                        <div class="group">
                            <label for="price" class="block text-[10px] font-black uppercase tracking-[0.3em] text-slate-500 mb-3 ml-1 group-focus-within:text-indigo-400">
                                Unit Valuation
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-5 flex items-center text-indigo-400 font-bold text-sm pointer-events-none">Rp</span>
                                <input type="number" id="price" name="price" value="{{ old('price') }}"
                                    class="w-full pl-14 pr-6 py-4 bg-white/[0.03] border border-white/[0.08] rounded-2xl text-white focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-500/50 transition-all outline-none {{ $errors->has('price') ? 'border-red-500/50' : '' }}"
                                    placeholder="0">
                            </div>
                            @error('price') <p class="mt-2 text-[10px] font-bold text-red-500 uppercase tracking-widest ml-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    {{-- TWO COLUMN SELECT --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        {{-- OWNER SELECT --}}
                        <div class="group">
                            <label for="user_id" class="block text-[10px] font-black uppercase tracking-[0.3em] text-slate-500 mb-3 ml-1 group-focus-within:text-indigo-400">
                                Assign Custodian
                            </label>
                            <div class="relative">
                                <select id="user_id" name="user_id"
                                    class="w-full px-6 py-4 bg-[#0f172a] border border-white/[0.08] rounded-2xl text-white focus:ring-2 focus:ring-indigo-500/30 transition-all outline-none appearance-none cursor-pointer {{ $errors->has('user_id') ? 'border-red-500/50' : '' }}">
                                    <option value="" disabled selected>Select User</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                </div>
                            </div>
                            @error('user_id') <p class="mt-2 text-[10px] font-bold text-red-500 uppercase tracking-widest ml-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- CATEGORY SELECT --}}
                        <div class="group">
                            <label for="category_id" class="block text-[10px] font-black uppercase tracking-[0.3em] text-slate-500 mb-3 ml-1 group-focus-within:text-indigo-400">
                                Asset Class
                            </label>
                            <div class="relative">
                                <select id="category_id" name="category_id"
                                    class="w-full px-6 py-4 bg-[#0f172a] border border-white/[0.08] rounded-2xl text-white focus:ring-2 focus:ring-indigo-500/30 transition-all outline-none appearance-none cursor-pointer {{ $errors->has('category_id') ? 'border-red-500/50' : '' }}">
                                    <option value="" disabled selected>Select Classification</option>
                                    @foreach ($categories as $c)
                                        <option value="{{ $c->id }}" {{ old('category_id') == $c->id ? 'selected' : '' }}>
                                            {{ $c->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                </div>
                            </div>
                            @error('category_id') <p class="mt-2 text-[10px] font-bold text-red-500 uppercase tracking-widest ml-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    {{-- ACTIONS --}}
                    <div class="flex items-center justify-end gap-6 pt-10 border-t border-white/[0.05]">
                        <a href="{{ route('product.index') }}"
                            class="text-sm font-bold text-slate-500 hover:text-white transition-colors tracking-wide">
                            Discard Changes
                        </a>

                        <button type="submit"
                            class="px-10 py-4 bg-gradient-to-r from-indigo-600 via-purple-600 to-fuchsia-600 hover:from-indigo-500 hover:via-purple-500 hover:to-fuchsia-500 text-white text-sm font-black rounded-2xl shadow-[0_0_20px_rgba(99,102,241,0.3)] transition-all transform active:scale-95 flex items-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                            INITIALIZE ASSET
                        </button>
                    </div>
                </form>
            </div>

            {{-- DECORATION FOOTER --}}
            <div class="mt-10 flex flex-col items-center gap-2">
                <div class="w-12 h-[1px] bg-indigo-500/30"></div>
                <p class="text-[10px] font-black uppercase tracking-[0.5em] text-slate-700">
                    System Protocol v2.4 // Secure Entry
                </p>
            </div>
        </div>
    </div>
</x-app-layout>