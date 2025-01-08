<x-layouts.app title="Perbarui Mentor" activeMenu="mentor.edit">
    <div class="container my-5">
        <x-breadcrumb title="Perbarui Mentor" :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => url('/')],
            ['label' => 'Mentor', 'url' => route('mentor.index')],
            ['label' => 'Perbarui Mentor'],
        ]" />

        <x-sweet-alert />

        <div class="card">
            <div class="card-body">
                <form action="{{ route('mentor.update', $mentor) }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @include('mentor.includes.form')

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary me-2">Perbarui</button>
                        <a href="{{ route('mentor.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>