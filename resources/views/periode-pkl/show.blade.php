<x-layouts.app title="Detail Periode Pkl" activeMenu="periode-pkl.show">
     <div class="container my-5">
        <x-breadcrumb title="Detail Periode Pkl" :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => url('/')],
            ['label' => 'Periode Pkl', 'url' => route('periode-pkl.index')],
            ['label' => 'Detail Periode Pkl'],
        ]" />

        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('periode-pkl.index') }}" class="btn btn-sm btn-secondary">
                        <i class="bx bx-arrow-back me-1"></i>Kembali
                    </a>

                    <div>
                        <a href="{{ route('periode-pkl.create') }}"
                            class="btn btn-sm btn-info">
                            <i class="bx bx-plus me-1"></i>Baru
                        </a>
                        <a href="{{ route('periode-pkl.edit', $periodePkl) }}"
                            class="btn btn-sm btn-primary">
                            <i class="bx bx-pencil me-1"></i>Edit
                        </a>
                        <a href="{{ route('periode-pkl.destroy', $periodePkl) }}"
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
                                <div class="col-md-8 form-group">: {{ $periodePkl->sekolah->nama_sekolah }}</div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Tanggal Mulai</label>
                                </div>
                                <div class="col-md-8 form-group">: 
                                    {!! $periodePkl->tanggal_mulai
                                        ? \Carbon\Carbon::parse($periodePkl->tanggal_mulai)->translatedFormat('d M Y')
                                        : '<i class="text-danger">undefined</i>' !!}
                                        
                                        {{-- {{ now()->parse($periodePkl->tanggal_mulai)->format('d M Y')}} --}}
                                    </div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Tanggal Selesai</label>
                                </div>
                                <div class="col-md-8 form-group">: {!! $periodePkl->tanggal_selesai
                                    ? \Carbon\Carbon::parse($periodePkl->tanggal_selesai)->translatedFormat('d M Y')
                                    : '<i class="text-danger">undefined</i>' !!}</div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Durasi Bulan</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $periodePkl->durasi_bulan }} Bulan</div>
                                <div class="col-md-4">
                                    <label for="first-name-horizontal">Keterangan</label>
                                </div>
                                <div class="col-md-8 form-group">: {{ $periodePkl->keterangan }}</div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
