<x-layouts.app title="Mentor" activeMenu="mentor">
    <div class="my-5 container-fluid">
        <x-breadcrumb title="Mentor" :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => url('/')],
            ['label' => 'Mentor'],
        ]" />

        <x-bs-toast />
        
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                @can('mentor create')
                    <a href="{{ route('mentor.create') }}" class="btn btn-primary">
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
                                
                                    <th>Nama Mentor</th>
                                    <th>Email Mentor</th>
                                    <th>Alamat Mentor</th>
                                    <th>No Telp Mentor</th>
                                    <th>Foto Mentor</th>
                                    <th>Ttd Mentor</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mentor as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    
                                        <td>{{ $row?->nama_mentor }}</td>
                                        <td>{{ $row?->email_mentor }}</td>
                                        <td>{{ $row?->alamat_mentor }}</td>
                                        <td>{{ $row?->no_telp_mentor }}</td>
                                        <td>{{ $row?->foto_mentor }}</td>
                                        <td>{{ $row?->ttd_mentor }}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            @can('mentor view')
                                                <div class="me-1">
                                                    <a href="{{ route('mentor.show', $row) }}"
                                                        class="btn btn-icon btn-outline-info btn-sm"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-title="Detail"
                                                        data-bs-placement="top">
                                                        <span class="bx bx-show"></span>
                                                    </a>
                                                </div>
                                            @endcan
                                            @can('mentor edit')
                                                <div class="me-1">
                                                    <a href="{{ route('mentor.edit', $row) }}"
                                                        class="btn btn-icon btn-outline-primary btn-sm"
                                                        data-bs-toggle="tooltip" data-bs-title="Edit"
                                                        data-bs-placement="top">
                                                        <span class="bx bx-pencil"></span>
                                                    </a>
                                                </div>
                                            @endcan
                                            @can('mentor delete')
                                                <form action="{{ route('mentor.destroy', $row) }}"
                                                    method="POST" class="d-inline"
                                                    @csrf
                                                    @method('DELETE')
                                                    <x-input.confirm-button text="Data mentor ini akan dihapus!"
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
                    {!! $mentor->withQueryString()->links() !!}
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>