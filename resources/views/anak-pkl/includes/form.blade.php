<div class="row">
    <div class="col-md-12">

        {{-- <div class="mb-4">
                    <label for="id_sekolah" class="form-label">Id Sekolah</label>
                    <input 
                        type="text" 
                        name="id_sekolah" 
                        class="form-control {{ $errors->has('id_sekolah') ? 'is-invalid' : '' }}" 
                        id="id_sekolah" 
                        value="{{ old('id_sekolah', $anakPkl?->id_sekolah) }}" 
                        placeholder="Masukkan Id Sekolah" />
                    @error('id_sekolah')<small class="invalid-feedback">{{ $message }}</small>@enderror
                </div>
                <div class="mb-4">
                    <label for="id_periode_pkl" class="form-label">Id Periode Pkl</label>
                    <input 
                        type="text" 
                        name="id_periode_pkl" 
                        class="form-control {{ $errors->has('id_periode_pkl') ? 'is-invalid' : '' }}" 
                        id="id_periode_pkl" 
                        value="{{ old('id_periode_pkl', $anakPkl?->id_periode_pkl) }}" 
                        placeholder="Masukkan Id Periode Pkl" />
                    @error('id_periode_pkl')<small class="invalid-feedback">{{ $message }}</small>@enderror
                </div>
                <div class="mb-4">
                    <label for="id_mentor" class="form-label">Id Mentor</label>
                    <input 
                        type="text" 
                        name="id_mentor" 
                        class="form-control {{ $errors->has('id_mentor') ? 'is-invalid' : '' }}" 
                        id="id_mentor" 
                        value="{{ old('id_mentor', $anakPkl?->id_mentor) }}" 
                        placeholder="Masukkan Id Mentor" />
                    @error('id_mentor')<small class="invalid-feedback">{{ $message }}</small>@enderror
                </div> --}}

        <div class="mb-4">
            <label for="id_sekolah" class="form-label">Sekolah</label>
            <select name="id_sekolah" class="form-control @error('id_sekolah') is-invalid @enderror" id="id_sekolah">
                <option value=""> -- Pilih Sekolah -- </option>
                @foreach ($sekolah as $dt)
                    <option value="{{ $dt->id_sekolah }}"
                        {{ old('id_sekolah', $anakPkl?->id_sekolah) == $dt->id_sekolah ? 'selected' : '' }}>
                        {{ $dt->nama_sekolah }} <!-- Misalnya, nama unit yang ingin ditampilkan -->
                    </option>
                @endforeach
            </select>
            @error('id_sekolah')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-4">
            <label for="id_periode_pkl" class="form-label">Periode Pkl</label>
            <select name="id_periode_pkl" class="form-control @error('id_periode_pkl') is-invalid @enderror"
                id="id_periode_pkl">
                <option value=""> -- Pilih Periode Pkl -- </option>
                @foreach ($periode as $dt)
                    <option value="{{ $dt->id_periode_pkl }}"
                        {{ old('id_periode_pkl', $anakPkl?->id_periode_pkl) == $dt->id_periode_pkl ? 'selected' : '' }}>
                        {{ $dt->tanggal_mulai }} - {{ $dt->tanggal_selesai }} <!-- Misalnya, nama unit yang ingin ditampilkan -->
                    </option>
                @endforeach
            </select>
            @error('id_periode_pkl')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-4">
            <label for="id_mentor" class="form-label">Mentor</label>
            <select name="id_mentor" class="form-control @error('id_mentor') is-invalid @enderror" id="id_mentor">
                <option value=""> -- Pilih Mentor -- </option>
                @foreach ($mentor as $dt)
                    <option value="{{ $dt->id_mentor }}"
                        {{ old('id_mentor', $anakPkl?->id_mentor) == $dt->id_mentor ? 'selected' : '' }}>
                        {{ $dt->nama_mentor }} <!-- Misalnya, nama unit yang ingin ditampilkan -->
                    </option>
                @endforeach
            </select>
            @error('id_mentor')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>



        <div class="mb-4">
            <label for="nama_anak_pkl" class="form-label">Nama Anak Pkl</label>
            <input type="text" name="nama_anak_pkl"
                class="form-control {{ $errors->has('nama_anak_pkl') ? 'is-invalid' : '' }}" id="nama_anak_pkl"
                value="{{ old('nama_anak_pkl', $anakPkl?->nama_anak_pkl) }}" placeholder="Masukkan Nama Anak Pkl" />
            @error('nama_anak_pkl')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-4">
            <label for="no_telp_anak_pkl" class="form-label">No Telp Anak Pkl</label>
            <input type="text" name="no_telp_anak_pkl"
                class="form-control {{ $errors->has('no_telp_anak_pkl') ? 'is-invalid' : '' }}" id="no_telp_anak_pkl"
                value="{{ old('no_telp_anak_pkl', $anakPkl?->no_telp_anak_pkl) }}"
                placeholder="Masukkan No Telp Anak Pkl" />
            @error('no_telp_anak_pkl')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-4">
            <label for="email_anak_pkl" class="form-label">Email Anak Pkl</label>
            <input type="text" name="email_anak_pkl"
                class="form-control {{ $errors->has('email_anak_pkl') ? 'is-invalid' : '' }}" id="email_anak_pkl"
                value="{{ old('email_anak_pkl', $anakPkl?->email_anak_pkl) }}" placeholder="Masukkan Email Anak Pkl" />
            @error('email_anak_pkl')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-4">
            <label for="foto_anak_pkl" class="form-label">Foto Anak Pkl</label>
            <input type="file" name="foto_anak_pkl"
                class="form-control {{ $errors->has('foto_anak_pkl') ? 'is-invalid' : '' }}" id="foto_anak_pkl"
                value="{{ old('foto_anak_pkl', $anakPkl?->foto_anak_pkl) }}" placeholder="Masukkan Foto Anak Pkl" />
            @error('foto_anak_pkl')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>
