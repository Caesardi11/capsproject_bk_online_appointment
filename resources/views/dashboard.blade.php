@extends('layout.app')

@section('title', 'Dashboard')

@section('content')
    <div>
        <p class="text-3xl text-gray-800 font-bold">Dashboard</p>
    </div>
    <div>
        <i>
            <ol class="list-reset flex mt-3">
                <li class="text-neutral-500">Dashboard</li>
            </ol>
        </i>
    </div>

    <div class="mt-16">
        @if (Auth::user()->role == 'admin')
            <p class="text-7xl text-gray-800 font-bold">Selamat Datang Admin,</p>
            <p class="text-lg text-gray-400 font-semibold mt-3 italic">Silahkan Akses Menu yang berada pada Sidebar untuk
                memudahkan pekerjaan anda.</p>
        @elseif (Auth::user()->role == 'pasien')
            <div class="mt-16">
                <p class="text-xl text-gray-800 font-semibold">Riwayat Pendaftaran</p>
                <div class="relative overflow-x-auto rounded-lg mt-5">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                        <thead class="text-xs text-white uppercase bg-gray-500">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Nama Poli
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Dokter
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Hari
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Jam Mulai
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Jam Selesai
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Antrian
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cekPHistory as $Pendaftaran)
                                <tr class="bg-gray-200 border-gray-900">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $Pendaftaran->nama_poli }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $Pendaftaran->nama }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $Pendaftaran->hari }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $Pendaftaran->jam_mulai }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $Pendaftaran->jam_selesai }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $Pendaftaran->no_antrian }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @elseif (Auth::user()->role == 'dokter')
            <p class="text-7xl text-gray-800 font-bold">Selamat Datang Dokter,</p>
            <p class="text-lg text-gray-400 font-semibold mt-3 italic">Silahkan Akses Menu yang berada pada Sidebar untuk
                memudahkan pekerjaan anda.</p>
        @endif
    </div>
@endsection
