<?php

namespace App\Http\Controllers;

use App\Models\LoginAc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('auth.login');
    }

    public function registerPage()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'jenis_kelamin' => ['required', 'string', 'max:20'],
            'username' => ['required', 'string', 'max:100', 'unique:loginac,username'],
            'email' => ['nullable', 'email', 'max:150', 'unique:loginac,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $akun = new LoginAc();
        $akun->setAttribute('nama', $data['nama']);
        $akun->setAttribute('jenis_kelamin', $data['jenis_kelamin']);
        $akun->setAttribute('username', $data['username']);
        $akun->setAttribute('email', $data['email'] ?? null);
        $akun->setAttribute('password', Hash::make($data['password']));
        $akun->setAttribute('role', 'pengguna');
        $akun->save();

        Auth::guard()->login($akun);

        return redirect()->route('beranda');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $akun = LoginAc::query()
            ->where('username', $data['username'])
            ->first(['*']);

        if (! $akun) {
            return back()->withErrors([
                'username' => 'Username atau password salah.',
            ])->onlyInput('username');
        }

        $passwordHash = (string) $akun->getAttribute('password');

        if (! Hash::check($data['password'], $passwordHash)) {
            return back()->withErrors([
                'username' => 'Username atau password salah.',
            ])->onlyInput('username');
        }

        Auth::guard()->login($akun, $request->boolean('remember'));

        return redirect()->route('beranda');
    }

    public function logout(Request $request)
    {
        Auth::guard()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('beranda');
    }

    public function redirectProvider(string $provider)
    {
        if (! in_array($provider, ['google', 'facebook'], true)) {
            abort(404, 'Provider tidak ditemukan.', []);
        }

        return Socialite::driver($provider)->redirect();
    }

    public function callbackProvider(string $provider)
    {
        if (! in_array($provider, ['google', 'facebook'], true)) {
            abort(404, 'Provider tidak ditemukan.', []);
        }

        $social = Socialite::driver($provider)->user();
        $providerId = $provider . '_id';
        $socialId = (string) $social->getId();
        $email = $social->getEmail();

        $query = LoginAc::query()
            ->where($providerId, $socialId);

        if ($email) {
            $query->orWhere('email', $email);
        }

        $akun = $query->first(['*']);

        if (! $akun) {
            $nama = $social->getName() ?: 'Pengguna';
            $baseUsername = Str::slug($social->getNickname() ?: $nama, '_');
            $username = $baseUsername ?: $provider . '_user';

            while (LoginAc::query()->where('username', $username)->exists()) {
                $username = $baseUsername . '_' . Str::lower(Str::random(5));
            }

            $akun = new LoginAc();
            $akun->setAttribute('nama', $nama);
            $akun->setAttribute('jenis_kelamin', '-');
            $akun->setAttribute('username', $username);
            $akun->setAttribute('email', $email);
            $akun->setAttribute('password', Hash::make(Str::random(32)));
            $akun->setAttribute($providerId, $socialId);
            $akun->setAttribute('role', 'pengguna');
            $akun->save();
        } else {
            $akun->setAttribute($providerId, $socialId);

            if ($email) {
                $akun->setAttribute('email', $email);
            }

            $akun->save();
        }

        Auth::guard()->login($akun, true);

        return redirect()->route('beranda');
    }

    public function updatePassword(Request $request)
    {
        $data = $request->validate([
            'password_lama' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $idLogin = Auth::id();

        if (! $idLogin) {
            abort(403, 'Akses ditolak.', []);
        }

        $akun = LoginAc::query()
            ->findOrFail($idLogin);

        $passwordHash = (string) $akun->getAttribute('password');

        if (! Hash::check($data['password_lama'], $passwordHash)) {
            return back()->withErrors([
                'password_lama' => 'Password lama tidak sesuai.',
            ]);
        }

        $akun->setAttribute('password', Hash::make($data['password']));
        $akun->save();

        return back()->with('success', 'Password berhasil diubah.');
    }
}
