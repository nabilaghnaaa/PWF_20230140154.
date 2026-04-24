<x-app-layout>
    <div class="relative min-h-screen bg-[#020617] py-12 px-4 sm:px-6 lg:px-8 overflow-hidden">
        {{-- BACKGROUND GLOW EFFECT --}}
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-fuchsia-600/15 blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[30%] h-[30%] rounded-full bg-indigo-600/10 blur-[120px] pointer-events-none"></div>

        <div class="relative max-w-2xl mx-auto z-10">
            
            {{-- HEADER SECTION --}}
            <div class="flex items-center gap-6 mb-10">
                <a href="{{ route('category.index') }}"
                    class="p-3 rounded-2xl bg-white/[0.03] border border-white/[0.05] text-slate-400 hover:text-fuchsia-400 hover:bg-fuchsia-400/10 transition-all group shadow-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
                <div>
                    <h1 class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-fuchsia-400 via-rose-400 to-amber-400 tracking-tighter">
                        Modify Category
                    </h1>
                    <p class="text-slate-500 text-sm mt-1 font-medium">Update classification details for ID: {{ $category->id }}</p>
                </div>
            </div>

            {{-- MAIN FORM CARD --}}
            <div class="bg-white/[0.02] backdrop-blur-2xl border border-white/[0.05] rounded-[2.5rem] p-10 shadow-2xl relative overflow-hidden">
                {{-- Top Decorative Glow Line --}}
                <div class="absolute top-0 left-0 w-full h-[2px] bg-gradient-to-r from-transparent via-rose-500/50 to-transparent"></div>

                <form action="/category/{{ $category->id }}" method="POST" class="space-y-8">
                    @csrf
                    @method('PUT')

                    {{-- CATEGORY NAME INPUT --}}
                    <div class="group">
                        <label for="name" class="block text-[10px] font-black uppercase tracking-[0.3em] text-slate-500 mb-4 ml-1 group-focus-within:text-fuchsia-400 transition-colors">
                            Classification Name
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-500 group-focus-within:text-fuchsia-400 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </div>
                            <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}"
                                class="w-full pl-14 pr-6 py-4 bg-white/[0.03] border border-white/[0.08] rounded-2xl text-white placeholder-slate-600 focus:ring-2 focus:ring-fuchsia-500/30 focus:border-fuchsia-500/50 transition-all outline-none {{ $errors->has('name') ? 'border-red-500/50 bg-red-500/5' : '' }}"
                                placeholder="Update category name...">
                        </div>
                        
                        {{-- ERROR MESSAGE --}}
                        @error('name') 
                            <div class="mt-3 flex items-center gap-2 text-red-500 ml-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                <p class="text-[10px] font-bold uppercase tracking-widest">{{ $message }}</p>
                            </div>
                        @enderror
                    </div>

                    {{-- STATUS BOX --}}
                    <div class="p-4 rounded-2xl bg-white/[0.01] border border-white/[0.03] flex items-center justify-between">
                        <span class="text-[10px] font-black uppercase tracking-widest text-slate-600">Record Status</span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-emerald-500/10 text-emerald-500 border border-emerald-500/20">
                            Active Sync
                        </span>
                    </div>

                    {{-- ACTIONS --}}
                    <div class="flex items-center justify-end gap-6 pt-6 border-t border-white/[0.05]">
                        <a href="{{ route('category.index') }}"
                            class="text-xs font-bold text-slate-500 hover:text-white transition-colors tracking-widest uppercase">
                            Discard
                        </a>

                        <button type="submit"
                            class="px-10 py-4 bg-gradient-to-r from-rose-600 via-fuchsia-600 to-indigo-600 hover:from-rose-500 hover:via-fuchsia-500 hover:to-indigo-500 text-white text-sm font-black rounded-2xl shadow-[0_0_25px_rgba(225,29,72,0.3)] transition-all transform active:scale-95 flex items-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            COMMIT CHANGES
                        </button>
                    </div>
                </form>
            </div>

            {{-- DECORATION FOOTER --}}
            <div class="mt-10 flex flex-col items-center gap-2">
                <div class="w-12 h-[1px] bg-rose-500/30"></div>
                <p class="text-[10px] font-black uppercase tracking-[0.5em] text-slate-700">
                    System Override v2.4 // Modification Layer
                </p>
            </div>
        </div>
    </div>
</x-app-layout>