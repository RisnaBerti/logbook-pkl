<x-layouts.app title="Anak Pkl" activeMenu="anak-pkl">
    <div class="my-5 container-fluid">
        <x-breadcrumb title="Anak Pkl" :breadcrumbs="[['label' => 'Dashboard', 'url' => url('/')], ['label' => 'Anak Pkl']]" />

        <x-bs-toast />

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                @can('anak-pkl create')
                    <a href="{{ route('anak-pkl.create') }}" class="btn btn-primary">
                        <span class="bx bx-plus me-1"></span>Tambah Data
                    </a>
                @endcan
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Sekolah</th>
                                <th>Mentor</th>
                                <th>Periode Pkl</th>
                                <th>Nama</th>
                                <th class="text-nowrap">No Telp</th>
                                <th>Email</th>
                                <th>Foto</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($anakPkl as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->sekolah?->nama_sekolah }}</td>
                                    <td>{{ $row->mentor?->nama_mentor }}</td>
                                    <td>{{ now()->parse($row->periode_pkl?->tanggal_mulai)->format('d M Y') }} s.d
                                        {{ now()->parse($row->periode_pkl?->tanggal_selesai)->format('d M Y') }}</td>
                                    <td>{{ $row?->nama_anak_pkl }}</td>
                                    <td>{{ $row?->no_telp_anak_pkl }}</td>
                                    <td>{{ $row?->email_anak_pkl }}</td>
                                    <td>
                                        @if ($row->foto_anak_pkl)
                                            <img src="{{ asset('storage/foto/anak-pkl/' . $row->foto_anak_pkl) }}"
                                                alt="Logo Sekolah" style="max-width: 50px; max-height: 50px;">
                                        @else
                                            <span>Tidak ada logo</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            @can('anak-pkl view')
                                                <div class="me-1">
                                                    <a href="{{ route('anak-pkl.show', $row) }}"
                                                        class="btn btn-icon btn-outline-info btn-sm"
                                                        data-bs-toggle="tooltip" data-bs-title="Detail"
                                                        data-bs-placement="top">
                                                        <span class="bx bx-show"></span>
                                                    </a>
                                                </div>
                                            @endcan
                                            @can('anak-pkl edit')
                                                <div class="me-1">
                                                    <a href="{{ route('anak-pkl.edit', $row) }}"
                                                        class="btn btn-icon btn-outline-primary btn-sm"
                                                        data-bs-toggle="tooltip" data-bs-title="Edit"
                                                        data-bs-placement="top">
                                                        <span class="bx bx-pencil"></span>
                                                    </a>
                                                </div>
                                            @endcan
                                            @can('anak-pkl delete')
                                                <form action="{{ route('anak-pkl.destroy', $row) }}" method="POST"
                                                    class="d-inline" @csrf @method('DELETE') <x-input.confirm-button
                                                    text="Data anak pkl ini akan dihapus!" positive="Ya, hapus!"
                                                    icon="info" class="btn btn-icon btn-outline-danger btn-sm"
                                                    data-bs-toggle="tooltip" data-bs-title="Hapus" data-bs-placement="top">
                                                    @csrf
                                                    <span class="bx bx-trash"></span>
                                                    </x-input.confirm-button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="mt-3 d-flex justify-content-end">
                    {!! $anakPkl->withQueryString()->links() !!}
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
