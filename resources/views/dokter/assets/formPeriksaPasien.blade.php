<div>
    <h2 class="text-3xl font-bold mb-4">Form Periksa Pasien</h2>
    @if ($pasienDalamAntrian == 'belumDipilih')
        <form action="{{ route('periksa') }}" method="POST" name="formPeriksa" id="formPeriksa">
            @csrf
            @method('PUT')
            <div>
                <label for="no_antrian" class="block text-sm font-medium leading-6 text-gray-900">No. Antrian</label>
                <div class="mt-2">
                    <input id="no_antrian" name="no_antrian" type="text" disabled
                        class="block w-full px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>

            <div>
                <label for="nama_pasien" class="block text-sm font-medium leading-6 text-gray-900">Nama Pasien</label>
                <div class="mt-2">
                    <input id="nama_pasien" name="nama_pasien" type="text" disabled
                        class="block w-full px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>

            <div>
                <label for="keluhan" class="block text-sm font-medium leading-6 text-gray-900">Keluhan</label>
                <div class="mt-2">
                    <input id="keluhan" name="keluhan" type="text" disabled
                        class="block w-full px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>

            <div>
                <label for="tanggal_pemeriksaan" class="block text-sm font-medium leading-6 text-gray-900">Tanggal
                    Pemeriksaan</label>
                <div class="mt-2">
                    <input id="tanggal_pemeriksaan" name="tanggal_pemeriksaan" type="datetime" disabled
                        value="{{ $today }}"
                        class="block w-full px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>

            <div>
                <label for="tanggal_pemeriksaan" class="block text-sm font-medium leading-6 text-gray-900">Pilihan
                    Obat</label>
                <div class="mt-2">
                    <select name="pilihan_obat[]" id="pilihan_obat"
                        class="block w-full px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        multiple disabled>
                        @foreach ($allObat as $obat)
                            <option value="{{ $obat->id }}">{{ $obat->nama_obat }} - {{ $obat->kemasan }} -
                                {{ $obat->harga }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label for="catatan" class="block text-sm font-medium leading-6 text-gray-900">Catatan Hasil
                    Periksa</label>
                <div class="mt-2">
                    <textarea id="catatan" name="catatan" rows="3" placeholder="Catatan Pemeriksaan" disabled
                        class="block w-full px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                </div>
            </div>

            <div>
                <label for="biaya_periksa" class="block text-sm font-medium leading-6 text-gray-900">Biaya
                    Periksa</label>
                <div class="mt-2">
                    <input id="biaya_periksa" name="biaya_periksa" type="number" placeholder="Biaya Pemeriksaan"
                        disabled
                        class="block w-full px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>

            <div>
                <button type="submit"
                    class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 mt-3 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
            </div>
        </form>
    @else
        <form action="{{ route('periksaProsesInsert', $pasienDalamAntrian->id_pasien) }}" method="POST"
            name="formPeriksa" id="formPeriksa">
            @csrf
            @method('PUT')
            <input type="hidden" name="id_daftar_poli" value="{{ $id_daftar_poli }}">
            <div>
                <label for="no_antrian" class="block text-sm font-medium leading-6 text-gray-900">No. Antrian</label>
                <div class="mt-2">
                    <input id="no_antrian" name="no_antrian" type="text" readonly
                        value="{{ $pasienDalamAntrian->no_antrian }}"
                        class="block w-full px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>

            <div>
                <label for="nama_pasien" class="block text-sm font-medium leading-6 text-gray-900">Nama Pasien</label>
                <div class="mt-2">
                    <input id="nama_pasien" name="nama_pasien" type="text" readonly
                        value="{{ $pasienDalamAntrian->nama }}"
                        class="block w-full px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>

            <div>
                <label for="keluhan" class="block text-sm font-medium leading-6 text-gray-900">Keluhan</label>
                <div class="mt-2">
                    <input id="keluhan" name="keluhan" type="text" readonly
                        value="{{ $pasienDalamAntrian->keluhan }}"
                        class="block w-full px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>

            <div>
                <label for="tanggal_pemeriksaan" class="block text-sm font-medium leading-6 text-gray-900">Tanggal
                    Pemeriksaan</label>
                <div class="mt-2">
                    <input id="tanggal_pemeriksaan" name="tanggal_pemeriksaan" type="datetime" readonly
                        value="{{ $today }}"
                        class="block w-full px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>

            <div>
                <label for="tanggal_pemeriksaan" class="block text-sm font-medium leading-6 text-gray-900">Pilihan
                    Obat</label>
                <div class="mt-2">
                    <select name="pilihan_obat[]" id="pilihan_obat"
                        class="block w-full px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        multiple required>
                        @foreach ($allObat as $obat)
                            <option value="{{ $obat->id }}">{{ $obat->nama_obat }} -
                                {{ $obat->kemasan }} -
                                {{ $obat->harga }}</option>
                        @endforeach
                    </select>
                </div>
                @foreach ($hargaDataObat as $obatId => $harga)
                    <input type="hidden" name="harga_obat[{{ $obatId }}]" value="{{ $harga }}">
                @endforeach
            </div>

            <div>
                <label for="catatan" class="block text-sm font-medium leading-6 text-gray-900">Catatan Hasil
                    Periksa</label>
                <div class="mt-2">
                    <textarea id="catatan" name="catatan" rows="3" placeholder="Catatan Pemeriksaan" required
                        class="block w-full px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                </div>
            </div>

            <div>
                <label for="biaya_periksa" class="block text-sm font-medium leading-6 text-gray-900">Biaya
                    Periksa</label>
                <div class="mt-2">
                    <input id="biaya_periksa" name="biaya_periksa" type="number" placeholder="Biaya Pemeriksaan"
                        hidden
                        class="block w-full px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    <p class="mt-2">Total: <span id="formattedTotal">0</span></p>
                </div>
                @foreach ($hargaDataObat as $obatId => $harga)
                    <input type="hidden" name="harga_obat[{{ $obatId }}]" value="{{ $harga }}">
                @endforeach
            </div>

            <div>
                <button type="button" id="calculateTotal"
                    class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 mt-3 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Calculate
                    Total</button>
            </div>

            <div>
                <button type="submit"
                    class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 mt-3 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Simpan
                    Pemeriksaan</button>
            </div>
        </form>
    @endif
</div>
