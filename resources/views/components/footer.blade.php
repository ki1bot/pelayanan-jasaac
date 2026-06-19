<footer class="mt-12 border-t border-green-200 bg-white dark:border-slate-800 dark:bg-slate-950">
    <div class="relative overflow-hidden">
        <div class="absolute left-0 top-0 h-40 w-40 rounded-full bg-green-200/50 blur-3xl dark:bg-green-600/10"></div>
        <div class="absolute right-0 bottom-0 h-52 w-52 rounded-full bg-green-100/60 blur-3xl dark:bg-green-500/10"></div>

        <div class="relative px-4 py-10 md:px-8">
            <div class="grid gap-8 lg:grid-cols-[1.35fr_0.75fr_0.75fr_0.9fr]">
                <div>
                    <a href="{{ route('beranda') }}" class="inline-flex items-center gap-3">
                        <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-green-600 text-sm font-black text-white shadow-lg shadow-green-600/20">
                            AC
                        </span>

                        <span class="text-2xl font-black tracking-tight text-slate-950 dark:text-white">
                            JasaAC
                        </span>
                    </a>

                    <p class="mt-4 max-w-xl text-sm leading-7 text-slate-600 dark:text-slate-300">
                        Website pelayanan jasa AC untuk pembelian AC, penjualan AC bekas, service AC, pembayaran, keranjang, dan laporan transaksi.
                    </p>

                    <div class="mt-5 inline-flex items-center gap-2 rounded-full border border-green-200 bg-green-50 px-4 py-2 text-sm font-bold text-green-700 dark:border-green-900 dark:bg-green-950 dark:text-green-300">
                        <span class="h-2 w-2 rounded-full bg-green-600"></span>
                        Pelayanan Cepat dan Terintegrasi
                    </div>
                </div>

                <div>
                    <h3 class="text-sm font-black uppercase tracking-[0.18em] text-slate-950 dark:text-white">
                        Menu
                    </h3>

                    <div class="mt-5 grid gap-3">
                        <a href="{{ route('beranda') }}" class="text-sm font-medium text-slate-600 transition hover:translate-x-1 hover:text-green-600 dark:text-slate-300 dark:hover:text-green-400">
                            Beranda
                        </a>

                        <a href="{{ route('harga.beli') }}" class="text-sm font-medium text-slate-600 transition hover:translate-x-1 hover:text-green-600 dark:text-slate-300 dark:hover:text-green-400">
                            Harga Beli AC
                        </a>

                        <a href="{{ route('harga.jual') }}" class="text-sm font-medium text-slate-600 transition hover:translate-x-1 hover:text-green-600 dark:text-slate-300 dark:hover:text-green-400">
                            Harga Jual AC
                        </a>

                        <a href="{{ route('harga.service') }}" class="text-sm font-medium text-slate-600 transition hover:translate-x-1 hover:text-green-600 dark:text-slate-300 dark:hover:text-green-400">
                            Harga Service AC
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="text-sm font-black uppercase tracking-[0.18em] text-slate-950 dark:text-white">
                        Layanan
                    </h3>

                    <div class="mt-5 grid gap-3">
                        <a href="{{ route('beli.form') }}" class="text-sm font-medium text-slate-600 transition hover:translate-x-1 hover:text-green-600 dark:text-slate-300 dark:hover:text-green-400">
                            Pesan Beli AC
                        </a>

                        <a href="{{ route('jual.form') }}" class="text-sm font-medium text-slate-600 transition hover:translate-x-1 hover:text-green-600 dark:text-slate-300 dark:hover:text-green-400">
                            Pesan Jual AC
                        </a>

                        <a href="{{ route('service.form') }}" class="text-sm font-medium text-slate-600 transition hover:translate-x-1 hover:text-green-600 dark:text-slate-300 dark:hover:text-green-400">
                            Pesan Service AC
                        </a>

                        <a href="{{ route('keranjang.index') }}" class="text-sm font-medium text-slate-600 transition hover:translate-x-1 hover:text-green-600 dark:text-slate-300 dark:hover:text-green-400">
                            Keranjang
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="text-sm font-black uppercase tracking-[0.18em] text-slate-950 dark:text-white">
                        Informasi
                    </h3>

                    <div class="mt-5 grid gap-3">
                        <div class="rounded-2xl border border-green-200 bg-green-50 p-4 dark:border-slate-800 dark:bg-slate-900">
                            <p class="text-xs font-bold uppercase tracking-widest text-green-700 dark:text-green-300">
                                Lokasi
                            </p>

                            <p class="mt-1 text-sm font-bold text-slate-900 dark:text-white">
                                Jakarta Timur
                            </p>
                        </div>

                        <div class="rounded-2xl border border-green-200 bg-green-50 p-4 dark:border-slate-800 dark:bg-slate-900">
                            <p class="text-xs font-bold uppercase tracking-widest text-green-700 dark:text-green-300">
                                Biaya Jarak
                            </p>

                            <p class="mt-1 text-sm font-bold text-slate-900 dark:text-white">
                                Rp 5.000 / KM
                            </p>
                        </div>

                        <a href="{{ route('kontak') }}" class="inline-flex items-center justify-center rounded-2xl bg-green-600 px-5 py-3 text-sm font-bold text-white transition hover:bg-green-700">
                            Hubungi Kami
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-10 flex flex-col justify-between gap-3 border-t border-green-200 pt-5 text-sm text-slate-500 dark:border-slate-800 dark:text-slate-400 md:flex-row md:items-center">
                <p>
                    © {{ date('Y') }} JasaAC. Semua hak dilindungi.
                </p>

                <p>
                    Project Website Pelayanan Jasa AC.
                </p>
            </div>
        </div>
    </div>
</footer>
