<x-layouts.app title="Perbarui Sertifikat" activeMenu="sertifikat.edit">
    <div class="container my-5">
        <x-breadcrumb title="Perbarui Sertifikat" :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => url('/')],
            ['label' => 'Sertifikat', 'url' => route('sertifikat.index')],
            ['label' => 'Perbarui Sertifikat'],
        ]" />

        <x-sweet-alert />

        <div class="card">
            <div class="card-body">
                <form action="{{ route('sertifikat.update', $sertifikat) }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @include('sertifikat.includes.form')

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary me-2">Perbarui</button>
                        <a href="{{ route('sertifikat.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>