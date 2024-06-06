@extends('layouts.user')

@section('content')
    @include('layouts.navbars.auth.navbar')

    <div class="h-screen w-full flex justify-center items-center">
        <div id='calendar' class="bg-white p-6 mt-20 rounded-lg w-[500px]"></div>
    </div>

    <!-- Main modal -->
    <div id="select-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 bg-black bg-opacity-50 z-50 flex justify-center items-center w-full inset-0 h-full modal-transition">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Daftar Peminjaman
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="select-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    <p class="text-gray-500 dark:text-gray-400 mb-4" id="tanggal"> </p>
                    <ul id="list-peminjaman" class="space-y-4 mb-4">

                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        var eventss = {!! $events !!};
        var modal = document.getElementById('select-modal');
        var ulElement = document.getElementById('list-peminjaman');

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                height: 600,
                aspectRatio: 1,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth'
                },
                initialDate: '2024-05-12',
                events: eventss

            });
            calendar.on('dateClick', function(info) {
                console.log('clicked on ' + info.dateStr);
                console.log(info);

                fetch('/peminjaman/check?date=' + info.dateStr)
                    .then(response => response.text())
                    .then(text => {
                        console.log('Raw response:', text); // Log respons mentah
                        const data = JSON.parse(text);
                        // console.log(data);
                        if (data.exist == true) {
                            document.getElementById('tanggal').innerHTML = 'Tanggal : ' + info.dateStr
                            modal.classList.remove('hidden'); // Show the modal
                            document.body.classList.add(
                                'overflow-hidden'); // Prevent scrolling behind modal
                            data.peminjaman.forEach((item) => {
                                var status = '';
                                if (item.status == '1') {
                                    status =
                                        '<span class="bg-yellow-400 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded">DIBATALKAN</span>'
                                } else if (item.status == '2') {
                                    status =
                                        '<span class="bg-red-800 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded">DITOLAK</span>'
                                } else {
                                    status =
                                        '<span class="bg-green-500 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded">DITERIMA</span>'
                                }


                                var liElement = document.createElement('li');
                                liElement.innerHTML = `
                            <a href="/edit/peminjaman?id=${item.id}" class="inline-flex items-center justify-between w-full p-5 text-gray-900 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-500 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-900 hover:bg-gray-100 dark:text-white dark:bg-gray-600 dark:hover:bg-gray-500">
                                <div class="block">
                                    <div class="w-full text-lg font-semibold">${item.pemohon}</div>
                                    <div class="w-full text-gray-500 dark:text-gray-400">${item.kegiatan}</div>
                                </div>
                                ${status}
                                <svg class="w-4 h-4 ms-3 rtl:rotate-180 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                </svg>
                            </a>
    `;
                                ulElement.appendChild(liElement);
                            });
                            // Swal.fire({
                            //     title: 'Sudah Ada Peminjaman',
                            //     text: "Lihat peminjaman?",
                            //     icon: 'info',
                            //     showCancelButton: true,
                            //     confirmButtonColor: '#3085d6',
                            //     cancelButtonColor: '#d33',
                            //     confirmButtonText: 'Yes'
                            // }).then((result) => {
                            //     if (result.isConfirmed) {
                            //         var url = '/peminjaman/keterangan?date=' + info.dateStr;
                            //         window.location.href = url;
                            //     }
                            // });

                        } else if (data.exist == false) {
                            Swal.fire({
                                title: 'Tidak Ada Peminjaman',
                                text: "Tidak ada peminjaman pada tanggal ini. Apakah Anda ingin membuat peminjaman baru?",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = '/form-peminjaman?date=' + info
                                        .dateStr;
                                }
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'Error',
                            text: 'An error occurred while checking peminjaman.',
                            icon: 'error'
                        });
                    });
            });
            modal.querySelectorAll('[data-modal-toggle]').forEach(function(button) {
                button.addEventListener('click', function(event) {
                    modal.classList.add('hidden'); // Hide the modal
                    document.body.classList.remove('overflow-hidden'); // Restore scrolling

                    while (ulElement.hasChildNodes()) {
                        ulElement.removeChild(ulElement.firstChild);
                    }
                });
            });
            calendar.render();
        });



        // function confirmDelete() {
        //     event.preventDefault();
        //     Swal.fire({
        //         title: 'Tidak Ada Peminjaman',
        //         text: "Tidak ada peminjaman pada tanggal ini. Apakah anda ingin membuat yang baru?",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Ya, Buat baru!',
        //         cancelButtonText: 'Batal'
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             window.location.href = '/form-peminjaman';
        //         }
        //     })
        // }
    </script>
@endsection
