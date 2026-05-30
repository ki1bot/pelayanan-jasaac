<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LoginAc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class AuthApiController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'jenis_kelamin' => ['required', 'string', 'max:20'],
            'username' => ['required', 'string', 'max:100', 'unique:loginac,username'],
            'email' => ['nullable', 'email', 'max:150', 'unique:loginac,email'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        $user = LoginAc::query()->create([
            'nama' => $data['nama'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'username' => $data['username'],
            'email' => $data['email'] ?? null,
            'password' => Hash::make($data['password']),
            'role' => 'pengguna',
        ]);

        $token = $user->createToken('token-login')->plainTextToken;

        return response()->json([
            'message' => 'Register berhasil.',
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $user = LoginAc::query()
            ->where('username', $data['username'])
            ->first(['*']);

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            return response()->json([
                'message' => 'Username atau password salah.',
            ], 401);
        }

        $token = $user->createToken('token-login')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil.',
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        $token = $request->user()?->currentAccessToken();

        if ($token instanceof PersonalAccessToken) {
            $token->delete();
        }

        return response()->json([
            'message' => 'Logout berhasil.',
        ]);
    }
}
