<div>
    <h2 class="text-3xl font-bold mb-4">Antrian Pasien</h2>
    <div class="relative overflow-x-auto rounded-lg mt-5">
        <table id="example" class="table-auto w-full w-full text-sm text-left rtl:text-right text-black">
            <thead class="text-xs text-white uppercase bg-gray-500">
                <tr>
                    <th scope="col" class="px-6 py-3">Nama Pasien</th>
                    <th scope="col" class="px-6 py-3">Keluhan</th>
                    <th scope="col" class="px-6 py-3">No. Antrian</th>
                    <th scope="col" class="px-6 py-3">Poli</th>
                    <th scope="col" class="px-6 py-3">Alamat</th>
                    <th scope="col" class="px-6 py-3">No. HP</th>
                    <th scope="col" class="px-6 py-3">No. RM</th>
                    <th scope="col" class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($daftar_poli as $table)
                    <tr class="bg-gray-200 border-gray-900">
                        <td scope="row" class="px-6 py-4 whitespace-nowrap">{{ $table->nama }}</td>
                        <td scope="row" class="px-6 py-4 whitespace-nowrap">{{ $table->keluhan }}</td>
                        <td scope="row" class="px-6 py-4 whitespace-nowrap">{{ $table->no_antrian }}</td>
                        <td scope="row" class="px-6 py-4 whitespace-nowrap">{{ $table->nama_poli }}</td>
                        <td scope="row" class="px-6 py-4 whitespace-nowrap">{{ $table->alamat }}</td>
                        <td scope="row" class="px-6 py-4 whitespace-nowrap">{{ $table->no_hp }}</td>
                        <td scope="row" class="px-6 py-4 whitespace-nowrap">{{ $table->no_rm }}</td>
                        <td scope="row" class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('periksaProses', $table->id_pasien) }}"
                                class="rounded-md bg-orange-400 px-1.5 py-1 text-sm font-semibold text-white shadow-sm hover:bg-orange-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-400">Pilih</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#example').DataTable({
            order: [
                [2, 'asc']
            ], // 2 is the column index (0-based) for "No. Antrian"
            // Add any other customization options here
        });
    });
</script>
