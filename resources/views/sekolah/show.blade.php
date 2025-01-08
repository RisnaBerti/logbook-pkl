<x-layouts.app title="Detail Sekolah" activeMenu="sekolah.show">
    <div class="container my-5">
        <x-breadcrumb title="Detail Sekolah" :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => url('/')],
            ['label' => 'Sekolah', 'url' => route('sekolah.index')],
            ['label' => 'Detail Sekolah'],
        ]" />

        <div class="card shadow-sm border-0">
            <!-- Header Section with improved spacing and styling -->
            <div class="card-header bg-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('sekolah.index') }}" class="btn btn-outline-secondary btn-sm px-3">
                        <i class="bx bx-arrow-back me-1"></i>Kembali
                    </a>

                    <div class="btn-group">
                        <a href="{{ route('sekolah.create') }}" class="btn btn-outline-info btn-sm px-3">
                            <i class="bx bx-plus me-1"></i>Baru
                        </a>
                        <a href="{{ route('sekolah.edit', $sekolah) }}" class="btn btn-outline-primary btn-sm px-3">
                            <i class="bx bx-pencil me-1"></i>Edit
                        </a>
                        <a href="{{ route('sekolah.destroy', $sekolah) }}" class="btn btn-outline-danger btn-sm px-3">
                            <i class="bx bx-trash me-1"></i>Hapus
                        </a>
                    </div>
                </div>
            </div>

            <!-- Main Content Section with improved layout -->
            <div class="card-body p-4">
                <div class="row">
                    <!-- School Logo Section -->
                    <div class="col-md-4 text-center mb-4">
                        <div class="mb-3">
                            <img 
                                src="{{ $sekolah->logo_sekolah ? asset('storage/logos/' . $sekolah->logo_sekolah) : "https://ui-avatars.com/api/?background=random&name={$unitsekolah->nama_unit_sekolah}" }}"
                                alt="Logo Sekolah" 
                                class="img-fluid rounded-circle shadow-sm"
                                style="max-width: 200px; height: auto;"
                            >
                        </div>
                        <h4 class="text-primary mb-0">{{ $sekolah->nama_sekolah }}</h4>
                        <p class="text-muted">
                            <span class="badge {{ $sekolah->status === 'Aktif' ? 'bg-success' : 'bg-secondary' }}">
                                {{ $sekolah->status }}
                            </span>
                        </p>
                    </div>

                    <!-- School Details Section -->
                    <div class="col-md-8">
                        <div class="list-group list-group-flush">
                            <div class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-md-4 text-muted">
                                        <i class="bx bx-map-pin me-2"></i>Alamat
                                    </div>
                                    <div class="col-md-8">
                                        {{ $sekolah->alamat_sekolah }}
                                    </div>
                                </div>
                            </div>

                            <div class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-md-4 text-muted">
                                        <i class="bx bx-phone me-2"></i>Telepon
                                    </div>
                                    <div class="col-md-8">
                                        {{ $sekolah->telepon_sekolah }}
                                    </div>
                                </div>
                            </div>

                            <div class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-md-4 text-muted">
                                        <i class="bx bx-envelope me-2"></i>Email
                                    </div>
                                    <div class="col-md-8">
                                        {{ $sekolah->email_sekolah }}
                                    </div>
                                </div>
                            </div>

                            <div class="list-group-item px-0">
                                <div class="row">
                                    <div class="col-md-4 text-muted">
                                        <i class="bx bx-info-circle me-2"></i>Keterangan
                                    </div>
                                    <div class="col-md-8">
                                        {{ $sekolah->keterangan }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>