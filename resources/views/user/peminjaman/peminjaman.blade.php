@extends('layouts.user')

@section('content')
    @include('layouts.navbars.auth.navbar')
    <div class="h-screen w-full flex justify-center items-center">
        <div class=" bg-transparent w-4/5 ">
            <div class="flex justify-end ">
                <a href="{{ route('form-peminjaman') }}" class=" bg-green-300 px-5 py-3 rounded-md font-bold text-green-600">+
                    Tambah
                    Peminjaman</a>
            </div>
            <div class="bg-[#192257] text-white mt-3 p-4 rounded-lg">
                <div>
                    <h1 class="font-semibold pt-3 ">Disetujui</h1>
                    <table class="w-full rounded-lg">
                        <tbody class="w-full rounded-lg flex flex-col gap-3">
                            @foreach ($disetujui as $item)
                                @if ($item->addedby == Auth::id())
                                    @php
                                        $room = \App\Models\Ruangan::where('id', $item->ruangan)->first();
                                    @endphp
                                    <tr class="bg-white rounded-lg text-black flex justify-between items-center pr-4">
                                        <td class="gap-0 leading-none p-2 rounded-l-lg pl-4">
                                            <p class="font-extrabold text-lg min-w-36">{{ $room->name }}</p>
                                        </td>
                                        <td class="gap-0 leading-none p-2 rounded-l-lg pl-4">
                                            <p class=" font-extralight text-lg min-w-36">{{ $item->pemohon }}</p>
                                        </td>
                                        @php
                                            $formattedDate = Carbon\Carbon::createFromFormat(
                                                'Y-m-d',
                                                $item->tanggal,
                                            )->format('d F Y');
                                        @endphp
                                        <td class="text-slate-500">{{ $formattedDate }}</td>
                                        <td>
                                            <span
                                                class="bg-green-500 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded-full">
                                                DISETUJI
                                            </span>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div>
                    <h1 class="font-semibold pt-3">Dibatalkan</h1>
                    <table class="w-full rounded-lg">
                        <tbody class="w-full rounded-lg flex flex-col gap-3">
                            @foreach ($dibatalkan as $item)
                                @if ($item->addedby == Auth::id())
                                    @php
                                        $room = \App\Models\Ruangan::where('id', $item->ruangan)->first();
                                    @endphp
                                    <tr class="bg-white rounded-lg text-black flex justify-between items-center pr-4">
                                        <td class="gap-0 leading-none p-2 rounded-l-lg pl-4">
                                            <p class="font-extrabold text-lg min-w-36">{{ $room->name }}</p>
                                        </td>
                                        <td class="gap-0 leading-none p-2 rounded-l-lg pl-4">
                                            <p class=" font-extralight text-lg min-w-36">{{ $item->pemohon }}</p>
                                        </td>
                                        @php
                                            $formattedDate = Carbon\Carbon::createFromFormat(
                                                'Y-m-d',
                                                $item->tanggal,
                                            )->format('d F Y');
                                        @endphp
                                        <td class="text-slate-500">{{ $formattedDate }}</td>
                                        <td>
                                            <span
                                                class="bg-yellow-400 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded-full">
                                                DIBATALKAN
                                            </span>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div>
                    <h1 class="font-semibold pt-3">Ditolak</h1>
                    <table class="w-full rounded-lg">
                        <tbody class="w-full rounded-lg flex flex-col gap-3">
                            @foreach ($ditolak as $item)
                                @if ($item->addedby == Auth::id())
                                    @php
                                        $room = \App\Models\Ruangan::where('id', $item->ruangan)->first();
                                    @endphp
                                    <tr class="bg-white rounded-lg text-black flex justify-between items-center pr-4">
                                        <td class="gap-0 leading-none p-2 rounded-l-lg pl-4">
                                            <p class="font-extrabold text-lg min-w-36">{{ $room->name }}</p>
                                        </td>
                                        <td class="gap-0 leading-none p-2 rounded-l-lg pl-4">
                                            <p class=" font-extralight text-lg min-w-36">{{ $item->pemohon }}</p>
                                        </td>
                                        @php
                                            $formattedDate = Carbon\Carbon::createFromFormat(
                                                'Y-m-d',
                                                $item->tanggal,
                                            )->format('d F Y');
                                        @endphp
                                        <td class="text-slate-500">{{ $formattedDate }}</td>
                                        <td>
                                            <span
                                                class="bg-red-800 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded-full">
                                                DITOLAK
                                            </span>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
