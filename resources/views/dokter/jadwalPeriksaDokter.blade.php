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
        @if ($operation == 'input')
            @include('dokter.assets.formInputJadwal')
        @elseif ($operation == 'edit')
            @include('dokter.assets.formEditJadwal')
        @elseif ($operation == 'noinput')
            @include('dokter.assets.formDisabled')
        @endif
    </div>
@endsection
