<x-layouts.app title="Jurnal" activeMenu="jurnal">
    <div class="my-5 container-fluid">
        <x-breadcrumb title="Jurnal" :breadcrumbs="[['label' => 'Dashboard', 'url' => url('/')], ['label' => 'Jurnal']]" />

        <x-bs-toast />

        <div class="row justify-content-center">
            <div class="col-md-8">
                @can('jurnal create')
                    <div class="mb-4">
                        <a href="{{ route('jurnal.create') }}" class="btn btn-primary">
                            <span class="bx bx-plus me-1"></span>Tambah Jurnal
                        </a>
                    </div>
                @endcan

                @foreach ($jurnal as $row)
                    <div class="card mb-4">
                        <!-- Header Post -->
                        <div class="card-header bg-white border-bottom">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avatar avatar-sm">
                                        <span class="avatar-initial rounded-circle bg-primary">
                                            {{ substr($row->anak_pkl?->nama_anak_pkl, 0, 1) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-0">{{ $row->anak_pkl?->nama_anak_pkl }}</h6>
                                    <small class="text-muted">
                                        {{ now()->parse($row?->tanggal_jurnal)->format('d M Y') }}
                                        • {{ now()->parse($row?->waktu_mulai_aktifitas)->format('H:i') }}
                                        - {{ now()->parse($row?->waktu_selesai_aktifitas)->format('H:i') }}
                                        ({{ $row?->durasi_format }})
                                    </small>
                                </div>
                                <!-- Action buttons -->
                                <div class="dropdown ms-auto">
                                    <button class="btn btn-icon btn-light btn-sm" data-bs-toggle="dropdown">
                                        <span class="bx bx-dots-vertical-rounded"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        @can('jurnal view')
                                            <li>
                                                <a class="dropdown-item" href="{{ route('jurnal.show', $row) }}">
                                                    <span class="bx bx-show me-2"></span>Detail
                                                </a>
                                            </li>
                                        @endcan
                                        @can('jurnal edit')
                                            <li>
                                                <a class="dropdown-item" href="{{ route('jurnal.edit', $row) }}">
                                                    <span class="bx bx-pencil me-2"></span>Edit
                                                </a>
                                            </li>
                                        @endcan
                                        @can('jurnal delete')
                                            <li>
                                                <form action="{{ route('jurnal.destroy', $row) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                        <span class="bx bx-trash me-2"></span>Hapus
                                                    </button>
                                                </form>
                                            </li>
                                        @endcan
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="card-body mt-2">
                            <h6 class="fw-bold mb-3">{{ $row->aktifitas }}</h6>
                            <p class="card-text">{{ $row->keterangan }}</p>
                        </div>

                        <!-- Feedback Section -->
                        <div class="card-footer bg-light border-top">
                            <!-- Feedback List -->
                            <div class="feedback-list mb-3 mt-3">
                                @foreach ($row->feedbacks as $feedback)
                                    <div class="d-flex mb-2">
                                        <div class="flex-shrink-0">
                                            <div class="avatar avatar-xs">
                                                <span class="avatar-initial rounded-circle bg-secondary">
                                                    {{ substr($feedback->mentor->nama_mentor, 0, 1) }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-2">
                                            <div class="bg-white rounded p-2">
                                                <h6 class="mb-1 fw-semibold">{{ $feedback->mentor->nama_mentor }}</h6>
                                                <p class="mb-1">{{ $feedback->isi_feedback }}</p>
                                                <small
                                                    class="text-muted">{{ $feedback->created_at->diffForHumans() }}</small>
                                            </div>
                                        </div>
                                        {{-- @if (auth()->user()->id === $feedback->id_mentor) --}}
                                        @can('feedback delete')
                                            <div class="ms-2">
                                                <form action="{{ route('feedback.destroy', $feedback->id_feedback) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link text-danger p-0"
                                                        onclick="return confirm('Hapus feedback ini?')">
                                                        <span class="bx bx-trash"></span>
                                                    </button>
                                                </form>
                                            </div>
                                        @endcan
                                        {{-- @endif --}}
                                    </div>
                                @endforeach
                            </div>

                            <!-- Feedback Input -->
                            @can('feedback create')
                            {{-- @if (auth()->user()->hasRole('mentor')) --}}
                            <form action="{{ route('jurnal.add-feedback', $row->id_jurnal) }}" method="POST">
                                @csrf
                                <div class="input-group">
                                    <input type="text" class="form-control" name="feedback"
                                        placeholder="Tambahkan feedback..." required>
                                    <button class="btn btn-primary" type="submit">
                                        <span class="bx bx-send"></span>
                                    </button>
                                </div>
                            </form>
                            {{-- @endif --}}
                            @endcan
                        </div>
                    </div>
                @endforeach

                {{-- Pagination --}}
                <div class="mt-3 d-flex justify-content-center">
                    {!! $jurnal->withQueryString()->links() !!}
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
