<x-layouts.app title="Tambah Feedback" activeMenu="feedback.create">
    <div class="container my-5">
        <x-breadcrumb title="Tambah Feedback" :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => url('/')],
            ['label' => 'Feedback', 'url' => route('feedback.index')],
            ['label' => 'Tambah Feedback'],
        ]" />

        <x-sweet-alert />

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Feedback Jurnal PKL</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('feedback.store') }}" method="POST" role="form">
                    @csrf
                    @method('POST')

                    {{-- Hidden input for student ID --}}
                    <input type="hidden" name="id_anak_pkl" value="{{ $anak_pkl->id_anak_pkl }}">

                    <div class="row">
                        <div class="col-md-12">
                            {{-- Display Student Info --}}
                            <div class="mb-4">
                                <h5>Jurnal PKL: {{ $anak_pkl->nama_anak_pkl }}</h5>
                            </div>

                            {{-- Journal List with Feedback Form --}}
                            <div class="mb-4">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Aktivitas</th>
                                                <th>Feedback</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($jurnal as $item)
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_jurnal)->format('d/m/Y') }}
                                                    </td>
                                                    <td>
                                                        <strong>{{ $item->aktifitas }}</strong>
                                                        <p class="text-muted mb-0">{{ $item->deskripsi }}</p>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="hidden"
                                                                name="jurnal[{{ $item->id_jurnal }}][id_jurnal]"
                                                                value="{{ $item->id_jurnal }}">
                                                            <textarea name="jurnal[{{ $item->id_jurnal }}][isi_feedback]"
                                                                class="form-control @error('jurnal.' . $item->id_jurnal . '.isi_feedback') is-invalid @enderror" rows="3"
                                                                placeholder="Berikan feedback untuk aktivitas ini...">{{ old('jurnal.' . $item->id_jurnal . '.isi_feedback') }}</textarea>
                                                            @error('jurnal.' . $item->id_jurnal . '.isi_feedback')
                                                                <small class="invalid-feedback">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center">Tidak ada jurnal yang
                                                        tersedia</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary me-2">Simpan Feedback</button>
                                <a href="{{ route('feedback.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
