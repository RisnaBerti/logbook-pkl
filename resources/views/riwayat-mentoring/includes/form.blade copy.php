<div class="row">
    <div class="col-md-12">
        <div class="mb-4">
            <label for="id_anak_pkl" class="form-label">Anak PKL</label>
            <select name="id_anak_pkl" class="form-select {{ $errors->has('id_anak_pkl') ? 'is-invalid' : '' }}"
                id="id_anak_pkl">
                <option value="">Pilih Anak PKL</option>
                @foreach ($anakPkl as $anak)
                    <option value="{{ $anak->id_anak_pkl }}"
                        {{ old('id_anak_pkl', $riwayatMentoring?->id_anak_pkl) == $anak->id_anak_pkl ? 'selected' : '' }}>
                        {{ $anak->nama_anak_pkl }}
                    </option>
                @endforeach
            </select>
            @error('id_anak_pkl')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-4">
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

        <div class="mb-4">
            <label for="tanggal_mulai" class="form-label">Periode Mentoring</label>
            <x-input.daterangepicker name1="tanggal_mulai" name2="tanggal_akhir" value1="" value2=""
                placeholder="Pilih Rentang Tanggal" opens="right" customRangeLabel="Periode Mentoring" />
            @error('tanggal_mulai')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>

        {{-- <div class="mb-4">
            <label for="hari_mentor" class="form-label">Hari Mentor</label>
            <x-input.currency name="hari_mentor" id="hari_mentor"
                value="{{ old('hari_mentor', $riwayatMentoring?->hari_mentor) }}" placeholder="Masukkan Hari Mentor"
                class="form-control text-end {{ $errors->has('hari_mentor') ? 'is-invalid' : '' }}" readonly />
            @error('hari_mentor')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div> --}}
    </div>
</div>
