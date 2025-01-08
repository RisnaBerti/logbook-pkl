<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\Middleware;
use \Illuminate\Routing\Controllers\HasMiddleware;
use Woo\GridView\DataProviders\EloquentDataProvider;

class SekolahController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:sekolah view', only: ['index', 'show']),
            new Middleware('permission:sekolah create', only: ['create', 'store']),
            new Middleware('permission:sekolah edit', only: ['edit', 'update']),
            new Middleware('permission:sekolah delete', only: ['destroy']),
        ];
    }

    public function index(): View
    {
        $sekolah = Sekolah::paginate(10);

        return view('sekolah.index', compact('sekolah'));
    }

    public function create(): View
    {
        $sekolah = new Sekolah();

        return view('sekolah.create', compact('sekolah'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'nama_sekolah' => 'required|string|max:100',
            'alamat_sekolah' => 'required|string|max:150',
            'telepon_sekolah' => 'required|string|max:20',
            'email_sekolah' => 'required|string|max:50',
            // 'logo_sekolah' => 'nullable|string|max:255',
            'logo_sekolah' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|boolean',
            'keterangan' => 'required|string|max:255',
        ]);

        $logoNameToStore = null;

        // Handle logo upload dan validasi panjang nama file logo
        if ($request->hasFile('logo_sekolah')) {
            $logoName = pathinfo($request->file('logo_sekolah')->getClientOriginalName(), PATHINFO_FILENAME);
            if (strlen($logoName) > 50) {
                return back()
                    ->withInput()
                    ->with('error', 'Nama logo tidak boleh lebih dari 20 karakter.');
            }
            $extension = $request->file('logo_sekolah')->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $logoPath = $request->file('logo_sekolah')->storeAs('logos', $fileName, 'public');
            $logoNameToStore = $fileName;
        }

        try {

            Sekolah::create(array_merge($validatedData, ['logo_sekolah' => $logoNameToStore ?? null]));
            // Sekolah::create($validatedData);
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('sekolah.index')
                ->with('error', 'Terjadi kesalahan saat membuat data.');
        }

        return redirect()->route('sekolah.index')
            ->with('success', 'Sekolah berhasil dibuat');
    }

    public function show($id): View
    {
        $sekolah = Sekolah::find($id);
        return view('sekolah.show', compact('sekolah'));
    }

    public function edit($id): View
    {
        $sekolah = Sekolah::find($id);
        return view('sekolah.edit', compact('sekolah'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $sekolah = Sekolah::find($id);

        $validatedData = $request->validate([
            'nama_sekolah' => 'required|string|max:100',
            'alamat_sekolah' => 'required|string|max:150',
            'telepon_sekolah' => 'required|string|max:20',
            'email_sekolah' => 'required|string|max:50',
            // 'logo_sekolah' => 'nullable|string|max:255',
            'logo_sekolah' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|boolean',
            'keterangan' => 'required|string|max:255',
        ]);

        $logoNameToStore = null;
        if ($request->hasFile('logo_sekolah')) {
            $logoName = pathinfo($request->file('logo_sekolah')->getClientOriginalName(), PATHINFO_FILENAME);
            if (strlen($logoName) > 20) {
                return back()
                    ->withInput()
                    ->with('error', 'Nama logo tidak boleh lebih dari 20 karakter.');
            }

            if ($sekolah->logo) {
                Storage::delete('public/logos/' . $sekolah->logo_sekolah);
            }

            $extension = $request->file('logo_sekolah')->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $request->file('logo_sekolah')->storeAs('logos', $fileName, 'public');
            $logoNameToStore = $fileName;
        }

        try {
            $sekolah->update(array_merge($validatedData, ['logo_sekolah' => $logoNameToStore ?? $sekolah->logo_sekolah]));
            // $sekolah->update($validatedData);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->route('sekolah.index')
                    ->with('error', 'Data sekolah ini sudah digunakan dan tidak dapat diperbarui.');
            }
            return redirect()->route('sekolah.index')
                ->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }

        return redirect()->route('sekolah.index')
            ->with('success', 'Sekolah berhasil diperbarui');
    }

    public function destroy($id): RedirectResponse
    {
        try {
            Sekolah::destroy($id);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->route('sekolah.index')
                    ->with('error', 'Data sekolah ini sudah digunakan dan tidak dapat dihapus.');
            }
            return redirect()->route('sekolah.index')
                ->with('error', 'Terjadi kesalahan saat menghapus data.');
        }

        return redirect()->route('sekolah.index')
            ->with('success', 'Sekolah berhasil dihapus');
    }
}
