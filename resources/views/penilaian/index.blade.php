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
                                <th>Tanggal Penilaian</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penilaian->groupBy('anak_pkl.id_anak_pkl') as $anakPklId => $nilaiGroup)
                                @php
                                    $firstNilai = $nilaiGroup->first();
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $firstNilai->anak_pkl?->nama_anak_pkl }}</td>
                                    <td>{{ $firstNilai->mentor?->nama_mentor }}</td>
                                    <td>{{ now()->parse($firstNilai?->tanggal_penilaian)->format('d M Y') }}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#detailModal{{ $anakPklId }}">
                                                <span class="bx bx-info-circle me-1"></span>Detail Nilai
                                            </button>
                                            @can('penilaian edit')
                                                <a href="{{ route('penilaian.edit', $firstNilai) }}"
                                                    class="btn btn-primary btn-sm ms-1">
                                                    <span class="bx bx-pencil me-1"></span>Edit
                                                </a>
                                            @endcan
                                            @can('penilaian delete')
                                                <form action="{{ route('penilaian.destroy', $firstNilai) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm ms-1"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                        <span class="bx bx-trash me-1"></span>Hapus
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>

                                        <!-- Modal Detail -->
                                        <div class="modal fade" id="detailModal{{ $anakPklId }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Detail Nilai -
                                                            {{ $firstNilai->anak_pkl?->nama_anak_pkl }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Keterampilan</th>
                                                                    <th>Nilai</th>
                                                                    <th>Keterangan</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($nilaiGroup as $index => $nilai)
                                                                    <tr>
                                                                        <td>{{ $index + 1 }}</td>
                                                                        <td>{{ $nilai->keterampilan?->nama_keterampilan }}
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <span
                                                                                class="badge bg-{{ $nilai->nilai >= 76 ? 'success' : 'danger' }}">
                                                                                {{ $nilai->nilai }}
                                                                            </span>
                                                                        </td>
                                                                        <td>{{ $nilai->keterangan }}</td>
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

                {{-- Pagination --}}
                <div class="mt-3 d-flex justify-content-end">
                    {!! $penilaian->withQueryString()->links() !!}
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
