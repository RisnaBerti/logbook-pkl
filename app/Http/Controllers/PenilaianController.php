<?php

namespace App\Http\Controllers;

use App\Models\AnakPkl;
use App\Models\Keterampilan;
use App\Models\Mentor;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use \Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Woo\GridView\DataProviders\EloquentDataProvider;

class PenilaianController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:penilaian view', only: ['index', 'show']),
            new Middleware('permission:penilaian create', only: ['create', 'store']),
            new Middleware('permission:penilaian edit', only: ['edit', 'update']),
            new Middleware('permission:penilaian delete', only: ['destroy']),
        ];
    }

    public function index(): View
    {
        $penilaian = Penilaian::paginate(10);

        return view('penilaian.index', compact('penilaian'));
    }

    public function create(): View
    {
        $penilaian = new Penilaian();
        $mentors = Mentor::all();
        $anakPkl = AnakPkl::all();
        $keterampilan = Keterampilan::all();


        return view('penilaian.create', compact('penilaian', 'keterampilan', 'mentors', 'anakPkl'));
    }

    public function store(Request $request): RedirectResponse
    {        
        // dd($request->all());

        $request->validate([
            'id_mentor' => 'required|exists:mentor,id_mentor',
            'id_anak_pkl' => 'required|exists:anak_pkl,id_anak_pkl',
            'penilaian.*.id_keterampilan' => 'required|exists:keterampilan,id_keterampilan',
            'penilaian.*.nilai' => 'required|numeric|min:0|max:100',
            'penilaian.*.keterangan' => 'nullable|string|max:255',
        ]);


        try {
            // Simpan setiap penilaian dengan id_anak_pkl yang sama
            foreach ($request->penilaian as $nilai) {
                Penilaian::create([
                    'id_mentor' => $request->id_mentor,
                    'id_anak_pkl' => $request->id_anak_pkl, // Menggunakan id_anak_pkl yang sama
                    'id_keterampilan' => $nilai['id_keterampilan'],
                    'tanggal_penilaian' => now(),
                    'nilai' => $nilai['nilai'],
                    'keterangan' => $nilai['keterangan'],
                ]);
            }
            // Penilaian::create($validatedData);
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('penilaian.index')
                ->with('error', 'Terjadi kesalahan saat membuat data.');
        }

        return redirect()->route('penilaian.index')
            ->with('success', 'Penilaian berhasil dibuat');
    }

    public function show($id): View
    {
        $penilaian = Penilaian::find($id);
        return view('penilaian.show', compact('penilaian', 'keterampilan', 'mentors', 'anakPkl'));
    }

    public function edit($id): View
    {
        $penilaian = Penilaian::find($id);
        $mentors = Mentor::all();
        $anakPkl = AnakPkl::all();
        $keterampilan = Keterampilan::all();

        return view('penilaian.edit', compact('penilaian', 'keterampilan', 'mentors', 'anakPkl'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $penilaian = Penilaian::find($id);

        $validatedData = $request->validate([
            'id_anak_pkl' => 'required|string|max:36',
            'id_mentor' => 'required|string|max:36',
            'id_keterampilan' => 'required|string|max:36',
            'tanggal_penilaian' => 'required|date',
            'nilai' => 'required|integer',
            'keterangan' => 'required|string|max:255',
        ]);

        try {
            $penilaian->update($validatedData);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->route('penilaian.index')
                    ->with('error', 'Data penilaian ini sudah digunakan dan tidak dapat diperbarui.');
            }
            return redirect()->route('penilaian.index')
                ->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }

        return redirect()->route('penilaian.index')
            ->with('success', 'Penilaian berhasil diperbarui');
    }

    public function destroy($id): RedirectResponse
    {
        try {
            Penilaian::destroy($id);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->route('penilaian.index')
                    ->with('error', 'Data penilaian ini sudah digunakan dan tidak dapat dihapus.');
            }
            return redirect()->route('penilaian.index')
                ->with('error', 'Terjadi kesalahan saat menghapus data.');
        }

        return redirect()->route('penilaian.index')
            ->with('success', 'Penilaian berhasil dihapus');
    }
}
