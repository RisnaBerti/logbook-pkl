<x-layouts.app title="Penilaian" activeMenu="penilaian">
    <div class="my-5 container-fluid">
        <x-breadcrumb title="Penilaian" :breadcrumbs="[['label' => 'Dashboard', 'url' => url('/')], ['label' => 'Penilaian']]" />

        <x-bs-toast />

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                @can('penilaian create')
                    <a href="{{ route('penilaian.create') }}" class="btn btn-primary">
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
                                <th>Anak Pkl</th>
                                <th>Mentor</th>
                                <th>Keterampilan</th>
                                <th>Tanggal Penilaian</th>
                                <th>Nilai</th>
                                <th>Keterangan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penilaian as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->anak_pkl?->nama_anak_pkl }}</td>
                                    <td>{{ $row->mentor?->nama_mentor }}</td>
                                    <td>{{ $row->keterampilan?->nama_keterampilan }}</td>
                                    <td>{{ now()->parse($row?->tanggal_penilaian)->format('d M Y') }}</td>
                                    <td>{{ $row?->nilai }}</td>
                                    <td>{{ $row?->keterangan }}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            @can('penilaian view')
                                                <div class="me-1">
                                                    <a href="{{ route('penilaian.show', $row) }}"
                                                        class="btn btn-icon btn-outline-info btn-sm"
                                                        data-bs-toggle="tooltip" data-bs-title="Detail"
                                                        data-bs-placement="top">
                                                        <span class="bx bx-show"></span>
                                                    </a>
                                                </div>
                                            @endcan
                                            @can('penilaian edit')
                                                <div class="me-1">
                                                    <a href="{{ route('penilaian.edit', $row) }}"
                                                        class="btn btn-icon btn-outline-primary btn-sm"
                                                        data-bs-toggle="tooltip" data-bs-title="Edit"
                                                        data-bs-placement="top">
                                                        <span class="bx bx-pencil"></span>
                                                    </a>
                                                </div>
                                            @endcan
                                            @can('penilaian delete')
                                                <form action="{{ route('penilaian.destroy', $row) }}" method="POST"
                                                    class="d-inline" @csrf @method('DELETE') <x-input.confirm-button
                                                    text="Data penilaian ini akan dihapus!" positive="Ya, hapus!"
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
                    {!! $penilaian->withQueryString()->links() !!}
                </div>
            </div>

            
        </div>
    </div>
</x-layouts.app>
