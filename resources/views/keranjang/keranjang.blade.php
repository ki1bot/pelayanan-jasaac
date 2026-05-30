@extends('utama')

@section('content')
    <section class="rounded-3xl bg-white p-6 shadow-sm dark:bg-slate-900">
        <div class="flex flex-col justify-between gap-4 md:flex-row md:items-center">
            <div>
                <h1 class="text-2xl font-bold">Keranjang Pesanan</h1>
                <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Periksa pesanan sebelum melanjutkan pembayaran.</p>
            </div>

            <a href="{{ route('beranda') }}" class="rounded-xl border border-slate-300 px-5 py-3 text-sm font-semibold hover:bg-slate-100 dark:border-slate-700 dark:hover:bg-slate-800">
                Tambah Pesanan
            </a>
        </div>

        <div class="mt-6 overflow-x-auto">
            <table class="w-full min-w-[900px] border-collapse text-sm">
                <thead>
                    <tr class="border-b border-slate-200 text-left dark:border-slate-800">
                        <th class="p-3">Jenis</th>
                        <th class="p-3">Item</th>
                        <th class="p-3">Lokasi</th>
                        <th class="p-3">Jumlah</th>
                        <th class="p-3">Harga Satuan</th>
                        <th class="p-3">Jarak</th>
                        <th class="p-3">Biaya Jarak</th>
                        <th class="p-3">Total</th>
                        <th class="p-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($keranjang as $item)
                        <tr class="border-b border-slate-200 dark:border-slate-800">
                            <td class="p-3">{{ ucfirst($item->jenis) }}</td>
                            <td class="p-3">{{ $item->nama_item }}</td>
                            <td class="p-3">{{ $item->lokasi }}</td>
                            <td class="p-3">{{ $item->jumlah }}</td>
                            <td class="p-3">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                            <td class="p-3">{{ $item->jarak_km }} KM</td>
                            <td class="p-3">Rp {{ number_format($item->biaya_jarak, 0, ',', '.') }}</td>
                            <td class="p-3 font-bold">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                            <td class="p-3">
                                <form action="{{ route('keranjang.destroy', $item->id_keranjang) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="rounded-lg bg-red-600 px-3 py-2 text-xs font-semibold text-white hover:bg-red-700">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="p-6 text-center text-slate-500">
                                Keranjang masih kosong.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex flex-col items-start justify-between gap-4 border-t border-slate-200 pt-6 dark:border-slate-800 md:flex-row md:items-center">
            <p class="text-xl font-bold">Total: Rp {{ number_format($total ?? 0, 0, ',', '.') }}</p>

            <form action="{{ route('checkout') }}" method="POST">
                @csrf
                <button type="submit" class="rounded-xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white hover:bg-blue-700">
                    Checkout dan Bayar
                </button>
            </form>
        </div>
    </section>
@endsection
