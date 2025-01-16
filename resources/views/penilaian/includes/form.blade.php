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
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="penilaian-rows">
                    <tr class="penilaian-row">
                        <td>
                            <select name="detail_penilaian[0][id_keterampilan]" class="form-select">
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
                            {{-- <x-input.currency name="detail_penilaian[0][nilai]" placeholder="Nilai" class="form-control"
                                min="0" max="100" step="1" /> --}}
                            <input type="number" name="detail_penilaian[0][nilai]" placeholder="Nilai"
                                class="form-control" min="0" max="100"
                                step="1">
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm remove-row" disabled>
                                <i class="bx bx-trash"></i>
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
            <button type="submit" class="btn btn-primary me-2">Simpan Penilaian</button>
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

        // Fungsi untuk memeriksa duplikasi keterampilan
        function checkDuplicateKeterampilan() {
            const keterampilanSelects = container.querySelectorAll('select[name*="[id_keterampilan]"]');
            const selectedValues = new Set();
            let hasDuplicate = false;

            keterampilanSelects.forEach(select => {
                select.classList.remove('is-invalid');
                if (select.value) {
                    if (selectedValues.has(select.value)) {
                        select.classList.add('is-invalid');
                        hasDuplicate = true;
                    }
                    selectedValues.add(select.value);
                }
            });

            return hasDuplicate;
        }

        // Fungsi untuk menambahkan baris baru
        addButton.addEventListener('click', function() {
            rowIndex++;
            const newRow = container.querySelector('.penilaian-row').cloneNode(true);

            // Reset input di baris baru
            newRow.querySelectorAll('input, select').forEach((input) => {
                if (input.name) {
                    input.name = input.name.replace(/\[\d+\]/, `[${rowIndex}]`);
                }
                if (input.type === 'text' || input.type === 'number') {
                    input.value = '';
                } else if (input.tagName === 'SELECT') {
                    input.selectedIndex = 0;
                }
                input.classList.remove('is-invalid');
            });

            // Aktifkan tombol hapus pada baris baru
            const removeButton = newRow.querySelector('.remove-row');
            removeButton.disabled = false;
            removeButton.addEventListener('click', function() {
                if (confirm('Apakah Anda yakin ingin menghapus baris ini?')) {
                    newRow.remove();
                    checkDuplicateKeterampilan();
                }
            });

            container.appendChild(newRow);
        });

        // Event listener untuk perubahan pada select keterampilan
        container.addEventListener('change', function(e) {
            if (e.target.name && e.target.name.includes('[id_keterampilan]')) {
                checkDuplicateKeterampilan();
            }
        });

        // Validasi form sebelum submit
        form.addEventListener('submit', function(event) {
            let isValid = true;
            let errorMessage = '';

            // Validasi mentor dan anak PKL
            const mentorSelect = document.getElementById('id_mentor');
            const anakPklSelect = document.getElementById('id_anak_pkl');

            if (!mentorSelect.value) {
                mentorSelect.classList.add('is-invalid');
                errorMessage += '- Pilih Mentor.\n';
                isValid = false;
            }

            if (!anakPklSelect.value) {
                anakPklSelect.classList.add('is-invalid');
                errorMessage += '- Pilih Anak PKL.\n';
                isValid = false;
            }

            // Cek duplikasi keterampilan
            if (checkDuplicateKeterampilan()) {
                errorMessage += '- Terdapat keterampilan yang duplikat.\n';
                isValid = false;
            }

            // Validasi setiap baris penilaian
            const rows = container.querySelectorAll('.penilaian-row');
            rows.forEach((row, index) => {
                const keterampilan = row.querySelector('select[name*="[id_keterampilan]"]');
                const nilai = row.querySelector('input[name*="[nilai]"]');

                if (!keterampilan || !keterampilan.value) {
                    keterampilan.classList.add('is-invalid');
                    errorMessage += `- Pilih Keterampilan pada baris ${index + 1}.\n`;
                    isValid = false;
                }

                if (!nilai || isNaN(nilai.value) || nilai.value < 0 || nilai.value > 100) {
                    nilai.classList.add('is-invalid');
                    errorMessage += `- Masukkan nilai valid (0-100) pada baris ${index + 1}.\n`;
                    isValid = false;
                }
            });

            if (!isValid) {
                alert('Mohon perbaiki error berikut:\n' + errorMessage);
                event.preventDefault();
            }
        });

        // Hapus kelas is-invalid saat input berubah
        document.addEventListener('input', function(e) {
            if (e.target.classList.contains('is-invalid')) {
                e.target.classList.remove('is-invalid');
            }
        });
    });
</script>
