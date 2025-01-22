<x-layouts.app title="Detail Mentoring" activeMenu="detail-mentoring">
    <div class="my-5 container-fluid">
        <x-breadcrumb title="Detail Mentoring" :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => url('/')],
            ['label' => 'Detail Mentoring'],
        ]" />

        <x-bs-toast />
        
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                @can('detail-mentoring create')
                    <a href="{{ route('detail-mentoring.create') }}" class="btn btn-primary">
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
                                
                                    <th>Id Riwayat Mentoring</th>
                                    <th>Id Anak Pkl</th>
                                    <th>Id Mentor</th>
                                    <th>Hari Mentor</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detailMentoring as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    
                                        <td>{{ $row?->id_riwayat_mentoring }}</td>
                                        <td>{{ $row?->id_anak_pkl }}</td>
                                        <td>{{ $row?->id_mentor }}</td>
                                        <td>{{ $row?->hari_mentor }}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            @can('detail-mentoring view')
                                                <div class="me-1">
                                                    <a href="{{ route('detail-mentoring.show', $row) }}"
                                                        class="btn btn-icon btn-outline-info btn-sm"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-title="Detail"
                                                        data-bs-placement="top">
                                                        <span class="bx bx-show"></span>
                                                    </a>
                                                </div>
                                            @endcan
                                            @can('detail-mentoring edit')
                                                <div class="me-1">
                                                    <a href="{{ route('detail-mentoring.edit', $row) }}"
                                                        class="btn btn-icon btn-outline-primary btn-sm"
                                                        data-bs-toggle="tooltip" data-bs-title="Edit"
                                                        data-bs-placement="top">
                                                        <span class="bx bx-pencil"></span>
                                                    </a>
                                                </div>
                                            @endcan
                                            @can('detail-mentoring delete')
                                                <form action="{{ route('detail-mentoring.destroy', $row) }}"
                                                    method="POST" class="d-inline"
                                                    @csrf
                                                    @method('POST')
                                                    <x-input.confirm-button text="Data detail mentoring ini akan dihapus!"
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
                    {!! $detailMentoring->withQueryString()->links() !!}
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>