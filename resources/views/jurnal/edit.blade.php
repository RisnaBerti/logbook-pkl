<x-layouts.app title="Perbarui Jurnal" activeMenu="jurnal.edit">
    <div class="container my-5">
        <x-breadcrumb title="Perbarui Jurnal" :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => url('/')],
            ['label' => 'Jurnal', 'url' => route('jurnal.index')],
            ['label' => 'Perbarui Jurnal'],
        ]" />

        <x-sweet-alert />

        <div class="card">
            <div class="card-body">
                <form action="{{ route('jurnal.update', $jurnal) }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    @include('jurnal.includes.form')

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary me-2">Perbarui</button>
                        <a href="{{ route('jurnal.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>