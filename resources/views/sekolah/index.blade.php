<x-layouts.app title="Sekolah" activeMenu="sekolah">
    <div class="my-5 container-fluid">
        <x-breadcrumb title="Sekolah" :breadcrumbs="[['label' => 'Dashboard', 'url' => url('/')], ['label' => 'Sekolah']]" />

        <x-bs-toast />

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                @can('sekolah create')
                    <a href="{{ route('sekolah.create') }}" class="btn btn-primary">
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

                                <th>Nama Sekolah</th>
                                <th>Alamat Sekolah</th>
                                <th>Telepon Sekolah</th>
                                <th>Email Sekolah</th>
                                <th>Logo Sekolah</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sekolah as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row?->nama_sekolah }}</td>
                                    <td>{{ $row?->alamat_sekolah }}</td>
                                    <td>{{ $row?->telepon_sekolah }}</td>
                                    <td>{{ $row?->email_sekolah }}</td>
                                    <td>
                                        @if ($row->logo_sekolah)
                                            <img src="{{ asset('storage/logos/' . $row->logo_sekolah) }}"
                                                alt="Logo Sekolah" style="max-width: 50px; max-height: 50px;">
                                        @else
                                            <span>Tidak ada logo</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($row?->status == '1')
                                            <span class="badge bg-success">MOU</span>
                                        @elseif ($row?->status == '0')
                                            <span class="badge bg-danger">Belum MOU</span>
                                        @else
                                            <i class="text-danger">undefined</i>
                                        @endif
                                    </td>
                                    <td>{{ $row?->keterangan }}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            @can('sekolah view')
                                                <div class="me-1">
                                                    <a href="{{ route('sekolah.show', $row) }}"
                                                        class="btn btn-icon btn-outline-info btn-sm"
                                                        data-bs-toggle="tooltip" data-bs-title="Detail"
                                                        data-bs-placement="top">
                                                        <span class="bx bx-show"></span>
                                                    </a>
                                                </div>
                                            @endcan
                                            @can('sekolah edit')
                                                <div class="me-1">
                                                    <a href="{{ route('sekolah.edit', $row) }}"
                                                        class="btn btn-icon btn-outline-primary btn-sm"
                                                        data-bs-toggle="tooltip" data-bs-title="Edit"
                                                        data-bs-placement="top">
                                                        <span class="bx bx-pencil"></span>
                                                    </a>
                                                </div>
                                            @endcan
                                            @can('sekolah delete')
                                                <form action="{{ route('sekolah.destroy', $row) }}" method="POST"
                                                    class="d-inline" @csrf @method('DELETE') <x-input.confirm-button
                                                    text="Data sekolah ini akan dihapus!" positive="Ya, hapus!"
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
                    {!! $sekolah->withQueryString()->links() !!}
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
