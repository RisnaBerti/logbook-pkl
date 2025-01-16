<x-layouts.app title="Laporan Jurnal" activeMenu="laporan-jurnal">
    <div class="my-5 container-fluid">
        <x-breadcrumb title="Laporan Jurnal" :breadcrumbs="[['label' => 'Dashboard', 'url' => url('/')], ['label' => 'Laporan Jurnal']]" />

        <x-bs-toast />

        <!-- Filter Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Filter Data</h5>
                        <form method="GET" action="{{ route('laporan.jurnal') }}" class="row g-3">
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
                                <label class="form-label">Anak PKL</label>
                                <select class="form-select select2" name="anak_pkl">
                                    <option value="">Pilih Anak PKL</option>
                                    @foreach ($anak_pkl as $key => $value)
                                        <option value="{{ $key }}"
                                            {{ $forms['anak_pkl'] == $key ? 'selected' : '' }}>
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

                            <div class="col-md-2 d-flex align-items-end">
                                <div class="d-grid gap-2 d-md-flex">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-filter"></i> Filter
                                    </button>
                                    <a href="{{ route('laporan.jurnal') }}" class="btn btn-secondary">
                                        <i class="fas fa-sync"></i> Reset
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
                                        <th width="5%">No</th>
                                        <th>Nama</th>
                                        <th width="12%">Tanggal</th>
                                        <th width="10%">Durasi</th>
                                        <th>Aktivitas</th>
                                        <th>Keterangan</th>
                                        <th width="10%">Gambar</th>
                                        <th width="8%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data as $row)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $row->anak_pkl?->nama_anak_pkl }}</td>
                                            <td>{{ now()->parse($row->periode_pkl?->tanggal_jurnal)->format('d M Y') }}
                                            </td>
                                            <td>{{ $row->durasi_format }}</td>
                                            <td>{{ $row->aktifitas }}</td>
                                            <td>{{ $row->keterangan }}</td>
                                            <td class="text-center">
                                                @if ($row->gambar_pendukung)
                                                    <img src="{{ asset('storage/jurnal/' . $row->gambar_pendukung) }}"
                                                        class="img-thumbnail cursor-pointer" alt="Gambar"
                                                        style="max-width: 50px; max-height: 50px;"
                                                        onclick="showImage(this.src)">
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @can('feedback view')
                                                    <a href="{{ route('feedback.show', $row) }}"
                                                        class="btn btn-info btn-sm" data-bs-toggle="tooltip"
                                                        title="Lihat Detail">
                                                        <i class="fas fa-info-circle"></i>
                                                    </a>
                                                @endcan
                                            </td>
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
