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
                            {{ old('id_anak_pkl', $riwayatMentoring?->id_mentor) == $mentor->id_mentor ? 'selected' : '' }}>
                            {{ $mentor->nama_mentor }}
                        </option>
                    @endforeach
                </select>
                @error('id_mentor')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="tanggal_mulai" class="form-label">Periode Mentoring</label>
                <x-input.daterangepicker name1="tanggal_mulai" name2="tanggal_akhir" value1="" value2=""
                    placeholder="Pilih Rentang Tanggal" opens="right" customRangeLabel="Periode Mentoring" />
                @error('tanggal_mulai')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Anak PKL</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="detail-mentoring-rows">
                    <tr class="mentoring-row">
                        <td>
                            <select name="detail_mentoring[0][id_anak_pkl]" class="form-select">
                                <option value="">Pilih Anak PKL</option>
                                @foreach ($anakPkl as $anak)
                                    <option value="{{ $anak->id_anak_pkl }}"
                                        {{ old('id_anak_pkl', $riwayatMentoring?->id_anak_pkl) == $anak->id_anak_pkl ? 'selected' : '' }}>
                                        {{ $anak->nama_anak_pkl }}
                                    </option>
                                @endforeach
                            </select>
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
            <button type="submit" class="btn btn-primary me-2">Simpan</button>
            <a href="{{ route('detail-mentoring.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('detail-mentoring-rows');
        const addButton = document.getElementById('add-row');
        const form = document.querySelector('form');
        let rowIndex = document.querySelectorAll('.mentoring-row').length - 1;

        // Fungsi untuk memeriksa duplikasi anak_pkl
        function checkDuplicateMentoring() {
            const anakPklSelects = container.querySelectorAll('select[name*="[id_anak_pkl]"]');
            const selectedValues = new Set();
            let hasDuplicate = false;

            anakPklSelects.forEach(select => {
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
            const newRow = container.querySelector('.mentoring-row').cloneNode(true);

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
                    checkDuplicateMentoring();
                }
            });

            container.appendChild(newRow);
        });

        // Event listener untuk perubahan pada select anak_pkl
        container.addEventListener('change', function(e) {
            if (e.target.name && e.target.name.includes('[id_anak_pkl]')) {
                checkDuplicateMentoring();
            }
        });

        // Validasi form sebelum submit
        form.addEventListener('submit', function(event) {
            let isValid = true;
            let errorMessage = '';

            // Validasi mentor dan anak PKL
            // const mentorSelect = document.getElementById('id_mentor');
            const anakPklSelect = document.getElementById('id_anak_pkl');

            // if (!mentorSelect.value) {
            //     mentorSelect.classList.add('is-invalid');
            //     errorMessage += '- Pilih Mentor.\n';
            //     isValid = false;
            // }

            if (!anakPklSelect.value) {
                anakPklSelect.classList.add('is-invalid');
                errorMessage += '- Pilih Anak PKL.\n';
                isValid = false;
            }

            // Cek duplikasi anak_pkl
            if (checkDuplicateMentoring()) {
                errorMessage += '- Terdapat anak pkl yang duplikat.\n';
                isValid = false;
            }

            // Validasi setiap baris penilaian
            const rows = container.querySelectorAll('.mentoring-row');
            rows.forEach((row, index) => {
                const anak_pkl = row.querySelector('select[name*="[id_anak_pkl]"]');
                // const nilai = row.querySelector('input[name*="[nilai]"]');

                if (!anak_pkl || !anak_pkl.value) {
                    anak_pkl.classList.add('is-invalid');
                    errorMessage += `- Pilih Anak PKL pada baris ${index + 1}.\n`;
                    isValid = false;
                }

                // if (!nilai || isNaN(nilai.value) || nilai.value < 0 || nilai.value > 100) {
                //     nilai.classList.add('is-invalid');
                //     errorMessage += `- Masukkan nilai valid (0-100) pada baris ${index + 1}.\n`;
                //     isValid = false;
                // }
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
