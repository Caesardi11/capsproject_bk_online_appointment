@extends('layout.app')

@section('title', 'Periksa')

@section('content')
    <div>
        <p class="text-3xl text-gray-800 font-bold">Periksa</p>
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
                <li class="text-neutral-500">Periksa</li>
            </ol>
        </i>
    </div>
    <div class="mt-16 flex flex-col divide-y-2 divide-gray-300">
        @include('dokter.assets.antrianPasien')
        <div class="mt-10 pt-10">
            @include('dokter.assets.formPeriksaPasien')
        </div>
        <div class="mt-10 pt-10">
            @include('dokter.assets.riwayatPeriksa')
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var alertElement = document.getElementById('alert');
            alertElement.classList.remove('hidden');

            setTimeout(function() {
                alertElement.classList.add('hidden');
            }, 3000);
        });
        document.addEventListener('DOMContentLoaded', function() {
            function calculateTotal() {
                var selectedObatIds = Array.from(document.getElementById('pilihan_obat').selectedOptions)
                    .map(option => option.value);
                var total = 0;
                selectedObatIds.forEach(function(obatId) {
                    var hargaInput = document.querySelector(`input[name="harga_obat[${obatId}]"]`);
                    if (hargaInput) {
                        total += parseFloat(hargaInput.value) || 0;
                    }
                });
                total += 150000;
                document.getElementById('biaya_periksa').value = total;
                var formattedTotal = `Total: Rp ${total.toLocaleString('id-ID')}`;
                document.getElementById('formattedTotal').innerText = formattedTotal;
            }
            calculateTotal();
            document.getElementById('calculateTotal').addEventListener('click', function() {
                calculateTotal();
            });

        });
    </script>
@endsection
