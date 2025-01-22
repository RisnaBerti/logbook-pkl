<x-layouts.app title="Detail Riwayat Mentoring" activeMenu="riwayat-mentoring.show">
     <div class="container my-5">
        <x-breadcrumb title="Detail Riwayat Mentoring" :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => url('/')],
            ['label' => 'Riwayat Mentoring', 'url' => route('riwayat-mentoring.index')],
            ['label' => 'Detail Riwayat Mentoring'],
        ]" />

        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('riwayat-mentoring.index') }}" class="btn btn-sm btn-secondary">
                        <i class="bx bx-arrow-back me-1"></i>Kembali
                    </a>

                    <div>
                        <a href="{{ route('riwayat-mentoring.create') }}"
                            class="btn btn-sm btn-info">
                            <i class="bx bx-plus me-1"></i>Baru
                        </a>
                        <a href="{{ route('riwayat-mentoring.edit', $riwayatMentoring) }}"
                            class="btn btn-sm btn-primary">
                            <i class="bx bx-pencil me-1"></i>Edit
                        </a>
                        <a href="{{ route('riwayat-mentoring.destroy', $riwayatMentoring) }}"
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
                                <div class="col-md-8 form-group">: {{ $riwayatMentoring->id_anak_pkl }}</div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Id Mentor</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $riwayatMentoring->id_mentor }}</div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Tanggal Mulai</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $riwayatMentoring->tanggal_mulai }}</div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Tanggal Akhir</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $riwayatMentoring->tanggal_akhir }}</div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Hari Mentor</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $riwayatMentoring->hari_mentor }}</div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
