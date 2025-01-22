<x-layouts.app title="Perbarui Detail Mentoring" activeMenu="detail-mentoring.edit">
    <div class="container my-5">
        <x-breadcrumb title="Perbarui Detail Mentoring" :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => url('/')],
            ['label' => 'Detail Mentoring', 'url' => route('detail-mentoring.index')],
            ['label' => 'Perbarui Detail Mentoring'],
        ]" />

        <x-sweet-alert />

        <div class="card">
            <div class="card-body">
                <form action="{{ route('detail-mentoring.update', $detailMentoring) }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    @include('detail-mentoring.includes.form')

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary me-2">Perbarui</button>
                        <a href="{{ route('detail-mentoring.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>