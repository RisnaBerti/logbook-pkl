<div class="row">
    <div class="col-md-12">
        <div class="mb-4">
            <label for="id_anak_pkl" class="form-label">Anak Pkl</label>
            <select name="id_anak_pkl" class="form-control @error('id_anak_pkl') is-invalid @enderror" id="id_anak_pkl">
                <option value=""> -- Pilih Anak Pkl -- </option>
                @foreach ($anak_pkl as $dt)
                    <option value="{{ $dt->id_anak_pkl }}"
                        {{ old('id_anak_pkl', $jurnal?->id_anak_pkl) == $dt->id_anak_pkl ? 'selected' : '' }}>
                        {{ $dt->nama_anak_pkl }} | {{ $dt->mentor->nama_mentor }}
                    </option>
                @endforeach
            </select>
            @error('id_anak_pkl')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-4">
            <label for="id_mentor" class="form-label">Mentor</label>
            <select name="id_mentor" class="form-control @error('id_mentor') is-invalid @enderror" id="id_mentor">
                <option value=""> -- Pilih Mentor -- </option>
                @foreach ($mentor as $dt)
                    <option value="{{ $dt->id_mentor }}"
                        {{ old('id_mentor', $jurnal?->id_mentor) == $dt->id_mentor ? 'selected' : '' }}>
                        {{ $dt->nama_mentor }} <!-- Misalnya, nama unit yang ingin ditampilkan -->
                    </option>
                @endforeach
            </select>
            @error('id_mentor')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>


        <div class="mb-4">
            <label for="aktifitas" class="form-label">Aktifitas</label>
            <input type="text" name="aktifitas"
                class="form-control {{ $errors->has('aktifitas') ? 'is-invalid' : '' }}" id="aktifitas"
                value="{{ old('aktifitas', $jurnal?->aktifitas) }}" placeholder="Masukkan Aktifitas" />
            @error('aktifitas')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-4">
            <label for="tanggal_jurnal" class="form-label">Tanggal Jurnal</label>
            <x-input.daterangepicker name1="tanggal_jurnal"
                value1="{{ old('tanggal_jurnal', $jurnal?->tanggal_jurnal) }}" placeholder="Pilih Tanggal"
                opens="right" singleDatePicker="true" :ranges="false" />
        </div>

        <div class="mb-4">
            <label for="waktu_mulai_aktifitas" class="form-label">Waktu Mulai</label>
            <x-input.timepicker name1="waktu_mulai_aktifitas" id1="timepicker1"
                value1="{{ old('waktu_mulai_aktifitas', $jurnal?->waktu_mulai_aktifitas) }}" singleTimePicker="true" />

        </div>

        <div class="mb-4">
            <label for="waktu_selesai_aktifitas" class="form-label">Waktu Selesai</label>
            <x-input.timepicker name1="waktu_selesai_aktifitas" id1="timepicker2"
                value1="{{ old('waktu_selesai_aktifitas', $jurnal?->waktu_selesai_aktifitas) }}"
                singleTimePicker="true" />
        </div>

        <div class="mb-4">
            <label for="durasi" class="form-label">Durasi</label>
            <input type="text" name="durasi_display" id="durasi_display" readonly class="form-control text-end" />
            <input type="hidden" name="durasi" id="durasi" value="{{ old('durasi', $jurnal?->durasi) }}" />
        </div>

        <div class="mb-4">
            <label for="keterangan" class="form-label">Keterangan</label>
            <input type="text" name="keterangan"
                class="form-control {{ $errors->has('keterangan') ? 'is-invalid' : '' }}" id="keterangan"
                value="{{ old('keterangan', $jurnal?->keterangan) }}" placeholder="Masukkan Keterangan" />
            @error('keterangan')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>

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
                // Convert to Date objects for calculation
                const start = new Date(`2000/01/01 ${startTime}`);
                const end = new Date(`2000/01/01 ${endTime}`);

                // Validate end time not less than start time
                if (end < start) {
                    alert('Waktu selesai tidak boleh lebih kecil dari waktu mulai!');
                    document.querySelector('input[name="waktu_selesai_aktifitas"]').value = '';
                    durasiInput.value = '';
                    durasiDisplay.value = '';
                    return;
                }

                // Calculate duration in seconds
                let durationSeconds = (end - start) / 1000;

                // Store seconds in hidden input
                durasiInput.value = durationSeconds;

                // Format duration for display
                const hours = Math.floor(durationSeconds / 3600);
                durationSeconds %= 3600;
                const minutes = Math.floor(durationSeconds / 60);
                const seconds = durationSeconds % 60;

                durasiDisplay.value = `${hours} jam ${minutes} menit ${seconds} detik`;
            }
        }

        // Modify timepicker component options to include the calculation
        const options = {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
            onChange: function(selectedDates, dateStr, instance) {
                // Update hidden input
                const hiddenInput = document.querySelector(
                    `input[name="${instance.element.id === 'timepicker1' ? 'waktu_mulai_aktifitas' : 'waktu_selesai_aktifitas'}"]`
                );
                hiddenInput.value = dateStr;

                // Calculate duration
                calculateDuration();
            }
        };

        flatpickr("#timepicker1", options);
        flatpickr("#timepicker2", options);
    });
</script>
