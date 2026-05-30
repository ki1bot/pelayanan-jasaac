@extends('utama')

@section('content')
    <section class="mx-auto max-w-3xl rounded-3xl bg-white p-6 shadow-sm dark:bg-slate-900">
        <div class="flex flex-col justify-between gap-4 md:flex-row md:items-center">
            <div>
                <h1 class="text-2xl font-bold">{{ $data ? 'Edit' : 'Tambah' }} {{ $judul }}</h1>
                <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Isi data dengan benar agar tidak terjadi error database.</p>
            </div>

            <a href="{{ route('pemilik.crud.index', $jenis) }}" class="rounded-xl border border-slate-300 px-5 py-3 text-sm font-semibold hover:bg-slate-100 dark:border-slate-700 dark:hover:bg-slate-800">
                Kembali
            </a>
        </div>

        <form action="{{ $data ? route('pemilik.crud.update', [$jenis, $data->{$primary}]) : route('pemilik.crud.store', $jenis) }}" method="POST" class="mt-6 space-y-5">
            @csrf

            @if($data)
                @method('PUT')
            @endif

            @foreach($kolom as $field)
                <div>
                    <label class="mb-2 block text-sm font-semibold">{{ ucwords(str_replace('_', ' ', $field)) }}</label>

                    @if($field === 'id_hargabeli')
                        <select name="{{ $field }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 dark:border-slate-700 dark:bg-slate-950" required>
                            <option value="">Pilih harga beli</option>
                            @foreach($opsi['hargaBeli'] as $item)
                                <option value="{{ $item->id_hargabeli }}" @selected(old($field, $data->{$field} ?? '') == $item->id_hargabeli)>
                                    {{ $item->nama_merkac }} - Rp {{ number_format($item->harga, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                    @elseif($field === 'id_hargajual')
                        <select name="{{ $field }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 dark:border-slate-700 dark:bg-slate-950" required>
                            <option value="">Pilih harga jual</option>
                            @foreach($opsi['hargaJual'] as $item)
                                <option value="{{ $item->id_hargajual }}" @selected(old($field, $data->{$field} ?? '') == $item->id_hargajual)>
                                    {{ $item->nama_merkac }} - Rp {{ number_format($item->harga, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                    @elseif($field === 'id_hargaservice')
                        <select name="{{ $field }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 dark:border-slate-700 dark:bg-slate-950" required>
                            <option value="">Pilih harga service</option>
                            @foreach($opsi['hargaService'] as $item)
                                <option value="{{ $item->id_hargaservice }}" @selected(old($field, $data->{$field} ?? '') == $item->id_hargaservice)>
                                    {{ $item->keterangan_ac }} - Rp {{ number_format($item->harga, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                    @elseif($field === 'id_login')
                        <select name="{{ $field }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 dark:border-slate-700 dark:bg-slate-950" required>
                            <option value="">Pilih pengguna</option>
                            @foreach($opsi['login'] as $item)
                                <option value="{{ $item->id_login }}" @selected(old($field, $data->{$field} ?? '') == $item->id_login)>
                                    {{ $item->nama }} - {{ $item->username }}
                                </option>
                            @endforeach
                        </select>
                    @elseif($field === 'id_pesanan')
                        <select name="{{ $field }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 dark:border-slate-700 dark:bg-slate-950" required>
                            <option value="">Pilih pesanan</option>
                            @foreach($opsi['pesanan'] as $item)
                                <option value="{{ $item->id_pesanan }}" @selected(old($field, $data->{$field} ?? '') == $item->id_pesanan)>
                                    {{ $item->kode_pesanan }} - Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                    @elseif($field === 'role')
                        <select name="{{ $field }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 dark:border-slate-700 dark:bg-slate-950" required>
                            <option value="pengguna" @selected(old($field, $data->{$field} ?? '') === 'pengguna')>Pengguna</option>
                            <option value="pemilik" @selected(old($field, $data->{$field} ?? '') === 'pemilik')>Pemilik</option>
                        </select>
                    @elseif($field === 'status')
                        <select name="{{ $field }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 dark:border-slate-700 dark:bg-slate-950" required>
                            <option value="menunggu_pembayaran" @selected(old($field, $data->{$field} ?? '') === 'menunggu_pembayaran')>Menunggu Pembayaran</option>
                            <option value="diproses" @selected(old($field, $data->{$field} ?? '') === 'diproses')>Diproses</option>
                            <option value="selesai" @selected(old($field, $data->{$field} ?? '') === 'selesai')>Selesai</option>
                            <option value="dibatalkan" @selected(old($field, $data->{$field} ?? '') === 'dibatalkan')>Dibatalkan</option>
                        </select>
                    @elseif($field === 'status_pembayaran')
                        <select name="{{ $field }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 dark:border-slate-700 dark:bg-slate-950" required>
                            <option value="menunggu" @selected(old($field, $data->{$field} ?? '') === 'menunggu')>Menunggu</option>
                            <option value="berhasil" @selected(old($field, $data->{$field} ?? '') === 'berhasil')>Berhasil</option>
                            <option value="gagal" @selected(old($field, $data->{$field} ?? '') === 'gagal')>Gagal</option>
                        </select>
                    @elseif($field === 'metode_pembayaran')
                        <select name="{{ $field }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 dark:border-slate-700 dark:bg-slate-950" required>
                            <option value="">Pilih metode pembayaran</option>
                            <option value="qris" @selected(old($field, $data->{$field} ?? '') === 'qris')>QRIS</option>
                            <option value="dana" @selected(old($field, $data->{$field} ?? '') === 'dana')>DANA</option>
                            <option value="shopeepay" @selected(old($field, $data->{$field} ?? '') === 'shopeepay')>ShopeePay</option>
                            <option value="gopay" @selected(old($field, $data->{$field} ?? '') === 'gopay')>GoPay</option>
                            <option value="bca" @selected(old($field, $data->{$field} ?? '') === 'bca')>BCA</option>
                        </select>
                    @elseif($field === 'password')
                        <div class="relative">
                            <input type="password" name="{{ $field }}" placeholder="{{ $data ? 'Kosongkan jika tidak ingin mengubah password' : 'Masukkan password' }}" class="toggle-input w-full rounded-xl border border-slate-300 bg-white px-4 py-3 pr-12 dark:border-slate-700 dark:bg-slate-950">
                            <button type="button" class="toggle-password absolute right-4 top-3 text-sm font-semibold">👁</button>
                        </div>
                    @elseif(str_contains($field, 'tanggal'))
                        <input type="datetime-local" name="{{ $field }}" value="{{ old($field, isset($data->{$field}) ? \Carbon\Carbon::parse($data->{$field})->format('Y-m-d\TH:i') : '') }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 dark:border-slate-700 dark:bg-slate-950" required>
                    @elseif($field === 'pesan')
                        <textarea name="{{ $field }}" rows="5" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 dark:border-slate-700 dark:bg-slate-950" required>{{ old($field, $data->{$field} ?? '') }}</textarea>
                    @elseif(str_contains($field, 'harga') || $field === 'jumlah' || $field === 'jarak_km')
                        <input type="number" step="0.01" name="{{ $field }}" value="{{ old($field, $data->{$field} ?? '') }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 dark:border-slate-700 dark:bg-slate-950" required>
                    @else
                        <input type="text" name="{{ $field }}" value="{{ old($field, $data->{$field} ?? '') }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 dark:border-slate-700 dark:bg-slate-950" required>
                    @endif
                </div>
            @endforeach

            <button type="submit" class="w-full rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white hover:bg-blue-700">
                Simpan Data
            </button>
        </form>
    </section>
@endsection
