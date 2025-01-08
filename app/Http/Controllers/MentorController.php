<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use \Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Woo\GridView\DataProviders\EloquentDataProvider;

class MentorController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:mentor view', only: ['index', 'show']),
            new Middleware('permission:mentor create', only: ['create', 'store']),
            new Middleware('permission:mentor edit', only: ['edit', 'update']),
            new Middleware('permission:mentor delete', only: ['destroy']),
        ];
    }

    public function index(): View
    {
        $mentor = mentor::paginate(10);

        return view('mentor.index', compact('mentor'));
    }

    public function create(): View
    {
        $mentor = new mentor();

        return view('mentor.create', compact('mentor'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'nama_mentor' => 'required|string|max:50',
            'email_mentor' => 'required|string|max:50',
            'alamat_mentor' => 'required|string|max:150',
            'no_telp_mentor' => 'required|string|max:15',
            'foto_mentor' => 'nullable|string|max:255',
            'ttd_mentor' => 'required|string|max:50',
        ]);

        try {
            mentor::create($validatedData);
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('mentor.index')
                ->with('error', 'Terjadi kesalahan saat membuat data.');
        }

        return redirect()->route('mentor.index')
            ->with('success', 'Mentor berhasil dibuat');
    }

    public function show($id): View
    {
        $mentor = mentor::find($id);
        return view('mentor.show', compact('mentor'));
    }

    public function edit($id): View
    {
        $mentor = mentor::find($id);
        return view('mentor.edit', compact('mentor'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $mentor = mentor::find($id);

        $validatedData = $request->validate([
            'nama_mentor' => 'required|string|max:50',
            'email_mentor' => 'required|string|max:50',
            'alamat_mentor' => 'required|string|max:150',
            'no_telp_mentor' => 'required|string|max:15',
            'foto_mentor' => 'nullable|string|max:255',
            'ttd_mentor' => 'required|string|max:50',
        ]);

        try {
            $mentor->update($validatedData);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->route('mentor.index')
                    ->with('error', 'Data mentor ini sudah digunakan dan tidak dapat diperbarui.');
            }
            return redirect()->route('mentor.index')
                ->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }

        return redirect()->route('mentor.index')
            ->with('success', 'Mentor berhasil diperbarui');
    }

    public function destroy($id): RedirectResponse
    {
        try {
            mentor::destroy($id);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->route('mentor.index')
                    ->with('error', 'Data mentor ini sudah digunakan dan tidak dapat dihapus.');
            }
            return redirect()->route('mentor.index')
                ->with('error', 'Terjadi kesalahan saat menghapus data.');
        }

        return redirect()->route('mentor.index')
            ->with('success', 'Mentor berhasil dihapus');
    }
}
