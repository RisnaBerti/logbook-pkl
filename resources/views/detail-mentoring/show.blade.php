<x-layouts.app title="Detail Detail Mentoring" activeMenu="detail-mentoring.show">
     <div class="container my-5">
        <x-breadcrumb title="Detail Detail Mentoring" :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => url('/')],
            ['label' => 'Detail Mentoring', 'url' => route('detail-mentoring.index')],
            ['label' => 'Detail Detail Mentoring'],
        ]" />

        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('detail-mentoring.index') }}" class="btn btn-sm btn-secondary">
                        <i class="bx bx-arrow-back me-1"></i>Kembali
                    </a>

                    <div>
                        <a href="{{ route('detail-mentoring.create') }}"
                            class="btn btn-sm btn-info">
                            <i class="bx bx-plus me-1"></i>Baru
                        </a>
                        <a href="{{ route('detail-mentoring.edit', $detailMentoring) }}"
                            class="btn btn-sm btn-primary">
                            <i class="bx bx-pencil me-1"></i>Edit
                        </a>
                        <a href="{{ route('detail-mentoring.destroy', $detailMentoring) }}"
                            class="btn btn-sm btn-danger">
                            <i class="bx bx-trash me-1"></i>Hapus
                        </a>
                    </div>

                </div>
            </div>
            <div class="card-body">
                <form class="row g-3">
                    
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Id Riwayat Mentoring</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $detailMentoring->id_riwayat_mentoring }}</div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Id Anak Pkl</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $detailMentoring->id_anak_pkl }}</div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Id Mentor</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $detailMentoring->id_mentor }}</div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Hari Mentor</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $detailMentoring->hari_mentor }}</div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
