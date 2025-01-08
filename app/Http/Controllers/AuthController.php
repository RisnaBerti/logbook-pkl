<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
        return view('auth.register');
    }

    // Proses Registrasi
    public function doRegister(Request $request)
    {

        // echo '<pre>';
        // print_r($request->all());
        // echo '</pre>';
        // die;
        // 'email' => 'required|string|email|max:255|unique:users',
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ]);


        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password'])
        ]);

        if (!$user) {
            return back()->withErrors([
                'email' => 'Error hubungi admin.',
            ])->withInput($request->only(['email', 'name']));
        }

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Registrasi berhasil');
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
