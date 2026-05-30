<header class="sticky top-0 z-50 w-full border-b border-slate-200 bg-white dark:border-slate-800 dark:bg-slate-900">
    <nav class="flex w-full items-center justify-between px-4 py-3 md:px-8">
        <button id="sidebarToggle" type="button" class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-300 bg-white text-slate-800 transition hover:bg-slate-100 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100 dark:hover:bg-slate-800">
            <svg id="iconMenu" xmlns="http://www.w3.org/2000/svg" class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>

            <svg id="iconClose" xmlns="http://www.w3.org/2000/svg" class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <div class="flex items-center gap-3">
            <button id="themeToggle" type="button" class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-300 bg-white text-slate-800 transition hover:bg-slate-100 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100 dark:hover:bg-slate-800">
                <svg id="iconMoon" xmlns="http://www.w3.org/2000/svg" class="block h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12.79A9 9 0 1111.21 3A7 7 0 0021 12.79z"/>
                </svg>

                <svg id="iconSun" xmlns="http://www.w3.org/2000/svg" class="hidden h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m8.66-13.66l-.7.7M4.04 19.96l-.7.7M21 12h-1M4 12H3m16.96 7.96l-.7-.7M4.04 4.04l-.7-.7M12 7a5 5 0 100 10 5 5 0 000-10z"/>
                </svg>
            </button>

            @auth
                <div class="relative">
                    <button id="profileToggle" type="button" class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-600 text-sm font-bold text-white">
                        {{ strtoupper(substr(auth()->user()->nama ?? auth()->user()->username, 0, 1)) }}
                    </button>

                    <div id="profileMenu" class="absolute right-0 mt-3 hidden w-72 rounded-2xl border border-slate-200 bg-white p-4 shadow-xl dark:border-slate-800 dark:bg-slate-900">
                        <div class="mb-4 border-b border-slate-200 pb-3 dark:border-slate-800">
                            <p class="text-sm font-semibold">{{ auth()->user()->nama }}</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400">{{ auth()->user()->role }}</p>
                        </div>

                        <form action="{{ route('password.update') }}" method="POST" class="space-y-3">
                            @csrf
                            @method('PUT')

                            <div class="relative">
                                <input type="password" name="password_lama" placeholder="Password lama" class="toggle-input w-full rounded-xl border border-slate-300 bg-white px-3 py-2 pr-10 text-sm dark:border-slate-700 dark:bg-slate-950">
                                <button type="button" class="toggle-password absolute right-3 top-2 text-sm font-semibold">👁</button>
                            </div>

                            <div class="relative">
                                <input type="password" name="password" placeholder="Password baru" class="toggle-input w-full rounded-xl border border-slate-300 bg-white px-3 py-2 pr-10 text-sm dark:border-slate-700 dark:bg-slate-950">
                                <button type="button" class="toggle-password absolute right-3 top-2 text-sm font-semibold">👁</button>
                            </div>

                            <div class="relative">
                                <input type="password" name="password_confirmation" placeholder="Konfirmasi password" class="toggle-input w-full rounded-xl border border-slate-300 bg-white px-3 py-2 pr-10 text-sm dark:border-slate-700 dark:bg-slate-950">
                                <button type="button" class="toggle-password absolute right-3 top-2 text-sm font-semibold">👁</button>
                            </div>

                            <button type="submit" class="w-full rounded-xl bg-blue-600 px-3 py-2 text-sm font-semibold text-white hover:bg-blue-700">
                                Ubah Password
                            </button>
                        </form>

                        <form action="{{ route('logout') }}" method="POST" class="mt-3">
                            @csrf
                            <button type="submit" class="w-full rounded-xl bg-red-600 px-3 py-2 text-sm font-semibold text-white hover:bg-red-700">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="rounded-xl bg-blue-600 px-5 py-2 text-sm font-semibold text-white hover:bg-blue-700">
                    Login
                </a>
            @endauth
        </div>
    </nav>
</header>
