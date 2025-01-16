<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AnakPkl;
use App\Models\Sekolah;
use App\Models\PeriodePkl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function doLogin(Request $request)
    {
        $credentials = $request->validate([
            // 'email' => 'required|email',
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard')->with('success', 'Login berhasil');;
        }

        return back()->withErrors([
            'email' => 'email atau password salah',
        ])->withInput($request->only('email'));
    }

    public function register()
    {
        $periode = PeriodePkl::all();
        $sekolah = Sekolah::all();
        return view('auth.register', compact('periode', 'sekolah'));
    }

    // Proses Registrasi
    public function doRegister(Request $request)
    {
        $request->validate([
            'nama_anak_pkl' => 'required|string|max:255',
            'email_anak_pkl' => 'required|email|max:255|unique:users,email', // Validasi terhadap kolom `email` di tabel users
            'password' => 'required|string|min:6|confirmed',
            'id_sekolah' => 'required|exists:sekolah,id_sekolah', // Validasi terhadap tabel `sekolah`
            'id_periode_pkl' => 'required|exists:periode_pkl,id_periode_pkl', // Validasi terhadap tabel `periode_pkl`
            'no_telp_anak_pkl' => 'required|string|max:15|unique:anak_pkl,no_telp_anak_pkl', // Validasi terhadap tabel `anak_pkl`
        ]);

        try {
            // Hash password
            $hashedPassword = Hash::make($request->password);

            // Mulai transaksi database
            DB::beginTransaction();

            // Simpan data di tabel anak_pkl
            $anak_pkl = AnakPkl::create([
                'nama_anak_pkl' => $request->nama_anak_pkl,
                'email_anak_pkl' => $request->email_anak_pkl,
                'no_telp_anak_pkl' => $request->no_telp_anak_pkl,
                'id_sekolah' => $request->id_sekolah,
                'id_periode_pkl' => $request->id_periode_pkl,
                'status' => '1',
            ]);

            // Simpan data di tabel users
            $user = User::create([
                'name' => $request->nama_anak_pkl,
                'email' => $request->email_anak_pkl, // Pastikan menggunakan kolom `email` di tabel users
                'password' => $hashedPassword,
                'id_anak_pkl' => $anak_pkl->id_anak_pkl,
            ]);

            //hasrole anak-pkl
            $user->assignRole('anak-pkl');
            // Commit transaksi
            DB::commit();

            // Login user secara otomatis
            Auth::login($user);

            // Redirect ke dashboard dengan pesan sukses
            return redirect()->route('dashboard')->with('success', 'Registrasi berhasil');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi error
            DB::rollBack();

            // Log error untuk debugging (opsional)
            Log::error('Registrasi Error: ' . $e->getMessage());

            // Kembali dengan pesan error
            return back()->withErrors([
                'error' => 'Terjadi kesalahan saat registrasi. Silakan coba lagi atau hubungi admin.',
            ])->withInput($request->except('password'));
        }
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Anda telah logout');
    }

    // Halaman Ubah Password
    public function changePassword()
    {
        return redirect()->back()->with('error', 'Menu tidak bisa diakses');

        return view('auth.change-password');
    }

    // Proses Ubah Password
    public function doChangePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed'
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['Password saat ini salah']
            ]);
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('status', 'Password berhasil diubah');
    }

    public function profile(Request $request)
    {
        return redirect()->back()->with('error', 'Menu tidak bisa diakses');

        return view('profile', [
            'user' => $request->user()
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        return back()->with('status', 'Profil berhasil diperbarui');
    }
}
