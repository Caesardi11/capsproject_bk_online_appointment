@extends('layout.app')

@section('title', 'Tambah Obat')

@section('content')
    <div>
        <p class="text-3xl text-gray-800 font-bold">Tambah Daftar Obat</p>
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
                    <a href="{{ route('manageObat') }}"
                        class="text-primary hover:text-primary-600 focus:text-primary-600 active:text-primary-700">Mengelola
                        Obat</a>
                </li>
                <li>
                    <span class="mx-2 text-neutral-500">/</span>
                </li>
                <li class="text-neutral-500">Tambah Daftar Obat</li>
            </ol>
        </i>
    </div>
    <div class="mt-16">
        <form action="{{ route('tambahObatProses') }}" method="POST">
            @csrf
            <div>
                <label for="nama_obat" class="block text-sm font-medium leading-6 text-gray-900">Nama Obat</label>
                <div class="mt-2">
                    <input id="nama_obat" name="nama_obat" type="text" autocomplete="nama_obat" required
                        class="block w-full px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>

            <div>
                <label for="kemasan" class="block text-sm font-medium leading-6 text-gray-900">Kemasan</label>
                <div class="mt-2">
                    <input id="kemasan" name="kemasan" type="text" autocomplete="kemasan" required
                        class="block w-full px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>

            <div>
                <label for="harga" class="block text-sm font-medium leading-6 text-gray-900">Harga</label>
                <div class="mt-2">
                    <input id="harga" name="harga" type="text" autocomplete="harga" required
                        class="block w-full px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>

            <div>
                <button type="submit"
                    class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 mt-3 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Tambah
                    Daftar Obat</button>
            </div>
        </form>
    </div>
@endsection
