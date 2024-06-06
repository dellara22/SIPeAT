@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    <div class="container-fluid py-4">
        <div class="row">

            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 w-100">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    @if ($jurusan_count > 0)
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Jurusan</p>
                                        <h5 class="font-weight-bolder">
                                            {{ $jurusan_count }}
                                        </h5>
                                        <p class="mb-0" style="width: 250px">

                                            Total Jurusan saat ini
                                        </p>
                                    @else
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Belum Ada Jurusan</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row mt-4">

            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body p-3">
                        <form method="POST" action="{{ route('jurusan.store') }}" id="jurusanForm">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Jurusan</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    aria-describedby="namaJurusan">
                            </div>
                            <div class="mb-3">
                                <label for="nama_ketua" class="form-label">Ketua Jurusan</label>
                                <input type="text" class="form-control" id="nama_ketua" name="nama_ketua">
                            </div>
                            <div>
                                <button type="submit" class="btn"
                                    style="background-color: #5e72e4; color:white;">Submit</button>
                                <button type="button" class="btn btn-warning" onclick="handleReset()">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 mb-lg-0 mb-4">
                <div class="card ">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-2">Data Jurusan</h6>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center ">
                            <thead class="border-bottom border-top">
                                <td class="d-flex justify-content-center">No.</td>
                                <td>NAMA JURUSAN</td>
                                <td class="">
                                    <div class="d-flex justify-content-center">KETUA JURUSAN</div>
                                </td>
                                <td class="d-flex justify-content-center">AKSI</td>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @if ($jurusans)
                                    @foreach ($jurusans as $jurusan)
                                        <tr>
                                            <td class="d-flex justify-content-center">{{ $no++ }}</td>
                                            <td>{{ $jurusan->name }}</td>
                                            <td class="">
                                                <div class="d-flex justify-content-center">{{ $jurusan->nama_ketua }}</div>
                                            </td>
                                            <td class="">
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ route('jurusan.edit', $jurusan) }}"
                                                        style="background-color: #5e72e4; color:white; padding-top:1px; padding-bottom:1px; padding-right:20px; padding-left:20px; border-radius:15px;">Edit</a>
                                                    <form method="POST"
                                                        action="{{ route('jurusan.destroy', $jurusan->id) }}"
                                                        id="delete{{ $jurusan->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="{{ route('jurusan.destroy', $jurusan->id) }}"
                                                            onclick="confirmDelete(event, {{ $jurusan->id }})"
                                                            style="background-color: #f5365c; color:white; padding-top:3px; padding-bottom:3px; padding-right:20px; padding-left:20px; border-radius:15px;"
                                                            data-confirm-delete="true">Hapus</a>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td>Belum Ada Data Jurusan</td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
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
            const form = document.getElementById('jurusanForm');
            const originalValues = {
                name: form.name.value,
                nama_ketua: form.nama_ketua.value,
            };

            window.handleReset = function() {
                form.name.value = originalValues.name;
                form.nama_ketua.value = originalValues.nama_ketua;
            }
        });
    </script>
    <script>
        function confirmDelete(event, id) {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan bisa mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete' + id).submit();
                }
            })
        }
    </script>
@endpush
