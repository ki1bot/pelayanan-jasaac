@extends('utama')

@section('content')
    <section class="rounded-3xl bg-white p-6 shadow-sm dark:bg-slate-900">
        <div class="flex flex-col justify-between gap-4 md:flex-row md:items-center">
            <div>
                <h1 class="text-2xl font-bold">Laporan Transaksi</h1>
                <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Laporan pembelian AC, penjualan AC, dan service AC.</p>
            </div>

            <form action="{{ route('laporan.index') }}" method="GET" class="flex flex-col gap-3 sm:flex-row">
                <input type="date" name="tanggal_awal" value="{{ $tanggalAwal }}" class="rounded-xl border border-slate-300 bg-white px-4 py-3 dark:border-slate-700 dark:bg-slate-950">
                <input type="date" name="tanggal_akhir" value="{{ $tanggalAkhir }}" class="rounded-xl border border-slate-300 bg-white px-4 py-3 dark:border-slate-700 dark:bg-slate-950">
                <button type="submit" class="rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white hover:bg-blue-700">
                    Filter
                </button>
            </form>
        </div>

        <div class="mt-8 grid gap-4 md:grid-cols-3">
            <div class="rounded-2xl border border-slate-200 p-5 dark:border-slate-800">
                <p class="text-sm text-slate-500">Total Beli AC</p>
                <p class="mt-2 text-2xl font-bold">Rp {{ number_format($totalBeli, 0, ',', '.') }}</p>
            </div>

            <div class="rounded-2xl border border-slate-200 p-5 dark:border-slate-800">
                <p class="text-sm text-slate-500">Total Jual AC</p>
                <p class="mt-2 text-2xl font-bold">Rp {{ number_format($totalJual, 0, ',', '.') }}</p>
            </div>

            <div class="rounded-2xl border border-slate-200 p-5 dark:border-slate-800">
                <p class="text-sm text-slate-500">Total Service AC</p>
                <p class="mt-2 text-2xl font-bold">Rp {{ number_format($totalService, 0, ',', '.') }}</p>
            </div>
        </div>
    </section>

    <section class="mt-8 rounded-3xl bg-white p-6 shadow-sm dark:bg-slate-900">
        <h2 class="text-xl font-bold">Laporan Beli AC</h2>

        <div class="mt-5 overflow-x-auto">
            <table class="w-full min-w-[1000px] text-sm">
                <thead>
                    <tr class="border-b border-slate-200 text-left dark:border-slate-800">
                        <th class="p-3">Nama</th>
                        <th class="p-3">Merk</th>
                        <th class="p-3">Lokasi</th>
                        <th class="p-3">Jumlah</th>
                        <th class="p-3">Tanggal</th>
                        <th class="p-3">Jarak</th>
                        <th class="p-3">Biaya Jarak</th>
                        <th class="p-3">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($beliAc as $item)
                        <tr class="border-b border-slate-200 dark:border-slate-800">
                            <td class="p-3">{{ $item->nama_pembeli }}</td>
                            <td class="p-3">{{ $item->merk_ac }}</td>
                            <td class="p-3">{{ $item->lokasi }}</td>
                            <td class="p-3">{{ $item->jumlah }}</td>
                            <td class="p-3">{{ $item->tanggal }}</td>
                            <td class="p-3">{{ $item->jarak_km }} KM</td>
                            <td class="p-3">Rp {{ number_format($item->biaya_jarak, 0, ',', '.') }}</td>
                            <td class="p-3 font-bold">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="p-6 text-center text-slate-500">Belum ada laporan beli AC.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <section class="mt-8 rounded-3xl bg-white p-6 shadow-sm dark:bg-slate-900">
        <h2 class="text-xl font-bold">Laporan Jual AC</h2>

        <div class="mt-5 overflow-x-auto">
            <table class="w-full min-w-[1000px] text-sm">
                <thead>
                    <tr class="border-b border-slate-200 text-left dark:border-slate-800">
                        <th class="p-3">Nama</th>
                        <th class="p-3">Merk</th>
                        <th class="p-3">Lokasi</th>
                        <th class="p-3">Jumlah</th>
                        <th class="p-3">Tanggal</th>
                        <th class="p-3">Jarak</th>
                        <th class="p-3">Biaya Jarak</th>
                        <th class="p-3">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jualAc as $item)
                        <tr class="border-b border-slate-200 dark:border-slate-800">
                            <td class="p-3">{{ $item->nama_penjual }}</td>
                            <td class="p-3">{{ $item->merk_ac }}</td>
                            <td class="p-3">{{ $item->lokasi }}</td>
                            <td class="p-3">{{ $item->jumlah }}</td>
                            <td class="p-3">{{ $item->tanggal }}</td>
                            <td class="p-3">{{ $item->jarak_km }} KM</td>
                            <td class="p-3">Rp {{ number_format($item->biaya_jarak, 0, ',', '.') }}</td>
                            <td class="p-3 font-bold">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="p-6 text-center text-slate-500">Belum ada laporan jual AC.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <section class="mt-8 rounded-3xl bg-white p-6 shadow-sm dark:bg-slate-900">
        <h2 class="text-xl font-bold">Laporan Service AC</h2>

        <div class="mt-5 overflow-x-auto">
            <table class="w-full min-w-[1000px] text-sm">
                <thead>
                    <tr class="border-b border-slate-200 text-left dark:border-slate-800">
                        <th class="p-3">Nama</th>
                        <th class="p-3">Telepon</th>
                        <th class="p-3">Lokasi</th>
                        <th class="p-3">Keterangan</th>
                        <th class="p-3">Tanggal Awal</th>
                        <th class="p-3">Tanggal Akhir</th>
                        <th class="p-3">Jarak</th>
                        <th class="p-3">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($serviceAc as $item)
                        <tr class="border-b border-slate-200 dark:border-slate-800">
                            <td class="p-3">{{ $item->nama_client }}</td>
                            <td class="p-3">{{ $item->telp_client }}</td>
                            <td class="p-3">{{ $item->lokasi_client }}</td>
                            <td class="p-3">{{ $item->keterangan_ac }}</td>
                            <td class="p-3">{{ $item->tanggal_awal }}</td>
                            <td class="p-3">{{ $item->tanggal_akhir }}</td>
                            <td class="p-3">{{ $item->jarak_km }} KM</td>
                            <td class="p-3 font-bold">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="p-6 text-center text-slate-500">Belum ada laporan service AC.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
