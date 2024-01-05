@extends('layout.app')

@section('title', 'Mengelola Dokter')

@section('content')
    <div>
        <p class="text-3xl text-gray-800 font-bold">Mengelola Dokter</p>
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
                <li class="text-neutral-500">Mengelola Dokter</li>
            </ol>
        </i>
    </div>
    <div class="mt-16">
        <a href="{{ route('tambahDokter') }}"
            class="rounded-md bg-green-600 px-3.5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">Tambah
            Akun</a>
    </div>
    <div class="relative overflow-x-auto rounded-lg mt-5">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
            <thead class="text-xs text-white uppercase bg-gray-500">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No.
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nomer HP
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Alamat
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Poli
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dokters as $dokters)
                    <tr class="bg-gray-200 border-gray-900">
                        <th scope="row" class="px-6 py-4 whitespace-nowrap">
                            {{ $loop->iteration }}
                        </th>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $dokters->nama }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $dokters->user->email }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $dokters->no_hp }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $dokters->alamat }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($dokters->id_poli == null)
                                Poli belum ditentukan
                            @else
                                {{ $dokters->poli->nama_poli }}
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('editDokter', $dokters->id) }}"
                                class="rounded-md bg-orange-400 px-1.5 py-1 text-sm font-semibold text-white shadow-sm hover:bg-orange-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-400">Edit</a>
                            <form action="{{ route('hapusDokter', $dokters->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="rounded-md bg-red-500 px-1.5 py-1 mt-2 text-sm font-semibold text-white shadow-sm hover:bg-red-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-500">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
