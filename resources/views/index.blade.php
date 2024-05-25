@extends('layouts.app')

@section('content')
    <div class="min-height-400 bg-primary position-absolute w-100" style="z-index: -10"></div>
    <div class="container-fluid w-100 pt-3 mb-4">
        {{-- <h1>Fakultas Matematika dan Ilmu Pengetahuan Alam USK</h1> --}}
        <div style="display: flex; justify-content:center; align-items:center; column-gap: 30px;">
            <img src="/img/Logo.png" alt="fmipa" class="h-6 w-6">
            <div style="">
                <p class="fs-4 fw-light text-white h-1">Booking Aula dan Teater</p>
                <h1 class="fs-2 fw-bold text-white">Fakultas Matematika dan<br>Ilmu
                    Pengetahuan Alam USK
                </h1>
            </div>

            <div style="display: flex; justify-content:center; align-items:center;">
                <button
                    style="padding-left: 0.75rem;padding-right: 0.75rem; padding-top: 0.5rem; padding-bottom: 0.5rem; border:0; border-radius:7px">Login</button>
            </div>
        </div>
    </div>
    <div class="container-fluid w-100">
        <div style="display: flex; justify-content:center; align-items:center;" class="col">
            <img src="/img/landingpage.png" alt="fmipa" class="h-60 w-60">

        </div>
    </div>
@endsection
