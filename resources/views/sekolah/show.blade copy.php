<x-layouts.app title="Detail Sekolah" activeMenu="sekolah.show">
     <div class="container my-5">
        <x-breadcrumb title="Detail Sekolah" :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => url('/')],
            ['label' => 'Sekolah', 'url' => route('sekolah.index')],
            ['label' => 'Detail Sekolah'],
        ]" />

        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('sekolah.index') }}" class="btn btn-sm btn-secondary">
                        <i class="bx bx-arrow-back me-1"></i>Kembali
                    </a>

                    <div>
                        <a href="{{ route('sekolah.create') }}"
                            class="btn btn-sm btn-info">
                            <i class="bx bx-plus me-1"></i>Baru
                        </a>
                        <a href="{{ route('sekolah.edit', $sekolah) }}"
                            class="btn btn-sm btn-primary">
                            <i class="bx bx-pencil me-1"></i>Edit
                        </a>
                        <a href="{{ route('sekolah.destroy', $sekolah) }}"
                            class="btn btn-sm btn-danger">
                            <i class="bx bx-trash me-1"></i>Hapus
                        </a>
                    </div>

                </div>
            </div>
            <div class="card-body">
                <form class="row g-3">
                    
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Nama Sekolah</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $sekolah->nama_sekolah }}</div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Alamat Sekolah</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $sekolah->alamat_sekolah }}</div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Telepon Sekolah</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $sekolah->telepon_sekolah }}</div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Email Sekolah</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $sekolah->email_sekolah }}</div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Logo Sekolah</label>
                                </div>

                                <div class="col-md-8 form-group">: 
                                    <img src="{{ $sekolah->logo_sekolah ? asset('storage/logos/' . $sekolah->logo_sekolah) : "https://ui-avatars.com/api/?background=random&name={$unitsekolah->nama_unit_sekolah}" }}"
                                    alt="Logo Sekolah" class="img-fluid rounded shadow-sm mb-3" style="max-width: 200px;">
                                </div>

                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Status</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $sekolah->status }}</div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Keterangan</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $sekolah->keterangan }}</div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
