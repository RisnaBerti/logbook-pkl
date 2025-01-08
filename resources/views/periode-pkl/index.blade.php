<x-layouts.app title="Periode Pkl" activeMenu="periode-pkl">
    <div class="my-5 container-fluid">
        <x-breadcrumb title="Periode Pkl" :breadcrumbs="[['label' => 'Dashboard', 'url' => url('/')], ['label' => 'Periode Pkl']]" />

        <x-bs-toast />

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                @can('periode-pkl create')
                    <a href="{{ route('periode-pkl.create') }}" class="btn btn-primary">
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
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Durasi Bulan</th>
                                <th>Keterangan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($periodePkl as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->sekolah?->nama_sekolah }}</td>
                                    <td>{{ now()->parse($row?->tanggal_mulai)->format('d M Y') }}</td>
                                    <td>{{ now()->parse($row?->tanggal_selesai)->format('d M Y')}}</td>
                                    <td>{{ $row?->durasi_bulan }} Bulan</td>
                                    <td>{{ $row?->keterangan }}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            @can('periode-pkl view')
                                                <div class="me-1">
                                                    <a href="{{ route('periode-pkl.show', $row) }}"
                                                        class="btn btn-icon btn-outline-info btn-sm"
                                                        data-bs-toggle="tooltip" data-bs-title="Detail"
                                                        data-bs-placement="top">
                                                        <span class="bx bx-show"></span>
                                                    </a>
                                                </div>
                                            @endcan
                                            @can('periode-pkl edit')
                                                <div class="me-1">
                                                    <a href="{{ route('periode-pkl.edit', $row) }}"
                                                        class="btn btn-icon btn-outline-primary btn-sm"
                                                        data-bs-toggle="tooltip" data-bs-title="Edit"
                                                        data-bs-placement="top">
                                                        <span class="bx bx-pencil"></span>
                                                    </a>
                                                </div>
                                            @endcan
                                            @can('periode-pkl delete')
                                                <form action="{{ route('periode-pkl.destroy', $row) }}" method="POST"
                                                    class="d-inline" @csrf @method('DELETE') <x-input.confirm-button
                                                    text="Data periode pkl ini akan dihapus!" positive="Ya, hapus!"
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
                    {!! $periodePkl->withQueryString()->links() !!}
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
