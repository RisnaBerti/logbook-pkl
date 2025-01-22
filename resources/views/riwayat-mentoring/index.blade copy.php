<x-layouts.app title="Riwayat Mentoring" activeMenu="riwayat-mentoring">
    <div class="my-5 container-fluid">
        <x-breadcrumb title="Riwayat Mentoring" :breadcrumbs="[['label' => 'Dashboard', 'url' => url('/')], ['label' => 'Riwayat Mentoring']]" />

        <x-bs-toast />

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                @can('riwayat-mentoring create')
                    <a href="{{ route('riwayat-mentoring.create') }}" class="btn btn-primary">
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
                                <th>Periode Mentoring</th>
                                <th>Hari Mentor</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($riwayatMentoring as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->anak_pkl?->nama_anak_pkl }}</td>
                                    <td>{{ $row->mentor?->nama_mentor }}</td>
                                    <td>{{ now()->parse($row?->tanggal_mulai)->format('d M Y') }} s.d
                                        {{ now()->parse($row?->tanggal_selesai)->format('d M Y') }}</td>
                                    <td>{{ $row?->hari_mentor }} Hari</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            {{-- @can('riwayat-mentoring view')
                                                <div class="me-1">
                                                    <a href="{{ route('riwayat-mentoring.show', $row) }}"
                                                        class="btn btn-icon btn-outline-info btn-sm"
                                                        data-bs-toggle="tooltip" data-bs-title="Detail"
                                                        data-bs-placement="top">
                                                        <span class="bx bx-show"></span>
                                                    </a>    
                                                </div>
                                            @endcan --}}
                                            @can('riwayat-mentoring edit')
                                                <div class="me-1">
                                                    <a href="{{ route('riwayat-mentoring.edit', $row) }}"
                                                        class="btn btn-icon btn-outline-primary btn-sm"
                                                        data-bs-toggle="tooltip" data-bs-title="Edit"
                                                        data-bs-placement="top">
                                                        <span class="bx bx-pencil"></span>
                                                    </a>
                                                </div>
                                            @endcan
                                            @can('riwayat-mentoring delete')
                                                <form action="{{ route('riwayat-mentoring.destroy', $row) }}" method="POST"
                                                    class="d-inline" @csrf @method('DELETE') <x-input.confirm-button
                                                    text="Data riwayat mentoring ini akan dihapus!" positive="Ya, hapus!"
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
                    {!! $riwayatMentoring->withQueryString()->links() !!}
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
