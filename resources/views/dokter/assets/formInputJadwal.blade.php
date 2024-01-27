<form action="{{ route('inputJadwalProses') }}" method="POST">
    @csrf
    <div>
        <label for="service" class="block text-sm font-medium leading-6 text-gray-900">Pilih Hari</label>
        <select name="hari" id="hari"
            class="block w-full px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            @foreach ($keys as $hari)
                @if ($hari != 'Minggu')
                    <option value="{{ $hari }}">
                        {{ ucwords(strtolower($hari)) }} </option>
                @endif
            @endforeach
        </select>
    </div>

    <div>
        <label for="time" class="block text-sm font-medium leading-6 text-gray-900">Pilih Jam
            Mulai</label>
        <div class="mt-2">
            <input id="jam_mulai" name="jam_mulai" type="time" required
                class="block w-full px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
    </div>

    <div>
        <label for="time" class="block text-sm font-medium leading-6 text-gray-900">Pilih Jam
            Selesai</label>
        <div class="mt-2">
            <input id="jam_selesai" name="jam_selesai" type="time" required
                class="block w-full px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
    </div>

    <div>
        <label for="time" class="block text-sm font-medium leading-6 text-gray-900">Pilih Status</label>
        <div class="mt-2">
            <select name="status" id="status"
                class="block w-full px-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                <option value="yes">Aktif</option>
                <option value="no">Tidak Aktif</option>
            </select>
        </div>
    </div>

    <div>
        <button type="submit"
            class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 mt-3 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
    </div>
</form>
