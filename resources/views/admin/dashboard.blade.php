<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Beranda - Ab.sen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@300;400;500&family=Montserrat:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <link rel="shortcut icon" href="assets/favicon.png" type="image/x-icon">
    <style>
    :root {
        /* spacing scale */
        --sp-xs: 6px;
        --sp-sm: 10px;
        --sp-md: 16px;
        --sp-lg: 20px;
        --sp-xl: 28px;

        --sidebar-width: 262px;
        --sidebar-collapsed-width: 80px;
        --header-height: 115px;

        --primary-gradient: linear-gradient(136deg, #F0C071 0%, white 34%, #E9DBDB 80%, #D4B6B6 100%);
        --card-gradient-1: radial-gradient(ellipse 121.53% 153.17% at 21.45% 29.73%, rgba(0, 208.25, 255, 0.10) 0%, rgba(84.87, 176.54, 115.43, 0.03) 77%, rgba(67.30, 212.09, 195.20, 0) 100%);
        --card-gradient-2: radial-gradient(ellipse 134.89% 169.09% at 15.32% 21.04%, rgba(255, 0, 0, 0.10) 0%, rgba(255, 255, 255, 0.03) 77%, rgba(234.16, 213.89, 213.89, 0) 100%);
        --card-gradient-3: radial-gradient(ellipse 137.84% 102.64% at 100.00% 5.14%, rgba(42.50, 255, 0, 0.10) 0%, rgba(43, 255, 0, 0) 100%);
        --search-gradient: radial-gradient(ellipse 99.57% 1062.91% at 0.43% 50.00%, rgba(216.75, 255, 0, 0.06) 0%, rgba(84.87, 176.54, 115.43, 0.03) 77%, rgba(67.30, 212.09, 195.20, 0) 100%);

        --border-color: rgba(0, 0, 0, 0.06);
        --shadow-strong: 2px 6px 30px rgba(0, 0, 0, 0.18);
        --transition-speed: 0.28s;
        --radius: 12px;
    }

    /* Base reset */
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: 'Montserrat', sans-serif;
    }

    html,
    body {
        height: 100%;
        background: var(--primary-gradient);
        color: #111;
        -webkit-font-smoothing: antialiased;
    }

    /* Layout */
    .dashboard-container {
        display: flex;
        min-height: 100vh;
        align-items: stretch;
    }

    /* Sidebar */
    .sidebar {
        width: var(--sidebar-width);
        background: var(--card-gradient-1);
        box-shadow: var(--shadow-strong);
        backdrop-filter: blur(18px);
        position: fixed;
        height: 100vh;
        z-index: 1000;
        transition: width var(--transition-speed) ease, transform var(--transition-speed) ease;
        overflow: hidden;
        border-right: 1px solid var(--border-color);
        display: flex;
        flex-direction: column;
    }

    .sidebar.collapsed {
        width: var(--sidebar-collapsed-width);
    }

    .sidebar-header {
        height: var(--header-height);
        padding: calc(var(--sp-md)) calc(var(--sp-lg));
        display: flex;
        align-items: center;
        gap: var(--sp-md);
        border-bottom: 1px solid var(--border-color);
        transition: justify-content var(--transition-speed) ease, padding var(--transition-speed) ease;
    }

    /* center logo when collapsed */
    .sidebar.collapsed .sidebar-header {
        justify-content: center;
        padding-left: calc(var(--sp-md));
        padding-right: calc(var(--sp-md));
    }

    .sidebar-header img {
        width: 46px;
        height: 46px;
        border-radius: 8px;
        object-fit: cover;
        flex-shrink: 0;
        transition: margin var(--transition-speed) ease, transform var(--transition-speed) ease;
        display: block;
    }

    .sidebar-header h1 {
        font-size: 20px;
        font-weight: 600;
        color: #111;
        margin: 0;
        line-height: 1;
        white-space: nowrap;
        transition: opacity var(--transition-speed) ease, transform var(--transition-speed) ease;
        display: flex;
        align-items: center;
        /* vertical align fix */
    }

    .sidebar.collapsed .sidebar-header h1 {
        opacity: 0;
        transform: translateX(-6px);
        width: 0;
        overflow: hidden;
    }

    /* Menu */
    .sidebar-menu {
        padding: calc(var(--sp-sm)) 0;
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .menu-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: calc(var(--sp-sm)) calc(var(--sp-lg));
        cursor: pointer;
        transition: background var(--transition-speed), transform var(--transition-speed), padding var(--transition-speed);
        border-radius: 10px;
        margin: 0 calc(var(--sp-sm));
    }

    .menu-item:focus {
        outline: none;
        box-shadow: 0 0 0 4px rgba(0, 123, 255, 0.06);
    }

    .menu-item.active {
        background: rgba(255, 255, 255, 0.45);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(0, 0, 0, 0.04);
    }

    .menu-item i {
        font-size: 18px;
        min-width: 24px;
        text-align: center;
        color: #333;
        transition: transform var(--transition-speed);
        flex-shrink: 0;
    }

    .menu-item span {
        font-size: 16px;
        font-weight: 600;
        color: #111;
        white-space: nowrap;
        transition: opacity var(--transition-speed) ease, transform var(--transition-speed) ease;
    }

    .sidebar.collapsed .menu-item {
        justify-content: center;
        padding-left: calc(var(--sp-sm));
        padding-right: calc(var(--sp-sm));
    }

    .sidebar.collapsed .menu-item span {
        opacity: 0;
        transform: translateX(-6px);
        width: 0;
    }

    .menu-item:hover i {
        transform: translateX(6px);
    }

    .menu-item:hover {
        transform: translateX(2px);
        background: rgba(255, 255, 255, 0.12);
    }

    /* Toggle button */
    .sidebar-toggle {
        position: absolute;
        bottom: 16px;
        right: 16px;
        background: rgba(255, 255, 255, 0.9);
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        transition: transform var(--transition-speed);
        z-index: 1001;
    }

    .sidebar-toggle i {
        transition: transform var(--transition-speed) ease;
        font-size: 16px;
        color: #333;
    }

    /* rotate icon when collapsed (no class swapping) */
    .sidebar.collapsed .sidebar-toggle i {
        transform: rotate(180deg);
    }

    /* Footer user */
    .sidebar-footer {
        padding: 0 calc(var(--sp-lg));
        margin-top: auto;
        margin-bottom: 70px;
    }

    .user-profile {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 8px;
        border-radius: 12px;
        background: #FFFFFF;
        border: 1px solid var(--border-color);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
    }

    .user-avatar {
        width: 44px;
        height: 44px;
        background: #fff;
        border-radius: 50%;
        border: 1px solid rgba(0, 0, 0, 0.08);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }

    .user-info {
        display: flex;
        flex-direction: column;
        gap: 2px;
        transition: opacity var(--transition-speed) ease;
    }

    .sidebar.collapsed .user-info {
        opacity: 0;
        width: 0;
        overflow: hidden;
    }

    .user-name {
        font-size: 14px;
        font-weight: 600;
        color: #111;
    }

    .user-role {
        font-size: 12px;
        color: #6e6e6e;
        font-weight: 500;
    }

    .user-settings {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--border-color);
        background: linear-gradient(180deg, #fff, #fff);
        flex-shrink: 0;
    }

    /* Main content */
    .main-content {
        flex: 1;
        margin-left: var(--sidebar-width);
        transition: margin-left var(--transition-speed) ease;
        padding: 20px 28px;
        min-height: 100vh;
    }

    .sidebar.collapsed~.main-content {
        margin-left: var(--sidebar-collapsed-width);
    }

    .content-header {
        background: var(--card-gradient-1);
        box-shadow: 0 6px 22px rgba(0, 0, 0, 0.08);
        backdrop-filter: blur(10px);
        height: var(--header-height);
        display: flex;
        align-items: center;
        justify-content: flex-end;
        padding: 0 20px;
        margin-bottom: 18px;
        border-radius: 12px;
        border: 1px solid var(--border-color);
    }

    .header-actions {
        display: flex;
        gap: 12px;
        align-items: center;
    }

    .action-btn {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: transform var(--transition-speed);
    }

    .action-btn:focus {
        outline: none;
        box-shadow: 0 0 0 4px rgba(0, 123, 255, 0.06);
    }

    .notification-btn {
        background: #fff;
        border: 1px solid var(--border-color);
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.06);
    }

    .add-btn {
        background: linear-gradient(180deg, #FF2800, #FF7A50);
        color: #fff;
        font-size: 20px;
    }

    /* Stats */
    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 16px;
        margin-bottom: 18px;
    }

    .stat-card {
        background: var(--card-gradient-1);
        border-radius: var(--radius);
        padding: 18px;
        height: auto;
        min-height: 180px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        border: 1px solid var(--border-color);
        box-shadow: 0 6px 26px rgba(0, 0, 0, 0.06);
        transition: transform var(--transition-speed);
    }

    .stat-card:hover {
        transform: translateY(-6px);
    }

    .stat-number {
        font-family: 'Montserrat Alternates', sans-serif;
        font-size: 46px;
        font-weight: 400;
        color: #111;
    }

    .stat-label {
        font-size: 18px;
        font-weight: 600;
        color: #222;
    }

    .create-class-text {
        font-size: 32px;
        line-height: 1.05;
        font-weight: 600;
        color: #111;
    }

    .create-class-text span {
        font-weight: 700;
    }

    /* Search */
    .search-container {
        margin-bottom: 18px;
    }

    .search-bar {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 14px;
        border-radius: 14px;
        background: var(--search-gradient);
        border: 1px solid var(--border-color);
        box-shadow: 0 6px 26px rgba(0, 0, 0, 0.05);
        height: 52px;
    }

    .search-bar input {
        border: none;
        background: transparent;
        outline: none;
        width: 100%;
        font-size: 16px;
        color: #333;
    }

    .search-bar input::placeholder {
        color: #888;
    }

    /* Classes */
    .classes-container {
        background: var(--card-gradient-2);
        border-radius: 12px;
        border: 1px solid var(--border-color);
        padding: 18px;
        margin-bottom: 18px;
        box-shadow: 0 6px 26px rgba(0, 0, 0, 0.04);
    }

    .class-item {
        background: #fff;
        border-radius: 10px;
        border: 1px solid var(--border-color);
        padding: 12px;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 12px;
        transition: transform var(--transition-speed), box-shadow var(--transition-speed);
    }

    .class-item:hover {
        transform: translateX(6px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.06);
    }

    .class-number {
        font-size: 16px;
        font-weight: 700;
        min-width: 28px;
        text-align: center;
        color: #111;
        position: relative;
        padding-right: 10px;
    }

    .class-number::after {
        content: '';
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        height: 28px;
        width: 1px;
        background: var(--border-color);
        opacity: 0.9;
    }

    .class-avatar {
        width: 58px;
        height: 58px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eee;
        color: #666;
        font-weight: 700;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
    }

    .class-info {
        flex: 1;
    }

    .class-name {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 4px;
        color: #111;
    }

    .class-description {
        font-size: 14px;
        color: #6e6e6e;
    }

    .class-stats {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-left: auto;
    }

    .class-count {
        font-size: 20px;
        font-weight: 700;
        text-align: right;
    }

    .class-count.full {
        color: #FF0000;
    }

    .class-count.partial {
        color: #FF7700;
    }

    .class-count.low {
        color: #40A700;
    }

    /* Mobile responsiveness */
    @media (max-width: 992px) {
        .sidebar {
            transform: translateX(-100%);
            position: fixed;
        }

        .sidebar.mobile-open {
            transform: translateX(0);
        }

        .sidebar.collapsed {
            width: var(--sidebar-width);
            /* keep full width in mobile when open */
        }

        .main-content {
            margin-left: 0;
            width: 100%;
            padding: 16px;
        }

        .mobile-menu-toggle {
            display: block;
            position: fixed;
            top: 12px;
            left: 12px;
            z-index: 1100;
            background: #fff;
            border-radius: 10px;
            width: 44px;
            height: 44px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
            border: 1px solid var(--border-color);
        }

        .stats-container {
            grid-template-columns: 1fr;
        }
    }

    @media (min-width: 993px) {
        .mobile-menu-toggle {
            display: none;
        }
    }

    @media (max-width: 768px) {
        .class-item {
            flex-direction: column;
            align-items: flex-start;
        }

        .class-stats {
            margin-left: 0;
            margin-top: 10px;
            width: 100%;
            justify-content: space-between;
        }

        .class-number::after {
            display: none;
        }
    }

    /* small animation for menu items (stagger) */
    .menu-item {
        opacity: 0;
        transform: translateX(-8px);
        animation: slideIn .36s ease forwards;
    }

    .menu-item:nth-child(1) {
        animation-delay: .06s;
    }

    .menu-item:nth-child(2) {
        animation-delay: .12s;
    }

    .menu-item:nth-child(3) {
        animation-delay: .18s;
    }

    @keyframes slideIn {
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <!-- Mobile Menu Toggle -->
        <button class="mobile-menu-toggle" aria-label="Toggle menu" aria-expanded="false">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Sidebar -->
        <aside class="sidebar" role="navigation">
            <div class="sidebar-header">
                <img src="https://placehold.co/46x46" alt="Ab.sen Logo">
                <h1>Ab.sen</h1>
            </div>

            <nav class="sidebar-menu" aria-label="Main menu">
                <div class="menu-item active" tabindex="0">
                    <i class="fas fa-home" aria-hidden="true"></i>
                    <span>Beranda</span>
                </div>
                <div class="menu-item" tabindex="0">
                    <i class="fas fa-users" aria-hidden="true"></i>
                    <span>Kelas</span>
                </div>
                <div class="menu-item" tabindex="0">
                    <i class="fas fa-cog" aria-hidden="true"></i>
                    <span>Pengaturan</span>
                </div>
            </nav>

            <div class="sidebar-footer">
                <div class="user-profile" role="group" aria-label="User profile">
                    <div class="user-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="user-info">
                        <div class="user-name">Fulan Putra</div>
                        <div class="user-role">User</div>
                    </div>
                    <div class="user-settings" title="Settings">
                        <i class="fas fa-ellipsis-v"></i>
                    </div>
                </div>
            </div>

            <button class="sidebar-toggle" aria-label="Toggle sidebar" aria-expanded="true">
                <i class="fas fa-chevron-left"></i>
            </button>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="content-header">
                <div class="header-actions">
                    <button class="action-btn notification-btn" aria-label="Notifications" title="Notifikasi">
                        <i class="fas fa-bell"></i>
                    </button>
                    <button class="action-btn add-btn" aria-label="Add" title="Tambah">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>

            <section class="stats-container" aria-label="Statistics">
                <div class="stat-card">
                    <div class="stat-number">28</div>
                    <div class="stat-label">Jumlah Kelas</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">12</div>
                    <div class="stat-label">Notifikasi</div>
                </div>
                <div class="stat-card">
                    <div class="create-class-text">
                        Buat<br><span>Kelas</span>
                    </div>
                </div>
            </section>

            <section class="search-container" aria-label="Search">
                <div class="search-bar" role="search">
                    <input type="text" placeholder="Cari kelas..." aria-label="Cari kelas">
                    <div class="search-icon" aria-hidden="true"><i class="fas fa-search"></i></div>
                </div>
            </section>

            <section class="classes-container" aria-label="Classes list">
                <article class="class-item">
                    <div class="class-number">1</div>
                    <div class="class-avatar">SJ</div>
                    <div class="class-info">
                        <div class="class-name">SKARIGA JHIC</div>
                        <div class="class-description">Tim Lomba Jagoan Hosting</div>
                    </div>
                    <div class="class-stats">
                        <div class="class-count full">12 / 12</div>
                        <div class="class-menu"><i class="fas fa-ellipsis-v"></i></div>
                    </div>
                </article>

                <article class="class-item">
                    <div class="class-number">2</div>
                    <div class="class-avatar">RA</div>
                    <div class="class-info">
                        <div class="class-name">11 RPL A</div>
                        <div class="class-description">Jurusan Rekayasa Perangkat Lunak</div>
                    </div>
                    <div class="class-stats">
                        <div class="class-count partial">24 / 33</div>
                        <div class="class-menu"><i class="fas fa-ellipsis-v"></i></div>
                    </div>
                </article>

                <article class="class-item">
                    <div class="class-number">3</div>
                    <div class="class-avatar">OS</div>
                    <div class="class-info">
                        <div class="class-name">OSIS 2024/2025</div>
                        <div class="class-description">Organisasi Siswa Intra Sekolah Masa Bakti 2024/2025</div>
                    </div>
                    <div class="class-stats">
                        <div class="class-count low">11 / 30</div>
                        <div class="class-menu"><i class="fas fa-ellipsis-v"></i></div>
                    </div>
                </article>
            </section>
        </main>
    </div>

    <script>
    // grab elements
    const sidebar = document.querySelector('.sidebar');
    const sidebarToggle = document.querySelector('.sidebar-toggle');
    const mobileToggle = document.querySelector('.mobile-menu-toggle');
    const mobileIcon = mobileToggle && mobileToggle.querySelector('i');

    // Sidebar toggle (uses rotate animation via CSS)
    sidebarToggle.addEventListener('click', () => {
        sidebar.classList.toggle('collapsed');
        const expanded = sidebar.classList.contains('collapsed') ? 'false' : 'true';
        sidebarToggle.setAttribute('aria-expanded', expanded);
    });

    // Mobile toggle
    mobileToggle.addEventListener('click', () => {
        sidebar.classList.toggle('mobile-open');
        const open = sidebar.classList.contains('mobile-open');
        mobileToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        if (mobileIcon) {
            mobileIcon.classList.toggle('fa-times', open);
            mobileIcon.classList.toggle('fa-bars', !open);
        }
    });

    // Close mobile menu when clicking a menu item (on mobile)
    document.querySelectorAll('.menu-item').forEach(item => {
        item.addEventListener('click', function() {
            if (window.innerWidth < 993 && sidebar.classList.contains('mobile-open')) {
                sidebar.classList.remove('mobile-open');
                mobileToggle.setAttribute('aria-expanded', 'false');
                if (mobileIcon) {
                    mobileIcon.classList.remove('fa-times');
                    mobileIcon.classList.add('fa-bars');
                }
            }
        });

        // keyboard accessibility: Enter key triggers click
        item.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                item.click();
            }
        });
    });

    // keep UI consistent on resize (if user resizes from mobile to desktop)
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 993) {
            sidebar.classList.remove('mobile-open');
            if (mobileIcon) {
                mobileIcon.classList.remove('fa-times');
                mobileIcon.classList.add('fa-bars');
                mobileToggle.setAttribute('aria-expanded', 'false');
            }
        }
    });

    // simple hover scale for action buttons
    document.querySelectorAll('.action-btn').forEach(btn => {
        btn.addEventListener('mouseenter', () => btn.style.transform = 'scale(1.06)');
        btn.addEventListener('mouseleave', () => btn.style.transform = 'scale(1)');
    });
    </script>
</body>

</html>
