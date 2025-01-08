{{-- 
contoh penggunaan:
<x-input.confirm-button text="Data ini akan diupdate!" positive="Ya, simpan!" icon="info">
    Simpan
</x-input.confirm-button>
--}}

@props([
    'url' => null,
    'class' => 'btn btn-danger',
    'title' => 'Apakah Anda yakin?',
    'text' => 'Data ini akan dihapus!',
    'icon' => 'warning',
    'positive' => 'Ya, hapus!',
    'negative' => 'Batal',
])

<a href="#" {{ $attributes->merge(['class' => $class . ' confirm-button']) }} data-url="{{ $url }}"
    data-title="{{ $title }}" data-text="{{ $text }}" data-icon="{{ $icon }}"
    data-positive="{{ $positive }}" data-negative="{{ $negative }}">
    {{ $slot }}
</a>

@pushOnce('css')
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endPushOnce

@pushOnce('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.confirm-button').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    Swal.fire({
                        title: this.getAttribute('data-title'),
                        text: this.getAttribute('data-text'),
                        icon: this.getAttribute('data-icon'),
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: this.getAttribute('data-positive'),
                        cancelButtonText: this.getAttribute('data-negative')
                    }).then((result) => {
                        if (result.isConfirmed) {
                            if (this.getAttribute('data-url')) {
                                window.location.href = this.getAttribute('data-url');
                            } else {
                                this.closest('form').submit();
                            }
                        }
                    });
                });
            });
        });
    </script>
@endPushOnce
