<div class="row">
    <div class="col-md-12">
        <div class="mb-4">
            <label for="id_anak_pkl" class="form-label">Anak PKL</label>
            <select name="id_anak_pkl" class="form-select {{ $errors->has('id_anak_pkl') ? 'is-invalid' : '' }}"
                id="id_anak_pkl">
                <option value="">Pilih Anak PKL</option>
                @foreach ($anakPkl as $anak)
                    <option value="{{ $anak->id_anak_pkl }}"
                        {{ old('id_anak_pkl', $sertifikat?->id_anak_pkl) == $anak->id_anak_pkl ? 'selected' : '' }}>
                        {{ $anak->nama_anak_pkl }}
                    </option>
                @endforeach
            </select>
            @error('id_anak_pkl')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-4">
            <label for="sertifikat_depan" class="form-label">Sertifikat Depan</label>
            <input type="file" name="sertifikat_depan"
                class="form-control {{ $errors->has('sertifikat_depan') ? 'is-invalid' : '' }}" id="sertifikat_depan"
                value="{{ old('sertifikat_depan', $sertifikat?->sertifikat_depan) }}"
                placeholder="Masukkan Sertifikat Depan" />
            @error('sertifikat_depan')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-4">
            <label for="sertifikat_belakang" class="form-label">Sertifikat Belakang</label>
            <input type="file" name="sertifikat_belakang"
                class="form-control {{ $errors->has('sertifikat_belakang') ? 'is-invalid' : '' }}"
                id="sertifikat_belakang" value="{{ old('sertifikat_belakang', $sertifikat?->sertifikat_belakang) }}"
                placeholder="Masukkan Sertifikat Belakang" />
            @error('sertifikat_belakang')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-4">
            <label for="keterangan" class="form-label">Keterangan</label>
            <input type="text" name="keterangan"
                class="form-control {{ $errors->has('keterangan') ? 'is-invalid' : '' }}" id="keterangan"
                value="{{ old('keterangan', $sertifikat?->keterangan) }}" placeholder="Masukkan Keterangan" />
            @error('keterangan')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>
