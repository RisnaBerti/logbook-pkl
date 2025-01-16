<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                placeholder="{{ __('Name') }}" value="{{ isset($user) ? $user->name : old('name') }}" required
                autofocus>
            @error('name')
                <span class="invalid-feedback">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="username">{{ __('Username') }}</label>
            <input type="text" name="username" id="username"
                class="form-control @error('username') is-invalid @enderror" placeholder="{{ __('Username') }}"
                value="{{ isset($user) ? $user->username : old('username') }}" required autofocus>
            @error('username')
                <span class="invalid-feedback">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>

    {{-- <div class="col-md-6">
        <div class="form-group">
            <label for="id_mentor">{{ __('Mentor') }}</label>
            <input type="id_mentor" name="id_mentor" id="id_mentor"
                class="form-control @error('id_mentor') is-invalid @enderror" placeholder="{{ __('id_mentor') }}"
                value="{{ isset($user) ? $user->id_mentor : old('id_mentor') }}" required>
            @error('id_mentor')
                <span class="invalid-feedback">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div> --}}

    <div class="mb-4">
        <label for="id_mentor" class="form-label">Mentor</label>
        <select name="id_mentor" class="form-control @error('id_mentor') is-invalid @enderror" id="id_mentor">
            <option value=""> -- Pilih Mentor -- </option>
            @foreach ($mentor as $dt)
                <option value="{{ $dt->id_mentor }}"
                    {{ old('id_mentor', $user?->id_mentor) == $dt->id_mentor ? 'selected' : '' }}>
                    {{ $dt->nama_mentor }} <!-- Misalnya, nama unit yang ingin ditampilkan -->
                </option>
            @endforeach
        </select>
        @error('id_mentor')
            <small class="invalid-feedback">{{ $message }}</small>
        @enderror
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="password">{{ __('Password') }}</label>
            <input type="password" name="password" id="password"
                class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}"
                {{ empty($user) ? 'required' : '' }}>
            @error('password')
                <span class="invalid-feedback">
                    {{ $message }}
                </span>
            @enderror
            @isset($user)
                <div id="passwordHelpBlock" class="form-text">
                    {{ __('Leave the password & password confirmation blank if you don`t want to change them.') }}
                </div>
            @endisset
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="password-confirmation">{{ __('Password Confirmation') }}</label>
            <input type="password" name="password_confirmation" id="password-confirmation" class="form-control"
                placeholder="{{ __('Password Confirmation') }}" {{ empty($user) ? 'required' : '' }}>
        </div>
    </div>

    @empty($user)
        <div class="col-md-6">
            <div class="form-group">
                <label for="role">{{ __('Role') }}</label>
                <select class="form-select" name="role" id="role" class="form-control" required>
                    <option value="" selected disabled>-- Pilih role --</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                    @error('role')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </select>
            </div>
        </div>

        {{-- <div class="col-md-6">
            <div class="form-group">
                <label for="unit_sekolah">{{ __('Unit Sekolah') }}</label>
                <select class="form-select" name="unit_sekolah" id="unit_sekolah" class="form-control" required>
                    <option value="" selected disabled>-- Pilih Unit Sekolah --</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                    @error('role')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </select>
            </div>
        </div> --}}

        {{-- <div class="col-md-6">
            <div class="form-group">
                <label for="avatar">{{ __('Avatar') }}</label>
                <input type="file" name="avatar" id="avatar"
                    class="form-control @error('avatar') is-invalid @enderror">
                @error('avatar')
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div> --}}
    @endempty

    @isset($user)
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="role">{{ __('Role') }}</label>
                    <select class="form-select" name="role" id="role" class="form-control" required>
                        <option value="" selected disabled>{{ __('-- Select role --') }}</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}"
                                {{ $user->getRoleNames()->toArray() !== [] && $user->getRoleNames()[0] == $role->name ? 'selected' : '-' }}>
                                {{ $role->name }}</option>
                        @endforeach
                    </select>
                    @error('role')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

            {{-- <div class="col-md-1 text-center">
                <div class="avatar avatar-xl">
                    @if (!$user->avatar)
                        <img src="https://via.placeholder.com/350?text=No+Image+Avaiable" alt="Avatar"
                            class="rounded mb-2 mt-2 img-fluid">
                    @else
                        <img src="{{ asset('storage/uploads/avatars/' . $user->avatar) }}" alt="Avatar"
                            class="rounded mb-2 mt-2 img-fluid">
                    @endif
                </div>
            </div>

            <div class="col-md-5 me-0 pe-0">
                <div class="form-group">
                    <label for="avatar">{{ __('Avatar') }}</label>
                    <input type="file" name="avatar" class="form-control @error('avatar') is-invalid @enderror"
                        id="avatar">
                    @error('avatar')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                    @if ($user->avatar == null)
                        <div id="passwordHelpBlock" class="form-text">
                            {{ __('Leave the avatar blank if you don`t want to change it.') }}
                        </div>
                    @endif
                </div>
            </div> --}}
        </div>
    @endisset
</div>
