<x-layouts.app title="Keterampilan" activeMenu="keterampilan">
    <div class="my-5 container-fluid">
        <x-breadcrumb title="Keterampilan" :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => url('/')],
            ['label' => 'Keterampilan'],
        ]" />

        <x-bs-toast />
        
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                @can('keterampilan create')
                    <a href="{{ route('keterampilan.create') }}" class="btn btn-primary">
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
                                
                                    <th>Nama Keterampilan</th>
                                    <th>Deskripsi Keterampilan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($keterampilan as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    
                                        <td>{{ $row?->nama_keterampilan }}</td>
                                        <td>{{ $row?->deskripsi_keterampilan }}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            @can('keterampilan view')
                                                <div class="me-1">
                                                    <a href="{{ route('keterampilan.show', $row) }}"
                                                        class="btn btn-icon btn-outline-info btn-sm"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-title="Detail"
                                                        data-bs-placement="top">
                                                        <span class="bx bx-show"></span>
                                                    </a>
                                                </div>
                                            @endcan
                                            @can('keterampilan edit')
                                                <div class="me-1">
                                                    <a href="{{ route('keterampilan.edit', $row) }}"
                                                        class="btn btn-icon btn-outline-primary btn-sm"
                                                        data-bs-toggle="tooltip" data-bs-title="Edit"
                                                        data-bs-placement="top">
                                                        <span class="bx bx-pencil"></span>
                                                    </a>
                                                </div>
                                            @endcan
                                            @can('keterampilan delete')
                                                <form action="{{ route('keterampilan.destroy', $row) }}"
                                                    method="POST" class="d-inline"
                                                    @csrf
                                                    @method('DELETE')
                                                    <x-input.confirm-button text="Data keterampilan ini akan dihapus!"
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
                    {!! $keterampilan->withQueryString()->links() !!}
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>