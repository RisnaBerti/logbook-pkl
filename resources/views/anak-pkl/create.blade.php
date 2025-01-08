<x-layouts.app title="Tambah Anak Pkl" activeMenu="anak-pkl.create">
    <div class="container my-5">
        <x-breadcrumb title="Tambah Anak Pkl" :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => url('/')],
            ['label' => 'Anak Pkl', 'url' => route('anak-pkl.index')],
            ['label' => 'Tambah Anak Pkl'],
        ]" />

        <x-sweet-alert />

        <div class="card">
            <div class="card-body">
                <form action="{{ route('anak-pkl.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    @include('anak-pkl.includes.form')

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary me-2">Tambah</button>
                        <a href="{{ route('anak-pkl.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>