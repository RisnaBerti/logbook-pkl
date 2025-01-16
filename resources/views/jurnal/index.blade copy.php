<x-layouts.app title="Jurnal" activeMenu="jurnal">
    <div class="my-5 container-fluid">
        <x-breadcrumb title="Jurnal" :breadcrumbs="[['label' => 'Dashboard', 'url' => url('/')], ['label' => 'Jurnal']]" />

        <x-bs-toast />

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                @can('jurnal create')
                    <a href="{{ route('jurnal.create') }}" class="btn btn-primary">
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
                                <th>Aktifitas</th>
                                <th class="text-nowrap">Tanggal Jurnal</th>
                                <th class="text-nowrap">Waktu Mulai</th>
                                <th class="text-nowrap">Waktu Selesai</th>
                                <th>Durasi</th>
                                <th>Keterangan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jurnal as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $row->anak_pkl?->nama_anak_pkl }}</td>
                                    <td>{{ $row->mentor?->nama_mentor }}</td>
                                    <td>{{ $row?->aktifitas }}</td>
                                    <td>{{ now()->parse($row?->tanggal_jurnal)->format('d M Y') }} </td>
                                    <td>{{ now()->parse($row?->waktu_mulai_aktifitas)->format('H:i') }}</td>
                                    <td>{{ now()->parse($row?->waktu_selesai_aktifitas)->format('H:i') }}</td>
                                    <td>{{ $row?->durasi_format }}</td>
                                    <td>{{ $row?->keterangan }}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            @can('jurnal view')
                                                <div class="me-1">
                                                    <a href="{{ route('jurnal.show', $row) }}"
                                                        class="btn btn-icon btn-outline-info btn-sm"
                                                        data-bs-toggle="tooltip" data-bs-title="Detail"
                                                        data-bs-placement="top">
                                                        <span class="bx bx-show"></span>
                                                    </a>
                                                </div>
                                            @endcan
                                            @can('jurnal edit')
                                                <div class="me-1">
                                                    <a href="{{ route('jurnal.edit', $row) }}"
                                                        class="btn btn-icon btn-outline-primary btn-sm"
                                                        data-bs-toggle="tooltip" data-bs-title="Edit"
                                                        data-bs-placement="top">
                                                        <span class="bx bx-pencil"></span>
                                                    </a>
                                                </div>
                                            @endcan
                                            @can('jurnal delete')
                                                <form action="{{ route('jurnal.destroy', $row) }}" method="POST"
                                                    class="d-inline" @csrf @method('POST') <x-input.confirm-button
                                                    text="Data jurnal ini akan dihapus!" positive="Ya, hapus!"
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
                    {!! $jurnal->withQueryString()->links() !!}
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
