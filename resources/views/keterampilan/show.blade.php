<x-layouts.app title="Detail Keterampilan" activeMenu="keterampilan.show">
     <div class="container my-5">
        <x-breadcrumb title="Detail Keterampilan" :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => url('/')],
            ['label' => 'Keterampilan', 'url' => route('keterampilan.index')],
            ['label' => 'Detail Keterampilan'],
        ]" />

        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('keterampilan.index') }}" class="btn btn-sm btn-secondary">
                        <i class="bx bx-arrow-back me-1"></i>Kembali
                    </a>

                    <div>
                        <a href="{{ route('keterampilan.create') }}"
                            class="btn btn-sm btn-info">
                            <i class="bx bx-plus me-1"></i>Baru
                        </a>
                        <a href="{{ route('keterampilan.edit', $keterampilan) }}"
                            class="btn btn-sm btn-primary">
                            <i class="bx bx-pencil me-1"></i>Edit
                        </a>
                        <a href="{{ route('keterampilan.destroy', $keterampilan) }}"
                            class="btn btn-sm btn-danger">
                            <i class="bx bx-trash me-1"></i>Hapus
                        </a>
                    </div>

                </div>
            </div>
            <div class="card-body">
                <form class="row g-3">
                    
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Nama Keterampilan</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $keterampilan->nama_keterampilan }}</div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Deskripsi Keterampilan</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $keterampilan->deskripsi_keterampilan }}</div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
