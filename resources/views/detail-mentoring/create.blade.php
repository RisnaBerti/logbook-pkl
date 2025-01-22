<x-layouts.app title="Tambah Detail Mentoring" activeMenu="detail-mentoring.create">
    <div class="container my-5">
        <x-breadcrumb title="Tambah Detail Mentoring" :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => url('/')],
            ['label' => 'Detail Mentoring', 'url' => route('detail-mentoring.index')],
            ['label' => 'Tambah Detail Mentoring'],
        ]" />

        <x-sweet-alert />

        <div class="card">
            <div class="card-body">
                <form action="{{ route('detail-mentoring.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    @include('detail-mentoring.includes.form')

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary me-2">Tambah</button>
                        <a href="{{ route('detail-mentoring.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>