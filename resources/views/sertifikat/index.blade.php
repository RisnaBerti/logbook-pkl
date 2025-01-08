<x-layouts.app title="Sertifikat" activeMenu="sertifikat">
    <div class="my-5 container-fluid">
        <x-breadcrumb title="Sertifikat" :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => url('/')],
            ['label' => 'Sertifikat'],
        ]" />

        <x-bs-toast />
        
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                @can('sertifikat create')
                    <a href="{{ route('sertifikat.create') }}" class="btn btn-primary">
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
                                
                                    <th>Id Anak Pkl</th>
                                    <th>Judul Sertifikat</th>
                                    <th>Nama Pengesah</th>
                                    <th>Tanggal Sertifikat</th>
                                    <th>Keterangan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sertifikat as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    
                                        <td>{{ $row?->id_anak_pkl }}</td>
                                        <td>{{ $row?->judul_sertifikat }}</td>
                                        <td>{{ $row?->nama_pengesah }}</td>
                                        <td>{{ $row?->tanggal_sertifikat }}</td>
                                        <td>{{ $row?->keterangan }}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            @can('sertifikat view')
                                                <div class="me-1">
                                                    <a href="{{ route('sertifikat.show', $row) }}"
                                                        class="btn btn-icon btn-outline-info btn-sm"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-title="Detail"
                                                        data-bs-placement="top">
                                                        <span class="bx bx-show"></span>
                                                    </a>
                                                </div>
                                            @endcan
                                            @can('sertifikat edit')
                                                <div class="me-1">
                                                    <a href="{{ route('sertifikat.edit', $row) }}"
                                                        class="btn btn-icon btn-outline-primary btn-sm"
                                                        data-bs-toggle="tooltip" data-bs-title="Edit"
                                                        data-bs-placement="top">
                                                        <span class="bx bx-pencil"></span>
                                                    </a>
                                                </div>
                                            @endcan
                                            @can('sertifikat delete')
                                                <form action="{{ route('sertifikat.destroy', $row) }}"
                                                    method="POST" class="d-inline"
                                                    @csrf
                                                    @method('DELETE')
                                                    <x-input.confirm-button text="Data sertifikat ini akan dihapus!"
                                                        positive="Ya, hapus!" icon="info"
                                                        class="btn btn-icon btn-outline-danger btn-sm"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-title="Hapus"
                                                        data-bs-placement="top">
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
                    {!! $sertifikat->withQueryString()->links() !!}
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>