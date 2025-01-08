<div class="row">
    <div class="col-md-12">
        
                <div class="mb-4">
                    <label for="nama_mentor" class="form-label">Nama Mentor</label>
                    <input 
                        type="text" 
                        name="nama_mentor" 
                        class="form-control {{ $errors->has('nama_mentor') ? 'is-invalid' : '' }}" 
                        id="nama_mentor" 
                        value="{{ old('nama_mentor', $mentor?->nama_mentor) }}" 
                        placeholder="Masukkan Nama Mentor" />
                    @error('nama_mentor')<small class="invalid-feedback">{{ $message }}</small>@enderror
                </div>
                <div class="mb-4">
                    <label for="email_mentor" class="form-label">Email Mentor</label>
                    <input 
                        type="text" 
                        name="email_mentor" 
                        class="form-control {{ $errors->has('email_mentor') ? 'is-invalid' : '' }}" 
                        id="email_mentor" 
                        value="{{ old('email_mentor', $mentor?->email_mentor) }}" 
                        placeholder="Masukkan Email Mentor" />
                    @error('email_mentor')<small class="invalid-feedback">{{ $message }}</small>@enderror
                </div>
                <div class="mb-4">
                    <label for="alamat_mentor" class="form-label">Alamat Mentor</label>
                    <input 
                        type="text" 
                        name="alamat_mentor" 
                        class="form-control {{ $errors->has('alamat_mentor') ? 'is-invalid' : '' }}" 
                        id="alamat_mentor" 
                        value="{{ old('alamat_mentor', $mentor?->alamat_mentor) }}" 
                        placeholder="Masukkan Alamat Mentor" />
                    @error('alamat_mentor')<small class="invalid-feedback">{{ $message }}</small>@enderror
                </div>
                <div class="mb-4">
                    <label for="no_telp_mentor" class="form-label">No Telp Mentor</label>
                    <input 
                        type="text" 
                        name="no_telp_mentor" 
                        class="form-control {{ $errors->has('no_telp_mentor') ? 'is-invalid' : '' }}" 
                        id="no_telp_mentor" 
                        value="{{ old('no_telp_mentor', $mentor?->no_telp_mentor) }}" 
                        placeholder="Masukkan No Telp Mentor" />
                    @error('no_telp_mentor')<small class="invalid-feedback">{{ $message }}</small>@enderror
                </div>
                <div class="mb-4">
                    <label for="foto_mentor" class="form-label">Foto Mentor</label>
                    <input 
                        type="text" 
                        name="foto_mentor" 
                        class="form-control {{ $errors->has('foto_mentor') ? 'is-invalid' : '' }}" 
                        id="foto_mentor" 
                        value="{{ old('foto_mentor', $mentor?->foto_mentor) }}" 
                        placeholder="Masukkan Foto Mentor" />
                    @error('foto_mentor')<small class="invalid-feedback">{{ $message }}</small>@enderror
                </div>
                <div class="mb-4">
                    <label for="ttd_mentor" class="form-label">Ttd Mentor</label>
                    <input 
                        type="text" 
                        name="ttd_mentor" 
                        class="form-control {{ $errors->has('ttd_mentor') ? 'is-invalid' : '' }}" 
                        id="ttd_mentor" 
                        value="{{ old('ttd_mentor', $mentor?->ttd_mentor) }}" 
                        placeholder="Masukkan Ttd Mentor" />
                    @error('ttd_mentor')<small class="invalid-feedback">{{ $message }}</small>@enderror
                </div>
    </div>
</div>