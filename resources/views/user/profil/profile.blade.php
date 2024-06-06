@extends('layouts.user')

@section('content')
    @include('layouts.navbars.auth.navbar')
    <div class="h-screen w-full flex justify-center items-center">
        <div class=" bg-transparent w-1/4">
            <div class="flex flex-col justify-center items-center bg-[#192257] p-6 rounded-lg">
                <div>
                    <svg class="w-20 h-20 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="40"
                        height="40" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M12 20a7.966 7.966 0 0 1-5.002-1.756l.002.001v-.683c0-1.794 1.492-3.25 3.333-3.25h3.334c1.84 0 3.333 1.456 3.333 3.25v.683A7.966 7.966 0 0 1 12 20ZM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10c0 5.5-4.44 9.963-9.932 10h-.138C6.438 21.962 2 17.5 2 12Zm10-5c-1.84 0-3.333 1.455-3.333 3.25S10.159 13.5 12 13.5c1.84 0 3.333-1.455 3.333-3.25S13.841 7 12 7Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>

                <form method="post" action="{{ route('profil.update') }}" class="flex flex-col gap-3 w-full"
                    id="profileForm">
                    @csrf
                    @method('patch')
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-white">NAMA
                            KETUA</label>
                        <input type="text" id="name" name="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="{{ $user->name }}" required />
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-white">Email</label>
                        <input type="email" id="email" name="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="{{ $user->email }}" required />
                    </div>
                    <div>
                        <label for="no_hp" class="block mb-2 text-sm font-medium text-white">No. HP</label>
                        <input type="text" id="no_hp" name="no_hp" pattern="[0-9]{12}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            @if ($user->no_hp) value={{ $user->no_hp }}
                            @else
                                placeholder="Masukkan Nomor HP" @endif
                            {{-- placeholder="081234566789" --}} />
                    </div>

                    <div class=" mt-6">
                        <div class="flex">
                            <button type="submit"
                                class="text-white w-1/2 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Simpan</button>
                            <button type="button"
                                class="text-blue-700 w-1/2 hover:text-white border bg-white border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center  mb-2"
                                onclick="handleReset()">Reset</button>
                        </div>
                        @if (session('status') === 'profile-updated')
                            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const form = document.getElementById('profileForm');
            const originalValues = {
                name: form.name.value,
                email: form.email.value,
                no_hp: form.no_hp.value
            };

            window.handleReset = function() {
                form.name.value = originalValues.name;
                form.email.value = originalValues.email;
                form.no_hp.value = originalValues.no_hp;
            }
        });
    </script>
@endsection
