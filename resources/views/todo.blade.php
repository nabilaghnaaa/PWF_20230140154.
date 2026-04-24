<x-app-layout> {{-- Menggunakan layout app-layout component --}}
    <div class="relative min-h-screen bg-[#020617] py-12 px-4 sm:px-6 lg:px-8 overflow-hidden"> {{-- Main container dengan background dan padding --}}
        {{-- BACKGROUND GLOW EFFECT --}}
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-indigo-600/20 blur-[120px] pointer-events-none"></div> {{-- Decorative glow effect di atas kiri --}}
        <div class="absolute bottom-[-10%] right-[-10%] w-[30%] h-[30%] rounded-full bg-fuchsia-600/10 blur-[120px] pointer-events-none"></div> {{-- Decorative glow effect di bawah kanan --}}

        <div class="relative max-w-4xl mx-auto z-10"> {{-- Container utama dengan max width dan centered --}}
            {{-- HEADER --}}
            <div class="mb-10 text-center"> {{-- Header section dengan centered alignment --}}
                <h1 class="text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 tracking-tighter">
                    Todo Hub {{-- Main title --}}
                </h1>
            </div>

            {{-- FORM INPUT --}}
            <div class="bg-white/[0.02] backdrop-blur-xl border border-white/[0.05] p-3 rounded-2xl shadow-2xl mb-8 flex flex-col sm:flex-row gap-3"> {{-- Form card container --}}
                <form action="/todo/store" method="POST" class="flex flex-col sm:flex-row gap-3 w-full"> {{-- Form yang submit ke /todo/store route dengan POST method --}}
                    @csrf {{-- CSRF token untuk security --}}
                    <input type="text" name="title" placeholder="Judul tugas..." class="flex-1 bg-transparent border-none px-4 py-3 text-white placeholder-slate-600 focus:ring-0 outline-none"> {{-- Input field untuk title todo --}}
                    <input type="text" name="description" placeholder="Detail..." class="flex-[2] bg-transparent border-l border-white/[0.05] px-4 py-3 text-white placeholder-slate-600 focus:ring-0 outline-none"> {{-- Input field untuk description todo --}}
                    <button type="submit" class="px-6 py-3 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white font-bold transition-all shadow-lg"> {{-- Submit button dengan gradient background --}}
                        Simpan {{-- Button text untuk submit form --}}
                    </button>
                </form>
            </div>

            {{-- FILTER BUTTONS --}}
            <div class="flex gap-3 mb-6 justify-center"> {{-- Filter button container dengan centered alignment --}}
                <button onclick="filterTodo('all')" class="px-5 py-1.5 rounded-full bg-white/[0.03] border border-white/[0.05] text-slate-300 text-xs font-bold hover:bg-indigo-500/20 hover:border-indigo-500/50 transition-all">Semua</button> {{-- Filter button untuk show all todos --}}
                <button onclick="filterTodo('pending')" class="px-5 py-1.5 rounded-full bg-white/[0.03] border border-white/[0.05] text-slate-300 text-xs font-bold hover:bg-amber-500/20 hover:border-amber-500/50 transition-all">Pending</button> {{-- Filter button untuk show pending todos --}}
                <button onclick="filterTodo('completed')" class="px-5 py-1.5 rounded-full bg-white/[0.03] border border-white/[0.05] text-slate-300 text-xs font-bold hover:bg-emerald-500/20 hover:border-emerald-500/50 transition-all">Completed</button> {{-- Filter button untuk show completed todos --}}
            </div>

            {{-- LIST SECTION --}}
            <div class="bg-white/[0.02] backdrop-blur-xl border border-white/[0.05] rounded-3xl overflow-hidden shadow-2xl"> {{-- Todo list card container --}}
                <div class="max-h-[500px] overflow-y-auto custom-scrollbar"> {{-- Scrollable container untuk todo items --}}
                    <div class="divide-y divide-white/[0.03]"> {{-- Section divider untuk setiap todo item --}}
                        @forelse($todos as $todo) {{-- Blade loop untuk iterate todos dengan fallback jika kosong --}}
                            <div class="todo-item group flex items-center justify-between px-8 py-6 hover:bg-white/[0.04] transition-all" data-status="{{ $todo->is_completed ? 'completed' : 'pending' }}"> {{-- Todo item row dengan data-status attribute untuk filtering --}}
                                <div class="flex items-center gap-5 w-full"> {{-- Left section dengan checkbox dan content --}}
                                    {{-- CHECKBOX (Ikon minimalis) --}}
                                    <form action="{{ route('todo.toggle', $todo->id) }}" method="POST"> {{-- Form untuk toggle completion status --}}
                                @csrf {{-- CSRF token untuk security --}}
                                @method('PATCH') {{-- Spoof PATCH method --}}
                                <button type="submit" class="w-6 h-6 rounded-lg border flex items-center justify-center transition-all {{ $todo->is_completed ? 'bg-emerald-500 border-emerald-500' : 'border-slate-600 hover:border-indigo-400' }}"> {{-- Toggle button dengan conditional styling --}}
                                    @if($todo->is_completed) {{-- Cek apakah todo sudah completed --}}
                                        <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"> {{-- Checkmark icon container --}}
                                            <path stroke-width="3" d="M5 13l4 4L19 7"/> {{-- Checkmark icon path --}}
                                        </svg> {{-- Tampilkan checkmark jika completed --}}
                                    @endif {{-- Tutup if block --}}
                                </button>
                            </form>

                                    {{-- CONTENT --}}
                                    <div class="flex flex-col flex-1 min-w-0"> {{-- Todo content container --}}
                                        <h3 class="text-white font-bold {{ $todo->is_completed ? 'line-through text-slate-500' : '' }}">{{ $todo->title }}</h3> {{-- Display todo title dengan conditional line-through styling --}}
                                        <p class="text-slate-500 text-xs mt-0.5">{{ $todo->description }}</p> {{-- Display todo description --}}
                                    </div>
                                </div>
                                
                                {{-- STATUS BADGE (Kotak Minimalis) --}}
                                <div class="flex items-center gap-4 ml-6 flex-shrink-0"> {{-- Right section dengan status badge dan delete button --}}
                                    <span class="px-3 py-1 rounded-md text-[10px] font-black uppercase tracking-wider border {{ $todo->is_completed ? 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20' : 'bg-amber-500/10 text-amber-500 border-amber-500/20' }}"> {{-- Status badge dengan conditional color --}}
                                        {{ $todo->is_completed ? 'Done' : 'Pending' }} {{-- Display status text --}}
                                    </span>

                                    <form action="/todo/{{ $todo->id }}" method="POST" onsubmit="return confirm('Hapus tugas ini?')"> {{-- Delete form dengan confirmation --}}
                                        @csrf {{-- CSRF token untuk security --}}
                                        @method('DELETE') {{-- Spoof DELETE method --}}
                                        <button type="submit" class="text-slate-600 hover:text-red-500 transition-colors"> {{-- Delete button --}}
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4m-6 4h8"></path></svg> {{-- Delete icon --}}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty {{-- Fallback jika tidak ada todos --}}
                            <div class="py-20 text-center text-slate-600">Belum ada data tugas.</div> {{-- Empty state message --}}
                        @endforelse {{-- Tutup forelse block --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function filterTodo(status) { {{-- Fungsi JavaScript untuk filter todo items berdasarkan status --}}
            document.querySelectorAll('.todo-item').forEach(item => { {{-- Loop semua todo items --}}
                item.style.display = (status === 'all' || item.getAttribute('data-status') === status) ? 'flex' : 'none'; {{-- Show/hide todo item berdasarkan filter status --}}
            }); {{-- Tutup loop --}}
        } {{-- Tutup fungsi --}}
    </script>
</x-app-layout> {{-- Tutup app-layout component --}}