<div class="row">
    <div class="col-md-12">
        
                <div class="mb-4">
                    <label for="id_riwayat_mentoring" class="form-label">Id Riwayat Mentoring</label>
                    <input 
                        type="text" 
                        name="id_riwayat_mentoring" 
                        class="form-control {{ $errors->has('id_riwayat_mentoring') ? 'is-invalid' : '' }}" 
                        id="id_riwayat_mentoring" 
                        value="{{ old('id_riwayat_mentoring', $detailMentoring?->id_riwayat_mentoring) }}" 
                        placeholder="Masukkan Id Riwayat Mentoring" />
                    @error('id_riwayat_mentoring')<small class="invalid-feedback">{{ $message }}</small>@enderror
                </div>
                <div class="mb-4">
                    <label for="id_anak_pkl" class="form-label">Id Anak Pkl</label>
                    <input 
                        type="text" 
                        name="id_anak_pkl" 
                        class="form-control {{ $errors->has('id_anak_pkl') ? 'is-invalid' : '' }}" 
                        id="id_anak_pkl" 
                        value="{{ old('id_anak_pkl', $detailMentoring?->id_anak_pkl) }}" 
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
                        value="{{ old('id_mentor', $detailMentoring?->id_mentor) }}" 
                        placeholder="Masukkan Id Mentor" />
                    @error('id_mentor')<small class="invalid-feedback">{{ $message }}</small>@enderror
                </div>
                <div class="mb-4">
                    <label for="hari_mentor" class="form-label">Hari Mentor</label>
                    <x-input.currency name="hari_mentor" id="hari_mentor"
                        value="{{ old('hari_mentor', $detailMentoring?->hari_mentor) }}" 
                        placeholder="Masukkan Hari Mentor"
                        class="form-control text-end {{ $errors->has('hari_mentor') ? 'is-invalid' : '' }}" />
                    @error('hari_mentor')<small class="invalid-feedback">{{ $message }}</small>@enderror
                </div>
    </div>
</div>