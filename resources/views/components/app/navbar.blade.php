<nav class="navbar navbar-main navbar-expand-lg mx-5 px-0 shadow-none rounded" id="navbarBlur" navbar-scroll="true" aria-label="breadcrumb">
    <div class="container-fluid py-1 px-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-1 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('dashboard') }}">Ab.sen</a>
                </li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">{{ Str::title(request()->segment(1)) }}</li>
            </ol>
            <h6 class="font-weight-bold mb-0">{{ Str::title(request()->segment(1)) }}</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div class="input-group">
                    <span class="input-group-text text-body bg-white  border-end-0 ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </span>
                    <input type="text" class="form-control ps-0" placeholder="Search">
                </div>
            </div>
            <div class="mb-0 me-2 font-weight-bold breadcrumb-text text-white">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="login" onclick="event.preventDefault();
                this.closest('form').submit();">
                        <button class="btn btn-sm btn-white mb-0 me-1 bg-dark text-white" type="submit">Log out</button>
                    </a>
                </form>
            </div>
            <ul class="navbar-nav justify-content-end">
                <li class="nav-item dropdown pe-2 d-flex align-items-center">
                    <a href="{{ route('notifikasi.index') }}" class="nav-link text-body p-0" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="currentColor" class="cursor-pointers">
                            <path fill-rule="evenodd"
                                d="M5.25 9a6.75 6.75 0 0113.5 0v.75c0 2.123.8 4.057 2.118 5.52a.75.75 0 01-.297 1.206c-1.544.57-3.16.99-4.831 1.243a3.75 3.75 0 11-7.48 0 24.585 24.585 0 01-4.831-1.244.75.75 0 01-.298-1.205A8.217 8.217 0 005.25 9.75V9zm4.502 8.9a2.25 2.25 0 104.496 0 25.057 25.057 0 01-4.496 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                </li>
                <li class="nav-item ps-2 d-flex align-items-center">
                    <a href="{{ route('profil.index') }}" class="nav-link text-body p-0">
                        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" class="avatar avatar-sm" alt="avatar" />
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
