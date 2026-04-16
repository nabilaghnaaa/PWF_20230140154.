<x-app-layout>
    <div class="relative min-h-screen bg-[#020617] py-12 px-4 sm:px-6 lg:px-8">
        {{-- BACKGROUND GLOW EFFECT --}}
        <div class="absolute top-[-10%] right-[-10%] w-[30%] h-[30%] rounded-full bg-indigo-600/10 blur-[120px] pointer-events-none"></div>

        <div class="relative max-w-2xl mx-auto z-10">
            <h1 class="text-3xl font-black text-white mb-8 tracking-tighter">About Me</h1>

            <div class="bg-white/[0.02] backdrop-blur-xl border border-white/[0.05] p-10 rounded-3xl shadow-2xl">
                <div class="space-y-6 text-lg text-slate-300">
                    
                    <div class="group border-b border-white/[0.05] pb-4 hover:border-indigo-500/50 transition-colors">
                        <span class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Nama</span>
                        <p class="font-bold text-white text-xl">Regina Rana Nabila</p>
                    </div>

                    <div class="group border-b border-white/[0.05] pb-4 hover:border-indigo-500/50 transition-colors">
                        <span class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">NIM</span>
                        <p class="font-mono text-indigo-400 text-lg">20230140154</p>
                    </div>

                    <div class="group border-b border-white/[0.05] pb-4 hover:border-indigo-500/50 transition-colors">
                        <span class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Program Studi</span>
                        <p class="font-semibold text-white">Teknologi Informasi</p>
                    </div>

                    <div class="group pt-2">
                        <span class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Hobi</span>
                        <div class="inline-flex items-center px-3 py-1 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-sm font-bold">
                            Ngoding
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>