<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokter;
use App\Models\Poli;
use App\Models\User;
use App\Models\Pasien;
use App\Models\Obat;
use Illuminate\Support\Facades\Auth;

class AdminDashboard extends Controller
{
    public function manageDokter()
    {
        $dokters = Dokter::with(['User', 'Poli'])->get();
        $polis = Poli::all();
        $operation = 'noedit';
        return view('admin.manageDokter', compact('dokters', 'polis', 'operation'));
    }

    public function tambahDokter() {
        $polis = Poli::all();
        return view('admin.tambahDokter', compact('polis'));
    }

    public function tambahDokterProses(Request $request) {
        $request->validate([
            'nama' => 'required',
            'id_poli' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required|min:5',
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::create([
            'name' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'role' => 'dokter',
        ]);

        Dokter::create([
            'nama' => $request->input('nama'),
            'id_akun' => $user->id,
            'id_poli' => $request->input('id_poli'),
            'alamat' => $request->input('alamat'),
            'no_hp' => $request->input('no_hp'),
        ]);

        return redirect()->route('manageDokter')->with('success', 'Dokter berhasil ditambahkan!');
    }

    public function editDokter($id) {
        $dokters = Dokter::with(['user', 'poli'])->get();
        $dokter = Dokter::where('id', $id)->first();
        $polis = Poli::all();
        $operation = 'edit';
        return view('admin.editDokter', compact('dokters', 'dokter', 'polis', 'operation'));
    }

    public function editDokterProses(Request $request, $id) {
        $request->validate([
            'nama' => 'required',
            'id_poli' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required|min:5',
            'email' => 'required|email',
            'password' => 'required',
        ]);


        $dokter = Dokter::where('id', $id)->first();
        $dokter->nama = $request->input('nama');
        $dokter->id_poli = $request->input('id_poli');
        $dokter->alamat = $request->input('alamat');
        $dokter->no_hp = $request->input('no_hp');
        $dokter->save();

        $user = User::where('id', $dokter->id_akun)->first();
        $user->name = $request->input('nama');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->save();

        return redirect()->route('manageDokter')->with('success', 'Dokter berhasil diedit!');
    }

    public function hapusDokter($id) {
        $dokter = Dokter::where('id', $id)->first();
        $user = User::where('id', $dokter->id_akun)->first();
        $dokter->delete();
        $user->delete();
        return redirect()->route('manageDokter')->with('success', 'Dokter berhasil dihapus!');
    }

    public function managePoli()
    {
        $polis = Poli::all();
        return view('admin.managePoli', compact('polis'));
    }

    public function tambahPoli() {
        return view('admin.tambahPoli');
    }

    public function tambahPoliProses(Request $request) {
        $request->validate([
            'nama_poli' => 'required',
            'keterangan' => 'required',
        ]);

        Poli::create([
            'nama_poli' => $request->input('nama_poli'),
            'keterangan' => $request->input('keterangan'),
        ]);

        return redirect()->route('managePoli')->with('success', 'Poli berhasil ditambahkan!');
    }

    public function editPoli($id) {
        $poli = Poli::where('id', $id)->first();
        return view('admin.editPoli', compact('poli'));
    }

    public function editPoliProses(Request $request, $id) {
        $request->validate([
            'nama_poli' => 'required',
            'keterangan' => 'required',
        ]);

        $poli = Poli::where('id', $id)->first();
        $poli->nama_poli = $request->input('nama_poli');
        $poli->keterangan = $request->input('keterangan');
        $poli->save();

        return redirect()->route('managePoli')->with('success', 'Poli berhasil diedit!');
    }

    public function hapusPoli($id) {
        $poli = Poli::where('id', $id)->first();
        $poli->delete();
        return redirect()->route('managePoli')->with('success', 'Poli berhasil dihapus!');
    }

    public function managePasien()
    {
        $pasiens = Pasien::with(['user'])->get();
        $operation = 'noedit';
        return view('admin.managePasien', compact('pasiens', 'operation'));
    }

    public function tambahPasien() {
        return view('admin.tambahPasien');
    }

    public function tambahPasienProses(Request $request) {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_ktp' => 'required|min:5',
            'no_hp' => 'required|min:5',
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::create([
            'name' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'role' => 'pasien',
        ]);

        Pasien::create([
            'nama' => $request->input('nama'),
            'id_akun' => $user->id,
            'alamat' => $request->input('alamat'),
            'no_ktp' => $request->input('no_ktp'),
            'no_hp' => $request->input('no_hp'),
            'no_rm' => $this->generateNoRM(),
        ]);

        return redirect()->route('managePasien')->with('success', 'Pasien berhasil ditambahkan!');
    }

    public function editPasien($id) {
        $pasien = Pasien::where('id', $id)->first();
        $operation = 'edit';
        return view('admin.editPasien', compact('pasien', 'operation'));
    }

    public function editPasienProses(Request $request, $id) {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_ktp' => 'required|min:5',
            'no_hp' => 'required|min:5',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $pasien = Pasien::where('id', $id)->first();
        $pasien->nama = $request->input('nama');
        $pasien->alamat = $request->input('alamat');
        $pasien->no_ktp = $request->input('no_ktp');
        $pasien->no_hp = $request->input('no_hp');
        $pasien->save();

        $user = User::where('id', $pasien->id_akun)->first();
        $user->name = $request->input('nama');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->save();

        return redirect()->route('managePasien')->with('success', 'Pasien berhasil diedit!');
    }

    public function hapusPasien($id) {
        $pasien = Pasien::where('id', $id)->first();
        $user = User::where('id', $pasien->id_akun)->first();
        $pasien->delete();
        $user->delete();
        return redirect()->route('managePasien')->with('success', 'Pasien berhasil dihapus!');
    }

    public function manageObat()
    {
        $obats = Obat::all();
        return view('admin.manageObat', compact('obats'));
    }

    public function tambahObat() {
        return view('admin.tambahObat');
    }

    public function tambahObatProses(Request $request) {
        $request->validate([
            'nama_obat' => 'required',
            'kemasan' => 'required',
            'harga' => 'required',
        ]);

        Obat::create([
            'nama_obat' => $request->input('nama_obat'),
            'kemasan' => $request->input('kemasan'),
            'harga' => $request->input('harga'),
        ]);

        return redirect()->route('manageObat')->with('success', 'Obat berhasil ditambahkan!');
    }

    public function editObat($id) {
        $obat = Obat::where('id', $id)->first();
        return view('admin.editObat', compact('obat'));
    }

    public function editObatProses(Request $request, $id) {
        $request->validate([
            'nama_obat' => 'required',
            'kemasan' => 'required',
            'harga' => 'required',
        ]);

        $obat = Obat::where('id', $id)->first();
        $obat->nama_obat = $request->input('nama_obat');
        $obat->kemasan = $request->input('kemasan');
        $obat->harga = $request->input('harga');
        $obat->save();

        return redirect()->route('manageObat')->with('success', 'Obat berhasil diedit!');
    }

    public function hapusObat($id) {
        $obat = Obat::where('id', $id)->first();
        $obat->delete();
        return redirect()->route('manageObat')->with('success', 'Obat berhasil dihapus!');
    }

    protected function generateNoRM()
    {
        $year = date('Y'); // Get the current year
        $month = date('m'); // Get the current month
        $all_patients = Pasien::count();
        $no_rm = $year . $month . '-' . ($all_patients + 1); // Generate the no_rm
        return $no_rm;
    }
}
