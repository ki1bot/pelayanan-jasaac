@extends('utama')

@section('content')
    <section class="grid gap-6 lg:grid-cols-[0.8fr_1.2fr]">
        <div class="rounded-3xl bg-blue-600 p-6 text-white shadow-sm md:p-8">
            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-blue-100">
                Kontak
            </p>

            <h1 class="mt-4 text-3xl font-bold md:text-5xl">
                Hubungi Kami
            </h1>

            <p class="mt-5 leading-relaxed text-blue-100">
                Kirim pesan kepada admin JasaAC untuk pertanyaan layanan, harga, pemesanan, atau kendala pembayaran.
            </p>

            <div class="mt-8 rounded-2xl bg-white/10 p-5">
                <p class="text-sm text-blue-100">Lokasi Pusat</p>
                <p class="mt-2 text-2xl font-bold">Jakarta</p>
            </div>
        </div>

        <div class="rounded-3xl bg-white p-6 shadow-sm dark:bg-slate-900 md:p-8">
            <h2 class="text-2xl font-bold">Form Kontak</h2>

            <form action="{{ route('kontak.simpan') }}" method="POST" class="mt-6 space-y-4">
                @csrf

                <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Nama" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 dark:border-slate-700 dark:bg-slate-950" required>

                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 dark:border-slate-700 dark:bg-slate-950" required>

                <input type="text" name="subjek" value="{{ old('subjek') }}" placeholder="Subjek" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 dark:border-slate-700 dark:bg-slate-950" required>

                <textarea name="pesan" rows="6" placeholder="Pesan" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 dark:border-slate-700 dark:bg-slate-950" required>{{ old('pesan') }}</textarea>

                <button type="submit" class="rounded-xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white hover:bg-blue-700">
                    Kirim Pesan
                </button>
            </form>
        </div>
    </section>
@endsection
