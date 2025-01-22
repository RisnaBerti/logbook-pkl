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
                                <th>Mentor</th>
                                <th class="text-nowrap">Tanggal Mulai</th>
                                <th class="text-nowrap">Tanggal Selesai</th>
                                <th class="text-center text-nowrap">Detail</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($riwayatMentoring as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->mentor?->nama_mentor }}</td>
                                    <td>{{ now()->parse($item->tanggal_mulai)->format('d M Y') }}</td>
                                    <td>{{ now()->parse($item->tanggal_akhir)->format('d M Y') }}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            @can('detail-mentoring view')
                                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                    data-bs-title="Detail"
                                                    data-bs-target="#detailModal{{ $item->id_riwayat_mentoring }}">
                                                    <span class="bx bx-info-circle me-1"> Detail</span>
                                                </button>
                                            @endcan
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            @can('riwayat-mentoring edit')
                                                <a href="{{ route('riwayat-mentoring.edit', $item) }}"
                                                    class="btn btn-primary btn-sm ms-1" data-bs-toggle="edit">
                                                    <span class="bx bx-pencil me-1"></span>
                                                </a>
                                            @endcan
                                            @can('riwayat-mentoring delete')
                                                <form action="{{ route('riwayat-mentoring.destroy', $item) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm ms-1"
                                                        data-bs-toggle="hapus"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                        <span class="bx bx-trash me-1"></span>
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>

                                        <!-- Modal Detail -->
                                        <div class="modal fade" id="detailModal{{ $item->id_riwayat_mentoring }}"
                                            tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <div class="align-items-end">
                                                            <h5 class="modal-title">Detail Mentoring Anak PKL -
                                                                {{ $item->mentor?->nama_mentor }}</h5>
                                                            <p class="mb-0">Periode:
                                                                {{ now()->parse($item->tanggal_mulai)->format('d M Y') }}
                                                                s.d
                                                                {{ now()->parse($item->tanggal_akhir)->format('d M Y') }}
                                                            </p>
                                                        </div>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th class="text-nowrap">Anak Pkl</th>
                                                                    <th class="text-nowrap">Sekolah</th>
                                                                    <th class="text-nowrap">Jumlah Hari</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($item->detail_mentoring as $detail)
                                                                    <tr>
                                                                        <td>{{ $loop->iteration }}</td>
                                                                        <td>{{ $detail->anak_pkl?->nama_anak_pkl }}
                                                                        <td>{{ $detail->anak_pkl->sekolah?->nama_sekolah }}
                                                                        <td>{{ $detail->hari_mentor }}
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-3 d-flex justify-content-end">
                    {!! $riwayatMentoring->withQueryString()->links() !!}
                </div>
            </div>

        </div>
    </div>
</x-layouts.app>
