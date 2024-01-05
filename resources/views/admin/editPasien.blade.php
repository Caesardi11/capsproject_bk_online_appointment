@extends('layout.app')

@section('title', 'Edit Pasien')

@section('content')
    <div>
        <p class="text-3xl text-gray-800 font-bold">Edit Akun Pasien</p>
    </div>
    <div>
        <i>
            <ol class="list-reset flex mt-3">
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="text-primary hover:text-primary-600 focus:text-primary-600 active:text-primary-700">Dashboard</a>
                </li>
                <li>
                    <span class="mx-2 text-neutral-500">/</span>
                </li>
                <li>
                    <a href="{{ route('managePasien') }}"
                        class="text-primary hover:text-primary-600 focus:text-primary-600 active:text-primary-700">Mengelola
                        Pasien</a>
                </li>
                <li>
                    <span class="mx-2 text-neutral-500">/</span>
                </li>
                <li class="text-neutral-500">Edit Akun Pasien</li>
            </ol>
        </i>
    </div>
    <div class="mt-16">
        <form action="{{ route('editPasienProses', $pasien->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label for="nama" class="block text-sm font-medium leading-6 text-gray-900">Nama</label>
                <div class="mt-2">
                    <input id="nama" name="nama" type="text" autocomplete="nama" required
                        value="{{ $pasien->nama }}"
                        class="block w-full px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>

            <div>
                <label for="alamat" class="block text-sm font-medium leading-6 text-gray-900">Alamat</label>
                <div class="mt-2">
                    <input id="alamat" name="alamat" type="text" autocomplete="alamat" required
                        value="{{ $pasien->alamat }}"
                        class="block w-full px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>

            <div>
                <label for="no_ktp" class="block text-sm font-medium leading-6 text-gray-900">No. KTP</label>
                <div class="mt-2">
                    <input id="no_ktp" name="no_ktp" type="text" autocomplete="no_ktp" required
                        value="{{ $pasien->no_ktp }}"
                        class="block w-full px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>

            <div>
                <label for="no_hp" class="block text-sm font-medium leading-6 text-gray-900">No. HP</label>
                <div class="mt-2">
                    <input id="no_hp" name="no_hp" type="text" autocomplete="no_hp" required
                        value="{{ $pasien->no_hp }}"
                        class="block w-full px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email
                    address</label>
                <div class="mt-2">
                    <input id="email" name="email" type="email" autocomplete="email" required
                        value="{{ $pasien->user->email }}"
                        class="block w-full px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between">
                    <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                </div>
                <div class="mt-2">
                    <input id="password" name="password" type="password" autocomplete="current-password" required
                        class="block w-full px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>

            <div>
                <button type="submit"
                    class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 mt-3 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Edit
                    Pasien</button>
            </div>
        </form>
    </div>
@endsection
