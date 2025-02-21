<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Jurnal;
use App\Models\Mentor;
use App\Models\AnakPkl;
use App\Models\DetailMentoring;
use App\Models\RiwayatMentoring;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    //funsi laporan jurnal
    public function laporanJurnal(Request $request)
    {
        // Get filter values from request
        $tanggal_awal = $request->tanggal_awal;
        $tanggal_akhir = $request->tanggal_akhir;
        $selected_anak_pkl = $request->anak_pkl;
        $selected_mentor = $request->mentor;

        // Get all mentors and anak_pkl for dropdowns
        $mentor = Mentor::pluck('nama_mentor', 'id_mentor')->toArray();
        $anak_pkl = AnakPkl::pluck('nama_anak_pkl', 'id_anak_pkl')->toArray();

        $user = auth()->user();

        // Filter data berdasarkan peran pengguna
        if ($user->hasRole('mentor')) {
            // Jika user adalah mentor
            $mentor = $user->id_mentor;

            // Start building the query
            $query = Jurnal::with(['anak_pkl', 'feedbacks', 'mentor'])->where('id_mentor', $mentor);

            // Apply filters only if they are provided
            if ($tanggal_awal && $tanggal_akhir) {
                $query->whereBetween('tanggal_jurnal', [$tanggal_awal, $tanggal_akhir]);
            }

            if ($selected_anak_pkl) {
                $query->where('id_anak_pkl', $selected_anak_pkl);
            }

            // if ($selected_mentor) {
            //     $query->where('id_mentor', $mentor);
            // }

            // Execute the query
            $data = $query->get();
        } elseif ($user->hasRole('anak-pkl')) {
            $anak_pkl = $user->id_anak_pkl;

            // Start building the query
            $query = Jurnal::with(['anak_pkl', 'feedbacks', 'mentor'])->where('id_anak_pkl', $anak_pkl);

            // Apply filters only if they are provided
            if ($tanggal_awal && $tanggal_akhir) {
                $query->whereBetween('tanggal_jurnal', [$tanggal_awal, $tanggal_akhir]);
            }

            // if ($selected_anak_pkl) {
            //     $query->where('id_anak_pkl', $anak_pkl);
            // }

            if ($selected_mentor) {
                $query->where('id_mentor', $selected_mentor);
            }

            // Execute the query
            $data = $query->get();
        } else {
            // Start building the query
            $query = Jurnal::with(['anak_pkl', 'feedbacks', 'mentor']);

            // Apply filters only if they are provided
            if ($tanggal_awal && $tanggal_akhir) {
                $query->whereBetween('tanggal_jurnal', [$tanggal_awal, $tanggal_akhir]);
            }

            if ($selected_anak_pkl) {
                $query->where('id_anak_pkl', $selected_anak_pkl);
            }

            if ($selected_mentor) {
                $query->where('id_mentor', $selected_mentor);
            }

            // Execute the query
            $data = $query->get();
        }

        // Pass the selected values back to the view for maintaining filter state
        $forms = [
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' => $tanggal_akhir,
            'anak_pkl' => $selected_anak_pkl,
            'mentor' => $selected_mentor,
        ];

        return view('laporan.laporan-jurnal', compact('data', 'mentor', 'anak_pkl', 'forms'));
    }

    //fungsi rekap jurnal
    public function rekapJurnal(Request $request)
    {
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));
        $selected_anak_pkl = $request->input('anak_pkl');
        $selected_mentor = $request->input('mentor');

        $forms = [
            'bulan' => $bulan,
            'tahun' => $tahun,
            'anak_pkl' => $selected_anak_pkl,
            'mentor' => $selected_mentor,
        ];

        $months = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        // Ambil data jurnal sekali saja
        $journalEntries = Jurnal::query()
            ->whereYear('tanggal_jurnal', $tahun)
            ->whereMonth('tanggal_jurnal', $bulan)
            ->when($selected_anak_pkl, fn($q) => $q->where('id_anak_pkl', $selected_anak_pkl))
            ->when($selected_mentor, fn($q) => $q->whereHas('anak_pkl', fn($q) => $q->where('id_mentor', $selected_mentor)))
            ->pluck('tanggal_jurnal')
            ->map(fn($date) => Carbon::parse($date)->format('Y-m-d'))
            ->flip() // Mengubah array menjadi key untuk pencarian lebih cepat
            ->toArray();

        // Siapkan data kalender
        $calendar = $this->generateCalendarData($tahun, $bulan, $journalEntries);

        $mentor = Mentor::pluck('nama_mentor', 'id_mentor')->toArray();
        $anak_pkl = AnakPkl::pluck('nama_anak_pkl', 'id_anak_pkl')->toArray();

        return view('laporan.rekap-jurnal', compact('calendar', 'mentor', 'anak_pkl', 'forms', 'months'));
    }

    private function generateCalendarData($tahun, $bulan, $journalEntries)
    {
        $firstDay = Carbon::create($tahun, $bulan, 1);
        $daysInMonth = $firstDay->daysInMonth;
        $calendar = [];

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $currentDate = Carbon::create($tahun, $bulan, $day);
            $dateString = $currentDate->format('Y-m-d');

            $calendar[$day] = [
                'date' => $day,
                'weekday' => $currentDate->dayOfWeek,
                'hasEntry' => isset($journalEntries[$dateString]),
                'isToday' => $dateString === Carbon::today()->format('Y-m-d'),
                'dateString' => $dateString
            ];
        }

        return $calendar;
    }

    //fungsi laporanMentoring
    public function laporanMentoring(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $id_mentor = $request->mentor;
        $id_sekolah = $request->sekolah;

        // Data untuk dropdown filter
        $mentor = Mentor::query()->pluck('nama_mentor', 'id_mentor')->toArray();
        $sekolah = Sekolah::query()->pluck('nama_sekolah', 'id_sekolah')->toArray();
        $daftar_bulan = [
            '1' => 'Januari',
            '2' => 'Februari',
            '3' => 'Maret',
            '4' => 'April',
            '5' => 'Mei',
            '6' => 'Juni',
            '7' => 'Juli',
            '8' => 'Agustus',
            '9' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        ];
        $daftar_tahun = range(date('Y') - 2, date('Y') + 1);

        $forms = [
            'bulan' => $bulan,
            'tahun' => $tahun,
            'mentor' => $id_mentor,
            'sekolah' => $id_sekolah,
        ];

        $query = DetailMentoring::with([
            'anak_pkl.sekolah',
            'anak_pkl.periode_pkl',
            'riwayat_mentoring.mentor'
        ]);

        if ($bulan && $tahun) {
            $query->whereHas('riwayat_mentoring', function ($q) use ($bulan, $tahun) {
                $q->whereMonth('tanggal_awal', $bulan)
                    ->whereYear('tanggal_awal', $tahun);
            });
        } elseif ($tahun) {
            $query->whereHas('riwayat_mentoring', function ($q) use ($tahun) {
                $q->whereYear('tanggal_awal', $tahun);
            });
        }

        if ($id_mentor) {
            $query->whereHas('riwayat_mentoring', function ($q) use ($id_mentor) {
                $q->where('id_mentor', $id_mentor);
            });
        }

        if ($id_sekolah) {
            $query->whereHas('anak_pkl.sekolah', function ($q) use ($id_sekolah) {
                $q->where('id_sekolah', $id_sekolah);
            });
        }

        $data = $query->get();

        return view('laporan.laporan-mentoring', compact(
            'data',
            'mentor',
            'sekolah',
            'forms',
            'daftar_bulan',
            'daftar_tahun'
        ));
    }

    //detailLaporanMentoring
    public function detailLaporanMentoring($id)
    {
        $data = RiwayatMentoring::with('anak_pkl.sekolah', 'anak_pkl.periode_pkl')->where('id_mentor', $id);

        return view('laporan.laporan-mentoring', compact('data', 'mentor', 'anak_pkl', 'forms', 'sekolah'));
    }
}
