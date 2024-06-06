@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    <div class="container-fluid py-4">
        <div class="row">

            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 w-100">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row d-flex justify-content-center">
                            <div class="col-lg-6 mb-lg-0 mb-4"
                                style="background-color:#7077A1; border-radius:15px; padding-top:10px; padding-bottom:10px;">
                                <form action="{{ route('peminjaman.update', $peminjaman) }}" method="POST"
                                    id="peminjamanForm" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="pemohon" class="form-label">Nama Pemohon</label>
                                        <input type="text" class="form-control" id="pemohon" name="pemohon"
                                            placeholder="Masukkan Nama Pemohon" value="{{ $peminjaman->pemohon }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="ruangan" class="form-label">Ruangan</label>
                                        <select class="form-select" aria-label="Default select example" required
                                            name="ruangan">
                                            <option>Pilih Ruang</option>
                                            @foreach ($ruangan as $item)
                                                @if ($peminjaman->ruangan == $item->id)
                                                    <option selected value="{{ $item->id }}">{{ $item->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endif
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggal" class="form-label">Tanggal</label>
                                        <input type="date" class="form-control" id="tanggal" name="tanggal"
                                            value="{{ $peminjaman->tanggal }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Upload Surat</label>
                                        <input class="form-control" type="file" id="formFile" name="surat">
                                    </div>

                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-select" aria-label="Default select example" required
                                            name="status">
                                            <option selected>Pilih Status</option>
                                            <option value="1">DIBATALKAN
                                            </option>

                                            <option value="2">DITOLAK</option>
                                            <option value="3">DISETUJUI</option>
                                        </select>
                                    </div>
                                    {{-- <div class="mb-3">
                                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" id="password_confirmation"
                                            name="password_confirmation" placeholder="Masukkan Password"
                                            title="Password harus terdiri dari 8 karakter">
                                    </div> --}}
                                    <div class="d-flex justify-content-end gap-2">
                                        <button type="submit" class="btn"
                                            style="background-color: #5e72e4; color:white;">Save</button>
                                        <button type="button" class="btn btn-warning"
                                            onclick="handleReset()">Reset</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal"><a href="{{route('admin.peminjaman')}}" class="text-white hover:text-white">Close</a></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        @include('layouts.footers.auth.footer')
    </div>
@endsection

@push('js')
    <script src="./assets/js/plugins/chartjs.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const form = document.getElementById('peminjamanForm');
            const originalValues = {
                pemohon: form.pemohon.value,
                ruangan: form.ruangan.value,
                tanggal: form.tanggal.value,
                status: form.status.value,
            };

            window.handleReset = function() {
                form.pemohon.value = originalValues.pemohon;
                form.ruangan.value = originalValues.ruangan;
                form.tanggal.value = originalValues.tanggal;
                form.status.value = originalValues.status;
            }
        });
    </script>
@endpush
