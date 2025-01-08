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
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Keterampilan</th>
                        <th>Nilai</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="penilaian-rows">
                    <tr class="penilaian-row">
                        <td>
                            <select name="penilaian[0][id_keterampilan]" class="form-select">
                                <option value="">Pilih Keterampilan</option>
                                @foreach ($keterampilan as $k)
                                    <option value="{{ $k->id_keterampilan }}"
                                        {{ old('id_keterampilan', $penilaian?->id_keterampilan) == $k->id_keterampilan ? 'selected' : '' }}>
                                        {{ $k->nama_keterampilan }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <x-input.currency name="penilaian[0][nilai]" placeholder="Nilai" class="form-control"
                                min="0" max="100" step="1" value="{{ old('nilai', $penilaian?->nilai) }}"/>
                        </td>
                        <td>
                            <input type="text" name="penilaian[0][keterangan]" class="form-control"
                                placeholder="Keterangan" value="{{ old('keterangan', $penilaian?->keterangan) }}">
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm remove-row" disabled>
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
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

        {{-- <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Simpan Penilaian</button>
        </div> --}}
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('penilaian-rows');
        const addButton = document.getElementById('add-row');
        const form = document.querySelector('form');
        let rowIndex = document.querySelectorAll('.penilaian-row').length - 1;

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

            // Update all input names and clear values
            newRow.querySelectorAll('[name]').forEach(element => {
                const originalName = element.name;
                // Update name attribute with new index
                element.name = element.name.replace(/\[\d+\]/, `[${rowIndex}]`);

                // Handle currency input display and hidden input
                if (element.hasAttribute('data-type') && element.getAttribute('data-type') ===
                    'currency') {
                    // Reset display value
                    element.value = '0';
                    // Generate new unique ID
                    const newId = 'input-currency-' + Math.random().toString(36).substring(2,
                        15);
                    element.id = newId;

                    // Re-initialize currency input
                    initializeCurrencyInput(element);
                } else if (element.type === 'hidden' && element.classList.contains(
                        'hidden-nominal')) {
                    // Reset hidden input value
                    element.value = '0';
                } else {
                    // Reset other inputs
                    element.value = '';
                }

                element.classList.remove('is-invalid');
            });

            // Enable and setup remove button
            const removeButton = newRow.querySelector('.remove-row');
            removeButton.disabled = false;
            removeButton.addEventListener('click', function() {
                if (confirm('Apakah Anda yakin ingin menghapus baris ini?')) {
                    newRow.remove();
                }
            });

            container.appendChild(newRow);
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

            if (!mentorSelect.value) {
                mentorSelect.classList.add('is-invalid');
                errorMessage += '- Pilih Mentor\n';
                isValid = false;
            }

            if (!anakPklSelect.value) {
                anakPklSelect.classList.add('is-invalid');
                errorMessage += '- Pilih Anak PKL\n';
                isValid = false;
            }

            // Validate each row
            rows.forEach((row, index) => {
                const keterampilan = row.querySelector(
                    'select[name^="penilaian"][name$="[id_keterampilan]"]');
                const nilaiHidden = row.querySelector(
                    'input[name^="penilaian"][name$="[nilai]"]');
                const keterangan = row.querySelector(
                    'input[name^="penilaian"][name$="[keterangan]"]');

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

                if (keterangan.value && keterangan.value.length > 255) {
                    keterangan.classList.add('is-invalid');
                    errorMessage += `- Keterangan terlalu panjang pada baris ${index + 1}\n`;
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
