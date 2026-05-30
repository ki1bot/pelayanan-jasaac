@extends('utama')

@section('content')
    <section class="rounded-3xl bg-white p-6 shadow-sm dark:bg-slate-900 md:p-8">
        <h1 class="text-3xl font-bold">Harga Beli AC</h1>
        <p class="mt-3 text-slate-600 dark:text-slate-300">Daftar harga pembelian AC berdasarkan merk.</p>

        <div class="mt-8 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @forelse($hargaBeli as $item)
                <div class="rounded-3xl border border-slate-200 p-6 dark:border-slate-800">
                    <h2 class="text-xl font-bold">{{ $item->nama_merkac }}</h2>
                    <p class="mt-4 text-2xl font-bold text-blue-600 dark:text-blue-400">
                        Rp {{ number_format($item->harga, 0, ',', '.') }}
                    </p>
                </div>
            @empty
                <p class="text-slate-500">Data harga beli AC belum tersedia.</p>
            @endforelse
        </div>
    </section>
@endsection
