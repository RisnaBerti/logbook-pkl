<?php

namespace App\Http\Controllers;

use App\Models\Detailtagihan;
use App\Models\Historykelas;
use App\Models\PendaftaranTryout;
use App\Models\Siswa;
use App\Models\Tagihan;
use App\Models\Tahunajaran;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PesertaController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:peserta kartu-tryout', only: ['kartuTryout']),
            new Middleware('permission:peserta cara-pembayaran', only: ['caraPembayaran']),
        ];
    }

    public function daftar(Request $request)
    {
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:50',
            'jenis_kelamin' => 'required|string|in:L,P',
            'nisn' => 'nullable|string|max:10',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'nama_asal_sekolah' => 'required|string|max:50',
            'nama_ortu' => 'nullable|string|max:50',
            'no_wa_ortu' => 'required|string|max:20',
            'no_wa_peserta' => 'required|string|max:20',
            'alamat_domisili' => 'required|string',
        ]);

        try {
            $validatedData['id_pendaftar'] = PendaftaranTryout::generateIdPendaftar();
            // $validatedData['no_peserta'] = 'TO_Muga' . $urutan_baru; // ketika daftar ga punya no_peserta -> didapat ketika sudah bayar -> trigger nya user ngakses menu cetak kartu
            $validatedData['nominal_tagihan'] = 15000;
            $validatedData['password_login'] = rand(100000, 999999);

            DB::transaction(function () use ($validatedData) {
                // dd($validatedData);

                // insert ke tabel pendaftaran
                PendaftaranTryout::create($validatedData);

                // insert ke tabel user
                $user = User::create([
                    'name' => $validatedData['nama_lengkap'],
                    'username' => $validatedData['id_pendaftar'],
                    'password' => Hash::make($validatedData['password_login']),
                ]);

                $user->assignRole('peserta tryout');

                // insert ke tabel siswa
                $siswa = Siswa::create([
                    'nis' => $validatedData['id_pendaftar'],
                    'no_va' => str_pad($validatedData['id_pendaftar'], 10, '0', STR_PAD_LEFT),
                    'nama' => $validatedData['nama_lengkap'],
                    'kodejk' => $validatedData['jenis_kelamin'] == 'L' ? 1 : 2,
                    'notelpon' => $validatedData['no_wa_ortu']
                ]);

                $kodeta = Tahunajaran::query()->where('isaktif', "1")->first()?->kodeta;

                if (!$kodeta) {
                    return redirect()->back()
                        ->withInput()
                        ->with('error', 'Tidak ada tahun ajaran aktif, hubungi admin sekolah');
                }

                // insert ke tabel historykelas
                Historykelas::create([
                    'nis' => $validatedData['id_pendaftar'],
                    'kodekelas' => "PENDAFTAR TRYOUT",
                    'kodeta' => $kodeta,
                    'kodestatus' => "1",
                    'isaktif' => "1"
                ]);

                // insert ke tabel tagihan
                $tagihan = Tagihan::create([
                    'idtagihan' => $validatedData['id_pendaftar'],
                    'nis' => $validatedData['id_pendaftar'],
                    'kodebulan' => now()->monthOfYear(),
                    'kodeta' => $kodeta,
                    'kodekelompok' => '91',
                    'tglgenerate' => now(),
                    'waktuawal' => now(),
                    'waktuakhir' => now()->addDays(14),
                    'aktif' => '1',
                    'statuspembayaran' => '0',
                    'urutanantrian' => '1',
                    'totaltagihan' => $validatedData['nominal_tagihan'],
                ]);

                // insert ke tabel detailtagihan
                Detailtagihan::create([
                    'idtagihan' => $validatedData['id_pendaftar'],
                    'idjenistagihan' => "FO",
                    'nominal' => $validatedData['nominal_tagihan'],
                ]);

                // kirim wa

                $numberformat = number_format($tagihan->totaltagihan, 0, ',', '.');

                $message = <<<EOD
                _Bismillahirrohmanirrohim._
                Terimakasih sudah mendaftar melalui sistem Pendaftaran Tryout SMP Muhammadiyah 3 Yogyakarta.

                Silakan melanjutkan pendaftaran melalui login :
                Link: https://tryout.smpmugayogya.my.id
                Username: *{$validatedData['id_pendaftar']}*
                Password: *{$validatedData['password_login']}*
                Nama: {$validatedData['nama_lengkap']}

                Batas Akhir Pembayaran: {$tagihan->waktuakhir->format('d-m-Y H:i')}
                Biaya Pendaftaran: *Rp. $numberformat*

                Join grup WA untuk informasi tryout:
                https://chat.whatsapp.com/HhjxYnyUxT0H3Cd30R3atw

                Terimakasih.
                EOD;

                $this->kirimWa($siswa->notelpon, $message, "PENDAFTARAN TRYOUT", $siswa->nis);
            });

            return redirect()->route('tryout.info-login', ['_id' => encrypt(['id' => $validatedData['id_pendaftar'], 'timestamp' => now()->timestamp])])
                ->with('noBack', true)
                ->with('success', 'Anda berhasil mendaftar, silahkan login untuk lanjut ke proses pembayaran.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('landing')
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat membuat data. ' . $e->getMessage());
        }

        return redirect()->route('landing')
            ->withInput()
            ->with('error', 'Terjadi kesalahan saat membuat data. Error tidak diketahui.');
    }

    public function infoLogin(Request $request)
    {
        $dekrip = decrypt($request->_id);

        if (now()->timestamp - $dekrip['timestamp'] > 300) { // 5 menit
            return redirect()->to('/')->with('warning', 'Halaman sudah expired.');
        }

        $pendaftaranTryout = PendaftaranTryout::query()->where('id_pendaftar', $dekrip['id'])->first();

        return view('pendaftaran-tryout.info-login', compact('pendaftaranTryout'))
            ->with('timestamp', Carbon::createFromTimestamp($dekrip['timestamp'])
                ->setTimezone('Asia/Jakarta')
                ->format('Y-m-d H:i:s'));
    }

    public function kartuTryout(Request $request)
    {
        $peserta = PendaftaranTryout::find($request->user()->username);

        $tagihan = Tagihan::query()->where('idtagihan', $peserta->id_pendaftar)->first();

        // cek apakah sudah bayar, kalau sudah bayar berikan no_pesertanya
        if ($tagihan->statuspembayaran == 1 && $tagihan->aktif == 0 && empty($peserta->no_peserta)) {
            $peserta->no_peserta = $peserta::generateNoPeserta();
            $peserta->update();
        }

        return view('peserta.kartu-tryout', compact('peserta', 'tagihan'));
    }

    public function caraPembayaran(Request $request, $bank = "bmi")
    {
        $peserta = PendaftaranTryout::query()->where('id_pendaftar', $request->user()->username)->first();

        $tagihan = Tagihan::query()->where('idtagihan', $peserta->id_pendaftar)->first();

        return match ($bank) {
            // "bsi" => view('peserta.cara-pembayaran-bsi', compact('peserta', 'tagihan')),
            "bmi" => view('peserta.cara-pembayaran-bmi', compact('peserta', 'tagihan')),
            default => view('peserta.cara-pembayaran-bmi', compact('peserta', 'tagihan'))
        };
    }
}
