@extends('layout.app')

@section('title', 'Jadwal Periksa')

@section('content')
    <div>
        <p class="text-3xl text-gray-800 font-bold">Jadwal Periksa</p>
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
                <li class="text-neutral-500">Jadwal Periksa</li>
            </ol>
        </i>
    </div>
    <div class="mt-16">
        <div class="relative overflow-x-auto rounded-lg mt-5">
            <table id="example" class="table-auto w-full w-full text-sm text-left rtl:text-right text-black">
                <thead class="text-xs text-white uppercase bg-gray-500">
                    <tr>
                        <th scope="col" class="px-6 py-3">Nama Dokter</th>
                        <th scope="col" class="px-6 py-3">Hari</th>
                        <th scope="col" class="px-6 py-3">Jam Mulai</th>
                        <th scope="col" class="px-6 py-3">Jam Selesai</th>
                        <th scope="col" class="px-6 py-3">Jadwal Aktif</th>
                        <th scope="col" class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jadwalDokters as $table)
                        <tr class="bg-gray-200 border-gray-900">
                            <td scope="row" class="px-6 py-4 whitespace-nowrap">
                                {{ isset($table['nama']) ? $table['nama'] : 'Tidak Ada Nama' }}</td>
                            <td scope="row" class="px-6 py-4 whitespace-nowrap">
                                {{ isset($table['hari']) ? $table['hari'] : 'Tidak Ada Hari' }}</td>
                            <td scope="row" class="px-6 py-4 whitespace-nowrap">
                                {{ isset($table['jam_mulai']) ? $table['jam_mulai'] : 'Tidak Ada Jam Mulai' }}</td>
                            <td scope="row" class="px-6 py-4 whitespace-nowrap">
                                {{ isset($table['jam_selesai']) ? $table['jam_selesai'] : 'Tidak Ada Jam Selesai' }}</td>
                            <td scope="row" class="px-6 py-4 whitespace-nowrap">
                                {{ isset($table['status']) ? $table['status'] : 'Tidak Ada Status' }}</td>
                            <td scope="row" class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('editJadwal', $table['id']) }}"
                                    class="rounded-md bg-orange-400 px-1.5 py-1 text-sm font-semibold text-white shadow-sm hover:bg-orange-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-400">Pilih</a>
                                <Form action="{{ route('hapusJadwal', $table['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="rounded-md bg-red-400 px-1.5 py-1 mt-2 text-sm font-semibold text-white shadow-sm hover:bg-red-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-400">Hapus</button>
                                </Form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-16">
        @if ($operation == 'input')
            @include('dokter.assets.formInputJadwal')
        @elseif ($operation == 'edit')
            @include('dokter.assets.formEditJadwal')
        @elseif ($operation == 'noinput')
            @include('dokter.assets.formDisabled')
        @endif
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                order: [
                    [2, 'asc']
                ],
            });
        });
    </script>
@endsection
