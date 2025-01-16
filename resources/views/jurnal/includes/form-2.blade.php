<div class="row">
    <div class="col-md-6">
        <!-- Anak PKL Selection -->
        <div class="mb-4">
            <label for="id_anak_pkl" class="form-label fw-bold">
                <i class="fas fa-user-graduate me-2"></i>Peserta PKL
            </label>
            <select name="id_anak_pkl" class="form-select @error('id_anak_pkl') is-invalid @enderror" id="id_anak_pkl"
                required>
                <option value="">-- Pilih Peserta PKL --</option>
                @foreach ($anak_pkl as $dt)
                    <option value="{{ $dt->id_anak_pkl }}"
                        {{ old('id_anak_pkl', $jurnal?->id_anak_pkl) == $dt->id_anak_pkl ? 'selected' : '' }}>
                        {{ $dt->nama_anak_pkl }} | {{ $dt->mentor->nama_mentor }}
                    </option>
                @endforeach
            </select>
            @error('id_anak_pkl')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Mentor Selection -->
        <div class="mb-4">
            <label for="id_mentor" class="form-label fw-bold">
                <i class="fas fa-chalkboard-teacher me-2"></i>Mentor
            </label>
            <select name="id_mentor" class="form-select @error('id_mentor') is-invalid @enderror" id="id_mentor"
                required>
                <option value="">-- Pilih Mentor --</option>
                @foreach ($mentor as $dt)
                    <option value="{{ $dt->id_mentor }}"
                        {{ old('id_mentor', $jurnal?->id_mentor) == $dt->id_mentor ? 'selected' : '' }}>
                        {{ $dt->nama_mentor }}
                    </option>
                @endforeach
            </select>
            @error('id_mentor')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Activity Input -->
        <div class="mb-4">
            <label for="aktifitas" class="form-label fw-bold">
                <i class="fas fa-tasks me-2"></i>Aktivitas
            </label>
            <textarea name="aktifitas" class="form-control @error('aktifitas') is-invalid @enderror" id="aktifitas" rows="3"
                required placeholder="Deskripsikan aktivitas hari ini...">{{ old('aktifitas', $jurnal?->aktifitas) }}</textarea>
            @error('aktifitas')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <!-- Date Input -->
        <div class="mb-4">
            <label for="tanggal_jurnal" class="form-label fw-bold">
                <i class="fas fa-calendar-alt me-2"></i>Tanggal
            </label>
            <x-input.daterangepicker name1="tanggal_jurnal"
                value1="{{ old('tanggal_jurnal', $jurnal?->tanggal_jurnal) }}" placeholder="Pilih Tanggal"
                opens="right" singleDatePicker="true" :ranges="false" />
        </div>

        <!-- Time Range -->
        <div class="row">
            <div class="col-md-6">
                <div class="mb-4">
                    <label for="waktu_mulai_aktifitas" class="form-label fw-bold">
                        <i class="fas fa-clock me-2"></i>Waktu Mulai
                    </label>
                    <x-input.timepicker name1="waktu_mulai_aktifitas" id1="timepicker1"
                        value1="{{ old('waktu_mulai_aktifitas', $jurnal?->waktu_mulai_aktifitas) }}"
                        singleTimePicker="true" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-4">
                    <label for="waktu_selesai_aktifitas" class="form-label fw-bold">
                        <i class="fas fa-clock me-2"></i>Waktu Selesai
                    </label>
                    <x-input.timepicker name1="waktu_selesai_aktifitas" id1="timepicker2"
                        value1="{{ old('waktu_selesai_aktifitas', $jurnal?->waktu_selesai_aktifitas) }}"
                        singleTimePicker="true" />
                </div>
            </div>
        </div>

        <!-- Duration Display -->
        <div class="mb-4">
            <label for="durasi" class="form-label fw-bold">
                <i class="fas fa-hourglass-half me-2"></i>Durasi
            </label>
            <input type="text" name="durasi_display" id="durasi_display" readonly
                class="form-control bg-light text-end" />
            <input type="hidden" name="durasi" id="durasi" value="{{ old('durasi', $jurnal?->durasi) }}" />
        </div>

        <!-- Notes Input -->
        <div class="mb-4">
            <label for="keterangan" class="form-label fw-bold">
                <i class="fas fa-sticky-note me-2"></i>Keterangan
            </label>
            <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan"
                rows="2" placeholder="Tambahkan catatan jika diperlukan...">{{ old('keterangan', $jurnal?->keterangan) }}</textarea>
            @error('keterangan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const timepicker1 = document.querySelector('#timepicker1');
            const timepicker2 = document.querySelector('#timepicker2');
            const durasiInput = document.querySelector('#durasi');
            const durasiDisplay = document.querySelector('#durasi_display');

            function calculateDuration() {
                const startTime = document.querySelector('input[name="waktu_mulai_aktifitas"]').value;
                const endTime = document.querySelector('input[name="waktu_selesai_aktifitas"]').value;

                if (startTime && endTime) {
                    const start = new Date(`2000/01/01 ${startTime}`);
                    const end = new Date(`2000/01/01 ${endTime}`);

                    if (end < start) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Kesalahan Input',
                            text: 'Waktu selesai tidak boleh lebih kecil dari waktu mulai!',
                        });
                        document.querySelector('input[name="waktu_selesai_aktifitas"]').value = '';
                        durasiInput.value = '';
                        durasiDisplay.value = '';
                        return;
                    }

                    let durationSeconds = (end - start) / 1000;
                    durasiInput.value = durationSeconds;

                    const hours = Math.floor(durationSeconds / 3600);
                    durationSeconds %= 3600;
                    const minutes = Math.floor(durationSeconds / 60);
                    const seconds = durationSeconds % 60;

                    durasiDisplay.value = `${hours} jam ${minutes} menit ${seconds} detik`;
                }
            }

            const options = {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true,
                onChange: function(selectedDates, dateStr, instance) {
                    const hiddenInput = document.querySelector(
                        `input[name="${instance.element.id === 'timepicker1' ? 'waktu_mulai_aktifitas' : 'waktu_selesai_aktifitas'}"]`
                    );
                    hiddenInput.value = dateStr;
                    calculateDuration();
                }
            };

            flatpickr("#timepicker1", options);
            flatpickr("#timepicker2", options);

            // Initialize Select2 for better dropdown experience
            $('#id_anak_pkl, #id_mentor').select2({
                theme: 'bootstrap-5',
                width: '100%'
            });
        });
    </script>
@endpush

@push('styles')
    <style>
        .form-label {
            color: #333;
            font-size: 0.95rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .invalid-feedback {
            font-size: 0.85rem;
        }

        .select2-container--bootstrap-5 .select2-selection {
            min-height: 38px;
        }
    </style>
@endpush
