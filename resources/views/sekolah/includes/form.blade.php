<div class="row">
    <div class="col-md-12">

        <div class="mb-4">
            <label for="nama_sekolah" class="form-label">Nama Sekolah</label>
            <input type="text" name="nama_sekolah"
                class="form-control {{ $errors->has('nama_sekolah') ? 'is-invalid' : '' }}" id="nama_sekolah"
                value="{{ old('nama_sekolah', $sekolah?->nama_sekolah) }}" placeholder="Masukkan Nama Sekolah" />
            @error('nama_sekolah')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-4">
            <label for="alamat_sekolah" class="form-label">Alamat Sekolah</label>
            <input type="text" name="alamat_sekolah"
                class="form-control {{ $errors->has('alamat_sekolah') ? 'is-invalid' : '' }}" id="alamat_sekolah"
                value="{{ old('alamat_sekolah', $sekolah?->alamat_sekolah) }}" placeholder="Masukkan Alamat Sekolah" />
            @error('alamat_sekolah')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-4">
            <label for="telepon_sekolah" class="form-label">Telepon Sekolah</label>
            <input type="text" name="telepon_sekolah"
                class="form-control {{ $errors->has('telepon_sekolah') ? 'is-invalid' : '' }}" id="telepon_sekolah"
                value="{{ old('telepon_sekolah', $sekolah?->telepon_sekolah) }}"
                placeholder="Masukkan Telepon Sekolah" />
            @error('telepon_sekolah')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-4">
            <label for="email_sekolah" class="form-label">Email Sekolah</label>
            <input type="text" name="email_sekolah"
                class="form-control {{ $errors->has('email_sekolah') ? 'is-invalid' : '' }}" id="email_sekolah"
                value="{{ old('email_sekolah', $sekolah?->email_sekolah) }}" placeholder="Masukkan Email Sekolah" />
            @error('email_sekolah')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-4">
            <!-- Pratinjau logo jika sudah ada -->
            @if ($sekolah?->logo_sekolah)
                <div class="mt-3">
                    <p>Logo saat ini:</p>
                    <img src="{{ asset('storage/logos/' . $sekolah->logo_sekolah) }}" alt="Logo Saat Ini"
                        class="img-thumbnail" style="max-height: 100px;">
                </div>
            @endif
            <label for="logo_sekolah" class="form-label">Logo Sekolah</label>
            <input type="file" name="logo_sekolah"
                class="form-control {{ $errors->has('logo_sekolah') ? 'is-invalid' : '' }}" id="logo_sekolah"
                value="{{ old('logo_sekolah', $sekolah?->logo_sekolah) }}" placeholder="Masukkan Logo Sekolah" />
            @error('logo_sekolah')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-4">
            <label for="status" class="form-label">Status</label>
            <x-input.select2 name="status" class="@error('status') is-invalid @enderror" placeholder="Pilih Status"
                :options="[
                    '1' => 'MOU',
                    '0' => 'BELUM MOU',
                ]" :selected="old('status', $sekolah?->status)" />
            @error('status')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>

        {{-- <div class="mb-4">
            <label for="status" class="form-label">Status</label>
            <input type="text" name="status" class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}"
                id="status" value="{{ old('status', $sekolah?->status) }}" placeholder="Masukkan status" />
            @error('status')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div> --}}
        <div class="mb-4">
            <label for="keterangan" class="form-label">Keterangan</label>
            <input type="text" name="keterangan"
                class="form-control {{ $errors->has('keterangan') ? 'is-invalid' : '' }}" id="keterangan"
                value="{{ old('keterangan', $sekolah?->keterangan) }}" placeholder="Masukkan Keterangan" />
            @error('keterangan')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>
