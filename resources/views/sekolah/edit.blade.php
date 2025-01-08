<x-layouts.app title="Perbarui Sekolah" activeMenu="sekolah.edit">
    <div class="container my-5">
        <x-breadcrumb title="Perbarui Sekolah" :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => url('/')],
            ['label' => 'Sekolah', 'url' => route('sekolah.index')],
            ['label' => 'Perbarui Sekolah'],
        ]" />

        <x-sweet-alert />

        <div class="card">
            <div class="card-body">
                <form action="{{ route('sekolah.update', $sekolah) }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @include('sekolah.includes.form')

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary me-2">Perbarui</button>
                        <a href="{{ route('sekolah.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>