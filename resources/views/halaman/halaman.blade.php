@extends('utama')

@section('content')
    @php
        $totalTransaksi = $jumlahBeli + $jumlahJual + $jumlahService;

        $statistik = [
            ['label' => 'Beli AC', 'jumlah' => $jumlahBeli, 'route' => route('beli.form'), 'kode' => 'BA'],
            ['label' => 'Jual AC', 'jumlah' => $jumlahJual, 'route' => route('jual.form'), 'kode' => 'JA'],
            ['label' => 'Service AC', 'jumlah' => $jumlahService, 'route' => route('service.form'), 'kode' => 'SA'],
            ['label' => 'Keranjang', 'jumlah' => $jumlahKeranjang, 'route' => route('keranjang.index'), 'kode' => 'KR'],
            ['label' => 'Pesanan', 'jumlah' => $jumlahPesanan, 'route' => route('laporan.index'), 'kode' => 'PS'],
            ['label' => 'Pembayaran', 'jumlah' => $jumlahPembayaran, 'route' => route('laporan.index'), 'kode' => 'PB'],
        ];

        $ringkasan = [
            ['label' => 'Beli AC', 'jumlah' => $jumlahBeli, 'persen' => $persenBeli, 'total' => $totalBeli],
            ['label' => 'Jual AC', 'jumlah' => $jumlahJual, 'persen' => $persenJual, 'total' => $totalJual],
            ['label' => 'Service AC', 'jumlah' => $jumlahService, 'persen' => $persenService, 'total' => $totalService],
        ];
    @endphp

    <section class="grid h-auto gap-5 lg:h-[calc(100vh-8rem)] lg:grid-rows-[0.95fr_1.05fr] lg:overflow-hidden">
        <div class="grid min-h-0 gap-5 xl:grid-cols-[1.45fr_0.55fr]">
            <div class="relative overflow-hidden rounded-[2rem] border border-green-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900 md:p-8">
                <div class="absolute -right-20 -top-24 h-64 w-64 rounded-full bg-green-200/60 blur-3xl dark:bg-green-500/15"></div>
                <div class="absolute -bottom-28 left-12 h-64 w-64 rounded-full bg-green-100/80 blur-3xl dark:bg-green-700/10"></div>

                <div class="relative flex h-full flex-col justify-between gap-6">
                    <div>
                        <div class="inline-flex items-center gap-2 rounded-full border border-green-200 bg-green-50 px-4 py-2 text-xs font-black uppercase tracking-[0.22em] text-green-700 dark:border-green-900 dark:bg-green-950 dark:text-green-300">
                            <span class="h-2 w-2 rounded-full bg-green-600"></span>
                            Pelayanan Jasa AC
                        </div>

                        <h1 class="mt-5 max-w-5xl text-4xl font-black leading-tight text-slate-950 dark:text-white md:text-5xl">
                            Dashboard Pelayanan Beli, Jual, dan Service AC
                        </h1>

                        <p class="mt-4 max-w-3xl text-sm leading-relaxed text-slate-600 dark:text-slate-300 md:text-base">
                            Pantau ringkasan transaksi, total pembayaran, keranjang, laporan, dan layanan AC dalam satu halaman dashboard yang lebih padat.
                        </p>
                    </div>

                    <div class="grid gap-3 sm:grid-cols-3">
                        <a href="{{ route('beli.form') }}" class="rounded-2xl bg-green-600 px-5 py-3 text-center text-sm font-black text-white hover:bg-green-700">
                            Pesan Beli AC
                        </a>

                        <a href="{{ route('jual.form') }}" class="rounded-2xl border border-green-300 bg-white px-5 py-3 text-center text-sm font-black text-green-800 hover:bg-green-50 dark:border-green-800 dark:bg-slate-950 dark:text-green-300 dark:hover:bg-slate-800">
                            Pesan Jual AC
                        </a>

                        <a href="{{ route('service.form') }}" class="rounded-2xl border border-green-300 bg-white px-5 py-3 text-center text-sm font-black text-green-800 hover:bg-green-50 dark:border-green-800 dark:bg-slate-950 dark:text-green-300 dark:hover:bg-slate-800">
                            Pesan Service AC
                        </a>
                    </div>
                </div>
            </div>

            <div class="rounded-[2rem] bg-green-600 p-6 text-white shadow-sm md:p-8">
                <div class="flex h-full flex-col justify-between gap-6">
                    <div>
                        <p class="text-xs font-black uppercase tracking-[0.22em] text-green-100">
                            Pusat Admin
                        </p>

                        <h2 class="mt-3 text-3xl font-black">
                            JasaAC Center
                        </h2>

                        <p class="mt-3 text-sm leading-relaxed text-green-50">
                            {{ $pusatService->lokasi_pusat ?? 'Jakarta' }}
                        </p>
                    </div>

                    <div class="rounded-3xl bg-white/15 p-5 backdrop-blur">
                        <p class="text-sm text-green-100">Biaya Jarak</p>
                        <p class="mt-2 text-4xl font-black">Rp 5.000</p>
                        <p class="mt-1 text-sm text-green-100">per kilometer</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid min-h-0 gap-5 xl:grid-cols-[0.85fr_0.75fr_0.65fr]">
            <div class="grid min-h-0 grid-cols-2 gap-3 md:grid-cols-3 xl:grid-cols-2">
                @foreach($statistik as $item)
                    <a href="{{ $item['route'] }}" class="group rounded-3xl border border-green-200 bg-white p-4 shadow-sm transition hover:-translate-y-1 hover:border-green-400 dark:border-slate-800 dark:bg-slate-900 dark:hover:border-green-700">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <p class="text-xs font-bold text-slate-500 dark:text-slate-400">{{ $item['label'] }}</p>
                                <p class="mt-2 text-3xl font-black text-slate-950 dark:text-white">{{ $item['jumlah'] }}</p>
                            </div>

                            <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-green-50 text-xs font-black text-green-700 ring-1 ring-green-200 group-hover:bg-green-600 group-hover:text-white dark:bg-green-950 dark:text-green-300 dark:ring-green-900">
                                {{ $item['kode'] }}
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="rounded-[2rem] border border-green-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-xs font-black uppercase tracking-[0.18em] text-green-700 dark:text-green-300">
                            Statistik
                        </p>
                        <h2 class="mt-1 text-xl font-black text-slate-950 dark:text-white">
                            Ringkasan Transaksi
                        </h2>
                    </div>

                    <a href="{{ route('laporan.index') }}" class="rounded-xl border border-green-300 px-4 py-2 text-xs font-black text-green-800 hover:bg-green-50 dark:border-green-800 dark:text-green-300 dark:hover:bg-slate-800">
                        Laporan
                    </a>
                </div>

                <div class="mt-5 space-y-4">
                    @foreach($ringkasan as $item)
                        <div>
                            <div class="mb-2 flex items-center justify-between gap-3 text-sm">
                                <div>
                                    <p class="font-black text-slate-900 dark:text-white">{{ $item['label'] }}</p>
                                    <p class="text-xs text-slate-500 dark:text-slate-400">{{ $item['jumlah'] }} data</p>
                                </div>

                                <p class="text-xs font-black text-green-700 dark:text-green-300">
                                    {{ $item['persen'] }}%
                                </p>
                            </div>

                            <div class="h-3 overflow-hidden rounded-full bg-green-100 dark:bg-slate-800">
                                <div class="h-full rounded-full bg-green-600" style="width: {{ $item['persen'] }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-5 rounded-3xl bg-green-50 p-4 dark:bg-green-950/40">
                    <p class="text-xs font-bold uppercase tracking-widest text-green-700 dark:text-green-300">Total Data Layanan</p>
                    <p class="mt-1 text-3xl font-black text-green-900 dark:text-green-100">{{ $totalTransaksi }}</p>
                </div>
            </div>

            <div class="rounded-[2rem] border border-green-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <p class="text-xs font-black uppercase tracking-[0.18em] text-green-700 dark:text-green-300">
                    Keuangan
                </p>

                <h2 class="mt-1 text-xl font-black text-slate-950 dark:text-white">
                    Total Transaksi
                </h2>

                <div class="mt-5 space-y-3">
                    <div class="rounded-2xl border border-green-200 p-4 dark:border-slate-800">
                        <p class="text-xs font-bold text-slate-500 dark:text-slate-400">Beli AC</p>
                        <p class="mt-1 text-xl font-black text-slate-950 dark:text-white">Rp {{ number_format($totalBeli, 0, ',', '.') }}</p>
                    </div>

                    <div class="rounded-2xl border border-green-200 p-4 dark:border-slate-800">
                        <p class="text-xs font-bold text-slate-500 dark:text-slate-400">Jual AC</p>
                        <p class="mt-1 text-xl font-black text-slate-950 dark:text-white">Rp {{ number_format($totalJual, 0, ',', '.') }}</p>
                    </div>

                    <div class="rounded-2xl border border-green-200 p-4 dark:border-slate-800">
                        <p class="text-xs font-bold text-slate-500 dark:text-slate-400">Service AC</p>
                        <p class="mt-1 text-xl font-black text-slate-950 dark:text-white">Rp {{ number_format($totalService, 0, ',', '.') }}</p>
                    </div>

                    <div class="rounded-2xl bg-green-600 p-4 text-white">
                        <p class="text-xs font-bold text-green-100">Total Semua</p>
                        <p class="mt-1 text-2xl font-black">Rp {{ number_format($totalSemua, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
