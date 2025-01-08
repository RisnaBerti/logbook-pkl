<x-layouts.app title="Detail Penilaian" activeMenu="penilaian.show">
     <div class="container my-5">
        <x-breadcrumb title="Detail Penilaian" :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => url('/')],
            ['label' => 'Penilaian', 'url' => route('penilaian.index')],
            ['label' => 'Detail Penilaian'],
        ]" />

        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('penilaian.index') }}" class="btn btn-sm btn-secondary">
                        <i class="bx bx-arrow-back me-1"></i>Kembali
                    </a>

                    <div>
                        <a href="{{ route('penilaian.create') }}"
                            class="btn btn-sm btn-info">
                            <i class="bx bx-plus me-1"></i>Baru
                        </a>
                        <a href="{{ route('penilaian.edit', $penilaian) }}"
                            class="btn btn-sm btn-primary">
                            <i class="bx bx-pencil me-1"></i>Edit
                        </a>
                        <a href="{{ route('penilaian.destroy', $penilaian) }}"
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
                                <div class="col-md-8 form-group">: {{ $penilaian->id_anak_pkl }}</div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Id Mentor</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $penilaian->id_mentor }}</div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Id Keterampilan</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $penilaian->id_keterampilan }}</div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Tanggal Penilaian</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $penilaian->tanggal_penilaian }}</div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Nilai</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $penilaian->nilai }}</div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Keterangan</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $penilaian->keterangan }}</div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
