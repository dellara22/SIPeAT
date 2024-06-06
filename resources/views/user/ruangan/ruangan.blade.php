@extends('layouts.user')

@section('content')
    @include('layouts.navbars.auth.navbar')
    <div class="h-screen w-full flex justify-center items-center">
        <div class="w-4/5 flex flex-wrap justify-center gap-6">
            @foreach ($ruangan as $item)
                @php
                    $peminjaman = \App\Models\Peminjaman::where('ruangan', $item->id)
                        ->where('status', '3')
                        ->first();
                @endphp
                <div
                    class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <a href="#">
                        <img class="rounded-t-lg" src="{{ '/assets/img/ruangan/' . $item->thumbnail }}"
                            alt="$item->thumbnail" />
                    </a>
                    <div class="p-5">
                        <div>
                            <a href="#">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    {{ $item->name }}</h5>
                            </a>
                        </div>
                        @if ($peminjaman)
                            <div class="flex justify-between">
                                <p
                                    class="flex bg-red-500 text-green-100 text-md text-center items-center font-medium me-2 px-3 py-2 rounded">
                                    Tidak Tersedia
                                </p>
                                </div>
                                @else
                                <div class="flex justify-between">
                                    <p
                                    class="flex bg-green-500 text-green-100 text-md text-center items-center font-medium me-2 px-2.5 py-0.5 rounded">
                                    Tersedia
                                    </p>
                                        <a href="/form-peminjaman?ruangan={{ $item->id }}"
                                            class="flex justify-end items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            Ajukan Peminjaman
                                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                            </svg>
                                        </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
