@extends('layout.app')

@section('title', 'Mengelola Poli')

@section('content')
    <div>
        <p class="text-3xl text-gray-800 font-bold">Mengelola Poli</p>
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
                <li class="text-neutral-500">Mengelola Poli</li>
            </ol>
        </i>
    </div>
    <div class="mt-16">
        <a href="{{ route('tambahPoli') }}"
            class="rounded-md bg-green-600 px-3.5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">Tambah
            Poli</a>
    </div>
    <div class="relative overflow-x-auto rounded-lg mt-5">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
            <thead class="text-xs text-white uppercase bg-gray-500">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No.
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama Poli
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Keterangan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($polis as $polis)
                    <tr class="bg-gray-200 border-gray-900">
                        <th scope="row" class="px-6 py-4 whitespace-nowrap">
                            {{ $loop->iteration }}
                        </th>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $polis->nama_poli }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $polis->keterangan }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('editPoli', $polis->id) }}"
                                class="rounded-md bg-orange-400 px-1.5 py-1 text-sm font-semibold text-white shadow-sm hover:bg-orange-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-400">Edit</a>
                            <form action="{{ route('hapusPoli', $polis->id) }}" method="POST">
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
