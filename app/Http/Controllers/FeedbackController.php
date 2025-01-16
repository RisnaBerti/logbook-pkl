<?php

namespace App\Http\Controllers;

use App\Models\AnakPkl;
use App\Models\Feedback;
use App\Models\Jurnal;
use App\Models\Mentor;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use \Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Woo\GridView\DataProviders\EloquentDataProvider;

class FeedbackController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:feedback view', only: ['index', 'show']),
            new Middleware('permission:feedback create', only: ['create', 'store']),
            new Middleware('permission:feedback edit', only: ['edit', 'update']),
            new Middleware('permission:feedback delete', only: ['destroy']),
        ];
    }

    public function index(): View
    {
        $user = auth()->user();

        // Base query with relationships
        $query = Feedback::with('mentor');

        if ($user->id_mentor) {
            $query->where('id_mentor', $user->id_mentor);
        } else if ($user->hasRole('Admin')) {
            $feedback = Feedback::paginate(10);
        } else if ($user->hasRole('anak-pkl')) {
            $query->where('id_anak_pkl', $user->id_anak_pkl);
        }

        // Order by latest journal date
        $feedback = $query->orderBy('tanggal_feedback', 'desc')
            ->paginate(10);


        return view('feedback.index', compact('feedback'));
    }

    // public function index(): View
    // {
    //     $feedback = Feedback::paginate(10);

    //     return view('feedback.index', compact('feedback'));
    // }

    public function create(): View
    {
        $feedback = new Feedback();
        $mentor = Mentor::all();
        $jurnal = Jurnal::all();
        $anak_pkl = AnakPkl::all();

        return view('feedback.create', compact('feedback', 'mentor', 'jurnal', 'anak_pkl'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'id_anak_pkl' => 'required|string|max:36',
            'id_mentor' => 'required|string|max:36',
            'id_jurnal' => 'required|string|max:36',
            'tanggal_feedback' => 'required|date',
            'isi_feedback' => 'required|string|max:255',
        ]);

        try {
            Feedback::create($validatedData);
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('feedback.index')
                ->with('error', 'Terjadi kesalahan saat membuat data.');
        }

        return redirect()->route('feedback.index')
            ->with('success', 'Feedback berhasil dibuat');
    }

    public function show($id): View
    {
        $feedback = Feedback::find($id);
        return view('feedback.show', compact('feedback'));
    }

    public function edit($id): View
    {
        $feedback = Feedback::find($id);
        $mentor = Mentor::all();
        $jurnal = Jurnal::all();
        $anak_pkl = AnakPkl::all();

        return view('feedback.edit', compact('feedback', 'mentor', 'jurnal', 'anak_pkl'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $feedback = Feedback::find($id);

        $validatedData = $request->validate([
            'id_anak_pkl' => 'required|string|max:36',
            'id_mentor' => 'required|string|max:36',
            'id_jurnal' => 'required|string|max:36',
            'tanggal_feedback' => 'required|date',
            'isi_feedback' => 'required|string|max:255',
        ]);

        try {
            $feedback->update($validatedData);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->route('feedback.index')
                    ->with('error', 'Data feedback ini sudah digunakan dan tidak dapat diperbarui.');
            }
            return redirect()->route('feedback.index')
                ->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }

        return redirect()->route('feedback.index')
            ->with('success', 'Feedback berhasil diperbarui');
    }

    public function destroy($id): RedirectResponse
    {
        try {
            Feedback::destroy($id);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->route('jurnal.index')
                    ->with('error', 'Data feedback ini sudah digunakan dan tidak dapat dihapus.');
            }
            return redirect()->route('jurnal.index')
                ->with('error', 'Terjadi kesalahan saat menghapus data.');
        }

        return redirect()->route('jurnal.index')
            ->with('success', 'Feedback berhasil dihapus');
    }
}
