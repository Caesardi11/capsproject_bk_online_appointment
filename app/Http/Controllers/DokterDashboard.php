<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokter;
use App\Models\User;
use App\Models\Poli;
use App\Models\Jadwal_periksa;
use App\Models\daftar_poli;
use App\Models\Obat;
use App\Models\Periksa;
use App\Models\detail_periksa;
use Illuminate\Support\Facades\Auth;


class DokterDashboard extends Controller
{
    public function userSetting()
    {
        $dokter = Dokter::where('id_akun', auth()->user()->id)->first();
        $polis = Poli::all();
        return view('dokter.userSetting', compact('dokter', 'polis'));
    }

    public function userSettingProses(Request $request , $id)
    {
        $request->validate([
            'nama' => 'required',
            'id_poli' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required|min:5',
            'email' => 'required',
            'password' => 'required',
        ]);

        $dokter = Dokter::where('id', $id)->first();
        $user = User::where('id', $dokter->id_akun)->first();

        $user->update([
            'name' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        $dokter->update([
            'nama' => $request->input('nama'),
            'id_poli' => $request->input('id_poli'),
            'alamat' => $request->input('alamat'),
            'no_hp' => $request->input('no_hp'),
        ]);

        return redirect()->route('dashboard')->with('success', 'Data berhasil diubah!');
    }

    public function jadwalPeriksaDokter ()
    {
        $dokter = Dokter::where('id_akun', auth()->user()->id)->first();
        $cekJadwalPeriksa = Jadwal_periksa::where('id_dokter', $dokter->id)->get();
        $operation = '';
        date_default_timezone_set('Asia/Jakarta');
        $hariH = date('l');
        $hari = [
            'Senin' => 'Monday',
            'Selasa' => 'Tuesday',
            'Rabu' => 'Wednesday',
            'Kamis' => 'Thursday',
            'Jumat' => 'Friday',
            'Sabtu' => 'Saturday',
            'Minggu' => 'Sunday',
        ];
        $keys = array_keys($hari);

        if ($cekJadwalPeriksa->count() == 0) {
            $operation = 'input';
            return view('dokter.jadwalPeriksaDokter', compact('operation', 'keys'));
        } else if ($cekJadwalPeriksa->count() > 0 && $cekJadwalPeriksa[0]->hari != array_search($hariH, $hari)) {
            $operation = 'edit';
            return view('dokter.jadwalPeriksaDokter', compact('cekJadwalPeriksa', 'operation', 'keys'));
        } else if ($cekJadwalPeriksa[0]->hari == array_search($hariH, $hari)) {
            $operation = 'noinput';
            return view('dokter.jadwalPeriksaDokter', compact('cekJadwalPeriksa', 'operation', 'keys'));
        }

        return view('dokter.jadwalPeriksaDokter', compact('cekJadwalPeriksa', 'operation', 'keys'));
    }

    public function inputJadwalProses(Request $request)
    {
        // dd($request->toArray());
        $request->validate([
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        $user = auth()->user()->id;
        $dokter = Dokter::where('id_akun', $user)->first();
        $hari = $request->input('hari');
        $jam_mulai = $request->input('jam_mulai');
        $jam_selesai = $request->input('jam_selesai');
        // dd($dokter, $hari, $jam_mulai, $jam_selesai);
        Jadwal_periksa::create([
            'id_dokter' => (int) $dokter->id,
            'hari' => $hari,
            'jam_mulai' => $jam_mulai,
            'jam_selesai' => $jam_selesai,
        ]);

        return redirect()->route('jadwalPeriksaDokter')->with('success', 'Jadwal berhasil ditambahkan!');
    }

    public function editJadwalProses(Request $request)
    {
        $request->validate([
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        $user = auth()->user()->id;
        $dokter = Dokter::where('id_akun', $user)->first();
        $jadwal = Jadwal_periksa::where('id_dokter', $dokter->id);

        $jadwal->update([
            'hari' => $request->input('hari'),
            'jam_mulai' => $request->input('jam_mulai'),
            'jam_selesai' => $request->input('jam_selesai'),
        ]);

        return redirect()->back()->with('success', 'Jadwal berhasil diubah!');
    }

    public function periksa()
    {
        $dokter = Dokter::where('id_akun', Auth::user()->id)->first();
        $daftar_poli = daftar_poli::join('jadwal_periksa', 'daftar_poli.id_jadwal', '=', 'jadwal_periksa.id')
            ->join('dokter', 'jadwal_periksa.id_dokter', '=', 'dokter.id')
            ->join('poli', 'dokter.id_poli', '=', 'poli.id')
            ->join('pasien', 'daftar_poli.id_pasien', '=', 'pasien.id')
            ->where('jadwal_periksa.id_dokter', $dokter->id)
            ->where('daftar_poli.status', 'daftar')
            ->select('daftar_poli.*', 'jadwal_periksa.*', 'poli.*', 'dokter.*', 'pasien.*')
            ->get();
        $allObat = Obat::all();
        date_default_timezone_set('Asia/Jakarta');
        $today = now()->format('Y-m-d H:i:s');
        $pasienDalamAntrian = 'belumDipilih';
        $defaultChoosen = $daftar_poli->where('no_antrian', $daftar_poli->min('no_antrian'))->first();

        $session = session()->all();
        $id_dokter = Dokter::where('id_akun', Auth::user()->id)->first()->id;

        $periksa = [];

        $oldPasien = Periksa::join('daftar_poli', 'periksa.id_daftar_poli', '=', 'daftar_poli.id')
            ->join('pasien', 'daftar_poli.id_pasien', '=', 'pasien.id')
            ->join('jadwal_periksa', 'daftar_poli.id_jadwal', '=', 'jadwal_periksa.id')
            ->where('daftar_poli.status', 'selesai')
            ->where('jadwal_periksa.id_dokter', $id_dokter)
            ->select('pasien.nama', 'daftar_poli.keluhan', 'periksa.tgl_periksa', 'periksa.catatan', 'periksa.id as id_periksa', 'periksa.biaya_periksa')
            ->get();

        foreach ($oldPasien as $value) {
            $obat = Periksa::join('detail_periksa', 'periksa.id', '=', 'detail_periksa.id_periksa')
                ->join('obat', 'detail_periksa.id_obat', '=', 'obat.id')
                ->join('daftar_poli', 'periksa.id_daftar_poli', '=', 'daftar_poli.id')
                ->where('daftar_poli.status', 'selesai')
                ->where('periksa.id', $value->id_periksa)
                ->select('obat.nama_obat')
                ->get();

            $periksa[] = [
                'nama' => $value->nama,
                'keluhan' => $value->keluhan,
                'tgl_periksa' => $value->tgl_periksa,
                'catatan' => $value->catatan,
                'obat' => $obat,
                'biaya_periksa' => $value->biaya_periksa,
            ];
        }

        // dd($periksa);

        return view('dokter.periksa')->with(compact('id_dokter', 'periksa', 'daftar_poli', 'allObat', 'pasienDalamAntrian', 'today', 'defaultChoosen'));
    }

    public function periksaProses($id_pasien)
    {
        $dokter = Dokter::where('id_akun', Auth::user()->id)->first();
        $daftar_poli = daftar_poli::join('jadwal_periksa', 'daftar_poli.id_jadwal', '=', 'jadwal_periksa.id')
            ->join('dokter', 'jadwal_periksa.id_dokter', '=', 'dokter.id')
            ->join('poli', 'dokter.id_poli', '=', 'poli.id')
            ->join('pasien', 'daftar_poli.id_pasien', '=', 'pasien.id')
            ->where('jadwal_periksa.id_dokter', $dokter->id)
            ->where('daftar_poli.status', 'daftar')
            ->select('daftar_poli.*', 'jadwal_periksa.*', 'poli.*', 'dokter.*', 'pasien.*')
            ->get();

        $pasienDalamAntrian = $daftar_poli->where('id_pasien', $id_pasien)->where('no_antrian', $daftar_poli->where('id_pasien', $id_pasien)->min('no_antrian'))->first();
        date_default_timezone_set('Asia/Jakarta');
        $today = now()->format('Y-m-d H:i:s');
        $defaultChoosen = $daftar_poli->where('id_pasien', $id_pasien)->where('no_antrian', $daftar_poli->where('id_pasien', $id_pasien)->min('no_antrian'))->first();
        $dokter_id = Dokter::where('id_akun', Auth::user()->id)->first()->id;
        $dokter = Dokter::with([
            'jadwal_periksa.daftar_poli.pasien'
        ])->find($dokter_id);
        $id_daftar_poli = null;

        // cari daftar poli by id pasien
        foreach ($dokter->jadwal_periksa as $jadwal) {
            foreach ($jadwal->daftar_poli as $daftar) {
                if ($daftar->pasien->id == $id_pasien) {
                    $id_daftar_poli = $daftar->id;
                }
            }
        }

        $allObat = Obat::all();
        $hargaDataObat = [];
        foreach ($allObat as $obat) {
            $hargaDataObat[$obat->id] = $obat->harga;
        }

        $periksa = [];
        $id_dokter = Dokter::where('id_akun', Auth::user()->id)->first()->id;
        $oldPasien = Periksa::join('daftar_poli', 'periksa.id_daftar_poli', '=', 'daftar_poli.id')
            ->join('pasien', 'daftar_poli.id_pasien', '=', 'pasien.id')
            ->join('jadwal_periksa', 'daftar_poli.id_jadwal', '=', 'jadwal_periksa.id')
            ->where('daftar_poli.status', 'selesai')
            ->where('jadwal_periksa.id_dokter', $id_dokter)
            ->select('pasien.nama', 'daftar_poli.keluhan', 'periksa.tgl_periksa', 'periksa.catatan', 'periksa.id as id_periksa', 'periksa.biaya_periksa')
            ->get();
        foreach ($oldPasien as $value) {
            $obat = Periksa::join('detail_periksa', 'periksa.id', '=', 'detail_periksa.id_periksa')
                ->join('obat', 'detail_periksa.id_obat', '=', 'obat.id')
                ->join('daftar_poli', 'periksa.id_daftar_poli', '=', 'daftar_poli.id')
                ->where('daftar_poli.status', 'selesai')
                ->where('periksa.id', $value->id_periksa)
                ->select('obat.nama_obat')
                ->get();
            $periksa[] = [
                'nama' => $value->nama,
                'keluhan' => $value->keluhan,
                'tgl_periksa' => $value->tgl_periksa,
                'catatan' => $value->catatan,
                'obat' => $obat,
                'biaya_periksa' => $value->biaya_periksa,
            ];
        }
        // dd($pasienDalamAntrian, $daftar_poli, $allObat, $today, $defaultChoosen, $hargaDataObat);
        return view('dokter.periksa', compact('pasienDalamAntrian', 'daftar_poli', 'allObat', 'today', 'defaultChoosen', 'hargaDataObat', 'id_daftar_poli', 'periksa'));
    }

    public function periksaProsesInsert(Request $request)
    {
        // dd($request->toArray());
        $request->validate([
            'id_daftar_poli' => 'required',
            'pilihan_obat' => 'required',
            'catatan' => 'required',
            'biaya_periksa' => 'required',
            'tanggal_pemeriksaan' => 'required',
        ]);
        // $tambahTime = $request->input('tanggal_pemeriksaan');
        // dd($tambahTime);
        $periksa = Periksa::create([
            'id_daftar_poli' => $request->input('id_daftar_poli'),
            'tgl_periksa' => $request->input('tanggal_pemeriksaan'),
            'catatan' => $request->input('catatan'),
            'biaya_periksa' => $request->input('biaya_periksa'),
        ]);

        daftar_poli::where('id', $request->input('id_daftar_poli'))->update([
            'status' => 'selesai',
        ]);

        foreach ($request->input('pilihan_obat') as $obat) {
            detail_periksa::create([
                'id_periksa' => $periksa->id,
                'id_obat' => $obat,
            ]);
        }
        return redirect()->route('periksa')->with('success', 'Berhasil memeriksa pasien!');
    }
}
