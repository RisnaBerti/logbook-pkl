<div class="row">
    <div class="col-md-12">
        <div class="row mb-4">
            <div class="col-md-6">
                <label for="id_mentor" class="form-label">Mentor</label>
                <select name="id_mentor" class="form-select {{ $errors->has('id_mentor') ? 'is-invalid' : '' }}"
                    id="id_mentor">
                    <option value="">Pilih Mentor</option>
                    @foreach ($mentors as $mentor)
                        <option value="{{ $mentor->id_mentor }}"
                            {{ old('id_anak_pkl', $penilaian?->id_mentor) == $mentor->id_mentor ? 'selected' : '' }}>
                            {{ $mentor->nama_mentor }}
                        </option>
                    @endforeach
                </select>
                @error('id_mentor')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="id_anak_pkl" class="form-label">Anak PKL</label>
                <select name="id_anak_pkl" class="form-select {{ $errors->has('id_anak_pkl') ? 'is-invalid' : '' }}"
                    id="id_anak_pkl">
                    <option value="">Pilih Anak PKL</option>
                    @foreach ($anakPkl as $anak)
                        <option value="{{ $anak->id_anak_pkl }}"
                            {{ old('id_anak_pkl', $penilaian?->id_anak_pkl) == $anak->id_anak_pkl ? 'selected' : '' }}>
                            {{ $anak->nama_anak_pkl }}
                        </option>
                    @endforeach
                </select>
                @error('id_anak_pkl')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror

                <input type="hidden" name="tanggal_penilaian" class="form-control" value="{{ $penilaian->tanggal_penilaian }}">
                <input type="hidden" name="keterangan" class="form-control" value="{{ $penilaian->keterangan }}">
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Keterampilan</th>
                        <th>Nilai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                {{-- <tbody id="penilaian-rows">
                    @foreach ($penilaianDetails as $index => $detail)
                        <tr class="penilaian-row">
                            <td>
                                <select name="penilaian[{{ $index }}][id_keterampilan]" class="form-select">
                                    <option value="">Pilih Keterampilan</option>
                                    @foreach ($keterampilan as $k)
                                        <option value="{{ $k->id_keterampilan }}"
                                            {{ $detail->id_keterampilan == $k->id_keterampilan ? 'selected' : '' }}>
                                            {{ $k->nama_keterampilan }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <x-input.currency name="penilaian[{{ $index }}][nilai]" placeholder="Nilai"
                                    class="form-control" min="0" max="100" step="1"
                                    value="{{ $detail->nilai }}" />
                            </td>
                            <td>
                                <input type="text" name="penilaian[{{ $index }}][keterangan]"
                                    class="form-control" placeholder="Keterangan" value="{{ $detail->keterangan }}">
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm remove-row"
                                    data-id="{{ $detail->id_penilaian }}" {{ $loop->count == 1 ? 'disabled' : '' }}>
                                    <i class="bx bx-trash"></i>
                                </button>

                            </td>
                        </tr>
                    @endforeach
                </tbody> --}}

                <tbody id="penilaian-rows">
                    @if ($penilaian && $penilaian->detail) {{-- Jika ada data penilaian --}}
                        @foreach ($penilaian->detail as $index => $detail)
                            <tr class="penilaian-row">
                                <td>
                                    <select name="detail_penilaian[{{ $index }}][id_keterampilan]"
                                        class="form-select">
                                        <option value="">Pilih Keterampilan</option>
                                        @foreach ($keterampilan as $k)
                                            <option value="{{ $k->id_keterampilan }}"
                                                {{ $detail->id_keterampilan == $k->id_keterampilan ? 'selected' : '' }}>
                                                {{ $k->nama_keterampilan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <x-input.currency name="detail_penilaian[{{ $index }}][nilai]"
                                        placeholder="Nilai" class="form-control" min="0" max="100"
                                        step="1" value="{{ $detail->nilai }}" />
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm remove-row"
                                        data-id="{{ $detail->id_detail_penilaian }}"
                                        {{ $loop->count == 1 ? 'disabled' : '' }}>
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        {{-- Jika tidak ada data, tampilkan satu baris kosong --}}
                        <tr class="penilaian-row">
                            <td>
                                <select name="detail_penilaian[0][id_keterampilan]" class="form-select">
                                    <option value="">Pilih Keterampilan</option>
                                    @foreach ($keterampilan as $k)
                                        <option value="{{ $k->id_keterampilan }}">{{ $k->nama_keterampilan }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <x-input.currency name="detail_penilaian[{{ $index }}][nilai]"
                                    placeholder="Nilai" class="form-control" min="0" max="100"
                                    step="1" />
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm remove-row" disabled>
                                    <i class="bx bx-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endif
                </tbody>


            </table>
        </div>

        <div class="mb-3 mt-3">
            <button type="button" class="btn btn-secondary" id="add-row">
                <i class="bi bi-plus-circle"></i> Tambah Baris
            </button>
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary me-2">Perbarui</button>
            <a href="{{ route('penilaian.index') }}" class="btn btn-secondary">Kembali</a>
        </div>

    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('penilaian-rows');
        const addButton = document.getElementById('add-row');
        const form = document.querySelector('form');
        let rowIndex = document.querySelectorAll('.penilaian-row').length - 1;

        // Function to get CSRF token
        function getCsrfToken() {
            // Try getting token from meta tag
            const metaToken = document.querySelector('meta[name="csrf-token"]');
            if (metaToken) return metaToken.content;

            // Try getting token from hidden input (Laravel forms often include this)
            const inputToken = document.querySelector('input[name="_token"]');
            if (inputToken) return inputToken.value;

            // If no token found, return null
            return null;
        }

        // Function to initialize currency input
        function initializeCurrencyInput(element) {
            element.addEventListener('input', function(e) {
                let value = this.value.replace(/\D/g, "");
                this.value = new Intl.NumberFormat('id-ID').format(value);

                let hiddenInput = this.nextElementSibling;
                if (hiddenInput && hiddenInput.type === 'hidden') {
                    hiddenInput.value = value ? parseInt(value) : 0;
                }
            });
        }

        // Initialize existing currency inputs
        document.querySelectorAll('input[data-type="currency"]').forEach(input => {
            initializeCurrencyInput(input);
        });

        // Function to add new row
        addButton.addEventListener('click', function() {
            rowIndex++;
            const newRow = container.querySelector('.penilaian-row').cloneNode(true);

            // Reset nilai dan nama
            newRow.querySelectorAll('[name]').forEach(element => {
                element.name = element.name.replace(/\[\d+\]/, `[${rowIndex}]`);
                element.value = '';
            });

            // Enable remove button for new row
            const removeButton = newRow.querySelector('.remove-row');
            if (removeButton) {
                removeButton.disabled = false;
                removeButton.removeAttribute('data-id'); // Remove data-id for new rows
            }

            container.appendChild(newRow);

            // Initialize currency input for new row
            const newCurrencyInput = newRow.querySelector('input[data-type="currency"]');
            if (newCurrencyInput) {
                initializeCurrencyInput(newCurrencyInput);
            }
        });

        // Improved remove row functionality
        container.addEventListener('click', async function(event) {
            const removeButton = event.target.closest('.remove-row');
            if (!removeButton) return;

            const row = removeButton.closest('.penilaian-row');
            const idDetailPenilaian = removeButton.getAttribute('data-id');

            // Check if this is the last row
            const totalRows = container.querySelectorAll('.penilaian-row').length;
            if (totalRows <= 1) {
                alert('Tidak dapat menghapus baris terakhir!');
                return;
            }

            try {
                if (idDetailPenilaian) {
                    // Handle existing row deletion
                    if (!confirm('Apakah Anda yakin ingin menghapus data ini?')) return;

                    const csrfToken = getCsrfToken();
                    if (!csrfToken) {
                        throw new Error('CSRF token tidak ditemukan');
                    }

                    const response = await fetch(`/detail-penilaian/${idDetailPenilaian}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        throw new Error(data.message || 'Terjadi kesalahan saat menghapus data');
                    }

                    alert(data.message || 'Data berhasil dihapus');
                    row.remove();
                } else {
                    // Handle new row deletion
                    if (confirm('Apakah Anda yakin ingin menghapus baris ini?')) {
                        row.remove();
                    }
                }
            } catch (error) {
                console.error('Error:', error);
                alert(error.message || 'Terjadi kesalahan saat menghapus data.');
            }
        });

        // Form validation before submit
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            const rows = document.querySelectorAll('.penilaian-row');
            let isValid = true;
            let errorMessage = '';

            // Validate mentor and anak PKL selection
            const mentorSelect = document.getElementById('id_mentor');
            const anakPklSelect = document.getElementById('id_anak_pkl');

            if (mentorSelect && !mentorSelect.value) {
                mentorSelect.classList.add('is-invalid');
                errorMessage += '- Pilih Mentor\n';
                isValid = false;
            }

            if (anakPklSelect && !anakPklSelect.value) {
                anakPklSelect.classList.add('is-invalid');
                errorMessage += '- Pilih Anak PKL\n';
                isValid = false;
            }

            // Validate each row
            rows.forEach((row, index) => {
                const keterampilan = row.querySelector(
                    'select[name^="detail_penilaian"][name$="[id_keterampilan]"]');
                const nilaiHidden = row.querySelector(
                    'input[name^="detail_penilaian"][name$="[nilai]"]');

                if (!keterampilan.value) {
                    keterampilan.classList.add('is-invalid');
                    errorMessage += `- Pilih Keterampilan pada baris ${index + 1}\n`;
                    isValid = false;
                }

                const nilaiValue = parseInt(nilaiHidden.value);
                if (isNaN(nilaiValue) || nilaiValue < 0 || nilaiValue > 100) {
                    const nilaiDisplay = row.querySelector('input[data-type="currency"]');
                    if (nilaiDisplay) nilaiDisplay.classList.add('is-invalid');
                    errorMessage += `- Masukkan Nilai valid (0-100) pada baris ${index + 1}\n`;
                    isValid = false;
                }
            });

            if (!isValid) {
                alert('Mohon perbaiki error berikut:\n' + errorMessage);
            } else {
                form.submit();
            }
        });

        // Remove validation styling on input change
        document.addEventListener('input', function(e) {
            if (e.target.classList.contains('is-invalid')) {
                e.target.classList.remove('is-invalid');
            }
        });
    });
</script>
