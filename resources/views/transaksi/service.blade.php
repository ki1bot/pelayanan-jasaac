@extends('utama')

@section('content')
    <section class="grid gap-6 lg:grid-cols-[1.1fr_0.9fr]">
        <div class="rounded-3xl bg-white p-6 shadow-sm dark:bg-slate-900 md:p-8">
            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-blue-600 dark:text-blue-400">
                Transaksi Service
            </p>

            <h1 class="mt-4 text-3xl font-bold md:text-4xl">
                Service AC
            </h1>

            <p class="mt-3 leading-relaxed text-slate-600 dark:text-slate-300">
                Isi data service AC, pilih jenis layanan, masukkan lokasi client, jadwal pengerjaan, dan metode pembayaran.
            </p>

            <form action="{{ route('keranjang.store') }}" method="POST" class="mt-8 space-y-5" id="formServiceAc">
                @csrf

                <input type="hidden" name="jenis" value="service">
                <input type="hidden" name="jumlah" value="1">

                <div class="grid gap-5 md:grid-cols-2">
                    <div>
                        <label for="nama_client" class="text-sm font-semibold">Nama Client</label>
                        <input type="text" id="nama_client" name="data_detail[nama_client]" value="{{ old('data_detail.nama_client') }}" required class="mt-2 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm outline-none focus:border-blue-600 dark:border-slate-700 dark:bg-slate-950">
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
                        <label for="id_harga" class="text-sm font-semibold">Jenis Service</label>
                        <select id="id_harga" name="id_harga" required class="mt-2 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm outline-none focus:border-blue-600 dark:border-slate-700 dark:bg-slate-950">
                            <option value="" data-harga="0">Pilih jenis service</option>
                            @foreach($hargaService as $item)
                                <option value="{{ $item->id_hargaservice }}" data-harga="{{ $item->harga }}" @selected(old('id_harga') == $item->id_hargaservice)>
                                    {{ $item->keterangan_ac }} - Rp {{ number_format($item->harga, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="telp_client" class="text-sm font-semibold">Nomor Telepon</label>
                        <input type="text" id="telp_client" name="data_detail[telp_client]" value="{{ old('data_detail.telp_client') }}" required class="mt-2 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm outline-none focus:border-blue-600 dark:border-slate-700 dark:bg-slate-950">
                    </div>
                </div>

                <div>
                    <label for="lokasi" class="text-sm font-semibold">Lokasi Client</label>
                    <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi') }}" required placeholder="Contoh: Bekasi Kota" class="mt-2 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm outline-none focus:border-blue-600 dark:border-slate-700 dark:bg-slate-950">
                </div>

                <div class="grid gap-5 md:grid-cols-3">
                    <div>
                        <label for="jarak_km" class="text-sm font-semibold">Jarak dari Pusat Service</label>
                        <input type="number" id="jarak_km" name="jarak_km" value="{{ old('jarak_km', 0) }}" min="0" step="0.01" required class="mt-2 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm outline-none focus:border-blue-600 dark:border-slate-700 dark:bg-slate-950">
                    </div>

                    <div>
                        <label for="tanggal_awal" class="text-sm font-semibold">Tanggal Awal</label>
                        <input type="date" id="tanggal_awal" name="data_detail[tanggal_awal]" value="{{ old('data_detail.tanggal_awal') }}" required class="mt-2 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm outline-none focus:border-blue-600 dark:border-slate-700 dark:bg-slate-950">
                    </div>

                    <div>
                        <label for="tanggal_akhir" class="text-sm font-semibold">Tanggal Akhir</label>
                        <input type="date" id="tanggal_akhir" name="data_detail[tanggal_akhir]" value="{{ old('data_detail.tanggal_akhir') }}" required class="mt-2 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm outline-none focus:border-blue-600 dark:border-slate-700 dark:bg-slate-950">
                    </div>
                </div>

                <div>
                    <label for="metode_pembayaran" class="text-sm font-semibold">Metode Pembayaran</label>
                    <select id="metode_pembayaran" name="data_detail[metode_pembayaran]" required class="mt-2 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm outline-none focus:border-blue-600 dark:border-slate-700 dark:bg-slate-950">
                        <option value="">Pilih metode pembayaran</option>
                        <option value="Transfer Bank" @selected(old('data_detail.metode_pembayaran') === 'Transfer Bank')>Transfer Bank</option>
                        <option value="QRIS" @selected(old('data_detail.metode_pembayaran') === 'QRIS')>QRIS</option>
                        <option value="Cash" @selected(old('data_detail.metode_pembayaran') === 'Cash')>Cash</option>
                    </select>
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
            <div class="rounded-3xl bg-green-600 p-6 text-white shadow-sm md:p-8">
                <h2 class="text-2xl font-bold">Ringkasan Harga</h2>

                <div class="mt-6 space-y-4">
                    <div class="flex justify-between gap-4">
                        <span class="text-green-100">Harga Service</span>
                        <span class="font-bold" id="hargaSatuanService">Rp 0</span>
                    </div>

                    <div class="flex justify-between gap-4">
                        <span class="text-green-100">Biaya Jarak</span>
                        <span class="font-bold" id="biayaJarakService">Rp 0</span>
                    </div>

                    <div class="border-t border-white/20 pt-4">
                        <div class="flex justify-between gap-4 text-xl">
                            <span class="font-semibold">Total</span>
                            <span class="font-bold" id="totalHargaService">Rp 0</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="rounded-3xl bg-white p-6 shadow-sm dark:bg-slate-900 md:p-8">
                <h2 class="text-xl font-bold">Daftar Harga Service AC</h2>

                <div class="mt-5 space-y-3">
                    @forelse($hargaService as $item)
                        <div class="flex items-center justify-between gap-4 rounded-2xl border border-slate-200 p-4 dark:border-slate-800">
                            <span class="font-semibold">{{ $item->keterangan_ac }}</span>
                            <span class="text-sm font-bold text-blue-600 dark:text-blue-400">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </span>
                        </div>
                    @empty
                        <p class="text-sm text-slate-500">Data harga service AC belum tersedia.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <script>
        const selectService = document.getElementById('id_harga');
        const jarakService = document.getElementById('jarak_km');
        const hargaSatuanService = document.getElementById('hargaSatuanService');
        const biayaJarakService = document.getElementById('biayaJarakService');
        const totalHargaService = document.getElementById('totalHargaService');
        const tarifJarakService = 5000;

        const formatRupiahService = (nilai) => new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            maximumFractionDigits: 0
        }).format(nilai);

        const hitungService = () => {
            const harga = Number(selectService.options[selectService.selectedIndex]?.dataset.harga || 0);
            const jarak = Math.max(Number(jarakService.value || 0), 0);
            const biayaJarak = jarak * tarifJarakService;
            const total = harga + biayaJarak;

            hargaSatuanService.textContent = formatRupiahService(harga);
            biayaJarakService.textContent = formatRupiahService(biayaJarak);
            totalHargaService.textContent = formatRupiahService(total);
        };

        selectService.addEventListener('change', hitungService);
        jarakService.addEventListener('input', hitungService);
        hitungService();
    </script>
@endsection
