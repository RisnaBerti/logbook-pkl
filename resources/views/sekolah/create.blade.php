<x-layouts.app title="Tambah Sekolah" activeMenu="sekolah.create">
    <div class="container my-5">
        <x-breadcrumb title="Tambah Sekolah" :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => url('/')],
            ['label' => 'Sekolah', 'url' => route('sekolah.index')],
            ['label' => 'Tambah Sekolah'],
        ]" />

        <x-sweet-alert />

        <div class="card">
            <div class="card-body">
                <form action="{{ route('sekolah.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    @include('sekolah.includes.form')

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary me-2">Tambah</button>
                        <a href="{{ route('sekolah.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>