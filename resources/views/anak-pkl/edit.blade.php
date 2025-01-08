<x-layouts.app title="Perbarui Anak Pkl" activeMenu="anak-pkl.edit">
    <div class="container my-5">
        <x-breadcrumb title="Perbarui Anak Pkl" :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => url('/')],
            ['label' => 'Anak Pkl', 'url' => route('anak-pkl.index')],
            ['label' => 'Perbarui Anak Pkl'],
        ]" />

        <x-sweet-alert />

        <div class="card">
            <div class="card-body">
                <form action="{{ route('anak-pkl.update', $anakPkl) }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @include('anak-pkl.includes.form')

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary me-2">Perbarui</button>
                        <a href="{{ route('anak-pkl.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>