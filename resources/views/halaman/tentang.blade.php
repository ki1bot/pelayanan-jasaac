@extends('utama')

@section('content')
    <section class="rounded-3xl bg-white p-6 shadow-sm dark:bg-slate-900 md:p-8">
        <p class="text-sm font-semibold uppercase tracking-[0.25em] text-blue-600 dark:text-blue-400">
            Tentang
        </p>

        <h1 class="mt-4 text-3xl font-bold md:text-5xl">
            Tentang Pelayanan Jasa AC
        </h1>

        <p class="mt-5 max-w-4xl leading-relaxed text-slate-600 dark:text-slate-300">
            Website Pelayanan Jasa AC dibuat untuk membantu pengguna melakukan pembelian AC, penjualan AC, permintaan service AC, pembayaran, dan melihat laporan transaksi secara lebih mudah.
        </p>

        <div class="mt-8 grid gap-6 md:grid-cols-3">
            <div class="rounded-3xl border border-slate-200 p-6 dark:border-slate-800">
                <h2 class="text-xl font-bold">Beli AC</h2>
                <p class="mt-3 text-slate-600 dark:text-slate-300">
                    Pengguna dapat memilih merk AC berdasarkan daftar harga beli yang tersedia.
                </p>
            </div>

            <div class="rounded-3xl border border-slate-200 p-6 dark:border-slate-800">
                <h2 class="text-xl font-bold">Jual AC</h2>
                <p class="mt-3 text-slate-600 dark:text-slate-300">
                    Pengguna dapat menjual AC dan sistem akan menghitung total berdasarkan harga dan jarak.
                </p>
            </div>

            <div class="rounded-3xl border border-slate-200 p-6 dark:border-slate-800">
                <h2 class="text-xl font-bold">Service AC</h2>
                <p class="mt-3 text-slate-600 dark:text-slate-300">
                    Pengguna dapat melakukan pemesanan service AC sesuai jenis layanan yang tersedia.
                </p>
            </div>
        </div>
    </section>
@endsection
