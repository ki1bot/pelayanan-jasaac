@extends('utama')

@section('content')
    <section class="grid gap-6 lg:grid-cols-[0.9fr_1.1fr]">
        <div class="rounded-3xl bg-white p-6 shadow-sm dark:bg-slate-900">
            <h1 class="text-2xl font-bold">Detail Pesanan</h1>

            <div class="mt-6 space-y-4">
                <div class="rounded-2xl border border-slate-200 p-4 dark:border-slate-800">
                    <p class="text-sm text-slate-500 dark:text-slate-400">Kode Pesanan</p>
                    <p class="mt-1 font-bold">{{ $pesanan->kode_pesanan }}</p>
                </div>

                <div class="rounded-2xl border border-slate-200 p-4 dark:border-slate-800">
                    <p class="text-sm text-slate-500 dark:text-slate-400">Total Harga</p>
                    <p class="mt-1 text-2xl font-bold text-blue-600 dark:text-blue-400">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</p>
                </div>

                <div class="rounded-2xl border border-slate-200 p-4 dark:border-slate-800">
                    <p class="text-sm text-slate-500 dark:text-slate-400">Status Pesanan</p>
                    <p class="mt-1 font-bold">{{ str_replace('_', ' ', ucfirst($pesanan->status)) }}</p>
                </div>

                @if($pembayaran)
                    <div class="rounded-2xl border border-slate-200 p-4 dark:border-slate-800">
                        <p class="text-sm text-slate-500 dark:text-slate-400">Status Pembayaran</p>
                        <p class="mt-1 font-bold">{{ ucfirst($pembayaran->status_pembayaran) }}</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="rounded-3xl bg-white p-6 shadow-sm dark:bg-slate-900">
            <h2 class="text-2xl font-bold">Pembayaran</h2>
            <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Pilih salah satu metode pembayaran lalu unggah bukti pembayaran.</p>

            <div class="mt-6 grid gap-4 sm:grid-cols-2">
                <div class="rounded-2xl border border-slate-200 p-4 dark:border-slate-800">
                    <p class="font-bold">QRIS</p>
                    <p class="mt-1 text-sm text-slate-500">Scan QRIS JasaAC</p>
                </div>

                <div class="rounded-2xl border border-slate-200 p-4 dark:border-slate-800">
                    <p class="font-bold">DANA</p>
                    <p class="mt-1 text-sm text-slate-500">0812-0000-0000</p>
                </div>

                <div class="rounded-2xl border border-slate-200 p-4 dark:border-slate-800">
                    <p class="font-bold">ShopeePay</p>
                    <p class="mt-1 text-sm text-slate-500">0812-0000-0000</p>
                </div>

                <div class="rounded-2xl border border-slate-200 p-4 dark:border-slate-800">
                    <p class="font-bold">GoPay</p>
                    <p class="mt-1 text-sm text-slate-500">0812-0000-0000</p>
                </div>

                <div class="rounded-2xl border border-slate-200 p-4 dark:border-slate-800 sm:col-span-2">
                    <p class="font-bold">BCA</p>
                    <p class="mt-1 text-sm text-slate-500">1234567890 a.n. JasaAC</p>
                </div>
            </div>

            <form action="{{ route('pembayaran.store', $pesanan->id_pesanan) }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-4">
                @csrf

                <select name="metode_pembayaran" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 dark:border-slate-700 dark:bg-slate-950" required>
                    <option value="">Pilih metode pembayaran</option>
                    <option value="qris">QRIS</option>
                    <option value="dana">DANA</option>
                    <option value="shopeepay">ShopeePay</option>
                    <option value="gopay">GoPay</option>
                    <option value="bca">BCA</option>
                </select>

                <input type="file" name="bukti_pembayaran" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 dark:border-slate-700 dark:bg-slate-950">

                <button type="submit" class="w-full rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white hover:bg-blue-700">
                    Kirim Pembayaran
                </button>
            </form>
        </div>
    </section>
@endsection
