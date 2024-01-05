@extends('layout.app')

@section('title', 'Daftar Poli')

@section('content')
    <div>
        <p class="text-3xl text-gray-800 font-bold">Daftar Poli</p>
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
                <li class="text-neutral-500">Daftar Poli</li>
            </ol>
        </i>
    </div>
    <div class="mt-16">
        <form action="{{ route('daftarPoliProses', ['id' => Auth::user()->id]) }}" method="POST">
            @csrf
            <div>
                <label for="jadwal" class="block text-sm font-medium leading-6 text-gray-900">Pilih Jadwal</label>
                <select name="jadwal" id="jadwal"
                    class="block w-full px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    <option class="text-gray-400" value="0">Pilih Jadwal</option>
                    //jadwal ambilkan nama dokter, nama poli, hari, jam mulai, jam selesai
                    @foreach ($jadwal as $jadwal)
                        <option value="{{ $jadwal['id'] }}">{{ ucwords($jadwal->dokter->nama) }} -
                            {{ ucwords($jadwal->dokter->poli->nama_poli) }} - {{ ucwords($jadwal['hari']) }} -
                            {{ $jadwal['jam_mulai'] }} - {{ $jadwal['jam_selesai'] }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="keluhan" class="block text-sm font-medium leading-6 text-gray-900">Keluhan</label>
                <div class="mt-2">
                    <textarea id="keluhan" name="keluhan" type="text" autocomplete="keluhan" required
                        class="block w-full px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                </div>
            </div>

            <div>
                <button type="submit"
                    class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 mt-3 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Daftar
                    Poli</button>
            </div>
        </form>
    </div>

    @if ($message = Session::get('success'))
        <script>
            alert("{{ $message }}")
        </script>
    @endif

@endsection
