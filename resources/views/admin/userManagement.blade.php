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
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">User</p>
                                    <h5 class="font-weight-bolder">
                                        {{ $totalpengguna }}
                                    </h5>
                                    <p class="mb-0" style="width: 250px">

                                        Total User
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
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Jurusan</p>
                                    <h5 class="font-weight-bolder">
                                        {{ $jurusan }}
                                    </h5>
                                    <p class="mb-0" style="width: 250px">

                                        Total Jurusan
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
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Admin</p>
                                    <h5 class="font-weight-bolder">
                                        {{ $totaladmin }}
                                    </h5>
                                    <p class="mb-0" style="width: 250px">

                                        Total Admin
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
            <div class="col-lg-12 mb-lg-0 mb-4">
                <div class="card ">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#tambahpengguna">+ Tambah Pengguna</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped align-items-center">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th>PENGGUNA</th>
                                    <th>EMAIL</th>
                                    <th>NO. TELP</th>
                                    <th class="text-center">ROLE</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @if ($totalpengguna != 0)
                                    @foreach ($pengguna as $item)
                                        <tr>
                                            <td class="text-center">{{ $no }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->no_hp }}</td>
                                            <td class="text-center">
                                                User
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada data pengguna</td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="tambahpengguna" tabindex="-1" aria-labelledby="tambahpenggunalabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pengguna</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <img width="20" height="20" src="https://img.icons8.com/ios/50/x-coordinate.png"
                                alt="x-coordinate" />
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('pengguna.store') }}" method="POST" id="penggunaForm">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Masukkan Nama">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Masukkan Email">
                            </div>
                            <div class="mb-3">
                                <label for="no_hp" class="form-label">No. Telp</label>
                                <input type="text" class="form-control" id="no_hp" name="no_hp"
                                    pattern="\d{10,13}" placeholder="Masukkan No. Telp"
                                    title="Nomor telepon harus terdiri angka">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Masukkan Password" title="Password harus terdiri dari 8 karakter">
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
                                <button type="button" class="btn btn-warning" onclick="handleReset()">Reset</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                    {{-- <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div> --}}
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
            const form = document.getElementById('penggunaForm');
            const originalValues = {
                name: form.name.value,
                email: form.email.value,
                no_hp: form.no_hp.value,
                password: form.password.value,
            };

            window.handleReset = function() {
                form.name.value = originalValues.name;
                form.email.value = originalValues.email;
                form.no_hp.value = originalValues.no_hp;
                form.password.value = originalValues.password;
            }
        });
    </script>
@endpush
