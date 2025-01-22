<x-layouts.app title="Tambah Riwayat Mentoring" activeMenu="riwayat-mentoring.create">
    <div class="container my-5">
        <x-breadcrumb title="Tambah Riwayat Mentoring" :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => url('/')],
            ['label' => 'Riwayat Mentoring', 'url' => route('riwayat-mentoring.index')],
            ['label' => 'Tambah Riwayat Mentoring'],
        ]" />

        <x-sweet-alert />

        <div class="card">
            <div class="card-body">
                <form action="{{ route('riwayat-mentoring.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    @include('riwayat-mentoring.includes.form')

                    {{-- <div class="mt-3">
                        <button type="submit" class="btn btn-primary me-2">Tambah</button>
                        <a href="{{ route('riwayat-mentoring.index') }}" class="btn btn-secondary">Kembali</a>
                    </div> --}}
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>