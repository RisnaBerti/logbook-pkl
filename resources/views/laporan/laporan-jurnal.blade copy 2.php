<x-layouts.app title="Laporan Jurnal" activeMenu="laporan-jurnal">
    <div class="my-5 container-fluid">
        <x-breadcrumb title="Laporan Jurnal" :breadcrumbs="[['label' => 'Dashboard', 'url' => url('/')], ['label' => 'Laporan Jurnal']]" />

        <x-bs-toast />

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <form method="GET" action="{{ route('laporan.jurnal') }}">
                    <div class="d-flex flex-wrap gap-2 align-items-end">
                        <!-- Input Rentang Tanggal -->
                        <x-input.daterangepicker name1="tanggal_awal" name2="tanggal_akhir" :value1="old('tanggal_awal', $forms['tanggal_awal'])"
                            :value2="old('tanggal_akhir', $forms['tanggal_akhir'])" placeholder="Pilih Rentang Tanggal" opens="right"
                            customRangeLabel="Tanggal" />

                        <!-- Dropdown Anak PKL -->
                        <x-input.select2 name="anak_pkl" :options="$anak_pkl" :selected="old('anak_pkl', $forms['anak_pkl'])"
                            placeholder="Pilih Anak PKL" />

                        <!-- Dropdown Mentor -->
                        <x-input.select2 name="mentor" :options="$mentor" :selected="old('mentor', $forms['mentor'])"
                            placeholder="Pilih Mentor" />

                        <!-- Tombol Proses -->
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-filter"></i> Proses
                        </button>

                        <!-- Tombol Reset -->
                        <a href="{{ route('laporan.jurnal') }}" class="btn btn-secondary">
                            <i class="fas fa-sync"></i> Reset
                        </a>
                    </div>
                </form>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                {{-- <th>Mentor</th> --}}
                                <th>Tanggal</th>
                                <th>Durasi</th>
                                <th>Aktivitas</th>
                                <th>Keterangan</th>
                                <th>Gambar Pendukung</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->anak_pkl?->nama_anak_pkl }}</td>
                                    {{-- <td>{{ $row->mentor?->nama_mentor }}</td> --}}
                                    <td>{{ now()->parse($row->periode_pkl?->tanggal_jurnal)->format('d M Y') }}</td>
                                    <td>{{ $row?->durasi }}</td>
                                    <td>{{ $row?->aktifitas }}</td>
                                    <td>{{ $row?->keterangan }}</td>
                                    <td>
                                        @if ($row->gambar_pendukung)
                                            <img src="{{ asset('storage/jurnal/' . $row->gambar_pendukung) }}"
                                                alt="Gambar" style="max-width: 50px; max-height: 50px;">
                                        @else
                                            <span>Tidak ada Gambar</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            @can('feedback view')
                                                <div class="me-1">
                                                    <a href="{{ route('feedback.show', $row) }}" class="btn btn-info btn-sm"
                                                        data-bs-toggle="tooltip" data-bs-title="Detail"
                                                        data-bs-placement="top">
                                                        <span class="bx bx-info-circle me-1"></span>Detail
                                                    </a>
                                                </div>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                {{-- <div class="mt-3 d-flex justify-content-end">
                    {!! $anakPkl->withQueryString()->links() !!}
                </div> --}}
            </div>
        </div>
    </div>

</x-layouts.app>
