@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Peminjaman</p>
                                    <h5 class="font-weight-bolder">
                                        {{ $total }}
                                    </h5>
                                    <p class="mb-0 " style="width: 250px">
                                        Total Peminjaman
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
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Disetujui</p>
                                    <h5 class="font-weight-bolder">
                                        {{ $totalsetuju }}
                                    </h5>
                                    <p class="mb-0" style="width: 250px">
                                        Peminjaman Disetujui
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
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Ditolak</p>
                                    <h5 class="font-weight-bolder">
                                        {{ $totaltdksetuju }}
                                    </h5>
                                    <p class="mb-0" style="width: 250px">

                                        Peminjaman Ditolak
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
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Dibatalkan</p>
                                    <h5 class="font-weight-bolder">
                                        {{ $totalbatal }}
                                    </h5>
                                    <p class="mb-0" style="width: 250px">
                                        Peminjaman Dibatalkan
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
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
                                data-bs-target="#tambahpeminjaman">+ Tambah Peminjaman</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center">
                            <thead class="border-bottom border-top">
                                <tr>
                                    <th class="text-center">PEMOHON</th>
                                    <th>RUANGAN</th>
                                    <th>TANGGAL</th>
                                    <th class="text-center">SURAT</th>
                                    <th class="text-center">STATUS</th>
                                    <th class="text-center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @if ($total != 0)
                                    @foreach ($peminjaman as $item)
                                        @php
                                            $room = \App\Models\Ruangan::where('id', $item->ruangan)->first();
                                        @endphp
                                        <tr>
                                            <td class="text-center">{{ $item->pemohon }}</td>
                                            <td>{{ $room->name }}</td>
                                            <td>{{ $item->tanggal }}</td>
                                            <td class="text-center align-items-center">
                                                <a href="{{ asset('/pdf/peminjaman/' . $item->surat) }}"
                                                    style="padding: 3px 20px; border-radius: 15px; width: fit-content;"
                                                    target="_blank">
                                                    <img src="/img/doc-text-svgrepo-com.svg" width="24" alt="">
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                @if ($item->status == '1')
                                                    <span
                                                        style="background-color: #fff3e0; color: #e65100; font-size: 0.75rem; font-weight: 500; margin-right: 0.5rem; padding: 0.25rem 0.625rem; border-radius: 0.25rem; border: 1px solid #e65100;">DIBATALKAN</span>
                                                @endif

                                                @if ($item->status == '2')
                                                    <span
                                                        style="background-color: #ffebee; color: #c62828; font-size: 0.75rem; font-weight: 500; margin-right: 0.5rem; padding: 0.25rem 0.625rem; border-radius: 0.25rem; border: 1px solid #c62828;">DITOLAK</span>
                                                @endif

                                                @if ($item->status == '3')
                                                    <span
                                                        style="background-color: #e0f7fa; color: #00695c; font-size: 0.75rem; font-weight: 500; margin-right: 0.5rem; padding: 0.25rem 0.625rem; border-radius: 0.25rem; border: 1px solid #00695c;">DISETUJUI</span>
                                                @endif

                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ route('peminjaman.edit', $item) }}"
                                                        style="background-color: #5e72e4; color: white; padding: 1px 20px; border-radius: 15px;">Edit</a>
                                                    <form method="POST" action="{{ route('peminjaman.destroy', $item) }}"
                                                        id="delete{{ $item->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="{{ route('jurusan.destroy', $item) }}"
                                                            onclick="confirmDelete(event, {{ $item->id }})"
                                                            style="background-color: #f5365c; color:white; padding-top:3px; padding-bottom:3px; padding-right:20px; padding-left:20px; border-radius:15px;"
                                                            data-confirm-delete="true">Hapus</a>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center">Belum ada data peminjaman</td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="tambahpeminjaman" tabindex="-1" aria-labelledby="tambahpeminjamanlabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Peminjaman</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <img width="20" height="20" src="https://img.icons8.com/ios/50/x-coordinate.png"
                                alt="x-coordinate" />
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('peminjaman.store') }}" method="POST" id="peminjamForm"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="pemohon" class="form-label">Nama Pemohon</label>
                                <input type="text" class="form-control" id="pemohon" name="pemohon"
                                    placeholder="Masukkan Nama Pemohon" required>
                            </div>
                            <div class="mb-3">
                                <label for="ruangan" class="form-label">Ruangan</label>
                                <select class="form-select" aria-label="Default select example" required name="ruangan">
                                    <option selected>Pilih Ruang</option>
                                    @foreach ($ruangan as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal">
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Upload Surat</label>
                                <input class="form-control" type="file" id="formFile" name="surat">
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
