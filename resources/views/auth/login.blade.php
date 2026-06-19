@extends('utama')

@section('content')
    <section class="mx-auto max-w-md rounded-3xl bg-white p-6 shadow-sm dark:bg-slate-900">
        <h1 class="text-2xl font-bold">Login</h1>
        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Masuk untuk membuat pesanan dan mengakses keranjang.</p>

        <div class="mt-6 grid gap-3">
            <a href="{{ route('social.redirect', 'google') }}" class="rounded-xl border border-slate-300 px-5 py-3 text-center text-sm font-semibold hover:bg-slate-100 dark:border-slate-700 dark:hover:bg-slate-800">
                Login dengan Google
            </a>

            <a href="{{ route('social.redirect', 'facebook') }}" class="rounded-xl border border-slate-300 px-5 py-3 text-center text-sm font-semibold hover:bg-slate-100 dark:border-slate-700 dark:hover:bg-slate-800">
                Login dengan Facebook
            </a>
        </div>

        <div class="my-6 flex items-center gap-3">
            <div class="h-px flex-1 bg-slate-200 dark:bg-slate-800"></div>
            <span class="text-xs text-slate-500">atau</span>
            <div class="h-px flex-1 bg-slate-200 dark:bg-slate-800"></div>
        </div>

        <form action="{{ route('login.proses') }}" method="POST" class="space-y-4">
            @csrf

            <input type="text" name="username" value="{{ old('username') }}" placeholder="Username" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 dark:border-slate-700 dark:bg-slate-950" required>

            <div class="relative">
                <input type="password" name="password" placeholder="Password" class="toggle-input w-full rounded-xl border border-slate-300 bg-white px-4 py-3 pr-12 dark:border-slate-700 dark:bg-slate-950" required>
                <button type="button" class="toggle-password absolute right-4 top-3 text-sm font-semibold"></button>
            </div>

            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="remember" value="1" class="rounded border-slate-300">
                <span>Ingat saya</span>
            </label>

            <button type="submit" class="w-full rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white hover:bg-blue-700">
                Login
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-slate-500">
            Belum punya akun?
            <a href="{{ route('register') }}" class="font-semibold text-blue-600 hover:text-blue-700">Daftar</a>
        </p>
    </section>
@endsection
