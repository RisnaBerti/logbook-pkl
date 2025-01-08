<div class="row">
    <div class="col-md-12">
        
                <div class="mb-4">
                    <label for="nama_keterampilan" class="form-label">Nama Keterampilan</label>
                    <input 
                        type="text" 
                        name="nama_keterampilan" 
                        class="form-control {{ $errors->has('nama_keterampilan') ? 'is-invalid' : '' }}" 
                        id="nama_keterampilan" 
                        value="{{ old('nama_keterampilan', $keterampilan?->nama_keterampilan) }}" 
                        placeholder="Masukkan Nama Keterampilan" />
                    @error('nama_keterampilan')<small class="invalid-feedback">{{ $message }}</small>@enderror
                </div>
                <div class="mb-4">
                    <label for="deskripsi_keterampilan" class="form-label">Deskripsi Keterampilan</label>
                    <input 
                        type="text" 
                        name="deskripsi_keterampilan" 
                        class="form-control {{ $errors->has('deskripsi_keterampilan') ? 'is-invalid' : '' }}" 
                        id="deskripsi_keterampilan" 
                        value="{{ old('deskripsi_keterampilan', $keterampilan?->deskripsi_keterampilan) }}" 
                        placeholder="Masukkan Deskripsi Keterampilan" />
                    @error('deskripsi_keterampilan')<small class="invalid-feedback">{{ $message }}</small>@enderror
                </div>
    </div>
</div>