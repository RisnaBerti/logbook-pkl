<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranTryout;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $pendaftaranTryout = new PendaftaranTryout();
        $pendaftaranTryout->tanggal_lahir = now()->subYears(11); // kira2 tahun lahir anak

        return view('landing.index', compact('pendaftaranTryout'));
    }
}
