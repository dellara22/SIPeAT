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
                                <form action="{{ route('jurusan.update', $jurusan) }}" method="POST" id="jurusanForm">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama Jurusan</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ $jurusan->name }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="nama_ketua" class="form-label">Ketua Jurusan</label>
                                        <input type="text" class="form-control" id="nama_ketua" name="nama_ketua"
                                            value="{{ $jurusan->nama_ketua }}">
                                    </div>
                                    <div>
                                        <button type="submit" class="btn"
                                            style="background-color: #5e72e4; color:white;">Save</button>
                                        <button type="button" class="btn btn-warning"
                                            onclick="handleReset()">Reset</button>
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
@endpush
