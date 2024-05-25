@extends('layouts.guest')

@section('content')
    @include('layouts.navbars.auth.navbar')
    <div class="h-screen w-full flex justify-center items-center">
        <div id='calendar' class="bg-white p-6 rounded-lg w-[500px]"></div>
    </div>
@endsection
