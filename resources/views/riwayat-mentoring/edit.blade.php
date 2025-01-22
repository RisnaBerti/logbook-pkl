<x-layouts.app title="Perbarui Riwayat Mentoring" activeMenu="riwayat-mentoring.edit">
    <div class="container my-5">
        <x-breadcrumb title="Perbarui Riwayat Mentoring" :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => url('/')],
            ['label' => 'Riwayat Mentoring', 'url' => route('riwayat-mentoring.index')],
            ['label' => 'Perbarui Riwayat Mentoring'],
        ]" />

        <x-sweet-alert />

        <div class="card">
            <div class="card-body">
                <form action="{{ route('riwayat-mentoring.update', $riwayatMentoring) }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @include('riwayat-mentoring.includes.form-edit')

                    {{-- <div class="mt-3">
                        <button type="submit" class="btn btn-primary me-2">Perbarui</button>
                        <a href="{{ route('riwayat-mentoring.index') }}" class="btn btn-secondary">Kembali</a>
                    </div> --}}
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>