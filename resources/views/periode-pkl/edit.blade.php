<x-layouts.app title="Perbarui Periode Pkl" activeMenu="periode-pkl.edit">
    <div class="container my-5">
        <x-breadcrumb title="Perbarui Periode Pkl" :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => url('/')],
            ['label' => 'Periode Pkl', 'url' => route('periode-pkl.index')],
            ['label' => 'Perbarui Periode Pkl'],
        ]" />

        <x-sweet-alert />

        <div class="card">
            <div class="card-body">
                <form action="{{ route('periode-pkl.update', $periodePkl) }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @include('periode-pkl.includes.form')

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary me-2">Perbarui</button>
                        <a href="{{ route('periode-pkl.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>