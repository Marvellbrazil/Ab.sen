<x-app-layout>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <x-app.navbar />
        <div class="pt-7 pb-6 bg-cover"
            style="background-image: url('../assets/img/header-orange-purple.jpg'); background-position: bottom;">
        </div>
        <div class="container">
            <div class="card card-body py-2 bg-transparent shadow-none">
                <div class="row">
                    <div class="col-auto">
                        <div
                            class="avatar avatar-2xl rounded-circle position-relative mt-n7 border border-gray-100 border-4 overflow-hidden">
                            <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="profile_image"
                                class="w-100 h-100 object-fit-cover">
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h3 class="mb-0 font-weight-bold">
                                {{ Auth::user()->username }}
                            </h3>
                            <p class="mb-0">
                                {{ Auth::user()->email }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container my-3 py-3">
            <div class="row">
                <div class="col-12 col-xl-6 mb-4">
                    <div class="card border shadow-xs h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-md-8 col-9 px-2 py-2">
                                    <h6 class="mb-0 font-weight-semibold text-lg">Informasi Profil</h6>
                                    <p class="text-sm mb-1">Berisi informasi tentang profil anda.</p>
                                </div>
                                <div class="col-md-4 col-3 text-end">
                                    <a href="{{ route('profil.edit', Auth::user()->id_user) }}">
                                        <button type="button" class="btn btn-white btn-icon px-2 py-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                viewBox="0 0 24 24" fill="currentColor">
                                                <path
                                                    d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                                            </svg>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <ul class="list-group">
                                <li
                                    class="list-group-item border-0 ps-0 text-dark font-weight-semibold pt-0 pb-1 text-sm">
                                    <span class="text-secondary">Username:</span> &nbsp; {{ Auth::user()->username }}
                                </li>
                                <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                    <span class="text-secondary">Email</span> &nbsp; {{ Auth::user()->email }}
                                </li>
                                <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                    <span class="text-secondary">Role:</span> &nbsp;
                                    {{ Str::ucfirst(Auth::user()->role) }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-6 mb-4">
                    <div class="card border shadow-xs h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-md-8 col-9 px-2 py-2">
                                    <h6 class="mb-0 font-weight-semibold text-lg">Detail Akun</h6>
                                    <p class="text-sm mb-1">Berisi informasi detail tentang akun anda.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <p class="text-sm mb-4">
                            <ul class="list-group">
                                <li
                                    class="list-group-item border-0 ps-0 text-dark font-weight-semibold pt-0 pb-1 text-sm">
                                    <span class="text-secondary">Akun Terbuat Pada:</span> &nbsp;
                                    {{ Auth::user()->created_at }}
                                </li>
                                <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                    <span class="text-secondary">Perubahan Terakhir Pada:</span> &nbsp;
                                    {{ Auth::user()->updated_at }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <x-app.footer />
        </div>
    </div>
</x-app-layout>