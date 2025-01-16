@php
    $pageTitle = 'Tambah Jurnal PKL';
    $breadcrumbs = [
        ['label' => 'Dashboard', 'url' => url('/')],
        ['label' => 'Jurnal', 'url' => route('jurnal.index')],
        ['label' => 'Tambah Jurnal'],
    ];
@endphp

<x-layouts.app title="{{ $pageTitle }}" activeMenu="jurnal.create">
    <div class="container my-5">
        {{-- Breadcrumb Component --}}
        <x-breadcrumb title="{{ $pageTitle }}" :breadcrumbs="$breadcrumbs" />

        {{-- Alert Component --}}
        <x-sweet-alert />

        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="card-title mb-0">
                    <i class="fas fa-edit me-2"></i>{{ $pageTitle }}
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('jurnal.store') }}" method="POST" role="form" enctype="multipart/form-data"
                    id="form-jurnal">
                    @csrf
                    @method('POST')

                    {{-- Form Fields Component --}}
                    @include('jurnal.includes.form')

                    {{-- Form Actions --}}
                    <div class="mt-4 d-flex justify-content-end gap-2">
                        <a href="{{ route('jurnal.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Tambah Jurnal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                // Form submission handler
                $('#form-jurnal').on('submit', function(e) {
                    e.preventDefault();

                    // Validate required fields
                    let isValid = true;
                    $(this).find('[required]').each(function() {
                        if (!$(this).val()) {
                            isValid = false;
                            $(this).addClass('is-invalid');
                        } else {
                            $(this).removeClass('is-invalid');
                        }
                    });

                    if (!isValid) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Validasi Gagal',
                            text: 'Mohon lengkapi semua field yang wajib diisi',
                        });
                        return;
                    }

                    // Show loading state
                    const submitBtn = $(this).find('button[type="submit"]');
                    const originalText = submitBtn.html();
                    submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...');
                    submitBtn.prop('disabled', true);

                    // Submit the form
                    this.submit();
                });

                // Initialize tooltips
                $('[data-bs-toggle="tooltip"]').tooltip();

                // Add validation classes on input change
                $('input, select, textarea').on('change', function() {
                    if ($(this).val()) {
                        $(this).removeClass('is-invalid');
                    }
                });
            });
        </script>
    @endpush

    @push('styles')
        <style>
            .card {
                border-radius: 0.5rem;
            }

            .card-header {
                border-radius: 0.5rem 0.5rem 0 0;
            }

            .form-control:focus,
            .form-select:focus {
                border-color: #86b7fe;
                box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
            }

            .btn {
                padding: 0.5rem 1rem;
                font-weight: 500;
            }

            .invalid-feedback {
                font-size: 0.875rem;
            }
        </style>
    @endpush
</x-layouts.app>
