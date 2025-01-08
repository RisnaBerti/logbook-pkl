<x-layouts.app title="Detail Anak Pkl" activeMenu="anak-pkl.show">
     <div class="container my-5">
        <x-breadcrumb title="Detail Anak Pkl" :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => url('/')],
            ['label' => 'Anak Pkl', 'url' => route('anak-pkl.index')],
            ['label' => 'Detail Anak Pkl'],
        ]" />

        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('anak-pkl.index') }}" class="btn btn-sm btn-secondary">
                        <i class="bx bx-arrow-back me-1"></i>Kembali
                    </a>

                    <div>
                        <a href="{{ route('anak-pkl.create') }}"
                            class="btn btn-sm btn-info">
                            <i class="bx bx-plus me-1"></i>Baru
                        </a>
                        <a href="{{ route('anak-pkl.edit', $anakPkl) }}"
                            class="btn btn-sm btn-primary">
                            <i class="bx bx-pencil me-1"></i>Edit
                        </a>
                        <a href="{{ route('anak-pkl.destroy', $anakPkl) }}"
                            class="btn btn-sm btn-danger">
                            <i class="bx bx-trash me-1"></i>Hapus
                        </a>
                    </div>

                </div>
            </div>
            <div class="card-body">
                <form class="row g-3">
                    
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Sekolah</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $anakPkl->sekolah->nama_sekolah }}</div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Periode Pkl</label>
                                </div>
                                <div class="col-md-8 form-group">:  {{ now()->parse($anakPkl->periode_pkl?->tanggal_mulai)->format('d M Y') }} s.d {{ now()->parse($anakPkl->periode_pkl?->tanggal_selesai)->format('d M Y') }}</div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Mentor</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $anakPkl->mentor->nama_mentor }}</div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Nama Anak Pkl</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $anakPkl->nama_anak_pkl }}</div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">No Telp Anak Pkl</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $anakPkl->no_telp_anak_pkl }}</div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Email Anak Pkl</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $anakPkl->email_anak_pkl }}</div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Foto Anak Pkl</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $anakPkl->foto_anak_pkl }}</div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
