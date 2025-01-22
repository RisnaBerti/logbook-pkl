<x-layouts.app title="Laporan Jurnal" activeMenu="laporan-jurnal">
    <div class="my-5 container-fluid">
        <x-breadcrumb title="Laporan Jurnal" :breadcrumbs="[['label' => 'Dashboard', 'url' => url('/')], ['label' => 'Laporan Jurnal']]" />

        <x-bs-toast />

        <!-- Filter Section -->
        <div class="row mb-4">
            <div class="col-12">
                {{-- <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Filter Data</h5>
                        <form method="GET" action="{{ route('laporan.mentoring') }}" class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Rentang Tanggal</label>
                                <div class="input-group">
                                    <input type="date" class="form-control" name="tanggal_awal"
                                        value="{{ $forms['tanggal_awal'] ?? '' }}">
                                    <span class="input-group-text">sampai</span>
                                    <input type="date" class="form-control" name="tanggal_akhir"
                                        value="{{ $forms['tanggal_akhir'] ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Sekolah</label>
                                <select class="form-select select2" name="sekolah">
                                    <option value="">Pilih sekolah</option>
                                    @foreach ($sekolah as $key => $value)
                                        <option value="{{ $key }}"
                                            {{ $forms['sekolah'] == $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Mentor</label>
                                <select class="form-select select2" name="mentor">
                                    <option value="">Pilih Mentor</option>
                                    @foreach ($mentor as $key => $value)
                                        <option value="{{ $key }}"
                                            {{ $forms['mentor'] == $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2 d-flex align-datas-end">
                                <div class="d-grid gap-2 d-md-flex">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-filter"></i> Filter
                                    </button>
                                    <a href="{{ route('laporan.mentoring') }}" class="btn btn-secondary">
                                        <i class="fas fa-sync"></i> Reset
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> --}}

                <div class="card mb-4">
                    <div class="card-body">
                        <form action="{{ route('laporan.mentoring') }}" method="GET" id="form-filter">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Bulan</label>
                                        <select name="bulan" class="form-control select2" id="bulan">
                                            <option value="">Semua Bulan</option>
                                            @foreach ($daftar_bulan as $key => $value)
                                                <option value="{{ $key }}"
                                                    {{ $forms['bulan'] == $key ? 'selected' : '' }}>
                                                    {{ $value }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Tahun</label>
                                        <select name="tahun" class="form-control select2" id="tahun">
                                            <option value="">Semua Tahun</option>
                                            @foreach ($daftar_tahun as $tahun)
                                                <option value="{{ $tahun }}"
                                                    {{ $forms['tahun'] == $tahun ? 'selected' : '' }}>
                                                    {{ $tahun }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Mentor</label>
                                        <select name="mentor" class="form-control select2" id="mentor">
                                            <option value="">Semua Mentor</option>
                                            @foreach ($mentor as $id => $nama)
                                                <option value="{{ $id }}"
                                                    {{ $forms['mentor'] == $id ? 'selected' : '' }}>
                                                    {{ $nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Sekolah</label>
                                        <select name="sekolah" class="form-control select2" id="sekolah">
                                            <option value="">Semua Sekolah</option>
                                            @foreach ($sekolah as $id => $nama)
                                                <option value="{{ $id }}"
                                                    {{ $forms['sekolah'] == $id ? 'selected' : '' }}>
                                                    {{ $nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12 mt-3">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-search me-2"></i>Filter
                                    </button>
                                    <a href="{{ route('laporan.mentoring') }}" class="btn btn-secondary">
                                        <i class="fas fa-sync-alt me-2"></i>Reset
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Table Section -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="journal-table" class="table table-striped table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th clas="text-nowrap">No</th>
                                        <th clas="text-nowrap">Mentor</th>
                                        <th clas="text-nowrap">Sekolah</th>
                                        <th clas="text-nowrap">Periode Mentoring</th>
                                        <th clas="text-nowrap">Nama PKL</th>
                                        <th clas="text-nowrap">Periode Magang</th>
                                        <th clas="text-nowrap">Hari Mentor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data as $row)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $row->riwayat_mentoring?->mentor?->nama_mentor ?? '-' }}</td>
                                            <td>{{ $row->anak_pkl?->sekolah?->nama_sekolah ?? '-' }}</td>
                                            <td>
                                                @if ($row->riwayat_mentoring?->tanggal_mulai && $row->riwayat_mentoring?->tanggal_akhir)
                                                    {{ now()->parse($row->riwayat_mentoring->tanggal_mulai)->format('d M Y') }}
                                                    s.d
                                                    {{ now()->parse($row->riwayat_mentoring->tanggal_akhir)->format('d M Y') }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{ $row->anak_pkl?->nama_anak_pkl ?? '-' }}</td>
                                            <td>
                                                @if ($row->anak_pkl?->periode_pkl?->tanggal_mulai && $row->anak_pkl?->periode_pkl?->tanggal_selesai)
                                                    {{ now()->parse($row->anak_pkl->periode_pkl->tanggal_mulai)->format('d M Y') }}
                                                    s.d
                                                    {{ now()->parse($row->anak_pkl->periode_pkl->tanggal_selesai)->format('d M Y') }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{ $row->hari_mentor ?? '-' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-4">
                                                <div class="text-muted">
                                                    <i class="fas fa-info-circle me-2"></i>
                                                    Tidak ada data yang tersedia
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layouts.app>
<style>
    .cursor-pointer {
        cursor: pointer;
    }

    .select2-container {
        width: 100% !important;
    }

    .page-title-box {
        padding: 20px 0;
        background-color: #fff;
        margin-bottom: 20px;
    }
</style>
<script>
    $(document).ready(function() {
        // Initialize Select2
        $('.select2').select2({
            theme: 'bootstrap-5',
            width: '100%'
        });

        // Initialize DataTable
        $('#journal-table').DataTable({
            responsive: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json'
            },
            dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        });

        // Initialize tooltips
        $('[data-bs-toggle="tooltip"]').tooltip();
    });

    // Function to show image in modal
    function showImage(src) {
        Swal.fire({
            imageUrl: src,
            imageAlt: 'Gambar Pendukung',
            showConfirmButton: false,
            width: 'auto',
            padding: '2em',
            background: '#fff',
            showCloseButton: true
        });
    }
</script>
