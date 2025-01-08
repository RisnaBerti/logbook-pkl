<x-layouts.app title="Detail Jurnal" activeMenu="jurnal.show">
     <div class="container my-5">
        <x-breadcrumb title="Detail Jurnal" :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => url('/')],
            ['label' => 'Jurnal', 'url' => route('jurnal.index')],
            ['label' => 'Detail Jurnal'],
        ]" />

        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('jurnal.index') }}" class="btn btn-sm btn-secondary">
                        <i class="bx bx-arrow-back me-1"></i>Kembali
                    </a>

                    <div>
                        <a href="{{ route('jurnal.create') }}"
                            class="btn btn-sm btn-info">
                            <i class="bx bx-plus me-1"></i>Baru
                        </a>
                        <a href="{{ route('jurnal.edit', $jurnal) }}"
                            class="btn btn-sm btn-primary">
                            <i class="bx bx-pencil me-1"></i>Edit
                        </a>
                        <a href="{{ route('jurnal.destroy', $jurnal) }}"
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
                                <div class="col-md-8 form-group">: {{ $jurnal->id_anak_pkl }}</div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Id Mentor</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $jurnal->id_mentor }}</div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Aktifitas</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $jurnal->aktifitas }}</div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Tanggal Jurnal</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $jurnal->tanggal_jurnal }}</div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Waktu Mulai Aktifitas</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $jurnal->waktu_mulai_aktifitas }}</div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Waktu Selesai Aktifitas</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $jurnal->waktu_selesai_aktifitas }}</div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Durasi</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $jurnal->durasi }}</div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Keterangan</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $jurnal->keterangan }}</div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
