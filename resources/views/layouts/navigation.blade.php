<nav x-data="{ open: false }" class="sticky top-0 z-50 bg-[#020617]/70 backdrop-blur-xl border-b border-white/[0.05]"> {{-- Navigation bar dengan Alpine.js untuk mobile menu toggle --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2"> {{-- Nav container dengan max-width dan padding --}}
        <div class="flex justify-between h-20 items-center"> {{-- Main flex container untuk logo + links + user menu --}}

            {{-- LEFT --}}
            <div class="flex items-center"> {{-- Left section dengan logo dan desktop links --}}

                {{-- LOGO --}}
                <a href="{{ route('dashboard') }}" class="shrink-0 flex items-center"> {{-- Logo link ke dashboard --}}
                    <x-application-logo class="block h-9 w-auto fill-current text-white" /> {{-- Render application logo component --}}
                </a>

                {{-- DESKTOP LINKS --}}
                <div class="hidden sm:flex sm:ms-10 space-x-2"> {{-- Desktop navigation links (hidden on mobile) --}}

                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" {{-- Dashboard link component dengan active state check --}}
                        class="text-slate-400 hover:text-white">
                        Dashboard {{-- Dashboard link text --}}
                    </x-nav-link>

                    <x-nav-link :href="route('about')" :active="request()->routeIs('about')" {{-- About link component dengan active state check --}}
                        class="text-slate-400 hover:text-white">
                        About {{-- About link text --}}
                    </x-nav-link>

                    {{-- SEMUA USER --}}
                    <x-nav-link :href="route('product.index')" :active="request()->routeIs('product.*')" {{-- Product link - accessible to all users --}}
                        class="text-slate-400 hover:text-white">
                        Product {{-- Product link text --}}
                    </x-nav-link>

                    {{-- ADMIN ONLY --}}
                    @if(Auth::user()->role === 'admin') {{-- Blade directive untuk cek apakah user adalah admin --}}

                        {{-- CATEGORY --}}
                        <x-nav-link :href="route('category.index')" :active="request()->routeIs('category.*')" {{-- Category link - admin only --}}
                            class="text-slate-400 hover:text-white">
                            Category {{-- Category link text --}}
                        </x-nav-link>

                        <x-nav-link :href="route('todo.index')" :active="request()->routeIs('todo.*')" {{-- Todo link - admin only --}}
                            class="text-slate-400 hover:text-white">
                            Todo {{-- Todo link text --}}
                        </x-nav-link>

                    @endif {{-- Tutup admin check --}}

                </div>
            </div>

            {{-- RIGHT USER MENU --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6"> {{-- Right section dengan user dropdown (hidden on mobile) --}}
                <x-dropdown align="right" width="48"> {{-- Dropdown component untuk user menu --}}

                    {{-- TRIGGER --}}
                    <x-slot name="trigger"> {{-- Slot untuk dropdown trigger button --}}
                        <button class="inline-flex items-center gap-3 px-4 py-2 rounded-xl bg-white/[0.05] hover:bg-white/[0.1] border border-white/[0.08] text-white transition"> {{-- User menu trigger button --}}

                            <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-indigo-500 to-pink-500 flex items-center justify-center text-xs font-bold"> {{-- Avatar circle dengan gradient background --}}
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }} {{-- Display first letter dari user name --}}
                            </div>

                            <div class="text-sm font-semibold"> {{-- User info section --}}
                                {{ Auth::user()->name }} {{-- Display user name --}}
                                @if(Auth::user()->role === 'admin') {{-- Cek apakah user adalah admin --}}
                                    <span class="text-red-400 text-xs">(admin)</span> {{-- Display admin badge jika user adalah admin --}}
                                @endif {{-- Tutup admin check --}}
                            </div>

                        </button>
                    </x-slot>

                    {{-- DROPDOWN --}}
                    <x-slot name="content"> {{-- Slot untuk dropdown content/menu --}}

                        <div class="px-4 py-3 border-b border-gray-700"> {{-- Dropdown header section --}}
                            <div class="text-sm text-white font-semibold"> {{-- User name display --}}
                                {{ Auth::user()->name }} {{-- Show current user name --}}
                            </div>
                            <div class="text-xs text-gray-400"> {{-- User email display --}}
                                {{ Auth::user()->email }} {{-- Show current user email --}}
                            </div>

                            @if(Auth::user()->role === 'admin') {{-- Cek apakah user adalah admin --}}
                                <div class="text-xs text-red-400 font-bold mt-1"> {{-- Admin badge --}}
                                    ADMIN {{-- Display ADMIN text jika user adalah admin --}}
                                </div>
                            @endif {{-- Tutup admin check --}}
                        </div>

                        <x-dropdown-link :href="route('profile.edit')"> {{-- Profile edit link dalam dropdown --}}
                            Profile {{-- Profile link text --}}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}"> {{-- Logout form --}}
                            @csrf {{-- CSRF token untuk security --}}
                            <x-dropdown-link :href="route('logout')" {{-- Logout link yang trigger form submit --}}
                                onclick="event.preventDefault(); this.closest('form').submit();"> {{-- Prevent default dan submit form dengan JS --}}
                                Log Out {{-- Logout link text --}}
                            </x-dropdown-link>
                        </form>

                    </x-slot>
                </x-dropdown>
            </div>

            {{-- HAMBURGER --}}
            <div class="-me-2 flex items-center sm:hidden"> {{-- Mobile hamburger button (visible only on mobile) --}}
                <button @click="open = !open" class="p-2 text-slate-400 hover:text-white"> {{-- Hamburger toggle button dengan Alpine.js --}}
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"> {{-- Hamburger/close icon SVG --}}
                        <path :class="{'hidden': open, 'inline-flex': !open}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" {{-- Hamburger icon path (3 lines) --}}
                            d="M4 6h16M4 12h16M4 18h16" /> {{-- Hamburger icon d attribute --}}
                        <path :class="{'hidden': !open, 'inline-flex': open}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" {{-- Close (X) icon path --}}
                            d="M6 18L18 6M6 6l12 12" /> {{-- Close icon d attribute --}}
                    </svg>
                </button>
            </div>

        </div>
    </div>

    {{-- MOBILE MENU --}}
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden bg-[#020617] border-b border-white/[0.05]"> {{-- Mobile menu container dengan Alpine.js conditional rendering --}}

        <div class="pt-2 pb-3 space-y-1"> {{-- Mobile menu links container --}}

            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"> {{-- Mobile dashboard link component --}}
                Dashboard {{-- Dashboard link text --}}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('about')" :active="request()->routeIs('about')"> {{-- Mobile about link component --}}
                About {{-- About link text --}}
            </x-responsive-nav-link>

            {{-- SEMUA USER --}}
            <x-responsive-nav-link :href="route('product.index')" :active="request()->routeIs('product.*')"> {{-- Mobile product link - accessible to all users --}}
                Product {{-- Product link text --}}
            </x-responsive-nav-link>

            {{-- ADMIN ONLY MOBILE --}}
            @if(Auth::user()->role === 'admin') {{-- Blade directive untuk cek apakah user adalah admin --}}

                <x-responsive-nav-link :href="route('category.index')" :active="request()->routeIs('category.*')"> {{-- Mobile category link - admin only --}}
                    Category {{-- Category link text --}}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('todo.index')" :active="request()->routeIs('todo.*')"> {{-- Mobile todo link - admin only --}}
                    Todo {{-- Todo link text --}}
                </x-responsive-nav-link>

            @endif {{-- Tutup admin check --}}

        </div>

    </div>
</nav> {{-- Tutup nav tag --}}