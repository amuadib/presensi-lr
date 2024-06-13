<nav x-cloak x-data="{ open: false }"
    class="flex relative w-full items-center justify-between px-6 h-16 bg-white text-gray-700 border-b border-gray-200 z-10">
    <div class="flex items-center">
        <button class="mr-2" aria-label="Open Menu" @click="open = !open">
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                viewBox="0 0 24 24" class="w-8 h-8">
                <path d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
        <img src="/logo-sm.png" alt="Logo" class="h-auto w-auto" />
    </div>
    <div class="flex items-center">
        <div class="hidden md:block md:flex md:justify-between md:bg-transparent">
            <x-nav-link :href="route('riwayat')" :active="request()->routeIs('riwayat')">
                <i class="fa fa-history"></i>
            </x-nav-link>
        </div>
    </div>

    <div @keydown.esc="open = false" x-show="open" class="z-10 fixed inset-0 transition-opacity">
        <div @click="open = !open" class="absolute inset-0 bg-black opacity-50" tabindex="0"></div>
    </div>

    <aside
        class="transform top-0 left-0 w-64 bg-white fixed h-full overflow-auto ease-in-out transition-all duration-300 z-30"
        :class="open ? 'translate-x-0' : '-translate-x-full'">
        <span @click="open = !open" class="flex w-full items-center p-4 border-b">
            <img src="/logo-sm.png" alt="Logo" class="h-auto w-auto" />
        </span>

        <x-nav-link :href="route('dashboard')" @click="open = !open"
            class="flex items-center p-4 hover:bg-indigo-500 hover:text-white">
            <span class="mr-2">
                <i class="fa fa-home"></i>
            </span>
            <span>Home</span>
        </x-nav-link>

        @can('Administrator')
            <x-nav-link :href="route('riwayat')" @click="open = !open"
                class="flex items-center p-4 hover:bg-indigo-500 hover:text-white">
                <span class="mr-2">
                    <i class="fa fa-history"></i>
                </span>
                <span> {{ __('History') }}</span>
            </x-nav-link>
            <x-nav-link :href="route('rekap')" @click="open = !open"
                class="flex items-center p-4 hover:bg-indigo-500 hover:text-white">
                <span class="mr-2">
                    <i class="fa fa-calendar-check"></i>
                </span>
                <span>Rekap</span>
            </x-nav-link>
            {{-- <x-nav-link :href="route('pembagian')" @click="open = !open"
                class="flex items-center p-4 hover:bg-indigo-500 hover:text-white">
                <span class="mr-2">
                    <i class="fa fa-map-signs"></i>
                </span>
                <span>Pembagian Jam Kerja</span>
            </x-nav-link> --}}
            @can('Admin')
                <x-nav-link :href="route('tunjangan')" @click="open = !open"
                    class="flex items-center p-4 hover:bg-indigo-500 hover:text-white">
                    <span class="mr-2">
                        <i class="fa fa-money-bill-alt"></i>
                    </span>
                    <span>Setup Tunjangan</span>
                </x-nav-link>
                <x-nav-link :href="route('unit')" @click="open = !open"
                    class="flex items-center p-4 hover:bg-indigo-500 hover:text-white">
                    <span class="mr-2">
                        <i class="fa fa-briefcase"></i>
                    </span>
                    <span>Unit Kerja</span>
                </x-nav-link>
                <x-nav-link :href="route('jam')" @click="open = !open"
                    class="flex items-center p-4 hover:bg-indigo-500 hover:text-white">
                    <span class="mr-2">
                        <i class="fa fa-clock"></i>
                    </span>
                    <span>Jam Kerja</span>
                </x-nav-link>
                <x-nav-link :href="route('lokasi')" @click="open = !open"
                    class="flex items-center p-4 hover:bg-indigo-500 hover:text-white">
                    <span class="mr-2">
                        <i class="fa fa-map-marker-alt"></i>
                    </span>
                    <span>Lokasi</span>
                </x-nav-link>
            @endcan
            <x-nav-link :href="route('pengguna')" @click="open = !open"
                class="flex items-center p-4 hover:bg-indigo-500 hover:text-white">
                <span class="mr-2">
                    <i class="fa fa-users"></i>
                </span>
                <span>Pengguna</span>
            </x-nav-link>
        @else
            <x-nav-link :href="route('riwayat')" @click="open = !open"
                class="flex items-center p-4 hover:bg-indigo-500 hover:text-white">
                <span class="mr-2">
                    <i class="fa fa-history"></i>
                </span>
                <span> {{ __('History') }}</span>
            </x-nav-link>
        @endcan
        <x-nav-link :href="route('profile.show')" @click="open = !open"
            class="flex items-center p-4 hover:bg-indigo-500 hover:text-white">
            <span class="mr-2">
                <i class="fa fa-user"></i>
            </span>
            <span> {{ __('Profile') }}</span>
        </x-nav-link>


        <div class="fixed bottom-0 w-full">
            @if (Auth::user()->isImpersonating())
                <a href="{{ route('user.loginAs.stop') }}"
                    class="flex items-center p-4 text-white bg-green-600 hover:bg-green-700 hover:text-white">
                    <span class="mr-2">
                        <i class="fa fa-user-secret"></i>
                    </span>
                    <span> Kembali</span>
                </a>
            @endif
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ url('logout') }}"
                    onclick="event.preventDefault();
                            this.closest('form').submit();"
                    class="flex items-center p-4 text-white bg-blue-500 hover:bg-red-600 w-full cursor-pointer">
                    <span class="mr-2">
                        <i class="fa fa-door-open"></i>
                    </span>
                    <span>
                        {{ __('Log Out') }}</span>
                </a>
            </form>
        </div>
    </aside>
</nav>
