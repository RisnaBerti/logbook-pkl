<div class="row">
    <div class="col-md-12">

        <div class="mb-4">
            <label for="id_sekolah" class="form-label">Sekolah</label>
            <select name="id_sekolah" class="form-control @error('id_sekolah') is-invalid @enderror" id="id_sekolah">
                <option value=""> -- Pilih Sekolah -- </option>
                @foreach ($sekolah as $dt)
                    <option value="{{ $dt->id_sekolah }}"
                        {{ old('id_sekolah', $periodePkl?->id_sekolah) == $dt->id_sekolah ? 'selected' : '' }}>
                        {{ $dt->nama_sekolah }} <!-- Misalnya, nama unit yang ingin ditampilkan -->
                    </option>
                @endforeach
            </select>
            @error('id_sekolah')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-4">
            <label for="tanggal_mulai" class="form-label">Periode PKL</label>
            <x-input.daterangepicker name1="tanggal_mulai" name2="tanggal_selesai" value1="" value2=""
                placeholder="Pilih Rentang Tanggal" opens="right" customRangeLabel="Periode PKL" />
            @error('tanggal_mulai')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-4">
            <label for="durasi_bulan" class="form-label">Durasi Bulan</label>
            <x-input.currency name="durasi_bulan" id="durasi_bulan"
                value="{{ old('durasi_bulan', $periodePkl?->durasi_bulan) }}" placeholder="Masukkan Durasi Bulan"
                class="form-control text-start {{ $errors->has('durasi_bulan') ? 'is-invalid' : '' }}" />
            @error('durasi_bulan')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-4">
            <label for="keterangan" class="form-label">Keterangan</label>
            <input type="text" name="keterangan"
                class="form-control {{ $errors->has('keterangan') ? 'is-invalid' : '' }}" id="keterangan"
                value="{{ old('keterangan', $periodePkl?->keterangan) }}" placeholder="Masukkan Keterangan" />
            @error('keterangan')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>
