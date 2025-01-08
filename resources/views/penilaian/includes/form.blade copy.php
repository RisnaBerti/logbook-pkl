<div class="row">
    <div class="col-md-12">
        
                <div class="mb-4">
                    <label for="id_anak_pkl" class="form-label">Id Anak Pkl</label>
                    <input 
                        type="text" 
                        name="id_anak_pkl" 
                        class="form-control {{ $errors->has('id_anak_pkl') ? 'is-invalid' : '' }}" 
                        id="id_anak_pkl" 
                        value="{{ old('id_anak_pkl', $penilaian?->id_anak_pkl) }}" 
                        placeholder="Masukkan Id Anak Pkl" />
                    @error('id_anak_pkl')<small class="invalid-feedback">{{ $message }}</small>@enderror
                </div>
                <div class="mb-4">
                    <label for="id_mentor" class="form-label">Id Mentor</label>
                    <input 
                        type="text" 
                        name="id_mentor" 
                        class="form-control {{ $errors->has('id_mentor') ? 'is-invalid' : '' }}" 
                        id="id_mentor" 
                        value="{{ old('id_mentor', $penilaian?->id_mentor) }}" 
                        placeholder="Masukkan Id Mentor" />
                    @error('id_mentor')<small class="invalid-feedback">{{ $message }}</small>@enderror
                </div>
                <div class="mb-4">
                    <label for="id_keterampilan" class="form-label">Id Keterampilan</label>
                    <input 
                        type="text" 
                        name="id_keterampilan" 
                        class="form-control {{ $errors->has('id_keterampilan') ? 'is-invalid' : '' }}" 
                        id="id_keterampilan" 
                        value="{{ old('id_keterampilan', $penilaian?->id_keterampilan) }}" 
                        placeholder="Masukkan Id Keterampilan" />
                    @error('id_keterampilan')<small class="invalid-feedback">{{ $message }}</small>@enderror
                </div>
                <div class="mb-4">
                    <label for="nilai" class="form-label">Nilai</label>
                    <x-input.currency name="nilai" id="nilai"
                        value="{{ old('nilai', $penilaian?->nilai) }}" 
                        placeholder="Masukkan Nilai"
                        class="form-control text-end {{ $errors->has('nilai') ? 'is-invalid' : '' }}" />
                    @error('nilai')<small class="invalid-feedback">{{ $message }}</small>@enderror
                </div>
                <div class="mb-4">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <input 
                        type="text" 
                        name="keterangan" 
                        class="form-control {{ $errors->has('keterangan') ? 'is-invalid' : '' }}" 
                        id="keterangan" 
                        value="{{ old('keterangan', $penilaian?->keterangan) }}" 
                        placeholder="Masukkan Keterangan" />
                    @error('keterangan')<small class="invalid-feedback">{{ $message }}</small>@enderror
                </div>
    </div>
</div>