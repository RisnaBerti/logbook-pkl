<x-layouts.app title="Perbarui Penilaian" activeMenu="penilaian.edit">
    <div class="container my-5">
        <x-breadcrumb title="Perbarui Penilaian" :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => url('/')],
            ['label' => 'Penilaian', 'url' => route('penilaian.index')],
            ['label' => 'Perbarui Penilaian'],
        ]" />

        <x-sweet-alert />

        <div class="card">
            <div class="card-body">
                <form action="{{ route('penilaian.update', $penilaian) }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @include('penilaian.includes.form')
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>