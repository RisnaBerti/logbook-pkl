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
                        <form method="GET" action="{{ route('rekap.jurnal') }}" class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Bulan</label>
                                <select class="form-select select2" name="bulan">
                                    @php
                                        $months = [
                                            1 => 'Januari',
                                            2 => 'Februari',
                                            3 => 'Maret',
                                            4 => 'April',
                                            5 => 'Mei',
                                            6 => 'Juni',
                                            7 => 'Juli',
                                            8 => 'Agustus',
                                            9 => 'September',
                                            10 => 'Oktober',
                                            11 => 'November',
                                            12 => 'Desember',
                                        ];
                                    @endphp
                                    @foreach ($months as $monthNum => $monthName)
                                        <option value="{{ $monthNum }}"
                                            {{ $forms['bulan'] == $monthNum ? 'selected' : '' }}>
                                            {{ $monthName }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Tahun</label>
                                <select class="form-select select2" name="tahun">
                                    @php
                                        $currentYear = date('Y');
                                        $startYear = 2023;
                                        $years = range($startYear, $currentYear);
                                    @endphp
                                    @foreach ($years as $year)
                                        <option value="{{ $year }}"
                                            {{ $forms['tahun'] == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @if (auth()->user()->id_anak_pkl)
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
                            @elseif(auth()->user()->id_mentor)
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
                            @else
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
                            @endif

                            <div class="col-md-2 d-flex align-items-end">
                                <div class="d-grid gap-2 d-md-flex">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-filter"></i> Filter
                                    </button>
                                    <a href="{{ route('rekap.jurnal') }}" class="btn btn-secondary">
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
                {{-- Di View --}}
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-3">
                            {{-- Kalender Jurnal: {{ $months[$forms['bulan']] }} {{ $forms['tahun'] }} --}}
                        </h5>
                        <div class="table-responsive">
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr class="bg-light">
                                        <th>Minggu</th>
                                        <th>Senin</th>
                                        <th>Selasa</th>
                                        <th>Rabu</th>
                                        <th>Kamis</th>
                                        <th>Jumat</th>
                                        <th>Sabtu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $currentDay = 1;
                                        $totalDays = count($calendar);
                                    @endphp

                                    @foreach (array_chunk($calendar, 7, true) as $week)
                                        <tr>
                                            @foreach ([0, 1, 2, 3, 4, 5, 6] as $dayOfWeek)
                                                <td
                                                    class="position-relative {{ isset($week[$currentDay]) && $week[$currentDay]['weekday'] == $dayOfWeek ? '' : 'bg-light' }}">
                                                    @if (isset($week[$currentDay]) && $week[$currentDay]['weekday'] == $dayOfWeek)
                                                        <div
                                                            class="{{ $week[$currentDay]['hasEntry'] ? 'bg-primary text-white' : '' }} 
                                                    {{ $week[$currentDay]['isToday'] ? 'border border-danger' : '' }} p-2">
                                                            {{ $currentDay }}
                                                            @if ($week[$currentDay]['hasEntry'])
                                                                <div>Ya</div>
                                                                <a href="{{ route('jurnal.show', ['tanggal_jurnal' => $week[$currentDay]['dateString']]) }}"
                                                                    class="stretched-link" data-bs-toggle="tooltip"
                                                                    title="Lihat detail jurnal"></a>
                                                            @endif
                                                        </div>
                                                        @php $currentDay++; @endphp
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
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
