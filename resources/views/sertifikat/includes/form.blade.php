<div class="row">
    <div class="col-md-12">
        
                <div class="mb-4">
                    <label for="id_anak_pkl" class="form-label">Id Anak Pkl</label>
                    <input 
                        type="text" 
                        name="id_anak_pkl" 
                        class="form-control {{ $errors->has('id_anak_pkl') ? 'is-invalid' : '' }}" 
                        id="id_anak_pkl" 
                        value="{{ old('id_anak_pkl', $sertifikat?->id_anak_pkl) }}" 
                        placeholder="Masukkan Id Anak Pkl" />
                    @error('id_anak_pkl')<small class="invalid-feedback">{{ $message }}</small>@enderror
                </div>
                <div class="mb-4">
                    <label for="judul_sertifikat" class="form-label">Judul Sertifikat</label>
                    <input 
                        type="text" 
                        name="judul_sertifikat" 
                        class="form-control {{ $errors->has('judul_sertifikat') ? 'is-invalid' : '' }}" 
                        id="judul_sertifikat" 
                        value="{{ old('judul_sertifikat', $sertifikat?->judul_sertifikat) }}" 
                        placeholder="Masukkan Judul Sertifikat" />
                    @error('judul_sertifikat')<small class="invalid-feedback">{{ $message }}</small>@enderror
                </div>
                <div class="mb-4">
                    <label for="nama_pengesah" class="form-label">Nama Pengesah</label>
                    <input 
                        type="text" 
                        name="nama_pengesah" 
                        class="form-control {{ $errors->has('nama_pengesah') ? 'is-invalid' : '' }}" 
                        id="nama_pengesah" 
                        value="{{ old('nama_pengesah', $sertifikat?->nama_pengesah) }}" 
                        placeholder="Masukkan Nama Pengesah" />
                    @error('nama_pengesah')<small class="invalid-feedback">{{ $message }}</small>@enderror
                </div>
                <div class="mb-4">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <input 
                        type="text" 
                        name="keterangan" 
                        class="form-control {{ $errors->has('keterangan') ? 'is-invalid' : '' }}" 
                        id="keterangan" 
                        value="{{ old('keterangan', $sertifikat?->keterangan) }}" 
                        placeholder="Masukkan Keterangan" />
                    @error('keterangan')<small class="invalid-feedback">{{ $message }}</small>@enderror
                </div>
    </div>
</div>