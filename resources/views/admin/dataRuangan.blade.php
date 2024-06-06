@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Ruangan</p>
                                    <h5 class="font-weight-bolder">
                                        {{ $total }}
                                    </h5>
                                    <p class="mb-0 " style="width: 250px">
                                        Total Ruangan saat ini
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Tersedia</p>
                                    <h5 class="font-weight-bolder">
                                        {{ $tersedia }}
                                    </h5>
                                    <p class="mb-0" style="width: 250px">

                                        Ruangan yang tersedia
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Tidak Tersedia</p>
                                    <h5 class="font-weight-bolder">
                                        {{ $tidaktersedia }}
                                    </h5>
                                    <p class="mb-0" style="width: 250px">

                                        Ruangan sedang dipinjam
                                    </p>
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
                        <form method="POST" action="{{ route('ruangan.store') }}" id="jurusanForm"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Ruangan</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    aria-describedby="name">
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">DESKRIPSI</label>
                                <textarea name="deskripsi" id="deskripsi" cols="25" rows="5" class="form-control"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="thumbnail" class="form-label">Thumbnail</label>
                                <input class="form-control" type="file" id="thumbnail" name="thumbnail">
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
                        <table class="table align-items-center">
                            <thead class="border-bottom border-top">
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th>Thumbnail</th>
                                    <th>Nama</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @if ($total != 0)
                                    @foreach ($ruangan as $item)
                                        <tr>
                                            <td class="text-center">{{ $no++ }}</td>
                                            <td style="width: fit-content">
                                                <div style="width: fit-content">
                                                    <img src="{{ '/assets/img/ruangan/' . $item->thumbnail }}"
                                                        alt="{{ $item->thumbnail }}" width="300">
                                                </div>
                                            </td>
                                            <td>{{ $item->name }}</td>
                                            @if ($item->status == true)
                                                <td class="d-flex justify-content-center align-items-center"
                                                    style="height:170.73px">
                                                    <form method="POST" action="{{ route('ruangan.update', $item) }}"
                                                        id="update{{ $item->id }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <a href="{{ route('ruangan.update', $item) }}"
                                                            onclick="confirmUpdate(event, {{ $item->id }})"
                                                            style="background-color: #2dce89; color:white; padding:3px 20px; border-radius:15px; width:fit-content;"
                                                            data-confirm-update="true">
                                                            Tersedia
                                                        </a>
                                                    </form>
                                                </td>
                                            @else
                                                <td class="d-flex justify-content-center align-items-center"
                                                    style="height:170.73px">
                                                    <form method="POST" action="{{ route('ruangan.update', $item) }}"
                                                        id="update{{ $item->id }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <a href="{{ route('ruangan.update', $item) }}"
                                                            onclick="confirmUpdate(event, {{ $item->id }})"
                                                            style="background-color: #f5365c; color:white; padding:3px 20px; border-radius:15px; width:fit-content;"
                                                            data-confirm-update="true">
                                                            Tidak Tersedia
                                                        </a>
                                                    </form>
                                                </td>
                                            @endif

                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4" class="text-center">Belum ada data ruangan</td>
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
                deskripsi: form.deskripsi.value,
                thumbnail: form.thumbnail.value,
            };

            window.handleReset = function() {
                form.name.value = originalValues.name;
                form.deskripsi.value = originalValues.deskripsi;
                form.thumbnail.value = originalValues.thumbnail;
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function confirmUpdate(event, id) {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda akan mengubah status ruangan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Ubah!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('update' + id).submit();
                }
            })
        }
    </script>
@endpush
