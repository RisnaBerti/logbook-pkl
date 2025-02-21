<x-layouts.app title="Sertifikat" activeMenu="sertifikat">
    <div class="my-5 container-fluid">
        <x-breadcrumb title="Sertifikat" :breadcrumbs="[['label' => 'Dashboard', 'url' => url('/')], ['label' => 'Sertifikat']]" />

        <x-bs-toast />

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0 card-title">Preview Sertifikat</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Sertifikat Bagian Depan -->
                    <div class="mb-4 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0 card-title">Sertifikat Bagian Depan</h6>
                            </div>
                            <div class="card-body">
                                <div class="position-relative">
                                    @if ($sertifikat?->sertifikat_depan)
                                        @php
                                            $extDepan = pathinfo($sertifikat->sertifikat_depan, PATHINFO_EXTENSION);
                                        @endphp

                                        @if ($extDepan === 'pdf')
                                            <iframe
                                                src="{{ asset('storage/sertifikat/' . $sertifikat->sertifikat_depan) }}"
                                                style="width: 100%; height: 500px; border: none;">
                                                Browser Anda tidak mendukung pratinjau PDF.
                                            </iframe>
                                        @else
                                            <img src="{{ asset('storage/sertifikat/' . $sertifikat->sertifikat_depan) }}"
                                                alt="Sertifikat Depan" class="rounded img-fluid">
                                        @endif
                                    @else
                                        <span>Tidak ada Sertifikat</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sertifikat Bagian Belakang -->
                    <div class="mb-4 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0 card-title">Sertifikat Bagian Belakang</h6>
                            </div>
                            <div class="card-body">
                                <div class="position-relative">
                                    @if ($sertifikat?->sertifikat_belakang)
                                        @php
                                            $extBelakang = pathinfo(
                                                $sertifikat->sertifikat_belakang,
                                                PATHINFO_EXTENSION,
                                            );
                                        @endphp

                                        @if ($extBelakang === 'pdf')
                                            <iframe
                                                src="{{ asset('storage/sertifikat/' . $sertifikat->sertifikat_belakang) }}"
                                                style="width: 100%; height: 500px; border: none;">
                                                Browser Anda tidak mendukung pratinjau PDF.
                                            </iframe>
                                        @else
                                            <img src="{{ asset('storage/sertifikat/' . $sertifikat->sertifikat_belakang) }}"
                                                alt="Sertifikat Belakang" class="rounded img-fluid">
                                        @endif
                                    @else
                                        <span>Tidak ada Sertifikat</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol Unduh dan Cetak -->
                <div class="mt-3 row">
                    <div class="text-center col-12">
                        <button class="btn btn-primary me-2" onclick="window.print()">
                            <i class="bx bx-printer me-1"></i>Cetak Sertifikat
                        </button>
                        @if ($sertifikat?->sertifikat_depan)
                            <a href="{{ asset('storage/sertifikat/' . $sertifikat->sertifikat_depan) }}"
                                class="btn btn-success" download>
                                <i class="bx bx-download me-1"></i>Unduh Sertifikat Depan
                            </a>
                        @endif
                        @if ($sertifikat?->sertifikat_belakang)
                            <a href="{{ asset('storage/sertifikat/' . $sertifikat->sertifikat_belakang) }}"
                                class="btn btn-success" download>
                                <i class="bx bx-download me-1"></i>Unduh Sertifikat Belakang
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Informasi Sertifikat -->
                <div class="mt-4 row">
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
