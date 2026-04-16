<x-app-layout>
    <div class="relative min-h-screen bg-[#020617] py-12 px-4 sm:px-6 lg:px-8 overflow-hidden">
        {{-- BACKGROUND GLOW EFFECT --}}
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-indigo-600/20 blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[30%] h-[30%] rounded-full bg-fuchsia-600/10 blur-[120px] pointer-events-none"></div>

        <div class="relative max-w-4xl mx-auto z-10">
            {{-- HEADER --}}
            <div class="mb-10 text-center">
                <h1 class="text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 tracking-tighter">
                    Todo Hub
                </h1>
            </div>

            {{-- FORM INPUT --}}
            <div class="bg-white/[0.02] backdrop-blur-xl border border-white/[0.05] p-3 rounded-2xl shadow-2xl mb-8 flex flex-col sm:flex-row gap-3">
                <form action="/todo/store" method="POST" class="flex flex-col sm:flex-row gap-3 w-full">
                    @csrf
                    <input type="text" name="title" placeholder="Judul tugas..." class="flex-1 bg-transparent border-none px-4 py-3 text-white placeholder-slate-600 focus:ring-0 outline-none">
                    <input type="text" name="description" placeholder="Detail..." class="flex-[2] bg-transparent border-l border-white/[0.05] px-4 py-3 text-white placeholder-slate-600 focus:ring-0 outline-none">
                    <button type="submit" class="px-6 py-3 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white font-bold transition-all shadow-lg">
                        Simpan
                    </button>
                </form>
            </div>

            {{-- FILTER BUTTONS --}}
            <div class="flex gap-3 mb-6 justify-center">
                <button onclick="filterTodo('all')" class="px-5 py-1.5 rounded-full bg-white/[0.03] border border-white/[0.05] text-slate-300 text-xs font-bold hover:bg-indigo-500/20 hover:border-indigo-500/50 transition-all">Semua</button>
                <button onclick="filterTodo('pending')" class="px-5 py-1.5 rounded-full bg-white/[0.03] border border-white/[0.05] text-slate-300 text-xs font-bold hover:bg-amber-500/20 hover:border-amber-500/50 transition-all">Pending</button>
                <button onclick="filterTodo('completed')" class="px-5 py-1.5 rounded-full bg-white/[0.03] border border-white/[0.05] text-slate-300 text-xs font-bold hover:bg-emerald-500/20 hover:border-emerald-500/50 transition-all">Completed</button>
            </div>

            {{-- LIST SECTION --}}
            <div class="bg-white/[0.02] backdrop-blur-xl border border-white/[0.05] rounded-3xl overflow-hidden shadow-2xl">
                <div class="max-h-[500px] overflow-y-auto custom-scrollbar">
                    <div class="divide-y divide-white/[0.03]">
                        @forelse($todos as $todo)
                            <div class="todo-item group flex items-center justify-between px-8 py-6 hover:bg-white/[0.04] transition-all" data-status="{{ $todo->is_completed ? 'completed' : 'pending' }}">
                                <div class="flex items-center gap-5 w-full">
                                    {{-- CHECKBOX (Ikon minimalis) --}}
                                    <form action="{{ route('todo.toggle', $todo->id) }}" method="POST">
                                @csrf @method('PATCH')
                                <button type="submit" class="w-6 h-6 rounded-lg border flex items-center justify-center transition-all
                                    {{ $todo->is_completed ? 'bg-emerald-500 border-emerald-500' : 'border-slate-600 hover:border-indigo-400' }}">
                                    @if($todo->is_completed) 
                                        <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-width="3" d="M5 13l4 4L19 7"/>
                                        </svg> 
                                    @endif
                                </button>
                            </form>

                                    {{-- CONTENT --}}
                                    <div class="flex flex-col flex-1 min-w-0">
                                        <h3 class="text-white font-bold {{ $todo->is_completed ? 'line-through text-slate-500' : '' }}">{{ $todo->title }}</h3>
                                        <p class="text-slate-500 text-xs mt-0.5">{{ $todo->description }}</p>
                                    </div>
                                </div>
                                
                                {{-- STATUS BADGE (Kotak Minimalis) --}}
                                <div class="flex items-center gap-4 ml-6 flex-shrink-0">
                                    <span class="px-3 py-1 rounded-md text-[10px] font-black uppercase tracking-wider border {{ $todo->is_completed ? 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20' : 'bg-amber-500/10 text-amber-500 border-amber-500/20' }}">
                                        {{ $todo->is_completed ? 'Done' : 'Pending' }}
                                    </span>

                                    <form action="/todo/{{ $todo->id }}" method="POST" onsubmit="return confirm('Hapus tugas ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-slate-600 hover:text-red-500 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4m-6 4h8"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="py-20 text-center text-slate-600">Belum ada data tugas.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function filterTodo(status) {
            document.querySelectorAll('.todo-item').forEach(item => {
                item.style.display = (status === 'all' || item.getAttribute('data-status') === status) ? 'flex' : 'none';
            });
        }
    </script>
</x-app-layout>