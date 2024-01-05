@extends('layout.app')

@section('title', 'Mengelola Obat')

@section('content')
    <div>
        <p class="text-3xl text-gray-800 font-bold">Mengelola Obat</p>
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
                <li class="text-neutral-500">Mengelola Obat</li>
            </ol>
        </i>
    </div>
    <div class="mt-16">
        <a href="{{ route('tambahObat') }}"
            class="rounded-md bg-green-600 px-3.5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">Tambah
            Obat</a>
    </div>
    <div class="relative overflow-x-auto rounded-lg mt-5">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
            <thead class="text-xs text-white uppercase bg-gray-500">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No.
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama Obat
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Kemasan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Harga
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($obats as $obat)
                    <tr class="bg-gray-200 border-gray-900">
                        <th scope="row" class="px-6 py-4 whitespace-nowrap">
                            {{ $loop->iteration }}
                        </th>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $obat->nama_obat }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $obat->kemasan }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $obat->harga }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('editObat', $obat->id) }}"
                                class="rounded-md bg-orange-400 px-1.5 py-1 text-sm font-semibold text-white shadow-sm hover:bg-orange-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-400">Edit</a>
                            <form action="{{ route('hapusObat', $obat->id) }}" method="POST">
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
