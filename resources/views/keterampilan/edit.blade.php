<x-layouts.app title="Perbarui Keterampilan" activeMenu="keterampilan.edit">
    <div class="container my-5">
        <x-breadcrumb title="Perbarui Keterampilan" :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => url('/')],
            ['label' => 'Keterampilan', 'url' => route('keterampilan.index')],
            ['label' => 'Perbarui Keterampilan'],
        ]" />

        <x-sweet-alert />

        <div class="card">
            <div class="card-body">
                <form action="{{ route('keterampilan.update', $keterampilan) }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @include('keterampilan.includes.form')

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary me-2">Perbarui</button>
                        <a href="{{ route('keterampilan.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>