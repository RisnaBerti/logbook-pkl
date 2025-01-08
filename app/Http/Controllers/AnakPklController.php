<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use App\Models\AnakPkl;
use App\Models\Sekolah;
use Illuminate\View\View;
use App\Models\PeriodePkl;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\Middleware;
use \Illuminate\Routing\Controllers\HasMiddleware;
use Woo\GridView\DataProviders\EloquentDataProvider;

class AnakPklController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:anak-pkl view', only: ['index', 'show']),
            new Middleware('permission:anak-pkl create', only: ['create', 'store']),
            new Middleware('permission:anak-pkl edit', only: ['edit', 'update']),
            new Middleware('permission:anak-pkl delete', only: ['destroy']),
        ];
    }

    public function index(): View
    {
        $anakPkl = AnakPkl::paginate(10);

        return view('anak-pkl.index', compact('anakPkl'));
    }

    public function create(): View
    {
        $anakPkl = new AnakPkl();
        $sekolah = Sekolah::all();
        $mentor = Mentor::all();
        $periode = PeriodePkl::all();

        return view('anak-pkl.create', compact('anakPkl', 'periode', 'sekolah', 'mentor'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'id_sekolah' => 'required|string|max:36',
            'id_periode_pkl' => 'required|string|max:36',
            'id_mentor' => 'required|string|max:36',
            'nama_anak_pkl' => 'required|string|max:100',
            'no_telp_anak_pkl' => 'required|string|max:100',
            'email_anak_pkl' => 'required|string|max:100',
            // 'foto_anak_pkl' => 'nullable|string|max:255',
            'foto_anak_pkl' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $logoNameToStore = null;

        // Handle logo upload dan validasi panjang nama file logo
        if ($request->hasFile('foto_anak_pkl')) {
            $logoName = pathinfo($request->file('foto_anak_pkl')->getClientOriginalName(), PATHINFO_FILENAME);
            if (strlen($logoName) > 50) {
                return back()
                    ->withInput()
                    ->with('error', 'Nama Foto tidak boleh lebih dari 20 karakter.');
            }
            $extension = $request->file('foto_anak_pkl')->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $logoPath = $request->file('foto_anak_pkl')->storeAs('foto/anak-pkl', $fileName, 'public');
            $logoNameToStore = $fileName;
        }

        try {
            AnakPkl::create(array_merge($validatedData, ['foto_anak_pkl' => $logoNameToStore ?? null]));
            //     AnakPkl::create($validatedData);
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('anak-pkl.index')
                ->with('error', 'Terjadi kesalahan saat membuat data.');
        }

        return redirect()->route('anak-pkl.index')
            ->with('success', 'Anak Pkl berhasil dibuat');
    }

    public function show($id): View
    {
        $anakPkl = AnakPkl::find($id);
        return view('anak-pkl.show', compact('anakPkl'));
    }

    public function edit($id): View
    {
        $anakPkl = AnakPkl::find($id);
        
        $sekolah = Sekolah::all();
        $mentor = Mentor::all();
        $periode = PeriodePkl::all();
        
        return view('anak-pkl.edit', compact('anakPkl', 'periode', 'sekolah', 'mentor'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $anakPkl = AnakPkl::find($id);

        $validatedData = $request->validate([
            'id_sekolah' => 'required|string|max:36',
            'id_periode_pkl' => 'required|string|max:36',
            'id_mentor' => 'required|string|max:36',
            'nama_anak_pkl' => 'required|string|max:100',
            'no_telp_anak_pkl' => 'required|string|max:100',
            'email_anak_pkl' => 'required|string|max:100',
            'foto_anak_pkl' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $logoNameToStore = null;
        if ($request->hasFile('foto_anak_pkl')) {
            $logoName = pathinfo($request->file('foto_anak_pkl')->getClientOriginalName(), PATHINFO_FILENAME);
            if (strlen($logoName) > 20) {
                return back()
                    ->withInput()
                    ->with('error', 'Nama logo tidak boleh lebih dari 20 karakter.');
            }

            if ($anakPkl->foto_anak_pkl) {
                Storage::delete('public/foto/anak-pkl/' . $anakPkl->foto_anak_pkl);
            }

            $extension = $request->file('foto_anak_pkl')->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $request->file('foto_anak_pkl')->storeAs('foto_anak_pkl', $fileName, 'public');
            $logoNameToStore = $fileName;
        }

        try {
            // $anakPkl->update($validatedData)
            $anakPkl->update(array_merge($validatedData, ['foto_anak_pkl' => $logoNameToStore ?? $anakPkl->foto_anak_pkl]));
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->route('anak-pkl.index')
                    ->with('error', 'Data anak pkl ini sudah digunakan dan tidak dapat diperbarui.');
            }
            return redirect()->route('anak-pkl.index')
                ->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }

        return redirect()->route('anak-pkl.index')
            ->with('success', 'Anak Pkl berhasil diperbarui');
    }

    public function destroy($id): RedirectResponse
    {
        try {
            AnakPkl::destroy($id);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->route('anak-pkl.index')
                    ->with('error', 'Data anak pkl ini sudah digunakan dan tidak dapat dihapus.');
            }
            return redirect()->route('anak-pkl.index')
                ->with('error', 'Terjadi kesalahan saat menghapus data.');
        }

        return redirect()->route('anak-pkl.index')
            ->with('success', 'Anak Pkl berhasil dihapus');
    }
}
