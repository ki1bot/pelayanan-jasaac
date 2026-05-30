<aside id="sidebar" class="fixed left-0 top-0 z-40 h-full w-72 -translate-x-full overflow-y-auto border-r border-slate-200 bg-white pt-20 shadow-xl transition-transform duration-300 dark:border-slate-800 dark:bg-slate-900">
    <div class="flex flex-col gap-2 px-4 pb-8">
        <a href="{{ route('beranda') }}" class="sidebar-link rounded-xl px-4 py-3 text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800">
            Beranda
        </a>

        <a href="{{ route('harga.beli') }}" class="sidebar-link rounded-xl px-4 py-3 text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800">
            Harga Beli AC
        </a>

        <a href="{{ route('harga.jual') }}" class="sidebar-link rounded-xl px-4 py-3 text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800">
            Harga Jual AC
        </a>

        <a href="{{ route('harga.service') }}" class="sidebar-link rounded-xl px-4 py-3 text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800">
            Harga Service AC
        </a>

        <a href="{{ route('beli.form') }}" class="sidebar-link rounded-xl px-4 py-3 text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800">
            Pesan Beli AC
        </a>

        <a href="{{ route('jual.form') }}" class="sidebar-link rounded-xl px-4 py-3 text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800">
            Pesan Jual AC
        </a>

        <a href="{{ route('service.form') }}" class="sidebar-link rounded-xl px-4 py-3 text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800">
            Pesan Service AC
        </a>

        <a href="{{ route('keranjang.index') }}" class="sidebar-link rounded-xl px-4 py-3 text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800">
            Keranjang
        </a>

        <a href="{{ route('laporan.index') }}" class="sidebar-link rounded-xl px-4 py-3 text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800">
            Laporan
        </a>

        <a href="{{ route('tentang') }}" class="sidebar-link rounded-xl px-4 py-3 text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800">
            Tentang
        </a>

        <a href="{{ route('kontak') }}" class="sidebar-link rounded-xl px-4 py-3 text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800">
            Kontak
        </a>

        @auth
            @if(auth()->user()->role === 'pemilik')
                <div class="my-3 border-t border-slate-200 dark:border-slate-800"></div>

                <p class="px-4 text-xs font-bold uppercase tracking-widest text-slate-500 dark:text-slate-400">
                    Admin Pemilik
                </p>

                <a href="{{ route('pemilik.crud.index', 'loginac') }}" class="sidebar-link rounded-xl px-4 py-3 text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800">
                    CRUD Login
                </a>

                <a href="{{ route('pemilik.crud.index', 'hubungikami') }}" class="sidebar-link rounded-xl px-4 py-3 text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800">
                    CRUD Hubungi Kami
                </a>

                <a href="{{ route('pemilik.crud.index', 'pusatservice') }}" class="sidebar-link rounded-xl px-4 py-3 text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800">
                    CRUD Pusat Service
                </a>

                <a href="{{ route('pemilik.crud.index', 'hargabeliac') }}" class="sidebar-link rounded-xl px-4 py-3 text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800">
                    CRUD Harga Beli
                </a>

                <a href="{{ route('pemilik.crud.index', 'hargajualac') }}" class="sidebar-link rounded-xl px-4 py-3 text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800">
                    CRUD Harga Jual
                </a>

                <a href="{{ route('pemilik.crud.index', 'hargaserviceac') }}" class="sidebar-link rounded-xl px-4 py-3 text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800">
                    CRUD Harga Service
                </a>

                <a href="{{ route('pemilik.crud.index', 'beliac') }}" class="sidebar-link rounded-xl px-4 py-3 text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800">
                    CRUD Beli AC
                </a>

                <a href="{{ route('pemilik.crud.index', 'jualac') }}" class="sidebar-link rounded-xl px-4 py-3 text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800">
                    CRUD Jual AC
                </a>

                <a href="{{ route('pemilik.crud.index', 'serviceac') }}" class="sidebar-link rounded-xl px-4 py-3 text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800">
                    CRUD Service AC
                </a>

                <a href="{{ route('pemilik.crud.index', 'pesanan') }}" class="sidebar-link rounded-xl px-4 py-3 text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800">
                    CRUD Pesanan
                </a>

                <a href="{{ route('pemilik.crud.index', 'pembayaran') }}" class="sidebar-link rounded-xl px-4 py-3 text-sm font-medium hover:bg-slate-100 dark:hover:bg-slate-800">
                    CRUD Pembayaran
                </a>
            @endif
        @endauth
    </div>
</aside>

<div id="overlay" class="fixed inset-0 z-30 hidden bg-black/40"></div>
