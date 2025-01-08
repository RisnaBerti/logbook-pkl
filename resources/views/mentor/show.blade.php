<x-layouts.app title="Detail Mentor" activeMenu="mentor.show">
     <div class="container my-5">
        <x-breadcrumb title="Detail Mentor" :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => url('/')],
            ['label' => 'Mentor', 'url' => route('mentor.index')],
            ['label' => 'Detail Mentor'],
        ]" />

        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('mentor.index') }}" class="btn btn-sm btn-secondary">
                        <i class="bx bx-arrow-back me-1"></i>Kembali
                    </a>

                    <div>
                        <a href="{{ route('mentor.create') }}"
                            class="btn btn-sm btn-info">
                            <i class="bx bx-plus me-1"></i>Baru
                        </a>
                        <a href="{{ route('mentor.edit', $mentor) }}"
                            class="btn btn-sm btn-primary">
                            <i class="bx bx-pencil me-1"></i>Edit
                        </a>
                        <a href="{{ route('mentor.destroy', $mentor) }}"
                            class="btn btn-sm btn-danger">
                            <i class="bx bx-trash me-1"></i>Hapus
                        </a>
                    </div>

                </div>
            </div>
            <div class="card-body">
                <form class="row g-3">
                    
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Nama Mentor</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $mentor->nama_mentor }}</div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Email Mentor</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $mentor->email_mentor }}</div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Alamat Mentor</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $mentor->alamat_mentor }}</div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">No Telp Mentor</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $mentor->no_telp_mentor }}</div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Foto Mentor</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $mentor->foto_mentor }}</div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Ttd Mentor</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $mentor->ttd_mentor }}</div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
