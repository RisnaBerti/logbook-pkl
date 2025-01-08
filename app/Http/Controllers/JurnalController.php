<?php

namespace App\Http\Controllers;

use App\Models\AnakPkl;
use App\Models\Jurnal;
use App\Models\Mentor;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use \Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Woo\GridView\DataProviders\EloquentDataProvider;

class JurnalController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:jurnal view', only: ['index', 'show']),
            new Middleware('permission:jurnal create', only: ['create', 'store']),
            new Middleware('permission:jurnal edit', only: ['edit', 'update']),
            new Middleware('permission:jurnal delete', only: ['destroy']),
        ];
    }

    public function index(): View
    {
        $jurnal = Jurnal::paginate(10);

        return view('jurnal.index', compact('jurnal'));
    }

    public function create(): View
    {
        $jurnal = new Jurnal();
        $mentor = Mentor::all();
        $anak_pkl = AnakPkl::all();

        return view('jurnal.create', compact('jurnal', 'anak_pkl', 'mentor'));
    }

    public function store(Request $request): RedirectResponse
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'id_anak_pkl' => 'required|string|max:36',
            'id_mentor' => 'required|string|max:36',
            'aktifitas' => 'required|string|max:255',
            'tanggal_jurnal' => 'required|date',
            'waktu_mulai_aktifitas' => 'required',
            'waktu_selesai_aktifitas' => 'required',
            'durasi' => 'required|integer|min:0',
            'keterangan' => 'nullable|string|max:255'
        ]);

        // Validasi tambahan untuk waktu
        $waktuMulai = strtotime($request->waktu_mulai_aktifitas);
        $waktuSelesai = strtotime($request->waktu_selesai_aktifitas);

        if ($waktuSelesai < $waktuMulai) {
            return back()
                ->withInput()
                ->withErrors(['waktu_selesai_aktifitas' => 'Waktu selesai tidak boleh lebih kecil dari waktu mulai']);
        }

        // Pastikan durasi sesuai dengan selisih waktu
        $durasiHitung = $waktuSelesai - $waktuMulai;
        if ($durasiHitung != $request->durasi) {
            return back()
                ->withInput()
                ->withErrors(['durasi' => 'Durasi tidak sesuai dengan selisih waktu']);
        }

        try {
            Jurnal::create($validatedData);
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('jurnal.index')
                ->with('error', 'Terjadi kesalahan saat membuat data.');
        }

        return redirect()->route('jurnal.index')
            ->with('success', 'Jurnal berhasil dibuat');
    }

    public function show($id): View
    {
        $jurnal = Jurnal::find($id);
        return view('jurnal.show', compact('jurnal'));
    }

    public function edit($id): View
    {
        $jurnal = Jurnal::find($id);
        $mentor = Mentor::all();
        $anak_pkl = AnakPkl::all();

        return view('jurnal.edit', compact('jurnal', 'anak_pkl', 'mentor'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $jurnal = Jurnal::find($id);

        $validatedData = $request->validate([
            'id_anak_pkl' => 'required|string|max:36',
            'id_mentor' => 'required|string|max:36',
            'aktifitas' => 'required|string|max:255',
            'tanggal_jurnal' => 'required|date',
            'waktu_mulai_aktifitas' => 'required',
            'waktu_selesai_aktifitas' => 'required',
            'durasi' => 'required|integer|min:0',
            'keterangan' => 'required|string|max:255',
        ]);

        // Validasi tambahan untuk waktu
        $waktuMulai = strtotime($request->waktu_mulai_aktifitas);
        $waktuSelesai = strtotime($request->waktu_selesai_aktifitas);

        if ($waktuSelesai < $waktuMulai) {
            return back()
                ->withInput()
                ->withErrors(['waktu_selesai_aktifitas' => 'Waktu selesai tidak boleh lebih kecil dari waktu mulai']);
        }

        // Pastikan durasi sesuai dengan selisih waktu
        $durasiHitung = $waktuSelesai - $waktuMulai;
        if ($durasiHitung != $request->durasi) {
            return back()
                ->withInput()
                ->withErrors(['durasi' => 'Durasi tidak sesuai dengan selisih waktu']);
        }

        try {
            $jurnal->update($validatedData);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->route('jurnal.index')
                    ->with('error', 'Data jurnal ini sudah digunakan dan tidak dapat diperbarui.');
            }
            return redirect()->route('jurnal.index')
                ->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }

        return redirect()->route('jurnal.index')
            ->with('success', 'Jurnal berhasil diperbarui');
    }

    public function destroy($id): RedirectResponse
    {
        try {
            Jurnal::destroy($id);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->route('jurnal.index')
                    ->with('error', 'Data jurnal ini sudah digunakan dan tidak dapat dihapus.');
            }
            return redirect()->route('jurnal.index')
                ->with('error', 'Terjadi kesalahan saat menghapus data.');
        }

        return redirect()->route('jurnal.index')
            ->with('success', 'Jurnal berhasil dihapus');
    }
}
