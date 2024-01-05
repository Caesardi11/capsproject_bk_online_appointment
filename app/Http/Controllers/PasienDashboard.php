<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokter;
use App\Models\User;
use App\Models\Poli;
use App\Models\Pasien;
use App\Models\Jadwal_periksa;
use App\Models\Obat;
use App\Models\Daftar_poli;

class PasienDashboard extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 'pasien') {

        $jadwals = Jadwal_periksa::with(['dokter.poli'])->get();
        $pasien = Pasien::where('id_akun', auth()->user()->id)->first();
        $cekPHistory = daftar_poli::join('jadwal_periksa', 'daftar_poli.id_jadwal', '=', 'jadwal_periksa.id')
            ->join('dokter', 'jadwal_periksa.id_dokter', '=', 'dokter.id')
            ->join('poli', 'dokter.id_poli', '=', 'poli.id')
            ->where('daftar_poli.id_pasien', $pasien->id)
            ->select('daftar_poli.*', 'jadwal_periksa.*', 'poli.*', 'dokter.*')
            ->get();
        $test = Daftar_poli::all();
        // dd($cekPHistory->toArray());
        return view('dashboard', compact('jadwals', 'pasien', 'cekPHistory'));
        }
        // } elseif (auth()->user()->role == 'admin') {
        //     return redirect()->route('dashboard');
        // } elseif (auth()->user()->role == 'dokter') {
        //     return redirect()->route('dashboard');
        // }
        return view('dashboard');
    }

    public function daftarPoli()
    {
        $polis = Daftar_poli::all();
        $jadwal = Jadwal_periksa::with(['dokter', 'poli'])->get();
        $user = auth()->user()->id;
        $pasien = Pasien::where('id_akun', $user)->first();


        return view('pasien.daftarPoli', compact('polis', 'jadwal', 'pasien'));
    }

    //tolong benarkan codingan dibawah ini dengan penambahan parameter id
    public function daftarPoliProses($id, Request $request)
    {
        $request->validate([
            'jadwal' => 'required',
            'keluhan' => 'required',
        ]);

        $user = auth()->user()->id;
        $pasien = Pasien::where('id_akun', $user)->first();
        $jadwalInput = $request->input('jadwal');
        $keluhan = $request->input('keluhan');

        $histDaftarPolis = daftar_poli::where('id_pasien', $pasien->id)->get();
        $jadwals = Jadwal_periksa::with(['dokter.poli'])->get();

        if ($histDaftarPolis->count() > 0) {
            foreach ($histDaftarPolis as $histDaftarPoli) {
                foreach ($jadwals as $jadwal) {
                    if ($histDaftarPoli->id_jadwal == $jadwal->id && $jadwal->id == $jadwalInput && $histDaftarPoli->status == 'daftar') {
                        return redirect()->route('daftarPoli')->with('error', 'Anda sudah mendaftar poli!');
                    }
                }
            }
        }

        daftar_poli::create([
            'id_pasien' => (int) $pasien->id,
            'id_jadwal' => (int) $jadwalInput,
            'keluhan' => $keluhan,
            'no_antrian' => (int) $this->getNoAntrian($jadwalInput),
            'status' => 'daftar',
        ]);

        return redirect()->route('daftarPoli')->with('success', 'Berhasil mendaftar poli!');
    }

    public function getNoAntrian($jadwal)
    {
        $no_antrian = daftar_poli::where('id_jadwal', $jadwal)->max('no_antrian') + 1;
        return $no_antrian;
    }

}
