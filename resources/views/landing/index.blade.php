<x-layouts.guest title="PENDAFTARAN TRY-OUT | SMP MUGA YOGYA" activeMenu="landing">
    <div class="main-container">
        <img src="{{ asset('assets/img/front-pages/hero-bg.png') }}" class="main-bg">

        <x-guest-navbar />

        <!-- Content wrapper -->
        <div class="content-wrapper">

            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                {{-- hero --}}
                {{-- <section class="mb-5 bg-white rounded-1 hero section" style="min-height: 30vh">
                    <div class="container">
                        <div class="row gy-4">
                            <div class="col-lg-6 d-flex flex-column justify-content-center aos-init aos-animate"
                                data-aos="zoom-out">
                                <h1 style="line-height: 3.8rem;">Persiapkan Masa Depan Anda! Ikuti Tryout Sekarang!</h1>
                                <p>Daftar dan ikuti tryout untuk mempersiapkan diri masuk ke sekolah menengah pertama
                                    terbaik. Tes dengan standar kompetensi terkini dan evaluasi hasil secara cepat.</p>

                            </div>
                            <div class="text-center col-lg-6 hero-img aos-init aos-animate" data-aos="zoom-out"
                                data-aos-delay="200" style="margin: 100px 0;">
                                <img src="{{ asset('assets/img/logo/logosmpmugaygy.png') }}" class="img animat"
                                    alt="" height="380px">
                            </div>
                        </div>
                    </div>
                </section> --}}

                {{-- end hero --}}

                <br>

                <div>
                    <h4 class="mt-1 mb-5 text-center section-title fw-bold">FORM PENDAFTARAN</h4>
                    <p class="text-center fw-medium">Daftar dan ikuti tryout untuk mempersiapkan diri masuk ke
                        sekolah
                        menengah pertama terbaik. <br> Tes dengan standar kompetensi terkini dan evaluasi hasil secara
                        cepat.
                    </p>

                    <div class="container mt-5 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                        <div class="row gy-4">
                            <div class="col-lg-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="p-3">
                                            <div class="d-flex align-items-center aos-init aos-animate"
                                                data-aos="fade-up" data-aos-delay="200">
                                                <i class="flex-shrink-0 bx bxs-graduation me-3"
                                                    style="font-size: 36px !important;"></i>
                                                <div>
                                                    <h5 class="mb-1 fw-semibold">Pendaftaran</h5>
                                                    <a href="#alur-pendaftaran" class="fw-normal collapsed"
                                                        role="button" data-bs-toggle="collapse" aria-expanded="false"
                                                        aria-controls="alur-pendaftaran">Alur mendaftar</a>
                                                </div>
                                            </div>

                                            <div class="mt-3 collapse" id="alur-pendaftaran" style="">
                                                <div class="p-4 border d-grid d-sm-flex">
                                                    <ol class="mb-0">
                                                        <li>
                                                            <b>Isi Formulir</b>
                                                            <br>
                                                            Masukkan data pribadi di halaman pendaftaran.
                                                        </li>
                                                        <li>
                                                            <b>Konfirmasi Data</b>
                                                            <br>
                                                            Periksa kembali data yang telah diisi sebelum melanjutkan.
                                                            Kemudian klik daftar.
                                                        </li>
                                                        <li>
                                                            <b>Informasi Login Akun</b>
                                                            <br>
                                                            Anda akan memperoleh informasi akun untuk login ke aplikasi.
                                                            Harap disimpan dengan baik.
                                                        </li>
                                                        <li>
                                                            <b>Login Ke Aplikasi</b>
                                                            <br>
                                                            Login dengan informasi akun untuk melihat status pembayaran
                                                            dan mencetak/mengunduh kartu peserta.
                                                        </li>
                                                        <li>
                                                            <b>Lakukan Pembayaran dan Cetak Kartu</b>
                                                            <br>
                                                            Setelah login dan masuk ke menu "Kartu Tryout", jika belum
                                                            membayar maka tampil jumlah nominal yang perlu dibayarkan
                                                            dan jika sudah membayar maka kartu akan tertampil dan bisa
                                                            dicetak ataupun diunduh.
                                                        </li>
                                                        <li>
                                                            <b>Ikuti Tryout</b>
                                                            <br>
                                                            Hadiri tryout sesuai jadwal dan dengan membawa kartu
                                                            peserta.
                                                        </li>
                                                    </ol>
                                                </div>
                                            </div>

                                            <div class="mt-5 d-flex align-items-center aos-init aos-animate"
                                                data-aos="fade-up" data-aos-delay="200">
                                                <i class="flex-shrink-0 bx bx-receipt me-3"
                                                    style="font-size: 36px !important;"></i>
                                                <div>
                                                    <h5 class="mb-1 fw-semibold">Pembayaran</h5>
                                                    <a href="#cara-pembayaran" class="fw-normal collapsed"
                                                        role="button" data-bs-toggle="collapse" aria-expanded="false"
                                                        aria-controls="cara-pembayaran">Tata Cara Membayar</a>
                                                </div>
                                            </div>

                                            <div class="mt-3 collapse" id="cara-pembayaran" style="">
                                                <div class="p-4 border d-grid d-sm-flex">
                                                    <div>
                                                        <b>Cara bayar melalui Muamalat Bank Banking (Muamalat DIN)</b>
                                                        <ol>
                                                            <li>Login ke Mobile Banking Muamalat (Muamalat DIN)</li>
                                                            <li>Pilih menu "BELI atau BAYAR"</li>
                                                            <li>Pilih menu <b>VIRTUAL ACCOUNT</b></li>
                                                            <li>Pilih rekening sumber</li>
                                                            <li>Masukkan nomor "Virtual Account" <b>751018 [diperoleh setelah daftar]</b></li>
                                                            <li>Periksa informasi pembayaran pastikan VA sudah sesuai dengan informasi (cek info nama dan nama tagihan), kesalahan transfer ke Virtual Account lain bukan tanggung jawab bagian keuangan</li>
                                                            <li>Masukkan nominal bayar sesuai dengan total bayar yang tertera (biaya admin Rp. 3000 tertera)</li>
                                                            <li>Masukkan PIN mobile banking Anda</li>
                                                            <li>Konfirmasi pembayaran</li>
                                                            <li>Simpan bukti transaksi sebagai bukti pembayaran</li>
                                                        </ol>
                                                        <small>
                                                            *NB: Untuk lebih jelasnya ada di menu "Tata cara
                                                            pembayaran" setelah login.
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mt-5 d-flex align-items-center aos-init aos-animate"
                                                data-aos="fade-up" data-aos-delay="200">
                                                <i class="flex-shrink-0 bx bxl-whatsapp me-3"
                                                    style="font-size: 36px !important;"></i>
                                                <div>
                                                    <h5 class="mb-1 fw-semibold">Punya Pertanyaan?</h5>
                                                    <a href="#hubungi-admin" class="fw-normal collapsed" role="button"
                                                        data-bs-toggle="collapse" aria-expanded="false"
                                                        aria-controls="hubungi-admin">Hubungi Admin</a>
                                                </div>
                                            </div>

                                            <div class="mt-3 collapse" id="hubungi-admin" style="">
                                                <div class="p-4 border d-grid d-sm-flex">
                                                    <ol class="mb-0">
                                                        <li>
                                                            <b>Admin Muga</b>
                                                            <br>
                                                            <a href="https://wa.me/6282322756805" target="_blank"
                                                                class="fw-normal">Kirim pesan Whatsapp</a>
                                                        </li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <x-error-list />

                                        <form class="aos-init aos-animate" data-aos="fade-up" data-aos-delay="200"
                                            method="POST" action="{{ route('tryout.daftar') }}">
                                            @csrf
                                            <div class="row gy-4">
                                                <div class="col-md-12">
                                                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                                    <input type="text" name="nama_lengkap"
                                                        class="form-control {{ $errors->has('nama_lengkap') ? 'is-invalid' : '' }}"
                                                        id="nama_lengkap"
                                                        value="{{ old('nama_lengkap', $pendaftaranTryout?->nama_lengkap) }}"
                                                        placeholder="Masukkan Nama Lengkap" />
                                                    @error('nama_lengkap')
                                                        <small class="invalid-feedback">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="col-md-12">
                                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                                    <x-input.select2 name="jenis_kelamin" id="jenis_kelamin"
                                                        class="form-control {{ $errors->has('jenis_kelamin') ? 'is-invalid' : '' }}"
                                                        placeholder="Pilih Jenis Kelamin" :options="[
                                                            'L' => 'L',
                                                            'P' => 'P',
                                                        ]"
                                                        selected="{{ old('jenis_kelamin', $pendaftaranTryout?->jenis_kelamin) }}" />
                                                    @error('jenis_kelamin')
                                                        <small class="invalid-feedback">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <!--<div class="col-md-12">-->
                                                <!--    <label for="nisn" class="form-label">Nisn</label>-->
                                                <!--    <input type="text" name="nisn"-->
                                                <!--        class="form-control {{ $errors->has('nisn') ? 'is-invalid' : '' }}"-->
                                                <!--        id="nisn"-->
                                                <!--        value="{{ old('nisn', $pendaftaranTryout?->nisn) }}"-->
                                                <!--        placeholder="Masukkan Nisn" />-->
                                                <!--    @error('nisn')-->
                                                <!--        <small class="invalid-feedback">{{ $message }}</small>-->
                                                <!--    @enderror-->
                                                <!--</div>-->
                                                
                                                <div class="col-md-12">
                                                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                                    <input type="text" name="tempat_lahir"
                                                        class="form-control {{ $errors->has('tempat_lahir') ? 'is-invalid' : '' }}"
                                                        id="tempat_lahir"
                                                        value="{{ old('tempat_lahir', $pendaftaranTryout?->tempat_lahir) }}"
                                                        placeholder="Masukkan Tempat Lahir" />
                                                    @error('tempat_lahir')
                                                        <small class="invalid-feedback">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="col-md-12">
                                                    <label for="tanggal_lahir" class="form-label">
                                                        Tanggal lahir
                                                    </label>
                                                    <x-input.daterangepicker name1="tanggal_lahir"
                                                        value1="{{ old('tanggal_lahir', $pendaftaranTryout?->tanggal_lahir) }}"
                                                        placeholder="Pilih Tanggal" opens="right"
                                                        singleDatePicker="true" :ranges="false" />
                                                    @error('tanggal_lahir')
                                                        <small class="invalid-feedback">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                
                                                <div class="col-md-12">
                                                    <label for="alamat_domisili" class="form-label">Alamat Domisili</label>
                                                    <textarea name="alamat_domisili"
                                                        class="form-control {{ $errors->has('alamat_domisili') ? 'is-invalid' : '' }}"
                                                        id="alamat_domisili"
                                                        placeholder="Masukkan Alamat Domisili">{{ old('alamat_domisili', $pendaftaranTryout?->alamat_domisili) }}</textarea>
                                                    @error('alamat_domisili')
                                                        <small class="invalid-feedback">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="col-md-12">
                                                    <label for="nama_asal_sekolah" class="form-label">Nama Asal
                                                        Sekolah</label>
                                                    <input type="text" name="nama_asal_sekolah"
                                                        class="form-control {{ $errors->has('nama_asal_sekolah') ? 'is-invalid' : '' }}"
                                                        id="nama_asal_sekolah"
                                                        value="{{ old('nama_asal_sekolah', $pendaftaranTryout?->nama_asal_sekolah) }}"
                                                        placeholder="Masukkan Nama Asal Sekolah" />
                                                    @error('nama_asal_sekolah')
                                                        <small class="invalid-feedback">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="nama_ortu" class="form-label">Nama Ortu</label>
                                                    <input type="text" name="nama_ortu"
                                                        class="form-control {{ $errors->has('nama_ortu') ? 'is-invalid' : '' }}"
                                                        id="nama_ortu"
                                                        value="{{ old('nama_ortu', $pendaftaranTryout?->nama_ortu) }}"
                                                        placeholder="Masukkan Nama Ortu" />
                                                    @error('nama_ortu')
                                                        <small class="invalid-feedback">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="no_wa_ortu" class="form-label">No Wa Ortu</label>
                                                    <input type="text" name="no_wa_ortu"
                                                        class="form-control {{ $errors->has('no_wa_ortu') ? 'is-invalid' : '' }}"
                                                        id="no_wa_ortu"
                                                        value="{{ old('no_wa_ortu', $pendaftaranTryout?->no_wa_ortu) }}"
                                                        placeholder="Masukkan No Wa Ortu" />
                                                    @error('no_wa_ortu')
                                                        <small class="invalid-feedback">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="no_wa_peserta" class="form-label">No Wa
                                                        Peserta</label>
                                                    <input type="text" name="no_wa_peserta"
                                                        class="form-control {{ $errors->has('no_wa_peserta') ? 'is-invalid' : '' }}"
                                                        id="no_wa_peserta"
                                                        value="{{ old('no_wa_peserta', $pendaftaranTryout?->no_wa_peserta) }}"
                                                        placeholder="Masukkan No Wa Peserta" />
                                                    @error('no_wa_peserta')
                                                        <small class="invalid-feedback">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="text-center col-md-12">
                                                    <x-input.confirm-button title="Lanjutkan daftar?" text=""
                                                        positive="Ya, daftar!" icon="info">
                                                        Daftar
                                                    </x-input.confirm-button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- End Contact Form -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- / Content -->

            <!-- Footer -->
            <footer class="footer" style="margin-top: 100px">
                {{-- <div class="container footer-top">
                    <div class="row gy-4">
                        <div class="col-lg-4 col-md-6 footer-about">
                            <a href="index.html" class="d-flex align-items-center">
                                <span class="sitename">Arsha</span>
                            </a>
                            <div class="pt-3 footer-contact">
                                <p>A108 Adam Street</p>
                                <p>New York, NY 535022</p>
                                <p class="mt-3">
                                    <strong>Phone:</strong> <span>+1 5589 55488 55</span>
                                </p>
                                <p><strong>Email:</strong> <span>info@example.com</span></p>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-3 footer-links">
                            <h4>Useful Links</h4>
                            <ul>
                                <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
                                <li>
                                    <i class="bi bi-chevron-right"></i> <a href="#">About us</a>
                                </li>
                                <li>
                                    <i class="bi bi-chevron-right"></i> <a href="#">Services</a>
                                </li>
                                <li>
                                    <i class="bi bi-chevron-right"></i>
                                    <a href="#">Terms of service</a>
                                </li>
                            </ul>
                        </div>

                        <div class="col-lg-2 col-md-3 footer-links">
                            <h4>Our Services</h4>
                            <ul>
                                <li>
                                    <i class="bi bi-chevron-right"></i> <a href="#">Web Design</a>
                                </li>
                                <li>
                                    <i class="bi bi-chevron-right"></i>
                                    <a href="#">Web Development</a>
                                </li>
                                <li>
                                    <i class="bi bi-chevron-right"></i>
                                    <a href="#">Product Management</a>
                                </li>
                                <li>
                                    <i class="bi bi-chevron-right"></i> <a href="#">Marketing</a>
                                </li>
                            </ul>
                        </div>

                        <div class="col-lg-4 col-md-12">
                            <h4>Follow Us</h4>
                            <p>
                                Cras fermentum odio eu feugiat lide par naso tierra videa magna
                                derita valies
                            </p>
                            <div class="social-links d-flex">
                                <a href=""><i class="bi bi-twitter-x"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div class="container mt-4 text-center copyright">
                    <p>
                        ©
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                        <a href="https://prabubimatech.com" target="_blank" class="footer-link">Team Developer
                            PrabubimaTech</a>
                    </p>
                </div>
            </footer>
            <!-- / Footer -->

            {{-- <div class="content-backdrop fade"></div> --}}
        </div>
        <!-- Content wrapper -->
        <!-- / Layout page -->

        <!-- Overlay -->

    </div>
</x-layouts.guest>
