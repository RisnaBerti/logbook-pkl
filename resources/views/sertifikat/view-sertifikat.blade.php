<x-layouts.app title="Sertifikat" activeMenu="sertifikat">
    <div class="my-5 container-fluid">
        <x-breadcrumb title="Sertifikat" :breadcrumbs="[['label' => 'Dashboard', 'url' => url('/')], ['label' => 'Sertifikat']]" />

        <x-bs-toast />

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Preview Sertifikat</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Front Certificate -->
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Sertifikat Bagian Depan</h6>
                            </div>
                            <div class="card-body">
                                <div class="position-relative">
                                    @if ($sertifikat?->sertifikat_depan)
                                        <img src="{{ asset('storage/sertifikat/' . $sertifikat->sertifikat_depan) }}"
                                            alt="Sertifikat Depan" class="img-fluid rounded">
                                    @else
                                        <span>Tidak ada Sertifikat</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Back Certificate -->
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Sertifikat Bagian Belakang</h6>
                            </div>
                            <div class="card-body">
                                @if ($sertifikat?->sertifikat_belakang)
                                    <img src="{{ asset('storage/sertifikat/' . $sertifikat->sertifikat_belakang) }}"
                                        alt="Sertifikat Belakang" class="img-fluid rounded">
                                @else
                                    <span>Tidak ada Sertifikat</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Download Buttons -->
                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <button class="btn btn-primary me-2" onclick="window.print()">
                            <i class="bx bx-printer me-1"></i>Cetak Sertifikat
                        </button>
                        {{-- <a href="{{ route('sertifikat.download', $sertifikat?->id_sertifikat) }}"
                            class="btn btn-success">
                            <i class="bx bx-download me-1"></i>Unduh Sertifikat
                        </a> --}}
                    </div>
                </div>

                <!-- Certificate Information -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="alert alert-info">
                            <i class="bx bx-info-circle me-2"></i>
                            Sertifikat ini merupakan bukti resmi telah menyelesaikan program Praktik Kerja Lapangan.
                            Silakan unduh atau cetak sertifikat sesuai kebutuhan.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <style>
        .certificate-content {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 8px;
        }

        .certificate-name {
            font-family: 'Times New Roman', serif;
            font-size: 23px;
            font-weight: bold;
            color: #000;
            margin-top: 5.5rem;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 1px;
            line-height: 1.2;
        }

        .certificate-details {
            font-family: 'Arial', sans-serif;
            font-size: 10px;
            color: #333;
            line-height: 1.5;
            margin-top: 10px;
        }

        @media print {

            .breadcrumb,
            .card-header,
            .btn,
            .alert {
                display: none !important;
            }

            .card {
                border: none !important;
            }

            .card-body {
                padding: 0 !important;
            }

            .certificate-content {
                background-color: transparent;
            }
        }
    </style>

</x-layouts.app>
