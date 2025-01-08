<?php

namespace App\Http\Controllers;

use App\Models\PeriodePkl;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use \Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Woo\GridView\DataProviders\EloquentDataProvider;

class PeriodePklController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:periode-pkl view', only: ['index', 'show']),
            new Middleware('permission:periode-pkl create', only: ['create', 'store']),
            new Middleware('permission:periode-pkl edit', only: ['edit', 'update']),
            new Middleware('permission:periode-pkl delete', only: ['destroy']),
        ];
    }

    public function index(): View
    {
        $periodePkl = PeriodePkl::paginate(10);

        return view('periode-pkl.index', compact('periodePkl'));
    }

    public function create(): View
    {
        $periodePkl = new PeriodePkl();

        return view('periode-pkl.create', compact('periodePkl'))->with('sekolah', Sekolah::all());
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'id_sekolah' => 'required|string|max:36',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'durasi_bulan' => 'required|integer',
            'keterangan' => 'required|string|max:255',
        ]);

        try {
            PeriodePkl::create($validatedData);
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('periode-pkl.index')
                ->with('error', 'Terjadi kesalahan saat membuat data.');
        }

        return redirect()->route('periode-pkl.index')
            ->with('success', 'Periode Pkl berhasil dibuat');
    }

    public function show($id): View
    {
        $periodePkl = PeriodePkl::find($id);
        return view('periode-pkl.show', compact('periodePkl'));
    }

    public function edit($id): View
    {
        $periodePkl = PeriodePkl::find($id);
        return view('periode-pkl.edit', compact('periodePkl'))->with('sekolah', Sekolah::all());
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $periodePkl = PeriodePkl::find($id);

        $validatedData = $request->validate([
            'id_sekolah' => 'required|string|max:36',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'durasi_bulan' => 'required|integer',
            'keterangan' => 'required|string|max:255',
        ]);

        try {
            $periodePkl->update($validatedData);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->route('periode-pkl.index')
                    ->with('error', 'Data periode pkl ini sudah digunakan dan tidak dapat diperbarui.');
            }
            return redirect()->route('periode-pkl.index')
                ->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }

        return redirect()->route('periode-pkl.index')
            ->with('success', 'Periode Pkl berhasil diperbarui');
    }

    public function destroy($id): RedirectResponse
    {
        try {
            PeriodePkl::destroy($id);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->route('periode-pkl.index')
                    ->with('error', 'Data periode pkl ini sudah digunakan dan tidak dapat dihapus.');
            }
            return redirect()->route('periode-pkl.index')
                ->with('error', 'Terjadi kesalahan saat menghapus data.');
        }

        return redirect()->route('periode-pkl.index')
            ->with('success', 'Periode Pkl berhasil dihapus');
    }
}
