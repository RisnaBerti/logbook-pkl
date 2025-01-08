<x-layouts.app title="Detail Feedback" activeMenu="feedback.show">
     <div class="container my-5">
        <x-breadcrumb title="Detail Feedback" :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => url('/')],
            ['label' => 'Feedback', 'url' => route('feedback.index')],
            ['label' => 'Detail Feedback'],
        ]" />

        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('feedback.index') }}" class="btn btn-sm btn-secondary">
                        <i class="bx bx-arrow-back me-1"></i>Kembali
                    </a>

                    <div>
                        <a href="{{ route('feedback.create') }}"
                            class="btn btn-sm btn-info">
                            <i class="bx bx-plus me-1"></i>Baru
                        </a>
                        <a href="{{ route('feedback.edit', $feedback) }}"
                            class="btn btn-sm btn-primary">
                            <i class="bx bx-pencil me-1"></i>Edit
                        </a>
                        <a href="{{ route('feedback.destroy', $feedback) }}"
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
                                <div class="col-md-8 form-group">: {{ $feedback->id_anak_pkl }}</div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Id Mentor</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $feedback->id_mentor }}</div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Id Jurnal</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $feedback->id_jurnal }}</div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Tanggal Feedback</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $feedback->tanggal_feedback }}</div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Isi Feedback</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $feedback->isi_feedback }}</div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
