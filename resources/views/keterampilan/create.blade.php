<x-layouts.app title="Tambah Keterampilan" activeMenu="keterampilan.create">
    <div class="container my-5">
        <x-breadcrumb title="Tambah Keterampilan" :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => url('/')],
            ['label' => 'Keterampilan', 'url' => route('keterampilan.index')],
            ['label' => 'Tambah Keterampilan'],
        ]" />

        <x-sweet-alert />

        <div class="card">
            <div class="card-body">
                <form action="{{ route('keterampilan.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    @include('keterampilan.includes.form')

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary me-2">Tambah</button>
                        <a href="{{ route('keterampilan.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>