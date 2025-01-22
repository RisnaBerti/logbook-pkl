<?php

namespace App\Http\Controllers;

use App\Models\DetailMentoring;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use \Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Woo\GridView\DataProviders\EloquentDataProvider;

class DetailMentoringController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:detail-mentoring view', only: ['index', 'show']),
            new Middleware('permission:detail-mentoring create', only: ['create', 'store']),
            new Middleware('permission:detail-mentoring edit', only: ['edit', 'update']),
            new Middleware('permission:detail-mentoring delete', only: ['destroy']),
        ];
    }

    public function index(): View
    {
        $detailMentoring = DetailMentoring::paginate(10);
        
        return view('detail-mentoring.index', compact('detailMentoring'));
    }

    public function create(): View
    {
        $detailMentoring = new DetailMentoring();

        return view('detail-mentoring.create', compact('detailMentoring'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            	'id_riwayat_mentoring' => 'required|string|max:36',
	'id_anak_pkl' => 'required|string|max:36',
	'id_mentor' => 'required|string|max:36',
	'hari_mentor' => 'nullable|integer',
        ]);

        try {
            DetailMentoring::create($validatedData);
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('detail-mentoring.index')
                ->with('error', 'Terjadi kesalahan saat membuat data.');
        }

        return redirect()->route('detail-mentoring.index')
            ->with('success', 'Detail Mentoring berhasil dibuat');
    }

    public function show($id): View
    {
        $detailMentoring = DetailMentoring::find($id);
        return view('detail-mentoring.show', compact('detailMentoring'));
    }

    public function edit($id): View
    {
        $detailMentoring = DetailMentoring::find($id);
        return view('detail-mentoring.edit', compact('detailMentoring'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $detailMentoring = DetailMentoring::find($id);
        
        $validatedData = $request->validate([
            	'id_riwayat_mentoring' => 'required|string|max:36',
	'id_anak_pkl' => 'required|string|max:36',
	'id_mentor' => 'required|string|max:36',
	'hari_mentor' => 'nullable|integer',
        ]);

        try {
            $detailMentoring->update($validatedData);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->route('detail-mentoring.index')
                    ->with('error', 'Data detail mentoring ini sudah digunakan dan tidak dapat diperbarui.');
            }
            return redirect()->route('detail-mentoring.index')
                ->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }

        return redirect()->route('detail-mentoring.index')
            ->with('success', 'Detail Mentoring berhasil diperbarui');
    }

    public function destroy($id): RedirectResponse
    {
        try {
            DetailMentoring::destroy($id);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->route('detail-mentoring.index')
                    ->with('error', 'Data detail mentoring ini sudah digunakan dan tidak dapat dihapus.');
            }
            return redirect()->route('detail-mentoring.index')
                ->with('error', 'Terjadi kesalahan saat menghapus data.');
        }

        return redirect()->route('detail-mentoring.index')
            ->with('success', 'Detail Mentoring berhasil dihapus');
    }
}