<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light-style layout-menu-fixed layout-compact"
    dir="ltr" data-style="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Register - {{ $title ?? config('app.name', 'Prabubima Tech') }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css">
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}">

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}" />

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom CSS -->
    <style>
        .register-card {
            max-width: 1100px !important;
            /* Increased from 900px */
            margin: 0 auto;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #696cff;
            box-shadow: 0 0 0 0.125rem rgba(105, 108, 255, 0.1);
        }

        .input-group-text {
            background-color: transparent;
        }

        .app-brand {
            margin-bottom: 2rem;
        }

        .auth-title {
            position: relative;
            padding-bottom: 1rem;
            margin-bottom: 2rem;
        }

        .auth-title::after {
            content: '';
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            bottom: 0;
            height: 3px;
            width: 50px;
            background-color: #696cff;
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .input-group-text i {
            font-size: 1.25rem;
        }

        /* New spacing rules */
        .card-body {
            padding: 2.5rem 3rem !important;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .input-group {
            margin-top: 0.25rem;
        }

        .col-md-6 {
            padding: 0 1.5rem;
        }

        .row {
            margin: 0 -1.5rem;
        }

        @media (max-width: 768px) {
            .register-card {
                margin: 1rem;
            }

            .card-body {
                padding: 1.5rem !important;
            }

            .col-md-6 {
                padding: 0 1rem;
            }
        }
    </style>

</head>

<body>
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register Card -->
                <div class="card register-card">
                    <div class="card-body">
                        <!-- Logo section remains the same -->

                        <div class="text-center mb-4">
                            <h4 class="auth-title">Selamat Datang di Prabubima Tech!</h4>
                            <p class="mb-0">Daftar untuk mengakses Sistem Logbook PKL/Magang</p>
                        </div>

                        <x-error-list />

                        <form id="formAuthentication" action="{{ route('register') }}" method="post">
                            @csrf
                            <div class="form-group mb-4">
                                <label for="nama_anak_pkl" class="form-label">Nama Lengkap</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-user"></i></span>
                                    <input type="text" class="form-control" id="nama_anak_pkl" name="nama_anak_pkl"
                                        placeholder="Masukkan Nama Lengkap" autofocus required />
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label for="no_telp_anak_pkl" class="form-label">Nomor WhatsApp</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-phone"></i></span>
                                    <input type="tel" class="form-control" id="no_telp_anak_pkl"
                                        name="no_telp_anak_pkl" placeholder="Masukkan Nomor WhatsApp" required />
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label for="email_anak_pkl" class="form-label">Email</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                    <input type="email" class="form-control" id="email_anak_pkl" name="email_anak_pkl"
                                        placeholder="Masukkan Email" required />
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="id_sekolah" class="form-label">Asal Sekolah</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-buildings"></i></span>
                                    <select class="form-select" id="id_sekolah" name="id_sekolah" required>
                                        <option value="" disabled selected>Pilih Sekolah</option>
                                        @foreach ($sekolah as $item)
                                            <option value="{{ $item->id_sekolah }}">{{ $item->nama_sekolah }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label for="id_periode_pkl" class="form-label">Periode PKL/Magang</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                                    <select class="form-select" id="id_periode_pkl" name="id_periode_pkl" required>
                                        <option value="" disabled selected>Pilih Periode</option>
                                        @foreach ($periode as $item)
                                            <option value="{{ $item->id_periode_pkl }}">
                                                {{ now()->parse($item?->tanggal_mulai)->format('d M Y') }} -
                                                {{ now()->parse($item?->tanggal_selesai)->format('d M Y') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label class="form-label" for="password">Password</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-lock"></i></span>
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="Masukkan Password" required />
                                    <span class="cursor-pointer input-group-text toggle-password"><i
                                            class="bx bx-hide"></i></span>
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label class="form-label" for="confirmPassword">Konfirmasi Password</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-lock"></i></span>
                                    <input type="password" id="confirmPassword" class="form-control"
                                        name="password_confirmation" placeholder="Konfirmasi Password" required />
                                    <span class="cursor-pointer input-group-text toggle-password"><i
                                            class="bx bx-hide"></i></span>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button class="btn btn-primary d-grid w-100" type="submit">
                                    Daftar
                                    {{-- <i class="bx bx-user-plus me-2"></i> Daftar --}}
                                </button>
                            </div>
                        </form>

                        <p class="text-center mt-4">
                            <span>Sudah memiliki akun?</span>
                            <a href="{{ route('login') }}" class="fw-semibold">
                                <span>Login</span>
                            </a>
                        </p>
                    </div>
                </div>

                <!-- /Register Card -->
            </div>
        </div>
    </div>

    <!-- Core JS -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('/assets/vendor/js/menu.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Custom JavaScript -->
    <script>
        $(document).ready(function() {
            // Phone number validation
            $('#no_telp_anak_pkl').on('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
            });

            // Password toggle
            $('.toggle-password').click(function() {
                const input = $(this).parent().find('input');
                const icon = $(this).find('i');

                if (input.attr('type') === 'password') {
                    input.attr('type', 'text');
                    icon.removeClass('bx-hide').addClass('bx-show');
                } else {
                    input.attr('type', 'password');
                    icon.removeClass('bx-show').addClass('bx-hide');
                }
            });

            // Password validation
            $('#formAuthentication').on('submit', function(e) {
                const password = $('#password').val();
                const confirmPassword = $('#confirmPassword').val();

                if (password !== confirmPassword) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Password dan konfirmasi password tidak cocok!'
                    });
                }
            });
        });
    </script>
</body>

</html>
