@extends('utama')

@section('content')
    <section class="grid gap-6 lg:grid-cols-[1.1fr_0.9fr]">
        <div class="rounded-3xl bg-white p-6 shadow-sm dark:bg-slate-900 md:p-8">
            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-blue-600 dark:text-blue-400">
                Transaksi Pembelian
            </p>

            <h1 class="mt-4 text-3xl font-bold md:text-4xl">
                Beli AC
            </h1>

            <p class="mt-3 leading-relaxed text-slate-600 dark:text-slate-300">
                Isi data pembelian AC, pilih merk AC, tentukan jumlah unit, lokasi, jarak, metode pembayaran, dan metode pengiriman.
            </p>

            <form action="{{ route('keranjang.store') }}" method="POST" class="mt-8 space-y-5" id="formBeliAc">
                @csrf

                <input type="hidden" name="jenis" value="beli">

                <div class="grid gap-5 md:grid-cols-2">
                    <div>
                        <label for="nama_pembeli" class="text-sm font-semibold">Nama Pembeli</label>
                        <input type="text" id="nama_pembeli" name="data_detail[nama_pembeli]" value="{{ old('data_detail.nama_pembeli') }}" required class="mt-2 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm outline-none focus:border-blue-600 dark:border-slate-700 dark:bg-slate-950">
                    </div>

                    <div>
                        <label for="jenis_kelamin" class="text-sm font-semibold">Jenis Kelamin</label>
                        <select id="jenis_kelamin" name="data_detail[jenis_kelamin]" required class="mt-2 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm outline-none focus:border-blue-600 dark:border-slate-700 dark:bg-slate-950">
                            <option value="">Pilih jenis kelamin</option>
                            <option value="Laki-laki" @selected(old('data_detail.jenis_kelamin') === 'Laki-laki')>Laki-laki</option>
                            <option value="Perempuan" @selected(old('data_detail.jenis_kelamin') === 'Perempuan')>Perempuan</option>
                        </select>
                    </div>
                </div>

                <div class="grid gap-5 md:grid-cols-2">
                    <div>
                        <label for="id_harga" class="text-sm font-semibold">Merk AC</label>
                        <select id="id_harga" name="id_harga" required class="mt-2 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm outline-none focus:border-blue-600 dark:border-slate-700 dark:bg-slate-950">
                            <option value="" data-harga="0">Pilih merk AC</option>
                            @foreach($hargaBeli as $item)
                                <option value="{{ $item->id_hargabeli }}" data-harga="{{ $item->harga }}" @selected(old('id_harga') == $item->id_hargabeli)>
                                    {{ $item->nama_merkac }} - Rp {{ number_format($item->harga, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="jumlah" class="text-sm font-semibold">Jumlah Unit</label>
                        <input type="number" id="jumlah" name="jumlah" value="{{ old('jumlah', 1) }}" min="1" required class="mt-2 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm outline-none focus:border-blue-600 dark:border-slate-700 dark:bg-slate-950">
                    </div>
                </div>

                <div>
                    <label for="lokasi" class="text-sm font-semibold">Lokasi Pembeli</label>
                    <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi') }}" required placeholder="Contoh: Bekasi Timur" class="mt-2 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm outline-none focus:border-blue-600 dark:border-slate-700 dark:bg-slate-950">
                </div>

                <div class="grid gap-5 md:grid-cols-2">
                    <div>
                        <label for="jarak_km" class="text-sm font-semibold">Jarak dari Pusat Service</label>
                        <input type="number" id="jarak_km" name="jarak_km" value="{{ old('jarak_km', 0) }}" min="0" step="0.01" required class="mt-2 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm outline-none focus:border-blue-600 dark:border-slate-700 dark:bg-slate-950">
                    </div>

                    <div>
                        <label for="telepon" class="text-sm font-semibold">Nomor Telepon</label>
                        <input type="text" id="telepon" name="data_detail[telepon]" value="{{ old('data_detail.telepon') }}" required class="mt-2 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm outline-none focus:border-blue-600 dark:border-slate-700 dark:bg-slate-950">
                    </div>
                </div>

                <div class="grid gap-5 md:grid-cols-2">
                    <div>
                        <label for="metode_pembayaran" class="text-sm font-semibold">Metode Pembayaran</label>
                        <select id="metode_pembayaran" name="data_detail[metode_pembayaran]" required class="mt-2 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm outline-none focus:border-blue-600 dark:border-slate-700 dark:bg-slate-950">
                            <option value="">Pilih metode pembayaran</option>
                            <option value="Transfer Bank" @selected(old('data_detail.metode_pembayaran') === 'Transfer Bank')>Transfer Bank</option>
                            <option value="QRIS" @selected(old('data_detail.metode_pembayaran') === 'QRIS')>QRIS</option>
                            <option value="Cash" @selected(old('data_detail.metode_pembayaran') === 'Cash')>Cash</option>
                        </select>
                    </div>

                    <div>
                        <label for="metode_pengiriman" class="text-sm font-semibold">Metode Pengiriman</label>
                        <select id="metode_pengiriman" name="data_detail[metode_pengiriman]" required class="mt-2 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm outline-none focus:border-blue-600 dark:border-slate-700 dark:bg-slate-950">
                            <option value="">Pilih metode pengiriman</option>
                            <option value="Kurir Toko" @selected(old('data_detail.metode_pengiriman') === 'Kurir Toko')>Kurir Toko</option>
                            <option value="Grab Express" @selected(old('data_detail.metode_pengiriman') === 'Grab Express')>Grab Express</option>
                            <option value="Gojek" @selected(old('data_detail.metode_pengiriman') === 'Gojek')>Gojek</option>
                            <option value="Ambil di Tempat" @selected(old('data_detail.metode_pengiriman') === 'Ambil di Tempat')>Ambil di Tempat</option>
                        </select>
                    </div>
                </div>

                @auth
                    <button type="submit" class="w-full rounded-2xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white hover:bg-blue-700">
                        Masukkan ke Keranjang
                    </button>
                @else
                    <a href="{{ route('login') }}" class="block w-full rounded-2xl bg-blue-600 px-6 py-3 text-center text-sm font-semibold text-white hover:bg-blue-700">
                        Login untuk Melanjutkan
                    </a>
                @endauth
            </form>
        </div>

        <div class="space-y-6">
            <div class="rounded-3xl bg-blue-600 p-6 text-white shadow-sm md:p-8">
                <h2 class="text-2xl font-bold">Ringkasan Harga</h2>

                <div class="mt-6 space-y-4">
                    <div class="flex justify-between gap-4">
                        <span class="text-blue-100">Harga Satuan</span>
                        <span class="font-bold" id="hargaSatuanBeli">Rp 0</span>
                    </div>

                    <div class="flex justify-between gap-4">
                        <span class="text-blue-100">Biaya Jarak</span>
                        <span class="font-bold" id="biayaJarakBeli">Rp 0</span>
                    </div>

                    <div class="border-t border-white/20 pt-4">
                        <div class="flex justify-between gap-4 text-xl">
                            <span class="font-semibold">Total</span>
                            <span class="font-bold" id="totalHargaBeli">Rp 0</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="rounded-3xl bg-white p-6 shadow-sm dark:bg-slate-900 md:p-8">
                <h2 class="text-xl font-bold">Daftar Harga Beli AC</h2>

                <div class="mt-5 space-y-3">
                    @forelse($hargaBeli as $item)
                        <div class="flex items-center justify-between gap-4 rounded-2xl border border-slate-200 p-4 dark:border-slate-800">
                            <span class="font-semibold">{{ $item->nama_merkac }}</span>
                            <span class="text-sm font-bold text-blue-600 dark:text-blue-400">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </span>
                        </div>
                    @empty
                        <p class="text-sm text-slate-500">Data harga beli AC belum tersedia.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <script>
        const selectBeli = document.getElementById('id_harga');
        const jumlahBeli = document.getElementById('jumlah');
        const jarakBeli = document.getElementById('jarak_km');
        const hargaSatuanBeli = document.getElementById('hargaSatuanBeli');
        const biayaJarakBeli = document.getElementById('biayaJarakBeli');
        const totalHargaBeli = document.getElementById('totalHargaBeli');
        const tarifJarakBeli = 5000;

        const formatRupiahBeli = (nilai) => new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            maximumFractionDigits: 0
        }).format(nilai);

        const hitungBeli = () => {
            const harga = Number(selectBeli.options[selectBeli.selectedIndex]?.dataset.harga || 0);
            const jumlah = Math.max(Number(jumlahBeli.value || 1), 1);
            const jarak = Math.max(Number(jarakBeli.value || 0), 0);
            const biayaJarak = jarak * tarifJarakBeli;
            const total = harga * jumlah + biayaJarak;

            hargaSatuanBeli.textContent = formatRupiahBeli(harga);
            biayaJarakBeli.textContent = formatRupiahBeli(biayaJarak);
            totalHargaBeli.textContent = formatRupiahBeli(total);
        };

        selectBeli.addEventListener('change', hitungBeli);
        jumlahBeli.addEventListener('input', hitungBeli);
        jarakBeli.addEventListener('input', hitungBeli);
        hitungBeli();
    </script>
@endsection
