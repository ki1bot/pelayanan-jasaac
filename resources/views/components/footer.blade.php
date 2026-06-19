<footer class="mt-10 border-t border-slate-200 bg-white dark:border-slate-800 dark:bg-slate-900">
    <div class="flex w-full flex-col gap-5 px-4 py-6 md:px-8 lg:flex-row lg:items-center lg:justify-between">
        <a href="{{ route('beranda') }}" class="flex items-center gap-3">
            <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-green-600 text-sm font-black text-white shadow-lg shadow-green-600/20">
                AC
            </span>

            <div>
                <h2 class="text-xl font-black tracking-tight text-slate-950 dark:text-white">
                    JasaAC
                </h2>

                <p class="text-xs font-medium text-slate-500 dark:text-slate-400">
                    Pelayanan Jasa AC Terintegrasi
                </p>
            </div>
        </a>

        <nav class="flex flex-wrap items-center gap-x-6 gap-y-3 text-sm font-semibold">
            <a href="{{ route('beranda') }}" class="text-slate-600 transition hover:text-green-600 dark:text-slate-300 dark:hover:text-green-400">
                Beranda
            </a>

            <a href="{{ route('harga.beli') }}" class="text-slate-600 transition hover:text-green-600 dark:text-slate-300 dark:hover:text-green-400">
                Harga Beli
            </a>

            <a href="{{ route('harga.jual') }}" class="text-slate-600 transition hover:text-green-600 dark:text-slate-300 dark:hover:text-green-400">
                Harga Jual
            </a>

            <a href="{{ route('harga.service') }}" class="text-slate-600 transition hover:text-green-600 dark:text-slate-300 dark:hover:text-green-400">
                Harga Service
            </a>

            <a href="{{ route('beli.form') }}" class="text-slate-600 transition hover:text-green-600 dark:text-slate-300 dark:hover:text-green-400">
                Beli AC
            </a>

            <a href="{{ route('jual.form') }}" class="text-slate-600 transition hover:text-green-600 dark:text-slate-300 dark:hover:text-green-400">
                Jual AC
            </a>

            <a href="{{ route('service.form') }}" class="text-slate-600 transition hover:text-green-600 dark:text-slate-300 dark:hover:text-green-400">
                Service AC
            </a>
        </nav>

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
            <div class="rounded-2xl border border-green-200 bg-green-50 px-4 py-2 text-sm font-bold text-green-700 dark:border-green-900 dark:bg-green-950 dark:text-green-300">
                Rp 5.000 / KM
            </div>

            <a href="{{ route('kontak') }}" class="rounded-2xl bg-green-600 px-5 py-2.5 text-center text-sm font-bold text-white transition hover:bg-green-700">
                Hubungi Kami
            </a>
        </div>
    </div>

    <div class="border-t border-slate-200 px-4 py-4 dark:border-slate-800 md:px-8">
        <div class="flex flex-col justify-between gap-2 text-sm text-slate-500 dark:text-slate-400 md:flex-row md:items-center">
            <p>
                © {{ date('Y') }} JasaAC. Semua hak dilindungi.
            </p>

            <p>
                Project Website Pelayanan Jasa AC.
            </p>
        </div>
    </div>
</footer>
