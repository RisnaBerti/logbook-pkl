<x-layouts.app title="Feedback" activeMenu="feedback">
    <div class="my-5 container-fluid">
        <x-breadcrumb title="Feedback" :breadcrumbs="[['label' => 'Dashboard', 'url' => url('/')], ['label' => 'Feedback']]" />

        <x-bs-toast />

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                @can('feedback create')
                    <a href="{{ route('feedback.create') }}" class="btn btn-primary">
                        <span class="bx bx-plus me-1"></span>Tambah Data
                    </a>
                @endcan
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Anak Pkl</th>
                                <th>Mentor</th>
                                <th>Jurnal</th>
                                <th>Tanggal Feedback</th>
                                <th>Isi Feedback</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($feedback as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $row->anak_pkl?->nama_anak_pkl }}</td>
                                    <td>{{ $row->mentor?->nama_mentor }}</td>
                                    <td>{{ $row->jurnal?->aktifitas }}</td>
                                    <td>{{ now()->parse($row?->tanggal_feedback)->format('d M Y') }}</td>
                                    <td>{{ $row?->isi_feedback }}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            @can('feedback view')
                                                <div class="me-1">
                                                    <a href="{{ route('feedback.show', $row) }}"
                                                        class="btn btn-icon btn-outline-info btn-sm"
                                                        data-bs-toggle="tooltip" data-bs-title="Detail"
                                                        data-bs-placement="top">
                                                        <span class="bx bx-show"></span>
                                                    </a>
                                                </div>
                                            @endcan
                                            @can('feedback edit')
                                                <div class="me-1">
                                                    <a href="{{ route('feedback.edit', $row) }}"
                                                        class="btn btn-icon btn-outline-primary btn-sm"
                                                        data-bs-toggle="tooltip" data-bs-title="Edit"
                                                        data-bs-placement="top">
                                                        <span class="bx bx-pencil"></span>
                                                    </a>
                                                </div>
                                            @endcan
                                            @can('feedback delete')
                                                <form action="{{ route('feedback.destroy', $row) }}" method="POST"
                                                    class="d-inline" @csrf @method('DELETE') <x-input.confirm-button
                                                    text="Data feedback ini akan dihapus!" positive="Ya, hapus!"
                                                    icon="info" class="btn btn-icon btn-outline-danger btn-sm"
                                                    data-bs-toggle="tooltip" data-bs-title="Hapus" data-bs-placement="top">
                                                    @csrf
                                                    <span class="bx bx-trash"></span>
                                                    </x-input.confirm-button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="mt-3 d-flex justify-content-end">
                    {!! $feedback->withQueryString()->links() !!}
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
