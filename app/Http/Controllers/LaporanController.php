<?php

namespace App\Http\Controllers;

use App\Models\AnakPkl;
use App\Models\Jurnal;
use App\Models\Mentor;
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

        $user = auth()->user();

        // Filter data berdasarkan peran pengguna
        if ($user->hasRole('mentor')) {
            // Jika user adalah mentor
            $mentor = Auth()->user->id_mentor;
        } elseif ($user->hasRole('anak-pkl')) {
            $anak_pkl = Auth()->user->id_anak_pkl;
        } 

        // Get all mentors and anak_pkl for dropdowns
        $mentor = Mentor::pluck('nama_mentor', 'id_mentor')->toArray();
        $anak_pkl = AnakPkl::pluck('nama_anak_pkl', 'id_anak_pkl')->toArray();

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

        // Format data for select2
        // $anak_pkl = AnakPkl::all()->map(function ($item) {
        //     return [
        //         'id' => $item->id_anak_pkl,
        //         'text' => $item->nama_anak_pkl
        //     ];
        // });

        // $mentor = Mentor::all()->map(function ($item) {
        //     return [
        //         'id' => $item->id_mentor,
        //         'text' => $item->nama_mentor
        //     ];
        // });

        // Pass the selected values back to the view for maintaining filter state
        $forms = [
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' => $tanggal_akhir,
            'anak_pkl' => $selected_anak_pkl,
            'mentor' => $selected_mentor,
        ];

        return view('laporan.laporan-jurnal', compact('data', 'mentor', 'anak_pkl', 'forms'));
    }
}
