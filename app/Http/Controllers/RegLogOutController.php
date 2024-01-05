<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Pasien;
use App\Models\User;

class RegLogOutController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function login_proses(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (auth()->attempt($credentials)) {
            return redirect()->route('dashboard');
        }
        return redirect()->route('login')->with('error', 'Email atau password salah!');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function register_proses(Request $request)
    {
        $this->validator($request->all())->validate();
        $data = [
            'name' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'role' => 'pasien',
        ];
        $user = User::create($data);
        Pasien::create([
            'id_akun' => $user->id,
            'nama' => $request->input('nama'),
            'alamat' => $request->input('alamat'),
            'no_ktp' => $request->input('no_ktp'),
            'no_hp' => $request->input('no_hp'),
            'no_rm' => $this->generateNoRM(),
        ]);
        return redirect()->route('login')->with('success', 'Register berhasil!');
    }

    public function logout()
    {
        auth()->logout();
        //arahkan ke route welcome
        return redirect()->Route('welcome');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255',
            'password' => 'required|min:2',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_ktp' => 'required|string|max:255',
            'no_hp' => 'required|string|max:50',
        ]);
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
