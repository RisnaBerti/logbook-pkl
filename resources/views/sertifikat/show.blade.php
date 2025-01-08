<x-layouts.app title="Detail Sertifikat" activeMenu="sertifikat.show">
     <div class="container my-5">
        <x-breadcrumb title="Detail Sertifikat" :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => url('/')],
            ['label' => 'Sertifikat', 'url' => route('sertifikat.index')],
            ['label' => 'Detail Sertifikat'],
        ]" />

        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('sertifikat.index') }}" class="btn btn-sm btn-secondary">
                        <i class="bx bx-arrow-back me-1"></i>Kembali
                    </a>

                    <div>
                        <a href="{{ route('sertifikat.create') }}"
                            class="btn btn-sm btn-info">
                            <i class="bx bx-plus me-1"></i>Baru
                        </a>
                        <a href="{{ route('sertifikat.edit', $sertifikat) }}"
                            class="btn btn-sm btn-primary">
                            <i class="bx bx-pencil me-1"></i>Edit
                        </a>
                        <a href="{{ route('sertifikat.destroy', $sertifikat) }}"
                            class="btn btn-sm btn-danger">
                            <i class="bx bx-trash me-1"></i>Hapus
                        </a>
                    </div>

                </div>
            </div>
            <div class="card-body">
                <form class="row g-3">
                    
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Id Anak Pkl</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $sertifikat->id_anak_pkl }}</div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Judul Sertifikat</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $sertifikat->judul_sertifikat }}</div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Nama Pengesah</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $sertifikat->nama_pengesah }}</div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Tanggal Sertifikat</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $sertifikat->tanggal_sertifikat }}</div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Keterangan</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $sertifikat->keterangan }}</div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
