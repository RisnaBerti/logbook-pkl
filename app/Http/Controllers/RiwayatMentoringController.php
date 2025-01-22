<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Mentor;
use App\Models\AnakPkl;
use App\Models\DetailMentoring;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\RiwayatMentoring;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\Middleware;
use \Illuminate\Routing\Controllers\HasMiddleware;
use Woo\GridView\DataProviders\EloquentDataProvider;

class RiwayatMentoringController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:riwayat-mentoring view', only: ['index', 'show']),
            new Middleware('permission:riwayat-mentoring create', only: ['create', 'store']),
            new Middleware('permission:riwayat-mentoring edit', only: ['edit', 'update']),
            new Middleware('permission:riwayat-mentoring delete', only: ['destroy']),
        ];
    }

    public function index(): View
    {
        $riwayatMentoring = RiwayatMentoring::paginate(10);

        $user = auth()->user();
        $query = RiwayatMentoring::with('detail_mentoring');

        // // Filter data berdasarkan peran pengguna
        // if ($user->id_mentor) {
        //     // Jika user adalah mentor
        //     $query->where('id_mentor', $user->id_mentor);
        // } elseif ($user->hasRole('anak-pkl')) {
        //     // Jika user adalah anak PKL
        //     $query->where('id_anak_pkl', $user->id_anak_pkl);
        // }

        // Order berdasarkan tanggal penilaian terbaru
        $riwayatMentoring = $query->paginate(10);

        return view('riwayat-mentoring.index', compact('riwayatMentoring'));
    }

    public function create(): View
    {
        $riwayatMentoring = new RiwayatMentoring();
        $anakPkl = AnakPkl::all();
        $mentors = Mentor::all();

        return view('riwayat-mentoring.create', compact('riwayatMentoring', 'anakPkl', 'mentors'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'id_mentor' => 'required|string|max:36',
            'tanggal_mulai' => 'required|date',
            'tanggal_akhir' => 'required|date',
            'detail_mentoring' => 'required|array|min:1',
            'detail_mentoring.*.id_anak_pkl' => 'required|exists:anak_pkl,id_anak_pkl',
        ]);

        // Hitung selisih hari antara tanggal mulai dan akhir
        $tanggalMulai = Carbon::parse($request->tanggal_mulai);
        $tanggalAkhir = Carbon::parse($request->tanggal_akhir);
        $hariMentor = round(abs($tanggalAkhir->diffInDays($tanggalMulai)) + 1);

        // Tambahkan hari_mentor ke validated data
        $validatedData['hari_mentor'] = $hariMentor;

        try {
            $mentoring = new RiwayatMentoring();
            $mentoring->id_mentor = $request->id_mentor;
            $mentoring->tanggal_mulai = $request->tanggal_mulai;
            $mentoring->tanggal_akhir = $request->tanggal_akhir;
            $mentoring->save();

            // Simpan detail mentoring
            foreach ($request->detail_mentoring as $detail) {
                DetailMentoring::create([
                    'id_riwayat_mentoring' => $mentoring->id_riwayat_mentoring,
                    'id_anak_pkl' => $detail['id_anak_pkl'],
                    'hari_mentor' => $hariMentor,
                ]);
            }



            // RiwayatMentoring::create($validatedData);
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('riwayat-mentoring.index')
                ->with('error', 'Terjadi kesalahan saat membuat data.');
        }

        return redirect()->route('riwayat-mentoring.index')
            ->with('success', 'Riwayat Mentoring berhasil dibuat');
    }

    public function show($id): View
    {
        $riwayatMentoring = RiwayatMentoring::find($id);
        return view('riwayat-mentoring.show', compact('riwayatMentoring'));
    }

    public function edit($id): View
    {
        $riwayatMentoring = RiwayatMentoring::find($id);
        $anakPkl = AnakPkl::all();
        $mentors = Mentor::all();
        
        return view('riwayat-mentoring.edit', compact('riwayatMentoring', 'anakPkl', 'mentors'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $riwayatMentoring = RiwayatMentoring::find($id);

        $request->validate([
            'id_mentor' => 'required|exists:mentor,id_mentor',
            'tanggal_mulai' => 'required|date',
            'tanggal_akhir' => 'required|date',
            'detail_mentoring' => 'required|array|min:1',
            'detail_mentoring.*.id_anak_pkl' => 'required|exists:anak_pkl,id_anak_pkl',
            // 'detail_mentoring.*.id_riwayat_mentoring' => 'required|exists:riwayat_mentoring,id_riwayat_mentoring',
            // 'detail_mentoring.*.hari_mentor' => 'required|numeric|min:0|max:100',
        ]);

        try {
            // // Hitung total hari_mentor
            // Hitung selisih hari antara tanggal mulai dan akhir
            $tanggalMulai = Carbon::parse($request->tanggal_mulai);
            $tanggalAkhir = Carbon::parse($request->tanggal_akhir);
            $hariMentor = round(abs($tanggalAkhir->diffInDays($tanggalMulai)) + 1);


            // Perbarui data penilaian
            $riwayatMentoring->id_mentor = $request->id_mentor;
            $riwayatMentoring->tanggal_mulai = $request->tanggal_mulai; // Gunakan key yang benar
            $riwayatMentoring->tanggal_akhir = $request->tanggal_akhir; // Gunakan key yang benar
            $riwayatMentoring->save();

            // Perbarui detail riwayatMentoring
            // Hapus detail lama
            DetailMentoring::where('id_riwayat_mentoring', $riwayatMentoring->id_riwayat_mentoring)->delete();

            // Simpan detail baru
            foreach ($request->detail_mentoring as $detail) {
                DetailMentoring::create([
                    'id_riwayat_mentoring' => $riwayatMentoring->id_riwayat_mentoring,
                    'hari_mentor' => $hariMentor,
                    'id_anak_pkl' => $detail['id_anak_pkl'],
                ]);
            }
            // $riwayatMentoring->update($validatedData);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->route('riwayat-mentoring.index')
                    ->with('error', 'Data riwayat mentoring ini sudah digunakan dan tidak dapat diperbarui.');
            }
            return redirect()->route('riwayat-mentoring.index')
                ->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }

        return redirect()->route('riwayat-mentoring.index')
            ->with('success', 'Riwayat Mentoring berhasil diperbarui');
    }

    public function destroy($id): RedirectResponse
    {
        try {
            RiwayatMentoring::destroy($id);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->route('riwayat-mentoring.index')
                    ->with('error', 'Data riwayat mentoring ini sudah digunakan dan tidak dapat dihapus.');
            }
            return redirect()->route('riwayat-mentoring.index')
                ->with('error', 'Terjadi kesalahan saat menghapus data.');
        }

        return redirect()->route('riwayat-mentoring.index')
            ->with('success', 'Riwayat Mentoring berhasil dihapus');
    }
}
