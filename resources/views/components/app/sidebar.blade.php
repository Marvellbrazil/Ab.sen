<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 bg-white fixed-start" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand d-flex align-items-center m-0"
            href="{{ route('dashboard') }}" target="_self">
            <img src="{{ asset('assets/img/abdotsen.png') }}" class="w-20 h-20 me-2" alt="Logo">
            <span class="font-weight-bold text-lg">Ab.sen</span>
        </a>
    </div>
    <div class="collapse navbar-collapse px-4 w-auto overflow-hidden" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <x-side-navitem route="dashboard" icon="bi bi-graph-up" itemname="Dashboard" />
            <x-side-navitem route="kelas.index" icon="bi bi-diagram-3-fill" itemname="Kelas" />
            <x-side-navitem route="notifikasi.index" icon="bi bi-bell-fill" itemname="Notifikasi" />
            <x-side-navitem route="profil.index" icon="bi bi-person-fill" itemname="Profil" />
        </ul>
    </div>
</aside>