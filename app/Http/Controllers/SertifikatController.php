<?php

namespace App\Http\Controllers;

use App\Models\Sertifikat;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use \Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
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
        $sertifikat = Sertifikat::paginate(10);
        
        return view('sertifikat.index', compact('sertifikat'));
    }

    public function create(): View
    {
        $sertifikat = new Sertifikat();

        return view('sertifikat.create', compact('sertifikat'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            	'id_anak_pkl' => 'required|string|max:36',
	'judul_sertifikat' => 'required|string|max:255',
	'nama_pengesah' => 'required|string|max:255',
	'tanggal_sertifikat' => 'required|date',
	'keterangan' => 'required|string|max:100',
        ]);

        try {
            Sertifikat::create($validatedData);
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('sertifikat.index')
                ->with('error', 'Terjadi kesalahan saat membuat data.');
        }

        return redirect()->route('sertifikat.index')
            ->with('success', 'Sertifikat berhasil dibuat');
    }

    public function show($id): View
    {
        $sertifikat = Sertifikat::find($id);
        return view('sertifikat.show', compact('sertifikat'));
    }

    public function edit($id): View
    {
        $sertifikat = Sertifikat::find($id);
        return view('sertifikat.edit', compact('sertifikat'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $sertifikat = Sertifikat::find($id);
        
        $validatedData = $request->validate([
            	'id_anak_pkl' => 'required|string|max:36',
	'judul_sertifikat' => 'required|string|max:255',
	'nama_pengesah' => 'required|string|max:255',
	'tanggal_sertifikat' => 'required|date',
	'keterangan' => 'required|string|max:100',
        ]);

        try {
            $sertifikat->update($validatedData);
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
            Sertifikat::destroy($id);
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
}