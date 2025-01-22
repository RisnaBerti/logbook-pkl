<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use App\Models\AnakPkl;
use App\Models\Penilaian;
use Illuminate\View\View;
use App\Models\Sertifikat;
use App\Models\Keterampilan;
use Illuminate\Http\Request;
use App\Models\DetailPenilaian;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\Middleware;
use \Illuminate\Routing\Controllers\HasMiddleware;
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
        $user = auth()->user();
        $query = Penilaian::with('detail');

        // Filter data berdasarkan peran pengguna
        if ($user->id_mentor) {
            // Jika user adalah mentor
            $query->where('id_mentor', $user->id_mentor);
        } elseif ($user->hasRole('anak-pkl')) {
            // Jika user adalah anak PKL
            $query->where('id_anak_pkl', $user->id_anak_pkl);
        }

        // Order berdasarkan tanggal penilaian terbaru
        $penilaian = $query->orderBy('tanggal_penilaian', 'desc')->paginate(10);

        return view('penilaian.index', compact('penilaian'));
    }

    public function create(): View
    {
        $penilaian = new Penilaian();
        $mentors = Mentor::all();
        $anakPkl = AnakPkl::doesntHave('penilaian')->get();
        $keterampilan = Keterampilan::all();


        return view('penilaian.create', compact('penilaian', 'keterampilan', 'mentors', 'anakPkl'));
    }

    public function store(Request $request): RedirectResponse
    {
        // dd($request->all());

        $request->validate([
            'id_mentor' => 'required|exists:mentor,id_mentor',
            'id_anak_pkl' => 'required|exists:anak_pkl,id_anak_pkl',
            'detail_penilaian' => 'required|array|min:1',
            'detail_penilaian.*.id_keterampilan' => 'required|exists:keterampilan,id_keterampilan',
            'detail_penilaian.*.nilai' => 'required|numeric|min:0|max:100',
        ]);

        try {
            // Hitung total dan rata-rata
            $totalNilai = 0;
            $jumlahNilai = count($request->detail_penilaian);

            foreach ($request->detail_penilaian as $detail) {
                $totalNilai += $detail['nilai'];
            }
            $rataRata = $totalNilai / $jumlahNilai;

            //jika nilai rata rata
            if ($rataRata >= 90 && $rataRata <= 100) {
                $grade = 'Sangat Baik';
            } elseif ($rataRata >= 75 && $rataRata < 90) {
                $grade = 'Baik';
            } elseif ($rataRata >= 60 && $rataRata < 75) {
                $grade = 'Cukup';
            } else {
                $grade = 'Belum Memenuhi Kriteria';
            }

            // Simpan data penilaian
            $penilaian = new Penilaian();
            $penilaian->id_mentor = $request->id_mentor;
            $penilaian->id_anak_pkl = $request->id_anak_pkl;
            $penilaian->tanggal_penilaian = now();
            $penilaian->nilai_rata_rata = $rataRata;
            $penilaian->grade = $grade;
            $penilaian->save();
            // dd('sampe sini ga');

            // Simpan detail penilaian
            foreach ($request->detail_penilaian as $detail) {
                DetailPenilaian::create([
                    'id_penilaian' => $penilaian->id_penilaian,
                    'id_keterampilan' => $detail['id_keterampilan'],
                    'nilai' => $detail['nilai']
                ]);
            }
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
        // $penilaian = Penilaian::find($id);
        $penilaian = Penilaian::with('detail')->findOrFail($id);
        $mentors = Mentor::all();
        $anakPkl = AnakPkl::all();
        $keterampilan = Keterampilan::all();

        // Ambil semua penilaian terkait mentor dan anak PKL ini
        $penilaianDetails = Penilaian::where('id_mentor', $penilaian->id_mentor)
            ->where('id_anak_pkl', $penilaian->id_anak_pkl)
            ->get();

        return view('penilaian.edit', compact('penilaian', 'penilaianDetails', 'keterampilan', 'mentors', 'anakPkl'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        // dd($request->all());
        $penilaian = Penilaian::find($id);

        $request->validate([
            'id_mentor' => 'required|exists:mentor,id_mentor',
            'id_anak_pkl' => 'required|exists:anak_pkl,id_anak_pkl',
            'detail_penilaian' => 'required|array|min:1',
            'detail_penilaian.*.id_keterampilan' => 'required|exists:keterampilan,id_keterampilan',
            'detail_penilaian.*.nilai' => 'required|numeric|min:0|max:100',
        ]);

        try {
            // Hitung total dan rata-rata
            $totalNilai = array_sum(array_column($request->detail_penilaian, 'nilai'));
            $jumlahNilai = count($request->detail_penilaian);
            $rataRata = $totalNilai / $jumlahNilai;

            if ($rataRata >= 90 && $rataRata <= 100) {
                $grade = 'Sangat Baik';
            } elseif ($rataRata >= 75 && $rataRata < 90) {
                $grade = 'Baik';
            } elseif ($rataRata >= 60 && $rataRata < 75) {
                $grade = 'Cukup';
            } else {
                $grade = 'Belum Memenuhi Kriteria';
            }
            // dd($grade);

            // Perbarui data penilaian
            $penilaian->id_mentor = $request->id_mentor;
            $penilaian->id_anak_pkl = $request->id_anak_pkl;
            $penilaian->tanggal_penilaian = $request->tanggal_penilaian; // Gunakan key yang benar
            $penilaian->nilai_rata_rata = $rataRata;
            $penilaian->grade = $grade;
            $penilaian->save();

            // Perbarui detail penilaian
            // Hapus detail lama
            DetailPenilaian::where('id_penilaian', $penilaian->id_penilaian)->delete();

            // Simpan detail baru
            foreach ($request->detail_penilaian as $detail) {
                DetailPenilaian::create([
                    'id_penilaian' => $penilaian->id_penilaian,
                    'id_keterampilan' => $detail['id_keterampilan'],
                    'nilai' => $detail['nilai'],
                ]);
            }

            // $penilaian->update($validatedData);
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
            // Hapus detail penilaian
            DetailPenilaian::where('id_penilaian', $id)->delete();

            // Hapus penilaian
            $penilaian = Penilaian::findOrFail($id);
            $penilaian->delete();

            // Berhasil menghapus
            return redirect()->route('penilaian.index')
                ->with('success', 'Data penilaian berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == '23000') {
                // Data terpakai
                return redirect()->route('penilaian.index')
                    ->with('error', 'Data penilaian ini sudah digunakan dan tidak dapat dihapus.');
            }

            // Kesalahan umum
            return redirect()->route('penilaian.index')
                ->with('error', 'Terjadi kesalahan saat menghapus data.');
        }

        // Tambahkan return default jika semua blok gagal
        return redirect()->route('penilaian.index')
            ->with('error', 'Terjadi kesalahan yang tidak diketahui.');
    }

    public function viewSertifikat($id)
    {
        $sertifikat = Sertifikat::where('id_anak_pkl', $id)->first();

        return view('sertifikat.view-sertifikat', compact('sertifikat'));
    }
}
