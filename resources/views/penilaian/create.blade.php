<x-layouts.app title="Tambah Penilaian" activeMenu="penilaian.create">
    <div class="container my-5">
        <x-breadcrumb title="Tambah Penilaian" :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => url('/')],
            ['label' => 'Penilaian', 'url' => route('penilaian.index')],
            ['label' => 'Tambah Penilaian'],
        ]" />

        <x-sweet-alert />

        <div class="card">
            <div class="card-body">
                <form action="{{ route('penilaian.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    @include('penilaian.includes.form')

                    {{-- <div class="mt-3">
                        <button type="submit" class="btn btn-primary me-2">Tambah</button>
                        <a href="{{ route('penilaian.index') }}" class="btn btn-secondary">Kembali</a>
                    </div> --}}
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>