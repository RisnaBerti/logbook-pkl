<?php

use App\Http\Controllers\AnakPklController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DetailMentoringController;
use App\Http\Controllers\DetailPenilaianController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\KeterampilanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\PeriodePklController;
use App\Http\Controllers\RiwayatMentoringController;
use App\Http\Controllers\RoleAndPermissionController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\UserController;
use App\Models\Sertifikat;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'doLogin']);

    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'doRegister']);

    Route::get('/', [AuthController::class, 'login'])->name('landing');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('/profile', [AuthController::class, 'updateProfile']);

    Route::get('/change-password', [AuthController::class, 'changePassword'])->name('change-password');
    Route::post('/change-password', [AuthController::class, 'doChangePassword']);

    // user manajemen
    Route::get('/permissions/refresh', [RoleAndPermissionController::class, 'refreshPermission'])->name('permissions.refresh');
    Route::resource('roles', RoleAndPermissionController::class);
    Route::resource('users', UserController::class);
    Route::resource('mentor', MentorController::class);
    Route::resource('anak-pkl', AnakPklController::class);
    Route::resource('keterampilan', KeterampilanController::class);
    Route::resource('sekolah', SekolahController::class);
    Route::resource('penilaian', PenilaianController::class);
    Route::resource('detail-penilaian', DetailPenilaianController::class);
    Route::resource('periode-pkl', PeriodePklController::class);
    Route::resource('feedback', FeedbackController::class);
    Route::resource('sertifikat', SertifikatController::class);
    Route::resource('jurnal', JurnalController::class);
    Route::resource('riwayat-mentoring', RiwayatMentoringController::class);
    Route::resource('detail-mentoring', DetailMentoringController::class);

    Route::post('/jurnal/{jurnal}/feedback', [JurnalController::class, 'addFeedback'])->name('jurnal.add-feedback');
    Route::delete('/jurnal-feedback/{feedback}', [JurnalController::class, 'deleteFeedback'])->name('jurnal.delete-feedback');

    Route::get('/sertifikat/view-sertifikat/{id}', [SertifikatController::class, 'viewSertifikat'])->name('sertifikat.view-sertifikat');
    Route::get('/sertifikat/download/{id}', [SertifikatController::class, 'downloadSertifikat'])->name('sertifikat.download');

    Route::get('/penilain/view-sertifikat/{id}', [PenilaianController::class, 'viewSertifikat'])->name('penilaian.view-sertifikat');
    Route::get('/laporan/jurnal', [LaporanController::class, 'laporanJurnal'])->name('laporan.jurnal');
    Route::get('/rekap/jurnal', [LaporanController::class, 'rekapJurnal'])->name('rekap.jurnal');
    Route::get('/laporan/mentoring', [LaporanController::class, 'laporanMentoring'])->name('laporan.mentoring');
});
