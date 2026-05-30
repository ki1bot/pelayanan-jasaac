@extends('utama')

@section('content')
    <section class="w-full">
        <div class="grid gap-6 lg:grid-cols-[1.2fr_0.8fr]">
            <div class="rounded-3xl bg-white p-8 shadow-sm dark:bg-slate-900 md:p-10">
                <p class="text-sm font-semibold uppercase tracking-[0.25em] text-blue-600 dark:text-blue-400">
                    Pelayanan Jasa AC
                </p>

                <h1 class="mt-5 max-w-4xl text-4xl font-bold leading-tight md:text-5xl">
                    Solusi Beli, Jual, dan Service AC dalam Satu Website
                </h1>

                <p class="mt-5 max-w-3xl leading-relaxed text-slate-600 dark:text-slate-300">
                    Website pelayanan jasa AC untuk pembelian AC, penjualan AC bekas, service AC, pembayaran, keranjang, dan laporan transaksi.
                </p>

                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <a href="{{ route('beli.form') }}" class="rounded-2xl bg-blue-600 px-6 py-3 text-center text-sm font-semibold text-white hover:bg-blue-700">
                        Pesan Beli AC
                    </a>

                    <a href="{{ route('jual.form') }}" class="rounded-2xl bg-slate-900 px-6 py-3 text-center text-sm font-semibold text-white hover:bg-slate-800 dark:bg-white dark:text-slate-900">
                        Pesan Jual AC
                    </a>

                    <a href="{{ route('service.form') }}" class="rounded-2xl border border-slate-300 px-6 py-3 text-center text-sm font-semibold hover:bg-slate-100 dark:border-slate-700 dark:hover:bg-slate-800">
                        Pesan Service AC
                    </a>
                </div>
            </div>

            <div class="rounded-3xl bg-blue-600 p-8 text-white shadow-sm md:p-10">
                <h2 class="text-2xl font-bold">
                    Pusat Admin JasaAC
                </h2>

                <p class="mt-4 leading-relaxed text-blue-100">
                    Lokasi pusat service berada di {{ $pusatService->lokasi_pusat ?? 'Jakarta' }}. Biaya jarak dihitung dari input jarak kilometer pelanggan menuju pusat admin.
                </p>

                <div class="mt-6 rounded-2xl bg-white/10 p-6">
                    <p class="text-sm text-blue-100">Biaya Jarak</p>
                    <p class="mt-3 text-3xl font-bold">Rp 5.000 / KM</p>
                </div>
            </div>
        </div>

        <div class="mt-6 grid gap-6 md:grid-cols-3 xl:grid-cols-6">
            <div class="rounded-3xl bg-white p-6 shadow-sm dark:bg-slate-900">
                <p class="text-sm text-slate-500">Beli AC</p>
                <p class="mt-3 text-3xl font-bold">{{ $jumlahBeli }}</p>
            </div>

            <div class="rounded-3xl bg-white p-6 shadow-sm dark:bg-slate-900">
                <p class="text-sm text-slate-500">Jual AC</p>
                <p class="mt-3 text-3xl font-bold">{{ $jumlahJual }}</p>
            </div>

            <div class="rounded-3xl bg-white p-6 shadow-sm dark:bg-slate-900">
                <p class="text-sm text-slate-500">Service AC</p>
                <p class="mt-3 text-3xl font-bold">{{ $jumlahService }}</p>
            </div>

            <div class="rounded-3xl bg-white p-6 shadow-sm dark:bg-slate-900">
                <p class="text-sm text-slate-500">Keranjang</p>
                <p class="mt-3 text-3xl font-bold">{{ $jumlahKeranjang }}</p>
            </div>

            <div class="rounded-3xl bg-white p-6 shadow-sm dark:bg-slate-900">
                <p class="text-sm text-slate-500">Pesanan</p>
                <p class="mt-3 text-3xl font-bold">{{ $jumlahPesanan }}</p>
            </div>

            <div class="rounded-3xl bg-white p-6 shadow-sm dark:bg-slate-900">
                <p class="text-sm text-slate-500">Pembayaran</p>
                <p class="mt-3 text-3xl font-bold">{{ $jumlahPembayaran }}</p>
            </div>
        </div>

        <div class="mt-6 grid gap-6 lg:grid-cols-[1.2fr_0.8fr]">
            <div class="rounded-3xl bg-white p-6 shadow-sm dark:bg-slate-900">
                <h2 class="text-xl font-bold">Ringkasan Transaksi</h2>

                <div class="mt-6 space-y-6">
                    <div>
                        <div class="mb-2 flex items-center justify-between text-sm">
                            <span>Beli AC</span>
                            <span>{{ $jumlahBeli }} data</span>
                        </div>
                        <div class="h-4 overflow-hidden rounded-full bg-slate-200 dark:bg-slate-800">
                            <div class="h-full rounded-full bg-blue-600" style="width: {{ $persenBeli }}%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="mb-2 flex items-center justify-between text-sm">
                            <span>Jual AC</span>
                            <span>{{ $jumlahJual }} data</span>
                        </div>
                        <div class="h-4 overflow-hidden rounded-full bg-slate-200 dark:bg-slate-800">
                            <div class="h-full rounded-full bg-slate-900 dark:bg-white" style="width: {{ $persenJual }}%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="mb-2 flex items-center justify-between text-sm">
                            <span>Service AC</span>
                            <span>{{ $jumlahService }} data</span>
                        </div>
                        <div class="h-4 overflow-hidden rounded-full bg-slate-200 dark:bg-slate-800">
                            <div class="h-full rounded-full bg-green-600" style="width: {{ $persenService }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="rounded-3xl bg-white p-6 shadow-sm dark:bg-slate-900">
                <h2 class="text-xl font-bold">Total Transaksi</h2>

                <div class="mt-6 space-y-4">
                    <div class="rounded-2xl border border-slate-200 p-4 dark:border-slate-800">
                        <p class="text-sm text-slate-500">Total Beli AC</p>
                        <p class="mt-2 text-xl font-bold">Rp {{ number_format($totalBeli, 0, ',', '.') }}</p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 p-4 dark:border-slate-800">
                        <p class="text-sm text-slate-500">Total Jual AC</p>
                        <p class="mt-2 text-xl font-bold">Rp {{ number_format($totalJual, 0, ',', '.') }}</p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 p-4 dark:border-slate-800">
                        <p class="text-sm text-slate-500">Total Service AC</p>
                        <p class="mt-2 text-xl font-bold">Rp {{ number_format($totalService, 0, ',', '.') }}</p>
                    </div>

                    <div class="rounded-2xl bg-blue-600 p-4 text-white">
                        <p class="text-sm text-blue-100">Total Semua</p>
                        <p class="mt-2 text-2xl font-bold">Rp {{ number_format($totalSemua, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
