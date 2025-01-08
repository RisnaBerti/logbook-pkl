<x-layouts.app title="Tambah Sertifikat" activeMenu="sertifikat.create">
    <div class="container my-5">
        <x-breadcrumb title="Tambah Sertifikat" :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => url('/')],
            ['label' => 'Sertifikat', 'url' => route('sertifikat.index')],
            ['label' => 'Tambah Sertifikat'],
        ]" />

        <x-sweet-alert />

        <div class="card">
            <div class="card-body">
                <form action="{{ route('sertifikat.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    @include('sertifikat.includes.form')

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary me-2">Tambah</button>
                        <a href="{{ route('sertifikat.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>