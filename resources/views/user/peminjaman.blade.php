@extends('layouts.guest')

@section('content')
    @include('layouts.navbars.auth.navbar')
    <div class="h-screen w-full flex justify-center items-center">
        <div class=" bg-transparent w-4/5 ">
            <div class="flex justify-end ">
                <button class=" bg-green-300 px-5 py-3 rounded-md font-bold text-green-600">+ Tambah Peminjaman</button>
            </div>
            <div class="bg-[#192257] text-white mt-3 p-4 rounded-lg">
                <div>
                    <h1 class="font-semibold pt-3 ">Sedang Berlangsung</h1>
                    <table class="w-full rounded-lg">
                        <tbody class="w-full rounded-lg flex flex-col gap-3">
                            <tr class="bg-white rounded-lg text-black flex justify-between items-center pr-4">
                                <td class="gap-0 leading-none p-2 rounded-l-lg pl-4">
                                    <p class="font-extrabold text-lg min-w-36">Aula FMIPA</p>
                                    <p>Gedung D</p>
                                </td>
                                <td class="text-slate-500">24 April 2024</td>
                                <td class=" text-slate-500">10.00 WIB</td>
                                <td>
                                    <span
                                        class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded">
                                        Booking
                                    </span>
                                </td>
                                <td class="p-2 rounded-r-lg">Action</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                    <h1 class="font-semibold pt-3">Riwayat Peminjaman</h1>
                    <table class="w-full rounded-lg">
                        <tbody class="w-full rounded-lg flex flex-col gap-3">
                            <tr class="bg-white rounded-lg text-black flex justify-between items-center pr-4">
                                <td class="gap-0 leading-none p-2 rounded-l-lg pl-4">
                                    <p class="font-extrabold text-lg min-w-36">Teater FMIPA</p>
                                    <p>Gedung D</p>
                                </td>
                                <td class="text-slate-500">18 April 2024</td>
                                <td class=" text-slate-500">13.00 WIB</td>
                                <td>
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded">
                                        Selesai
                                    </span>
                                </td>
                                <td class="p-2 rounded-r-lg">Action</td>
                            </tr>

                            <tr class="bg-white rounded-lg text-black flex justify-between items-center pr-4">
                                <td class="gap-0 leading-none p-2 rounded-l-lg pl-4">
                                    <p class="font-extrabold text-lg min-w-36">Teater FMIPA</p>
                                    <p>Gedung D</p>
                                </td>
                                <td class="text-slate-500 ">18 April 2024</td>
                                <td class=" text-slate-500">13.00 WIB</td>
                                <td>
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded">
                                        Selesai
                                    </span>
                                </td>
                                <td class="p-2 rounded-r-lg">Action</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
