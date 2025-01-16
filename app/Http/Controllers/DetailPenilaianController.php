<?php

namespace App\Http\Controllers;

use App\Models\DetailPenilaian;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use \Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Woo\GridView\DataProviders\EloquentDataProvider;

class DetailPenilaianController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:detail-penilaian view', only: ['index', 'show']),
            new Middleware('permission:detail-penilaian create', only: ['create', 'store']),
            new Middleware('permission:detail-penilaian edit', only: ['edit', 'update']),
            new Middleware('permission:detail-penilaian delete', only: ['destroy']),
        ];
    }

    public function index(): View
    {
        $detailPenilaian = DetailPenilaian::paginate(10);

        return view('detail-penilaian.index', compact('detailPenilaian'));
    }

    public function create(): View
    {
        $detailPenilaian = new DetailPenilaian();

        return view('detail-penilaian.create', compact('detailPenilaian'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'id_penilaian' => 'required|string|max:36',
            'id_keterampilan' => 'required|string|max:36',
            'nilai' => 'required|numeric',
        ]);

        try {
            DetailPenilaian::create($validatedData);
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('detail-penilaian.index')
                ->with('error', 'Terjadi kesalahan saat membuat data.');
        }

        return redirect()->route('detail-penilaian.index')
            ->with('success', 'Detail Penilaian berhasil dibuat');
    }

    public function show($id): View
    {
        $detailPenilaian = DetailPenilaian::find($id);
        return view('detail-penilaian.show', compact('detailPenilaian'));
    }

    public function edit($id): View
    {
        $detailPenilaian = DetailPenilaian::find($id);
        return view('detail-penilaian.edit', compact('detailPenilaian'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $detailPenilaian = DetailPenilaian::find($id);

        $validatedData = $request->validate([
            'id_penilaian' => 'required|string|max:36',
            'id_keterampilan' => 'required|string|max:36',
            'nilai' => 'required|numeric',
        ]);

        try {
            $detailPenilaian->update($validatedData);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->route('detail-penilaian.index')
                    ->with('error', 'Data detail penilaian ini sudah digunakan dan tidak dapat diperbarui.');
            }
            return redirect()->route('detail-penilaian.index')
                ->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }

        return redirect()->route('detail-penilaian.index')
            ->with('success', 'Detail Penilaian berhasil diperbarui');
    }

    // public function destroy($id): RedirectResponse
    // {
    //     try {
    //         DetailPenilaian::destroy($id);
    //     } catch (\Illuminate\Database\QueryException $e) {
    //         if ($e->getCode() == '23000') {
    //             return redirect()->route('detail-penilaian.index')
    //                 ->with('error', 'Data detail penilaian ini sudah digunakan dan tidak dapat dihapus.');
    //         }
    //         return redirect()->route('detail-penilaian.index')
    //             ->with('error', 'Terjadi kesalahan saat menghapus data.');
    //     }

    //     return redirect()->route('detail-penilaian.index')
    //         ->with('success', 'Detail Penilaian berhasil dihapus');
    // }

    public function destroy($id)  // Ubah return type ke JsonResponse
    {
        // dd($id);
        try {
            $penilaian = DetailPenilaian::findOrFail($id);
            $penilaian->delete();

            // Return JSON response karena ini adalah AJAX request
            return response()->json([
                'success' => true,
                'message' => 'Penilaian berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus data'
            ], 500);
        }
    }
}
