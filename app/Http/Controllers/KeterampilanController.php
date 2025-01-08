<?php

namespace App\Http\Controllers;

use App\Models\Keterampilan;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use \Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Woo\GridView\DataProviders\EloquentDataProvider;

class KeterampilanController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:keterampilan view', only: ['index', 'show']),
            new Middleware('permission:keterampilan create', only: ['create', 'store']),
            new Middleware('permission:keterampilan edit', only: ['edit', 'update']),
            new Middleware('permission:keterampilan delete', only: ['destroy']),
        ];
    }

    public function index(): View
    {
        $keterampilan = Keterampilan::paginate(10);
        
        return view('keterampilan.index', compact('keterampilan'));
    }

    public function create(): View
    {
        $keterampilan = new Keterampilan();

        return view('keterampilan.create', compact('keterampilan'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            	'nama_keterampilan' => 'required|string|max:50',
	'deskripsi_keterampilan' => 'required|string|max:100',
        ]);

        try {
            Keterampilan::create($validatedData);
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('keterampilan.index')
                ->with('error', 'Terjadi kesalahan saat membuat data.');
        }

        return redirect()->route('keterampilan.index')
            ->with('success', 'Keterampilan berhasil dibuat');
    }

    public function show($id): View
    {
        $keterampilan = Keterampilan::find($id);
        return view('keterampilan.show', compact('keterampilan'));
    }

    public function edit($id): View
    {
        $keterampilan = Keterampilan::find($id);
        return view('keterampilan.edit', compact('keterampilan'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $keterampilan = Keterampilan::find($id);
        
        $validatedData = $request->validate([
            	'nama_keterampilan' => 'required|string|max:50',
	'deskripsi_keterampilan' => 'required|string|max:100',
        ]);

        try {
            $keterampilan->update($validatedData);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->route('keterampilan.index')
                    ->with('error', 'Data keterampilan ini sudah digunakan dan tidak dapat diperbarui.');
            }
            return redirect()->route('keterampilan.index')
                ->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }

        return redirect()->route('keterampilan.index')
            ->with('success', 'Keterampilan berhasil diperbarui');
    }

    public function destroy($id): RedirectResponse
    {
        try {
            Keterampilan::destroy($id);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->route('keterampilan.index')
                    ->with('error', 'Data keterampilan ini sudah digunakan dan tidak dapat dihapus.');
            }
            return redirect()->route('keterampilan.index')
                ->with('error', 'Terjadi kesalahan saat menghapus data.');
        }

        return redirect()->route('keterampilan.index')
            ->with('success', 'Keterampilan berhasil dihapus');
    }
}