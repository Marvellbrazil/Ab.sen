<nav class="navbar navbar-main navbar-expand-lg mx-5 px-0 shadow-none rounded">
    <div class="container-fluid py-1 px-2">
        <div class="d-flex align-items-center w-100">
            <!-- Hamburger Menu untuk Mobile & Tablet -->
            <div class="d-xl-none me-3">
                <button class="btn btn-transparent border-0 p-1" type="button" id="simpleMobileMenuButton">
                    <i class="fas fa-bars fa-lg"></i>
                </button>
                <div class="mobile-menu" id="simpleMobileMenu" style="display: none;">
                    <div class="mobile-menu-content p-3">
                        <a class="menu-item {{ request()->segment(1) == 'dashboard' ? 'active' : '' }}"
                            href="{{ route('dashboard') }}">
                            <i class="bi bi-graph-up me-2"></i>Dashboard
                        </a>
                        <a class="menu-item {{ request()->segment(1) == 'kelas' ? 'active' : '' }}"
                            href="{{ route('kelas.index') }}">
                            <i class="bi bi-diagram-3-fill me-2"></i>Kelas
                        </a>
                        <a class="menu-item {{ request()->segment(1) == 'notifikasi' ? 'active' : '' }}"
                            href="{{ route('notifikasi.index') }}">
                            <i class="bi bi-bell-fill me-2"></i>Notifikasi
                        </a>
                        <a class="menu-item {{ request()->segment(1) == 'profil' ? 'active' : '' }}"
                            href="{{ route('profil.index') }}">
                            <i class="bi bi-person-fill me-2"></i>Profil
                        </a>

                        <hr>

                        <div class="input-group mb-2">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="fas fa-search text-sm"></i>
                            </span>
                            <input type="text" class="form-control border-start-0" placeholder="Search">
                        </div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-sm btn-dark w-110 text-white" type="submit">
                                <i class="fas fa-right-from-bracket me-2"></i>Log out
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="flex-grow-1">
                <ol class="breadcrumb bg-transparent mb-1 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark"
                            href="{{ route('dashboard') }}">Ab.sen</a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">
                        {{ Str::title(request()->segment(1)) }}</li>
                </ol>
                <h6 class="font-weight-bold mb-0">{{ Str::title(request()->segment(1)) ?: 'Dashboard' }}</h6>
            </nav>

            <!-- Desktop Content -->
            <div class="d-none d-xl-flex align-items-center">
                <div class="input-group me-3">
                    <span class="input-group-text text-body bg-white border-end-0">
                        <i class="fas fa-search text-sm"></i>
                    </span>
                    <input type="text" class="form-control ps-0 border-start-0" placeholder="Search">
                </div>

                <form method="POST" action="{{ route('logout') }}" class="me-3">
                    @csrf
                    <button class="btn btn-sm px-3 btn-dark mb-0 text-white d-inline-flex align-items-center" type="submit">
                        <i class="fas fa-right-from-bracket me-2"></i>Logout
                    </button>
                </form>

                <div class="d-flex align-items-center">
                    <a href="{{ route('notifikasi.index') }}" class="nav-link text-body p-0 me-3">
                        <i class="fas fa-bell"></i>
                    </a>
                    <a href="{{ route('profil.index') }}" class="nav-link text-body p-0">
                        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" class="avatar avatar-sm"
                            alt="avatar" />
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>

<style>
.mobile-menu {
    position: absolute;
    top: 100%;
    left: 1rem;
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    z-index: 1000;
    min-width: 250px;
}

.menu-item {
    display: block;
    padding: 10px 15px;
    border-radius: 6px;
    margin-bottom: 4px;
    color: #333;
    text-decoration: none;
}

.menu-item:hover,
.menu-item.active {
    background-color: #f8f9fa;
    color: #000;
}
</style>

<script>
// Simple mobile menu toggle
document.getElementById('simpleMobileMenuButton').addEventListener('click', function() {
    const menu = document.getElementById('simpleMobileMenu');
    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
});

// Close menu when clicking outside
document.addEventListener('click', function(e) {
    if (!e.target.closest('.d-xl-none')) {
        document.getElementById('simpleMobileMenu').style.display = 'none';
    }
});
</script>