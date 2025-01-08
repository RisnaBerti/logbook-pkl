<x-layouts.app title="Perbarui Feedback" activeMenu="feedback.edit">
    <div class="container my-5">
        <x-breadcrumb title="Perbarui Feedback" :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => url('/')],
            ['label' => 'Feedback', 'url' => route('feedback.index')],
            ['label' => 'Perbarui Feedback'],
        ]" />

        <x-sweet-alert />

        <div class="card">
            <div class="card-body">
                <form action="{{ route('feedback.update', $feedback) }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @include('feedback.includes.form')

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary me-2">Perbarui</button>
                        <a href="{{ route('feedback.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>