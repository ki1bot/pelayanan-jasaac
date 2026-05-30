@extends('utama')

@section('content')
    <section class="mx-auto max-w-md rounded-3xl bg-white p-6 shadow-sm dark:bg-slate-900">
        <h1 class="text-2xl font-bold">Register</h1>
        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Buat akun untuk membuat pesanan dan menyimpan keranjang.</p>

        <form action="{{ route('register.proses') }}" method="POST" class="mt-6 space-y-4">
            @csrf

            <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Nama lengkap" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 dark:border-slate-700 dark:bg-slate-950" required>

            <select name="jenis_kelamin" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 dark:border-slate-700 dark:bg-slate-950" required>
                <option value="">Pilih jenis kelamin</option>
                <option value="Laki-laki" @selected(old('jenis_kelamin') === 'Laki-laki')>Laki-laki</option>
                <option value="Perempuan" @selected(old('jenis_kelamin') === 'Perempuan')>Perempuan</option>
            </select>

            <input type="text" name="username" value="{{ old('username') }}" placeholder="Username" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 dark:border-slate-700 dark:bg-slate-950" required>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 dark:border-slate-700 dark:bg-slate-950">

            <div class="relative">
                <input type="password" name="password" placeholder="Password" class="toggle-input w-full rounded-xl border border-slate-300 bg-white px-4 py-3 pr-12 dark:border-slate-700 dark:bg-slate-950" required>
                <button type="button" class="toggle-password absolute right-4 top-3 text-sm font-semibold">👁</button>
            </div>

            <div class="relative">
                <input type="password" name="password_confirmation" placeholder="Konfirmasi password" class="toggle-input w-full rounded-xl border border-slate-300 bg-white px-4 py-3 pr-12 dark:border-slate-700 dark:bg-slate-950" required>
                <button type="button" class="toggle-password absolute right-4 top-3 text-sm font-semibold">👁</button>
            </div>

            <button type="submit" class="w-full rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white hover:bg-blue-700">
                Daftar
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-slate-500">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="font-semibold text-blue-600 hover:text-blue-700">Login</a>
        </p>
    </section>
@endsection
