<nav x-data="{ open: false }" class="sticky top-0 z-50 bg-[#020617]/70 backdrop-blur-xl border-b border-white/[0.05]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
        <div class="flex justify-between h-20 items-center">
            
            {{-- LEFT --}}
            <div class="flex">
                {{-- LOGO --}}
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-white" />
                    </a>
                </div>

                {{-- DESKTOP LINKS --}}
                <div class="hidden space-x-1 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-slate-400 hover:text-white">
                        Dashboard
                    </x-nav-link>

                    <x-nav-link :href="route('about')" :active="request()->routeIs('about')" class="text-slate-400 hover:text-white">
                        About
                    </x-nav-link>

                    <x-nav-link :href="route('product.index')" :active="request()->routeIs('product.*')" class="text-slate-400 hover:text-white">
                        Product
                    </x-nav-link>

                    <x-nav-link :href="route('todo.index')" :active="request()->routeIs('todo.*')" class="text-slate-400 hover:text-white">
                        Todo
                    </x-nav-link>
                </div>
            </div>

            {{-- RIGHT USER MENU --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">

                    {{-- TRIGGER --}}
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-3 px-4 py-2 rounded-xl bg-white/[0.05] hover:bg-white/[0.1] border border-white/[0.08] text-white transition">

                            {{-- AVATAR --}}
                            <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-indigo-500 to-pink-500 flex items-center justify-center text-xs font-bold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>

                            {{-- NAME + ROLE --}}
                            <div class="text-sm font-semibold">
                                {{ Auth::user()->name }}
                                @if(Auth::user()->role === 'admin')
                                    <span class="text-red-400 text-xs">(admin)</span>
                                @endif
                            </div>

                            {{-- ICON --}}
                            <svg class="w-4 h-4 opacity-70" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.937a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"/>
                            </svg>

                        </button>
                    </x-slot>

                    {{-- DROPDOWN CONTENT --}}
                    <x-slot name="content">

                        <div class="px-4 py-3 border-b border-gray-700">
                            <div class="text-sm text-white font-semibold">
                                {{ Auth::user()->name }}
                            </div>
                            <div class="text-xs text-gray-400">
                                {{ Auth::user()->email }}
                            </div>

                            @if(Auth::user()->role === 'admin')
                                <div class="text-xs text-red-400 font-bold mt-1">
                                    ADMIN
                                </div>
                            @endif
                        </div>

                        <x-dropdown-link :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Log Out
                            </x-dropdown-link>
                        </form>

                    </x-slot>
                </x-dropdown>
            </div>

            {{-- HAMBURGER --}}
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="p-2 text-slate-400 hover:text-white transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    {{-- MOBILE MENU --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-[#020617] border-b border-white/[0.05]">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-slate-300">
                Dashboard
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('product.index')" :active="request()->routeIs('product.*')" class="text-slate-300">
                Product
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('todo.index')" :active="request()->routeIs('todo.*')" class="text-slate-300">
                Todo
            </x-responsive-nav-link>
        </div>
    </div>
</nav>