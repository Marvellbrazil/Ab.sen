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
        --card-gradient-1: radial-gradient(ellipse 121.53% 153.17% at 21.45% 29.73%, rgba(0, 208.25, 255, 0.15) 0%, rgba(84.87, 176.54, 115.43, 0.03) 77%, rgba(67.30, 212.09, 195.20, 0) 100%);
        --card-gradient-2: radial-gradient(ellipse 134.89% 169.09% at 15.32% 21.04%, rgba(255, 0, 0, 0.15) 0%, rgba(255, 255, 255, 0.03) 77%, rgba(234.16, 213.89, 213.89, 0) 100%);
        --card-gradient-3: radial-gradient(ellipse 137.84% 102.64% at 100.00% 5.14%, rgba(42.50, 255, 0, 0.15) 0%, rgba(43, 255, 0, 0) 100%);
        --search-gradient: radial-gradient(ellipse 99.57% 1062.91% at 0.43% 50.00%, rgba(216.75, 255, 0, 0.11) 0%, rgba(84.87, 176.54, 115.43, 0.03) 77%, rgba(67.30, 212.09, 195.20, 0) 100%);

        --border-color: rgba(0, 0, 0, 0.08);
        --shadow-strong: 0 10px 40px rgba(0, 0, 0, 0.15);
        --shadow-medium: 0 6px 20px rgba(0, 0, 0, 0.1);
        --shadow-light: 0 4px 12px rgba(0, 0, 0, 0.08);
        --transition-speed: 0.3s;
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
        overflow-x: hidden;
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
        backdrop-filter: blur(20px);
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
        padding: var(--sp-md) var(--sp-lg);
        display: flex;
        align-items: center;
        gap: var(--sp-md);
        border-bottom: 1px solid var(--border-color);
        transition: justify-content var(--transition-speed) ease, padding var(--transition-speed) ease;
    }

    .sidebar.collapsed .sidebar-header {
        justify-content: center;
        padding-left: var(--sp-md);
        padding-right: var(--sp-md);
    }

    .sidebar-header img {
        width: 46px;
        height: 46px;
        border-radius: 10px;
        object-fit: cover;
        flex-shrink: 0;
        transition: margin var(--transition-speed) ease, transform var(--transition-speed) ease;
        display: block;
        box-shadow: var(--shadow-light);
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
    }

    .sidebar.collapsed .sidebar-header h1 {
        opacity: 0;
        transform: translateX(-10px);
        width: 0;
        overflow: hidden;
    }

    /* Menu */
    .sidebar-menu {
        padding: var(--sp-sm) 0;
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .menu-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: var(--sp-sm) var(--sp-lg);
        cursor: pointer;
        transition: all var(--transition-speed) ease;
        border-radius: 10px;
        margin: 0 var(--sp-sm);
        position: relative;
        overflow: hidden;
    }

    .menu-item:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.15);
    }

    .menu-item.active {
        background: rgba(255, 255, 255, 0.6);
        box-shadow: var(--shadow-light);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .menu-item.active::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 4px;
        background: linear-gradient(to bottom, #4A90E2, #7B68EE);
        border-radius: 0 4px 4px 0;
    }

    .menu-item i {
        font-size: 18px;
        min-width: 24px;
        text-align: center;
        color: #333;
        transition: transform var(--transition-speed), color var(--transition-speed);
        flex-shrink: 0;
        z-index: 1;
    }

    .menu-item span {
        font-size: 16px;
        font-weight: 600;
        color: #111;
        white-space: nowrap;
        transition: opacity var(--transition-speed) ease, transform var(--transition-speed) ease;
        z-index: 1;
    }

    .sidebar.collapsed .menu-item {
        justify-content: center;
        padding-left: var(--sp-sm);
        padding-right: var(--sp-sm);
    }

    .sidebar.collapsed .menu-item span {
        opacity: 0;
        transform: translateX(-10px);
        width: 0;
    }

    .menu-item:hover {
        transform: translateX(4px);
        background: rgba(255, 255, 255, 0.25);
        box-shadow: var(--shadow-light);
    }

    .menu-item:hover i {
        transform: scale(1.1);
        color: #4A90E2;
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
        box-shadow: var(--shadow-medium);
        transition: all var(--transition-speed) ease;
        z-index: 1001;
    }

    .sidebar-toggle:hover {
        background: rgba(255, 255, 255, 1);
        transform: scale(1.05);
        box-shadow: var(--shadow-strong);
    }

    .sidebar-toggle i {
        transition: transform var(--transition-speed) ease;
        font-size: 16px;
        color: #333;
    }

    .sidebar.collapsed .sidebar-toggle i {
        transform: rotate(180deg);
    }

    /* Footer user */
    .sidebar-footer {
        padding: 0 var(--sp-lg);
        margin-top: auto;
        margin-bottom: 70px;
    }

    .user-profile {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px;
        border-radius: 12px;
        background: #FFFFFF;
        border: 1px solid var(--border-color);
        box-shadow: var(--shadow-light);
        transition: all var(--transition-speed) ease;
    }

    .user-profile:hover {
        box-shadow: var(--shadow-medium);
        transform: translateY(-2px);
    }

    .user-avatar {
        width: 44px;
        height: 44px;
        background: linear-gradient(135deg, #6A11CB 0%, #2575FC 100%);
        border-radius: 50%;
        border: 2px solid rgba(255, 255, 255, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        color: white;
        flex-shrink: 0;
        box-shadow: var(--shadow-light);
    }

    .user-info {
        display: flex;
        flex-direction: column;
        gap: 2px;
        transition: opacity var(--transition-speed) ease;
        flex: 1;
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
        background: linear-gradient(180deg, #fff, #f9f9f9);
        flex-shrink: 0;
        cursor: pointer;
        transition: all var(--transition-speed) ease;
    }

    .user-settings:hover {
        background: linear-gradient(180deg, #f9f9f9, #f0f0f0);
        box-shadow: var(--shadow-light);
    }

    /* Main content */
    .main-content {
        flex: 1;
        margin-left: var(--sidebar-width);
        transition: margin-left var(--transition-speed) ease;
        padding: 24px 32px;
        min-height: 100vh;
    }

    .sidebar.collapsed~.main-content {
        margin-left: var(--sidebar-collapsed-width);
    }

    .content-header {
        background: var(--card-gradient-1);
        box-shadow: var(--shadow-medium);
        backdrop-filter: blur(15px);
        height: var(--header-height);
        display: flex;
        align-items: center;
        justify-content: flex-end;
        padding: 0 24px;
        margin-bottom: 24px;
        border-radius: var(--radius);
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
        transition: all var(--transition-speed) ease;
        border: none;
    }

    .action-btn:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.2);
    }

    .notification-btn {
        background: #fff;
        border: 1px solid var(--border-color);
        box-shadow: var(--shadow-light);
        position: relative;
    }

    .notification-btn::after {
        content: '';
        position: absolute;
        top: 8px;
        right: 8px;
        width: 8px;
        height: 8px;
        background: #FF3B30;
        border-radius: 50%;
        border: 2px solid white;
    }

    .add-btn {
        background: linear-gradient(135deg, #FF2800, #FF6B6B);
        color: #fff;
        font-size: 20px;
        box-shadow: var(--shadow-medium);
    }

    .action-btn:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-strong);
    }

    .add-btn:hover {
        background: linear-gradient(135deg, #E02200, #FF5252);
    }

    /* Stats */
    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
        margin-bottom: 24px;
    }

    .stat-card {
        background: var(--card-gradient-1);
        border-radius: var(--radius);
        padding: 24px;
        height: auto;
        min-height: 200px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        border: 1px solid var(--border-color);
        box-shadow: var(--shadow-light);
        transition: all var(--transition-speed) ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(to right, #4A90E2, #7B68EE);
    }

    .stat-card:nth-child(2) {
        background: var(--card-gradient-2);
    }

    .stat-card:nth-child(2)::before {
        background: linear-gradient(to right, #FF3B30, #FF9500);
    }

    .stat-card:nth-child(3) {
        background: var(--card-gradient-3);
    }

    .stat-card:nth-child(3)::before {
        background: linear-gradient(to right, #4CD964, #34C759);
    }

    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-strong);
    }

    .stat-number {
        font-family: 'Montserrat Alternates', sans-serif;
        font-size: 52px;
        font-weight: 400;
        color: #111;
        text-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .stat-label {
        font-size: 18px;
        font-weight: 600;
        color: #222;
    }

    .create-class-text {
        font-size: 36px;
        line-height: 1.1;
        font-weight: 600;
        color: #111;
    }

    .create-class-text span {
        font-weight: 700;
        background: linear-gradient(135deg, #4CD964, #34C759);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Search */
    .search-container {
        margin-bottom: 24px;
    }

    .search-bar {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 18px;
        border-radius: 14px;
        background: var(--search-gradient);
        border: 1px solid var(--border-color);
        box-shadow: var(--shadow-light);
        height: 56px;
        transition: all var(--transition-speed) ease;
    }

    .search-bar:focus-within {
        box-shadow: var(--shadow-medium);
        transform: translateY(-2px);
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

    .search-icon {
        color: #888;
    }

    /* Classes */
    .classes-container {
        background: var(--card-gradient-2);
        border-radius: var(--radius);
        border: 1px solid var(--border-color);
        padding: 20px;
        margin-bottom: 24px;
        box-shadow: var(--shadow-light);
    }

    .class-item {
        background: #fff;
        border-radius: 10px;
        border: 1px solid var(--border-color);
        padding: 16px;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 16px;
        transition: all var(--transition-speed) ease;
        position: relative;
        overflow: hidden;
    }

    .class-item::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 4px;
        background: linear-gradient(to bottom, #4A90E2, #7B68EE);
        border-radius: 4px 0 0 4px;
    }

    .class-item:nth-child(2)::before {
        background: linear-gradient(to bottom, #FF9500, #FFCC00);
    }

    .class-item:nth-child(3)::before {
        background: linear-gradient(to bottom, #4CD964, #34C759);
    }

    .class-item:hover {
        transform: translateX(8px);
        box-shadow: var(--shadow-medium);
    }

    .class-number {
        font-size: 18px;
        font-weight: 700;
        min-width: 30px;
        text-align: center;
        color: #111;
        position: relative;
        padding-right: 12px;
    }

    .class-number::after {
        content: '';
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        height: 30px;
        width: 1px;
        background: var(--border-color);
        opacity: 0.9;
    }

    .class-avatar {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #6A11CB 0%, #2575FC 100%);
        color: white;
        font-weight: 700;
        box-shadow: var(--shadow-light);
        font-size: 20px;
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
        gap: 12px;
        margin-left: auto;
    }

    .class-count {
        font-size: 20px;
        font-weight: 700;
        text-align: right;
    }

    .class-count.full {
        color: #FF3B30;
    }

    .class-count.partial {
        color: #FF9500;
    }

    .class-count.low {
        color: #34C759;
    }

    .class-menu {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all var(--transition-speed) ease;
    }

    .class-menu:hover {
        background: #f5f5f5;
        box-shadow: var(--shadow-light);
    }

    /* Mobile responsiveness */
    @media (max-width: 992px) {
        .sidebar {
            transform: translateX(-100%);
            position: fixed;
            box-shadow: var(--shadow-strong);
        }

        .sidebar.mobile-open {
            transform: translateX(0);
        }

        .sidebar.collapsed {
            width: var(--sidebar-width);
        }

        .main-content {
            margin-left: 0;
            width: 100%;
            padding: 16px;
        }

        .mobile-menu-toggle {
            display: block;
            position: fixed;
            top: 16px;
            left: 16px;
            z-index: 1100;
            background: #fff;
            border-radius: 10px;
            width: 44px;
            height: 44px;
            box-shadow: var(--shadow-medium);
            border: 1px solid var(--border-color);
            border: none;
            cursor: pointer;
            transition: all var(--transition-speed) ease;
        }

        .mobile-menu-toggle:hover {
            transform: scale(1.05);
            box-shadow: var(--shadow-strong);
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
            gap: 12px;
        }

        .class-stats {
            margin-left: 0;
            margin-top: 12px;
            width: 100%;
            justify-content: space-between;
        }

        .class-number::after {
            display: none;
        }

        .main-content {
            padding: 16px;
        }

        .content-header {
            padding: 0 16px;
            margin-bottom: 16px;
        }
    }

    /* Animations */
    .menu-item {
        opacity: 0;
        transform: translateX(-10px);
        animation: slideIn 0.4s ease forwards;
    }

    .menu-item:nth-child(1) {
        animation-delay: 0.1s;
    }

    .menu-item:nth-child(2) {
        animation-delay: 0.2s;
    }

    .menu-item:nth-child(3) {
        animation-delay: 0.3s;
    }

    @keyframes slideIn {
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .stat-card {
        animation: fadeInUp 0.5s ease forwards;
    }

    .stat-card:nth-child(1) {
        animation-delay: 0.1s;
    }

    .stat-card:nth-child(2) {
        animation-delay: 0.2s;
    }

    .stat-card:nth-child(3) {
        animation-delay: 0.3s;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
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
    // Sidebar toggle functionality
    const sidebar = document.querySelector('.sidebar');
    const sidebarToggle = document.querySelector('.sidebar-toggle');
    const mobileToggle = document.querySelector('.mobile-menu-toggle');
    const mobileIcon = mobileToggle.querySelector('i');

    // Desktop sidebar toggle
    sidebarToggle.addEventListener('click', () => {
        sidebar.classList.toggle('collapsed');
        const expanded = sidebar.classList.contains('collapsed') ? 'false' : 'true';
        sidebarToggle.setAttribute('aria-expanded', expanded);

        // Add ripple effect to toggle button
        const ripple = document.createElement('span');
        ripple.classList.add('ripple');
        sidebarToggle.appendChild(ripple);

        setTimeout(() => {
            ripple.remove();
        }, 600);
    });

    // Mobile menu toggle
    mobileToggle.addEventListener('click', () => {
        sidebar.classList.toggle('mobile-open');
        const open = sidebar.classList.contains('mobile-open');
        mobileToggle.setAttribute('aria-expanded', open);

        mobileIcon.classList.toggle('fa-times', open);
        mobileIcon.classList.toggle('fa-bars', !open);
    });

    // Close mobile menu when clicking a menu item
    document.querySelectorAll('.menu-item').forEach(item => {
        item.addEventListener('click', function() {
            if (window.innerWidth < 993 && sidebar.classList.contains('mobile-open')) {
                sidebar.classList.remove('mobile-open');
                mobileToggle.setAttribute('aria-expanded', 'false');
                mobileIcon.classList.remove('fa-times');
                mobileIcon.classList.add('fa-bars');
            }

            // Set active menu item
            document.querySelectorAll('.menu-item').forEach(i => i.classList.remove('active'));
            this.classList.add('active');
        });

        // Keyboard accessibility
        item.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                item.click();
            }
        });
    });

    // Update UI on window resize
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 993) {
            sidebar.classList.remove('mobile-open');
            mobileIcon.classList.remove('fa-times');
            mobileIcon.classList.add('fa-bars');
            mobileToggle.setAttribute('aria-expanded', 'false');
        }
    });

    // Enhanced hover effects for action buttons
    document.querySelectorAll('.action-btn').forEach(btn => {
        btn.addEventListener('mouseenter', () => {
            btn.style.transform = 'translateY(-4px) scale(1.05)';
        });

        btn.addEventListener('mouseleave', () => {
            btn.style.transform = 'translateY(0) scale(1)';
        });
    });

    // Add subtle animation to stat cards on load
    window.addEventListener('load', () => {
        document.querySelectorAll('.stat-card').forEach((card, index) => {
            card.style.animationDelay = `${0.1 + index * 0.1}s`;
        });
    });
    </script>
</body>

</html>
