<?php

namespace App\Http\Controllers;

use App\Models\AnakPkl;
use App\Models\Penilaian;
use Illuminate\View\View;
use App\Models\Sertifikat;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\Middleware;
use \Illuminate\Routing\Controllers\HasMiddleware;
use Woo\GridView\DataProviders\EloquentDataProvider;

class SertifikatController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:sertifikat view', only: ['index', 'show']),
            new Middleware('permission:sertifikat create', only: ['create', 'store']),
            new Middleware('permission:sertifikat edit', only: ['edit', 'update']),
            new Middleware('permission:sertifikat delete', only: ['destroy']),
        ];
    }

    public function index(): View
    {
        $user = auth()->user();
        $query = Sertifikat::with('anak_pkl.mentor');

        // Filter data berdasarkan peran pengguna
        if ($user->id_mentor) {
            // Jika user adalah mentor
            $query->whereHas('anak_pkl', function ($q) use ($user) {
                $q->where('id_mentor', $user->id_mentor);
            });
        } elseif ($user->hasRole('anak-pkl')) {
            // Jika user adalah anak PKL
            $query->where('id_anak_pkl', $user->id_anak_pkl);
        }

        // Order berdasarkan tanggal penilaian terbaru
        $sertifikat = $query->orderBy('tanggal_sertifikat', 'desc')->paginate(10);


        return view('sertifikat.index', compact('sertifikat'));
    }

    public function create(): View
    {
        $sertifikat = new Sertifikat();
        $anakPkl = AnakPkl::has('penilaian')
            ->whereDoesntHave('sertifikat') // Pastikan kolom 'sertifikat' ada di tabel AnakPkl
            ->get();

        return view('sertifikat.create', compact('sertifikat', 'anakPkl'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'id_anak_pkl' => 'required|string|max:36',
            'keterangan' => 'nullable|string|max:100', // Keterangan bisa nullable karena otomatis
            'sertifikat_depan' => 'nullable|image|mimes:pdf|max:2048',
            'sertifikat_belakang' => 'nullable|image|mimes:pdf|max:2048',
        ]);

        $validatedData['tanggal_sertifikat'] = now();

        $sertifikatDepanToStore = null;
        $sertifikatBelakangToStore = null;
        if ($request->hasFile('sertifikat_depan') && $request->hasFile('sertifikat_belakang')) {
            $sertifikatDepan = pathinfo($request->file('sertifikat_depan')->getClientOriginalName(), PATHINFO_FILENAME);
            $sertifikatBelakang = pathinfo($request->file('sertifikat_belakang')->getClientOriginalName(), PATHINFO_FILENAME);

            if ((strlen($sertifikatDepan) > 20) || (strlen($sertifikatBelakang) > 20)) {
                return back()
                    ->withInput()
                    ->with('error', 'Nama file sertifikat tidak boleh lebih dari 20 karakter.');
            }

            $extension1 = $request->file('sertifikat_depan')->getClientOriginalExtension();
            $extension2 = $request->file('sertifikat_belakang')->getClientOriginalExtension();
            $fileNameDepan = time() . '_depan.' . $extension1;
            $fileNameBelakang = time() . '_belakang.' . $extension2;

            $sertifikatDepanToStore = $request->file('sertifikat_depan')->storeAs('sertifikat', $fileNameDepan, 'public');
            $sertifikatBelakangToStore = $request->file('sertifikat_belakang')->storeAs('sertifikat', $fileNameBelakang, 'public');
        }

        try {
            // Hitung nilai rata-rata dari tabel relasi
            $nilaiRataRata = Penilaian::where('id_anak_pkl', $validatedData['id_anak_pkl'])
                ->value('nilai_rata_rata'); // Asumsikan ada kolom 'nilai' di tabel Penilaian

            // Tentukan keterangan berdasarkan nilai rata-rata
            if ($nilaiRataRata >= 90 && $nilaiRataRata <= 100) {
                $validatedData['keterangan'] = 'Sangat Baik';
            } elseif ($nilaiRataRata >= 75 && $nilaiRataRata < 90) {
                $validatedData['keterangan'] = 'Baik';
            } elseif ($nilaiRataRata >= 60 && $nilaiRataRata < 75) {
                $validatedData['keterangan'] = 'Cukup';
            } else {
                $validatedData['keterangan'] = 'Belum Memenuhi Kriteria';
            }

            // Simpan sertifikat
            Sertifikat::create(array_merge($validatedData, [
                'sertifikat_depan' => $sertifikatDepanToStore ?? null,
                'sertifikat_belakang' => $sertifikatBelakangToStore ?? null,
            ]));

            // Perbarui status anak_pkl menjadi 0
            AnakPkl::where('id_anak_pkl', $validatedData['id_anak_pkl'])->update(['status' => 0]);
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('sertifikat.index')
                ->with('error', 'Terjadi kesalahan saat membuat data.');
        }

        return redirect()->route('sertifikat.index')
            ->with('success', 'Sertifikat berhasil dibuat.');
    }


    public function show($id): View
    {
        $sertifikat = Sertifikat::find($id);
        return view('sertifikat.show', compact('sertifikat'));
    }

    public function edit($id): View
    {
        $sertifikat = Sertifikat::find($id);
        $anakPkl = AnakPkl::all();

        return view('sertifikat.edit', compact('sertifikat', 'anakPkl'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $sertifikat = Sertifikat::find($id);

        $validatedData = $request->validate([
            'id_anak_pkl' => 'required|string|max:36',
            'sertifikat_depan' => 'nullable|image|mimes:pdf|max:2048',
            'sertifikat_belakang' => 'nullable|image|mimes:pdf|max:2048',
            'keterangan' => 'required|string|max:100',
        ]);

        $sertifikatDepanToStore = null;
        $sertifikatBelakangToStore = null;
        if ($request->hasFile('sertifikat_depan') && $request->hasFile('sertifikat_belakang')) {
            $sertifikatDepan = pathinfo($request->file('sertifikat_depan')->getClientOriginalName(), PATHINFO_FILENAME);
            $sertifikatBelakang = pathinfo($request->file('sertifikat_belakang')->getClientOriginalName(), PATHINFO_FILENAME);
            if ((strlen($sertifikatDepan) > 20) && (strlen($sertifikatBelakang) > 20)) {
                return back()
                    ->withInput()
                    ->with('error', 'Nama logo tidak boleh lebih dari 20 karakter.');
            }

            if ($sertifikat->sertifikat_depan) {
                Storage::delete('public/sertifikat/' . $sertifikat->sertifikat_depan);
            }

            if ($sertifikat->sertifikat_belakang) {
                Storage::delete('public/sertifikat/' . $sertifikat->sertifikat_belakang);
            }

            $extension1 = $request->file('sertifikat_depan')->getClientOriginalExtension();
            $extension2 = $request->file('sertifikat_belakang')->getClientOriginalExtension();
            $fileNameDepan = time() . '_depan.' . $extension1;
            $fileNameBelakang = time() . '_belakang.' . $extension2;

            $request->file('sertifikat_depan')->storeAs('sertifikat', $fileNameDepan, 'public');
            $request->file('sertifikat_belakang')->storeAs('sertifikat', $fileNameBelakang, 'public');
            $sertifikatDepanToStore = $fileNameDepan;
            $sertifikatBelakangToStore = $fileNameBelakang;
        }

        try {
            $nilaiRataRata = Penilaian::where('id_anak_pkl', $validatedData['id_anak_pkl'])
                ->value('nilai_rata_rata'); // Asumsikan ada kolom 'nilai' di tabel Penilaian

            // Tentukan keterangan berdasarkan nilai rata-rata
            if ($nilaiRataRata >= 90 && $nilaiRataRata <= 100) {
                $validatedData['keterangan'] = 'Sangat Baik';
            } elseif ($nilaiRataRata >= 75 && $nilaiRataRata < 90) {
                $validatedData['keterangan'] = 'Baik';
            } elseif ($nilaiRataRata >= 60 && $nilaiRataRata < 75) {
                $validatedData['keterangan'] = 'Cukup';
            } else {
                $validatedData['keterangan'] = 'Belum Memenuhi Kriteria';
            }
            // $sertifikat->update($validatedData);
            $sertifikat->update(array_merge($validatedData, ['sertifikat_depan' => $sertifikatDepanToStore ?? $sertifikat->sertifikat_depan, 'sertifikat_belakang' => $sertifikatBelakangToStore ?? $sertifikat->sertifikat_belakang]));
            AnakPkl::where('id_anak_pkl', $validatedData['id_anak_pkl'])->update(['status' => 0]);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->route('sertifikat.index')
                    ->with('error', 'Data sertifikat ini sudah digunakan dan tidak dapat diperbarui.');
            }
            return redirect()->route('sertifikat.index')
                ->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }

        return redirect()->route('sertifikat.index')
            ->with('success', 'Sertifikat berhasil diperbarui');
    }

    public function destroy($id): RedirectResponse
    {
        try {
            $sertifikat = Sertifikat::find($id);

            // Pastikan data sertifikat ditemukan
            if (!$sertifikat) {
                return redirect()->route('sertifikat.index')
                    ->with('error', 'Sertifikat tidak ditemukan.');
            }

            // Hapus file sertifikat_depan dan sertifikat_belakang dari storage
            if ($sertifikat->sertifikat_depan) {
                Storage::disk('public')->delete('sertifikat/' . $sertifikat->sertifikat_depan);
            }
            if ($sertifikat->sertifikat_belakang) {
                Storage::disk('public')->delete('sertifikat/' . $sertifikat->sertifikat_belakang);
            }
            $sertifikat->delete();

            AnakPkl::where('id_anak_pkl', $sertifikat->id_anak_pkl)->update(['status' => 1]);
            //update 
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->route('sertifikat.index')
                    ->with('error', 'Data sertifikat ini sudah digunakan dan tidak dapat dihapus.');
            }
            return redirect()->route('sertifikat.index')
                ->with('error', 'Terjadi kesalahan saat menghapus data.');
        }

        return redirect()->route('sertifikat.index')
            ->with('success', 'Sertifikat berhasil dihapus');
    }

    //view sertifikat
    public function viewSertifikat($id)
    {
        // $sertifikat = Sertifikat::find($id);
        $sertifikat = Sertifikat::where('id_anak_pkl', $id)->first();
        return view('sertifikat.view-sertifikat', compact('sertifikat'));
    }

    //downloadSertifikat
    public function downloadSertifikat($id)
    {
        $sertifikat = Sertifikat::find($id);
        $fileName = $sertifikat->sertifikat_depan ?? $sertifikat->sertifikat_belakang ?? 'default.pdf';
        $filePath = public_path('storage/' . $fileName);
        return response()->download($filePath);
    }

    //upload
    public function upload($id): View
    {
        $sertifikat = Sertifikat::where('id_anak_pkl', $id)->first();
        $anakPkl = AnakPkl::where('id_anak_pkl', $id)->first();

        return view('sertifikat.upload', compact('sertifikat', 'anakPkl'));
    }

    public function uploadSertifikat(Request $request, $id)
    {
        // Pertama, pastikan anak PKL dengan ID tersebut ada
        $anakPkl = AnakPkl::where('id_anak_pkl', $id)->first();

        // if (!$anakPkl) {
        //     return back()->with('error', 'Data Anak PKL tidak ditemukan');
        // }

        // Cari atau buat sertifikat baru
        $sertifikat = Sertifikat::find($id);
        // $sertifikat = Sertifikat::where('id_anak_pkl', $id);
        // dd($sertifikat);

        // Generate ID sertifikat jika baru
        // if (!$sertifikat->exists) {
        //     $sertifikat->id_sertifikat = Str::ulid(); // atau method generate ID yang Anda gunakan
        // }

        $validatedData = $request->validate([
            'sertifikat_depan' => 'required|mimes:pdf|max:2048',
            'sertifikat_belakang' => 'required|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('sertifikat_depan') && $request->hasFile('sertifikat_belakang')) {
            $sertifikatDepan = pathinfo($request->file('sertifikat_depan')->getClientOriginalName(), PATHINFO_FILENAME);
            $sertifikatBelakang = pathinfo($request->file('sertifikat_belakang')->getClientOriginalName(), PATHINFO_FILENAME);

            if ((strlen($sertifikatDepan) > 20) && (strlen($sertifikatBelakang) > 20)) {
                return back()
                    ->withInput()
                    ->with('error', 'Nama file tidak boleh lebih dari 20 karakter.');
            }

            // Hapus file lama jika ada
            if ($sertifikat->sertifikat_depan) {
                Storage::delete('public/sertifikat/' . $sertifikat->sertifikat_depan);
            }
            if ($sertifikat->sertifikat_belakang) {
                Storage::delete('public/sertifikat/' . $sertifikat->sertifikat_belakang);
            }

            // Upload file baru
            $fileNameDepan = time() . '_depan.' . $request->file('sertifikat_depan')->getClientOriginalExtension();
            $fileNameBelakang = time() . '_belakang.' . $request->file('sertifikat_belakang')->getClientOriginalExtension();

            $request->file('sertifikat_depan')->storeAs('sertifikat', $fileNameDepan, 'public');
            $request->file('sertifikat_belakang')->storeAs('sertifikat', $fileNameBelakang, 'public');

            $sertifikat->sertifikat_depan = $fileNameDepan;
            $sertifikat->sertifikat_belakang = $fileNameBelakang;
        }

        // Hitung nilai dan grade
        $nilaiRataRata = Penilaian::where('id_anak_pkl', $id)->value('nilai_rata_rata') ?? 0;

        $grade = match (true) {
            $nilaiRataRata >= 90 && $nilaiRataRata <= 100 => 'Sangat Baik',
            $nilaiRataRata >= 75 && $nilaiRataRata < 90 => 'Baik',
            $nilaiRataRata >= 60 && $nilaiRataRata < 75 => 'Cukup',
            default => 'Belum Memenuhi Kriteria'
        };

        // Update sertifikat
        $sertifikat->tanggal_sertifikat = now();
        $sertifikat->keterangan = $grade;
        $sertifikat->save();

        // Update status anak PKL
        // $anakPkl->update(['status' => 0]);
        AnakPkl::where('id_anak_pkl', $id)->update(['status' => 0]);

        return redirect()->route('penilaian.index')
            ->with('success', 'Sertifikat berhasil diupload');
    }
}
