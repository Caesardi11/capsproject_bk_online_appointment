<div>
    <h2 class="text-3xl font-bold mb-4">Riwayat Pasien</h2>
    <div class="relative overflow-x-auto rounded-lg mt-5">
        <table id="contoh" class="table-auto w-full w-full text-sm text-left rtl:text-right text-black">
            <thead class="text-xs text-white uppercase bg-gray-500">
                <tr>
                    <th scope="col" class="px-6 py-3">Nama Pasien</th>
                    <th scope="col" class="px-6 py-3">Keluhan</th>
                    <th scope="col" class="px-6 py-3">Tanggal Periksa</th>
                    <th scope="col" class="px-6 py-3">Catatan</th>
                    <th scope="col" class="px-6 py-3">Obat</th>
                    <th scope="col" class="px-6 py-3">Biaya Periksa</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($periksa as $hasil)
                    <tr class="bg-gray-200 border-gray-900">
                        <td scope="row" class="px-6 py-4 whitespace-nowrap">{{ $hasil['nama'] }}</td>
                        <td scope="row" class="px-6 py-4 whitespace-nowrap">{{ $hasil['keluhan'] }}</td>
                        <td scope="row" class="px-6 py-4 whitespace-nowrap">{{ $hasil['tgl_periksa'] }}</td>
                        <td scope="row" class="px-6 py-4 whitespace-nowrap">{{ $hasil['catatan'] }}</td>
                        <td scope="row" class="px-6 py-4 whitespace-nowrap">
                            @foreach ($hasil['obat'] as $obat)
                                {{ $obat['nama_obat'] }}<br>
                            @endforeach
                        </td>
                        <td scope="row" class="px-6 py-4 whitespace-nowrap">{{ $hasil['biaya_periksa'] }}</td>
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
        $('#contoh').DataTable({
            order: [
                [2, 'asc']
            ], // 2 is the column index (0-based) for "No. Antrian"
            // Add any other customization options here
        });
    });
</script>
