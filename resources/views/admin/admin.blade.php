@extends('utama')

@section('content')
    <section class="rounded-3xl bg-white p-6 shadow-sm dark:bg-slate-900">
        <div class="flex flex-col justify-between gap-4 md:flex-row md:items-center">
            <div>
                <h1 class="text-2xl font-bold">CRUD {{ $judul }}</h1>
                <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Halaman ini hanya dapat diakses oleh pemilik.</p>
            </div>

            <a href="{{ route('pemilik.crud.create', $jenis) }}" class="rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white hover:bg-blue-700">
                Tambah Data
            </a>
        </div>

        <div class="mt-6 overflow-x-auto">
            <table class="w-full min-w-[900px] border-collapse text-sm">
                <thead>
                    <tr class="border-b border-slate-200 text-left dark:border-slate-800">
                        <th class="p-3">ID</th>
                        @foreach($kolom as $field)
                            <th class="p-3">{{ ucwords(str_replace('_', ' ', $field)) }}</th>
                        @endforeach
                        <th class="p-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $item)
                        <tr class="border-b border-slate-200 dark:border-slate-800">
                            <td class="p-3">{{ $item->{$primary} }}</td>

                            @foreach($kolom as $field)
                                <td class="p-3">
                                    @if($field === 'password')
                                        ********
                                    @elseif(is_numeric($item->{$field} ?? null) && str_contains($field, 'harga'))
                                        Rp {{ number_format($item->{$field}, 0, ',', '.') }}
                                    @else
                                        {{ $item->{$field} ?? '-' }}
                                    @endif
                                </td>
                            @endforeach

                            <td class="p-3">
                                <div class="flex gap-2">
                                    <a href="{{ route('pemilik.crud.edit', [$jenis, $item->{$primary}]) }}" class="rounded-lg bg-yellow-500 px-3 py-2 text-xs font-semibold text-white hover:bg-yellow-600">
                                        Edit
                                    </a>

                                    <form action="{{ route('pemilik.crud.destroy', [$jenis, $item->{$primary}]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-lg bg-red-600 px-3 py-2 text-xs font-semibold text-white hover:bg-red-700">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ count($kolom) + 2 }}" class="p-6 text-center text-slate-500">
                                Data belum tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $data->links() }}
        </div>
    </section>
@endsection
