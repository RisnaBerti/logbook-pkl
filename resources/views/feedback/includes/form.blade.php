<div class="row">
    <div class="col-md-12">
        <div class="mb-4">
            <label for="tanggal_feedback" class="form-label">Tanggal Feedback</label>
            <x-input.daterangepicker name1="tanggal_feedback"
                value1="{{ old('tanggal_feedback', $feedback?->tanggal_feedback) }}" placeholder="Pilih Tanggal"
                opens="right" singleDatePicker="true" :ranges="false" />
        </div>
        <div class="mb-4">
            <label for="id_anak_pkl" class="form-label">Anak Pkl</label>
            <select name="id_anak_pkl" class="form-control @error('id_anak_pkl') is-invalid @enderror" id="id_anak_pkl">
                <option value=""> -- Pilih Anak Pkl -- </option>
                @foreach ($anak_pkl as $dt)
                    <option value="{{ $dt->id_anak_pkl }}"
                        {{ old('id_anak_pkl', $feedback?->id_anak_pkl) == $dt->id_anak_pkl ? 'selected' : '' }}>
                        {{ $dt->nama_anak_pkl }}
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
                        {{ old('id_mentor', $feedback?->id_mentor) == $dt->id_mentor ? 'selected' : '' }}>
                        {{ $dt->nama_mentor }} <!-- Misalnya, nama unit yang ingin ditampilkan -->
                    </option>
                @endforeach
            </select>
            @error('id_mentor')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-4">
            <label for="id_jurnal" class="form-label">Jurnal PKL</label>
            <select name="id_jurnal" class="form-control @error('id_jurnal') is-invalid @enderror" id="id_jurnal">
                {{-- <option value=""> -- Pilih Mentor -- </option> --}}
                @foreach ($jurnal as $dt)
                    <option value="{{ $dt->id_jurnal }}"
                        {{ old('id_jurnal', $feedback?->id_jurnal) == $dt->id_jurnal ? 'selected' : '' }}>
                        {{ $dt->aktifitas }} <!-- Misalnya, nama unit yang ingin ditampilkan -->
                    </option>
                @endforeach
            </select>
            @error('id_jurnal')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-4">
            <label for="isi_feedback" class="form-label">Isi Feedback</label>
            <input type="text" name="isi_feedback"
                class="form-control {{ $errors->has('isi_feedback') ? 'is-invalid' : '' }}" id="isi_feedback"
                value="{{ old('isi_feedback', $feedback?->isi_feedback) }}" placeholder="Masukkan Isi Feedback" />
            @error('isi_feedback')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>
