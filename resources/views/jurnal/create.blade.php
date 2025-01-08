<x-layouts.app title="Tambah Jurnal" activeMenu="jurnal.create">
    <div class="container my-5">
        <x-breadcrumb title="Tambah Jurnal" :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => url('/')],
            ['label' => 'Jurnal', 'url' => route('jurnal.index')],
            ['label' => 'Tambah Jurnal'],
        ]" />

        <x-sweet-alert />

        <div class="card">
            <div class="card-body">
                <form action="{{ route('jurnal.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    @include('jurnal.includes.form')

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary me-2">Tambah</button>
                        <a href="{{ route('jurnal.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>