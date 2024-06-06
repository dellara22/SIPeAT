@extends('layouts.user')

@section('content')
    @include('layouts.navbars.auth.navbar')
    <div class=" pt-24 pb-24 h-full w-full flex justify-center items-center">
        <div class=" bg-transparent w-1/2 ">
            <div class="flex justify-center  ">
                <h1 class="text-white font-bold text-xl bg-[#192257] w-5/6 text-center py-2 rounded-sm">Keterangan Peminjaman
                </h1>
            </div>
            <div class="bg-white text-white mt-3 p-4 rounded-lg">
                <form class="flex flex-col gap-3" enctype="multipart/form-data" id="myForm"
                    action="{{ route('update-peminjaman', $peminjaman) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @if ($peminjaman->addedby == Auth::user()->id)
                        {{-- Ruangan --}}
                        <div>
                            <label for="ruangan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                RUANGAN<span class=" text-red-700">*</span>
                            </label>
                            <select id="ruangan" name="ruangan"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">

                                @foreach ($ruangans as $ruang)
                                    @if ($peminjaman->ruangan == $ruang->id)
                                        <option selected value="{{ $ruang->id }}">{{ $ruang->name }}
                                        </option>
                                    @else
                                        <option value="{{ $ruang->id }}">{{ $ruang->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        {{-- Tanggal --}}
                        <div>
                            <label for="tanggal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                TANGGAL<span class=" text-red-700">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input datepicker type="text" name="tanggal"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
                                    placeholder="Select date" value="{{ $formattedDate }}">
                            </div>
                        </div>

                        {{-- Nama Kegiatan --}}
                        <div>
                            <label for="kegiatan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NAMA
                                KEGIATAN/ACARA<span class=" text-red-700">*</span></label>
                            <input type="text" id="kegiatan" name="kegiatan"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Masukkan Nama Kegiatan/acara" value="{{ $peminjaman->kegiatan }}" required />
                        </div>
                        {{-- Nama Ketua Acara --}}
                        <div>
                            <label for="pemohon" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NAMA
                                KETUA PELAKSANA<span class=" text-red-700">*</span></label>
                            <input type="text" id="pemohon" name="pemohon" type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Masukkan Nama Ketua Pelaksana" value="{{ $peminjaman->pemohon }}" required />
                        </div>
                        {{-- Deskripsi Acara --}}
                        <div>
                            <label for="deskripsi"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">DESKRIPSI
                                KEGIATAN/ACARA<span class=" text-red-700">*</span></label>
                            <textarea id="deskripsi" name="deskripsi" rows="4"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Masukkan Deskripsi Kegiatan/Acara...">{{ $peminjaman->deskripsi }}</textarea>
                        </div>
                        {{-- Upload Surat Permohonan --}}
                        <div>

                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="surat">UPLOAD
                                SURAT PERMOHONAN<span class=" text-red-700">*</span></label>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                id="surat" name="surat" type="file">

                        </div>
                        {{-- Submit btn --}}

                        <div class=" flex justify-end">
                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Simpan</button>
                            <button type="button"
                                class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center  mb-2"
                                onclick="resetForm()">Reset</button>

                        </div>
                    @else
                        {{-- Ruangan --}}
                        <div>
                            <label for="ruangan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                RUANGAN<span class=" text-red-700">*</span>
                            </label>

                            @foreach ($ruangans as $ruang)
                                @if ($peminjaman->ruangan == $ruang->id)
                                    <input type="text" id="ruangan" name="ruangan"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Masukkan Nama Kegiatan/acara" value="{{ $ruang->name }}" disabled />
                                @endif
                            @endforeach
                        </div>
                        {{-- Tanggal --}}
                        <div>
                            <label for="tanggal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                TANGGAL<span class=" text-red-700">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input datepicker type="text" name="tanggal"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
                                    placeholder="Select date" disabled value="{{ $formattedDate }}">
                            </div>
                        </div>

                        {{-- Nama Kegiatan --}}
                        <div>
                            <label for="kegiatan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NAMA
                                KEGIATAN/ACARA<span class=" text-red-700">*</span></label>
                            <input type="text" id="kegiatan" name="kegiatan"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Masukkan Nama Kegiatan/acara" value="{{ $peminjaman->kegiatan }}"
                                disabled />
                        </div>
                        {{-- Nama Ketua Acara --}}
                        <div>
                            <label for="pemohon"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NAMA
                                KETUA PELAKSANA<span class=" text-red-700">*</span></label>
                            <input type="text" id="pemohon" name="pemohon"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Masukkan Nama Ketua Pelaksana" value="{{ $peminjaman->pemohon }}"
                                disabled />
                        </div>
                        {{-- Deskripsi Acara --}}
                        <div>
                            <label for="deskripsi"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">DESKRIPSI
                                KEGIATAN/ACARA<span class=" text-red-700">*</span></label>
                            <textarea id="deskripsi" name="deskripsi" rows="4" disabled
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Masukkan Deskripsi Kegiatan/Acara...">{{ $peminjaman->deskripsi }}</textarea>
                        </div>
                        {{-- Upload Surat Permohonan --}}
                        <div>

                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="surat">PREVIEW
                                SURAT PERMOHONAN<span class=" text-red-700">*</span></label>
                            <embed src="{{ asset('pdf/peminjaman/' . $peminjaman->surat) }}" type="application/pdf"
                                width="100%" height="600px" frameborder="0">

                        </div>
                    @endrole
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const form = document.getElementById('myForm');
        const originalValues = {
            ruangan: form.ruangan.value,
            tanggal: form.tanggal.value,
            kegiatan: form.kegiatan.value,
            pemohon: form.pemohon.value,
            deskripsi: form.deskripsi.value
        };

        window.handleReset = function() {
            form.ruangan.value = originalValues.ruangan;
            form.tanggal.value = originalValues.tanggal;
            form.kegiatan.value = originalValues.kegiatan;
            form.pemohon.value = originalValues.pemohon;
            form.deskripsi.value = originalValues.deskripsi;

            // Clear file input
            form.surat.value = '';
        }
    });
</script>
@endsection
