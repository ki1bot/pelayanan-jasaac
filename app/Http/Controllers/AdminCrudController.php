<?php

namespace App\Http\Controllers;

use App\Models\BeliAc;
use App\Models\HargaBeliAc;
use App\Models\HargaJualAc;
use App\Models\HargaServiceAc;
use App\Models\HubungiKami;
use App\Models\JualAc;
use App\Models\Keranjang;
use App\Models\LoginAc;
use App\Models\Pembayaran;
use App\Models\Pesanan;
use App\Models\PusatService;
use App\Models\ServiceAc;
use App\Services\HitungHargaAcService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminCrudController extends Controller
{
    public function index(string $jenis)
    {
        $config = $this->config($jenis);
        $model = $config['model'];

        $data = $model::query()
            ->orderBy($config['primary'], 'desc')
            ->paginate(10);

        $kolom = $config['kolom'];
        $primary = $config['primary'];
        $judul = $config['judul'];

        return view('admin.admin', compact('jenis', 'data', 'kolom', 'primary', 'judul'));
    }

    public function create(string $jenis)
    {
        $config = $this->config($jenis);
        $data = null;
        $kolom = $config['kolom'];
        $primary = $config['primary'];
        $judul = $config['judul'];
        $opsi = $this->opsiRelasi();

        return view('admin.form', compact('jenis', 'data', 'kolom', 'primary', 'judul', 'opsi'));
    }

    public function store(Request $request, string $jenis, HitungHargaAcService $hitungHarga)
    {
        $config = $this->config($jenis);
        $data = $request->validate($this->rules($jenis));
        $data = $this->siapkanData($jenis, $data, $hitungHarga);

        if ($jenis === 'loginac' && isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $config['model']::create($data);

        return redirect()->route('pemilik.crud.index', $jenis)->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit(string $jenis, int $id)
    {
        $config = $this->config($jenis);
        $data = $config['model']::findOrFail($id);
        $kolom = $config['kolom'];
        $primary = $config['primary'];
        $judul = $config['judul'];
        $opsi = $this->opsiRelasi();

        return view('admin.form', compact('jenis', 'data', 'kolom', 'primary', 'judul', 'opsi'));
    }

    public function update(Request $request, string $jenis, int $id, HitungHargaAcService $hitungHarga)
    {
        $config = $this->config($jenis);
        $model = $config['model']::findOrFail($id);
        $data = $request->validate($this->rules($jenis, $id));
        $data = $this->siapkanData($jenis, $data, $hitungHarga);

        if ($jenis === 'loginac') {
            if (! empty($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            } else {
                unset($data['password']);
            }
        }

        $model->update($data);

        return redirect()->route('pemilik.crud.index', $jenis)->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(string $jenis, int $id)
    {
        $config = $this->config($jenis);
        $config['model']::findOrFail($id)->delete();

        return back()->with('success', 'Data berhasil dihapus.');
    }

    private function config(string $jenis): array
    {
        $map = [
            'loginac' => [
                'model' => LoginAc::class,
                'primary' => 'id_login',
                'judul' => 'Login Pengguna',
                'kolom' => ['nama', 'jenis_kelamin', 'username', 'email', 'password', 'role'],
            ],
            'hubungikami' => [
                'model' => HubungiKami::class,
                'primary' => 'id_hubungi',
                'judul' => 'Hubungi Kami',
                'kolom' => ['nama', 'email', 'subjek', 'pesan'],
            ],
            'pusatservice' => [
                'model' => PusatService::class,
                'primary' => 'id_pusat',
                'judul' => 'Pusat Service',
                'kolom' => ['lokasi_pusat'],
            ],
            'hargabeliac' => [
                'model' => HargaBeliAc::class,
                'primary' => 'id_hargabeli',
                'judul' => 'Harga Beli AC',
                'kolom' => ['nama_merkac', 'harga'],
            ],
            'hargajualac' => [
                'model' => HargaJualAc::class,
                'primary' => 'id_hargajual',
                'judul' => 'Harga Jual AC',
                'kolom' => ['nama_merkac', 'harga'],
            ],
            'hargaserviceac' => [
                'model' => HargaServiceAc::class,
                'primary' => 'id_hargaservice',
                'judul' => 'Harga Service AC',
                'kolom' => ['keterangan_ac', 'harga'],
            ],
            'beliac' => [
                'model' => BeliAc::class,
                'primary' => 'id_beli',
                'judul' => 'Beli AC',
                'kolom' => ['id_hargabeli', 'nama_pembeli', 'jenis_kelamin', 'lokasi', 'jumlah', 'tanggal', 'metode_pembayaran', 'metode_pengiriman', 'jarak_km'],
            ],
            'jualac' => [
                'model' => JualAc::class,
                'primary' => 'id_jual',
                'judul' => 'Jual AC',
                'kolom' => ['id_hargajual', 'nama_penjual', 'jenis_kelamin', 'lokasi', 'jumlah', 'tanggal', 'metode_pembayaran', 'metode_pengiriman', 'jarak_km'],
            ],
            'serviceac' => [
                'model' => ServiceAc::class,
                'primary' => 'id_service',
                'judul' => 'Service AC',
                'kolom' => ['id_hargaservice', 'nama_client', 'jenis_kelamin', 'telp_client', 'lokasi_client', 'tanggal_awal', 'tanggal_akhir', 'metode_pembayaran', 'jarak_km'],
            ],
            'keranjang' => [
                'model' => Keranjang::class,
                'primary' => 'id_keranjang',
                'judul' => 'Keranjang',
                'kolom' => ['id_login', 'jenis', 'id_harga', 'nama_item', 'lokasi', 'jumlah', 'harga_satuan', 'jarak_km', 'biaya_jarak', 'total_harga'],
            ],
            'pesanan' => [
                'model' => Pesanan::class,
                'primary' => 'id_pesanan',
                'judul' => 'Pesanan',
                'kolom' => ['id_login', 'kode_pesanan', 'total_harga', 'status'],
            ],
            'pembayaran' => [
                'model' => Pembayaran::class,
                'primary' => 'id_pembayaran',
                'judul' => 'Pembayaran',
                'kolom' => ['id_pesanan', 'metode_pembayaran', 'status_pembayaran', 'bukti_pembayaran'],
            ],
        ];

        abort_unless(isset($map[$jenis]), 404);

        return $map[$jenis];
    }

    private function rules(string $jenis, ?int $id = null): array
    {
        return match ($jenis) {
            'loginac' => [
                'nama' => ['required', 'string', 'max:100'],
                'jenis_kelamin' => ['required', 'string', 'max:20'],
                'username' => ['required', 'string', 'max:100', Rule::unique('loginac', 'username')->ignore($id, 'id_login')],
                'email' => ['nullable', 'email', 'max:150', Rule::unique('loginac', 'email')->ignore($id, 'id_login')],
                'password' => [$id ? 'nullable' : 'required', 'string', 'min:6'],
                'role' => ['required', 'in:pemilik,pengguna'],
            ],
            'hubungikami' => [
                'nama' => ['required', 'string', 'max:100'],
                'email' => ['required', 'email', 'max:100'],
                'subjek' => ['required', 'string', 'max:150'],
                'pesan' => ['required', 'string'],
            ],
            'pusatservice' => [
                'lokasi_pusat' => ['required', 'string', 'max:150', Rule::unique('pusatservice', 'lokasi_pusat')->ignore($id, 'id_pusat')],
            ],
            'hargabeliac' => [
                'nama_merkac' => ['required', 'string', 'max:100', Rule::unique('hargabeliac', 'nama_merkac')->ignore($id, 'id_hargabeli')],
                'harga' => ['required', 'integer', 'min:0'],
            ],
            'hargajualac' => [
                'nama_merkac' => ['required', 'string', 'max:100', Rule::unique('hargajualac', 'nama_merkac')->ignore($id, 'id_hargajual')],
                'harga' => ['required', 'integer', 'min:0'],
            ],
            'hargaserviceac' => [
                'keterangan_ac' => ['required', 'string', 'max:191', Rule::unique('hargaserviceac', 'keterangan_ac')->ignore($id, 'id_hargaservice')],
                'harga' => ['required', 'integer', 'min:0'],
            ],
            'beliac' => [
                'id_hargabeli' => ['required', 'exists:hargabeliac,id_hargabeli'],
                'nama_pembeli' => ['required', 'string', 'max:100'],
                'jenis_kelamin' => ['required', 'string', 'max:20'],
                'lokasi' => ['required', 'string', 'max:150'],
                'jumlah' => ['required', 'integer', 'min:1'],
                'tanggal' => ['required', 'date'],
                'metode_pembayaran' => ['required', 'string', 'max:100'],
                'metode_pengiriman' => ['required', 'string', 'max:100'],
                'jarak_km' => ['required', 'numeric', 'min:0'],
            ],
            'jualac' => [
                'id_hargajual' => ['required', 'exists:hargajualac,id_hargajual'],
                'nama_penjual' => ['required', 'string', 'max:100'],
                'jenis_kelamin' => ['required', 'string', 'max:20'],
                'lokasi' => ['required', 'string', 'max:150'],
                'jumlah' => ['required', 'integer', 'min:1'],
                'tanggal' => ['required', 'date'],
                'metode_pembayaran' => ['required', 'string', 'max:100'],
                'metode_pengiriman' => ['required', 'string', 'max:100'],
                'jarak_km' => ['required', 'numeric', 'min:0'],
            ],
            'serviceac' => [
                'id_hargaservice' => ['required', 'exists:hargaserviceac,id_hargaservice'],
                'nama_client' => ['required', 'string', 'max:100'],
                'jenis_kelamin' => ['required', 'string', 'max:20'],
                'telp_client' => ['required', 'string', 'max:20'],
                'lokasi_client' => ['required', 'string', 'max:150'],
                'tanggal_awal' => ['required', 'date'],
                'tanggal_akhir' => ['required', 'date', 'after_or_equal:tanggal_awal'],
                'metode_pembayaran' => ['required', 'string', 'max:100'],
                'jarak_km' => ['required', 'numeric', 'min:0'],
            ],
            'pesanan' => [
                'id_login' => ['required', 'exists:loginac,id_login'],
                'kode_pesanan' => ['required', 'string', 'max:40', Rule::unique('pesanan', 'kode_pesanan')->ignore($id, 'id_pesanan')],
                'total_harga' => ['required', 'numeric', 'min:0'],
                'status' => ['required', 'in:menunggu_pembayaran,diproses,selesai,dibatalkan'],
            ],
            'pembayaran' => [
                'id_pesanan' => ['required', 'exists:pesanan,id_pesanan'],
                'metode_pembayaran' => ['required', 'in:qris,dana,shopeepay,gopay,bca'],
                'status_pembayaran' => ['required', 'in:menunggu,berhasil,gagal'],
                'bukti_pembayaran' => ['nullable', 'string', 'max:255'],
            ],
            default => [],
        };
    }

    private function siapkanData(string $jenis, array $data, HitungHargaAcService $hitungHarga): array
    {
        if ($jenis === 'beliac') {
            $harga = HargaBeliAc::findOrFail($data['id_hargabeli']);
            $hasil = $hitungHarga->hitung($harga->harga, (int) $data['jumlah'], (float) $data['jarak_km']);

            $data['merk_ac'] = $harga->nama_merkac;
            $data['biaya_jarak'] = $hasil['biaya_jarak'];
            $data['total_harga'] = $hasil['total_harga'];
        }

        if ($jenis === 'jualac') {
            $harga = HargaJualAc::findOrFail($data['id_hargajual']);
            $hasil = $hitungHarga->hitung($harga->harga, (int) $data['jumlah'], (float) $data['jarak_km']);

            $data['merk_ac'] = $harga->nama_merkac;
            $data['biaya_jarak'] = $hasil['biaya_jarak'];
            $data['total_harga'] = $hasil['total_harga'];
        }

        if ($jenis === 'serviceac') {
            $harga = HargaServiceAc::findOrFail($data['id_hargaservice']);
            $hasil = $hitungHarga->hitung($harga->harga, 1, (float) $data['jarak_km']);

            $data['keterangan_ac'] = $harga->keterangan_ac;
            $data['biaya_jarak'] = $hasil['biaya_jarak'];
            $data['total_harga'] = $hasil['total_harga'];
        }

        return $data;
    }

    private function opsiRelasi(): array
    {
        return [
            'hargaBeli' => HargaBeliAc::query()->orderBy('nama_merkac', 'asc')->get(),
            'hargaJual' => HargaJualAc::query()->orderBy('nama_merkac', 'asc')->get(),
            'hargaService' => HargaServiceAc::query()->orderBy('keterangan_ac', 'asc')->get(),
            'login' => LoginAc::query()->orderBy('nama', 'asc')->get(),
            'pesanan' => Pesanan::query()->orderBy('id_pesanan', 'desc')->get(),
        ];
}
}
