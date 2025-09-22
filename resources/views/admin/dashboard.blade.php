<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Ab.sen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@300;400;500&family=Montserrat:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <link rel="shortcut icon" href="assets/favicon.png" type="image/x-icon">
    <style>
    :root {
        --sidebar-width: 262px;
        --sidebar-collapsed-width: 80px;
        --header-height: 115px;
        --primary-gradient: linear-gradient(136deg, #F0C071 0%, white 34%, #E9DBDB 80%, #D4B6B6 100%);
        --card-gradient-1: radial-gradient(ellipse 121.53% 153.17% at 21.45% 29.73%, rgba(0, 208.25, 255, 0.15) 0%, rgba(84.87, 176.54, 115.43, 0.03) 77%, rgba(67.30, 212.09, 195.20, 0) 100%);
        --card-gradient-2: radial-gradient(ellipse 134.89% 169.09% at 15.32% 21.04%, rgba(255, 0, 0, 0.15) 0%, rgba(255, 255, 255, 0.03) 77%, rgba(234.16, 213.89, 213.89, 0) 100%);
        --card-gradient-3: radial-gradient(ellipse 137.84% 102.64% at 100.00% 5.14%, rgba(42.50, 255, 0, 0.15) 0%, rgba(43, 255, 0, 0) 100%);
        --search-gradient: radial-gradient(ellipse 99.57% 1062.91% at 0.43% 50.00%, rgba(216.75, 255, 0, 0.11) 0%, rgba(84.87, 176.54, 115.43, 0.03) 77%, rgba(67.30, 212.09, 195.20, 0) 100%);
        --content-gradient: radial-gradient(ellipse 119.44% 85.25% at 13.39% 17.75%, rgba(255, 89.25, 0, 0.11) 0%, rgba(84.87, 176.54, 115.43, 0.03) 77%, rgba(67.30, 212.09, 195.20, 0) 100%);
        --sidebar-gradient: radial-gradient(ellipse 127.02% 151.92% at 15.32% 21.04%, rgba(164.69, 238.74, 255, 0.15) 0%, rgba(109.97, 190.80, 244.37, 0.03) 77%, rgba(69.95, 144.07, 212.50, 0) 100%);
        --transition-speed: 0.3s;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Montserrat', sans-serif;
    }

    body {
        background: var(--primary-gradient);
        min-height: 100vh;
        overflow-x: hidden;
    }

    /* Layout Structure */
    .dashboard-container {
        display: flex;
        min-height: 100vh;
    }

    /* Sidebar Styles */
    .sidebar {
        width: var(--sidebar-width);
        background: var(--sidebar-gradient);
        box-shadow: 2px 4px 30px 2px rgba(0, 0, 0, 0.25);
        backdrop-filter: blur(40px);
        position: fixed;
        height: 100vh;
        z-index: 1000;
        transition: all var(--transition-speed) ease;
        overflow: hidden;
    }

    .sidebar.collapsed {
        width: var(--sidebar-collapsed-width);
    }

    .sidebar-header {
        padding: 1rem;
        display: flex;
        align-items: center;
        border-bottom: 1px solid rgba(0, 0, 0, 0.4);
        height: 115px;
    }

    .sidebar-header img {
        width: 38px;
        height: 38px;
        margin-right: 1rem;
        transition: margin var(--transition-speed) ease;
    }

    .sidebar.collapsed .sidebar-header img {
        margin-right: 0;
    }

    .sidebar-header h1 {
        color: black;
        font-size: 20px;
        font-family: 'Montserrat Alternates', sans-serif;
        font-weight: 500;
        text-shadow: 0px 4px 15px rgba(0, 0, 0, 0.25);
        white-space: nowrap;
        transition: opacity var(--transition-speed) ease;
    }

    .sidebar.collapsed .sidebar-header h1 {
        opacity: 0;
        width: 0;
    }

    .sidebar-menu {
        padding: 1rem 0;
    }

    .menu-item {
        display: flex;
        align-items: center;
        padding: 1rem 1.5rem;
        cursor: pointer;
        transition: all 0.2s ease;
        position: relative;
        overflow: hidden;
    }

    .menu-item.active {
        background: radial-gradient(ellipse 122.26% 184.06% at 7.59% 17.27%, rgba(226.80, 226.80, 226.80, 0.19) 14%, rgba(255, 40, 0, 0) 60%, rgba(255, 255, 255, 0.20) 100%);
        box-shadow: 2px 4px 74.5px 11px rgba(94.40, 94.40, 94.40, 0.27);
        border-radius: 12px;
        backdrop-filter: blur(10.65px);
    }

    .menu-item:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    .menu-item i {
        font-size: 1.5rem;
        margin-right: 1rem;
        min-width: 24px;
        text-align: center;
        color: #333;
        transition: margin var(--transition-speed) ease;
    }

    .sidebar.collapsed .menu-item i {
        margin-right: 0;
    }

    .menu-item span {
        color: black;
        font-size: 20px;
        font-weight: 500;
        text-shadow: 0px 4px 22px rgba(0, 0, 0, 0.25);
        white-space: nowrap;
        transition: opacity var(--transition-speed) ease;
    }

    .sidebar.collapsed .menu-item span {
        opacity: 0;
        width: 0;
    }

    .sidebar-toggle {
        position: absolute;
        bottom: 1rem;
        right: 1rem;
        background: rgba(255, 255, 255, 0.2);
        border: none;
        border-radius: 50%;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 1001;
    }

    .sidebar-toggle:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: rotate(180deg);
    }

    .sidebar-footer {
        position: absolute;
        bottom: 60px;
        width: 100%;
        padding: 0 1rem;
    }

    .user-profile {
        display: flex;
        align-items: center;
        background: #F5F5F5;
        box-shadow: 0px 0px 13.4px rgba(232, 78, 49, 0.35);
        border-radius: 12px;
        border: 0.25px black solid;
        padding: 0.5rem;
        transition: all var(--transition-speed) ease;
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        background: white;
        border-radius: 50%;
        border: 1px solid rgba(0, 0, 0, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 0.5rem;
        flex-shrink: 0;
    }

    .user-info {
        flex-grow: 1;
        transition: opacity var(--transition-speed) ease;
    }

    .sidebar.collapsed .user-info {
        opacity: 0;
        width: 0;
        overflow: hidden;
    }

    .user-name {
        color: black;
        font-size: 12px;
        font-weight: 500;
        text-shadow: 0px 4px 22px rgba(0, 0, 0, 0.25);
    }

    .user-role {
        color: #6E6E6E;
        font-size: 11px;
        font-weight: 500;
        text-shadow: 0px 4px 22px rgba(0, 0, 0, 0.25);
    }

    .user-settings {
        width: 32px;
        height: 32px;
        background: radial-gradient(ellipse 275.02% 203.63% at 309.38% 50.00%, rgba(232, 78, 49, 0) 0%, rgba(243.50, 166.50, 152, 0.50) 50%, white 100%);
        border-radius: 50%;
        border: 0.45px black solid;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    /* Main Content Styles */
    .main-content {
        flex: 1;
        margin-left: var(--sidebar-width);
        transition: margin-left var(--transition-speed) ease;
        padding: 1rem;
        min-height: 100vh;
    }

    .sidebar.collapsed~.main-content {
        margin-left: var(--sidebar-collapsed-width);
    }

    .content-header {
        background: radial-gradient(ellipse 127.02% 151.92% at 15.32% 21.04%, rgba(164.69, 238.74, 255, 0.15) 0%, rgba(109.97, 190.80, 244.37, 0.03) 77%, rgba(69.95, 144.07, 212.50, 0) 100%);
        box-shadow: 2px 4px 30px 2px rgba(0, 0, 0, 0.25);
        backdrop-filter: blur(40px);
        height: var(--header-height);
        display: flex;
        align-items: center;
        justify-content: flex-end;
        padding: 0 2rem;
        margin-bottom: 2rem;
        border-radius: 12px;
    }

    .header-actions {
        display: flex;
        gap: 1rem;
    }

    .action-btn {
        width: 43px;
        height: 43px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .notification-btn {
        background: white;
        box-shadow: 0px 4px 12px 2px rgba(0, 0, 0, 0.15);
        border: 0.20px black solid;
        backdrop-filter: blur(6px);
    }

    .add-btn {
        background: radial-gradient(ellipse 451.77% 779.25% at 50.29% 50.85%, #FF2800 22%, white 32%, #F9BEB3 49%);
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.15);
        color: white;
        font-size: 24px;
        font-weight: 400;
        text-shadow: 0px 4px 22px rgba(0, 0, 0, 0.25);
    }

    /* Stats Cards */
    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: var(--card-gradient-1);
        box-shadow: 2px 4px 30px 2px rgba(0, 0, 0, 0.25);
        border-radius: 12px;
        border: 0.35px black solid;
        backdrop-filter: blur(40px);
        padding: 1.5rem;
        height: 219px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: transform 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-card:nth-child(2) {
        background: var(--card-gradient-2);
    }

    .stat-card:nth-child(3) {
        background: var(--card-gradient-3);
        position: relative;
        overflow: hidden;
    }

    .stat-card:nth-child(3)::after {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 65px;
        height: 65px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 0 12px 0 50%;
    }

    .stat-number {
        color: black;
        font-size: 64px;
        font-family: 'Montserrat Alternates', sans-serif;
        font-weight: 300;
        letter-spacing: 2px;
        text-shadow: 0px 4px 22px rgba(0, 0, 0, 0.25);
    }

    .stat-label {
        color: black;
        font-size: 28px;
        font-weight: 500;
        text-shadow: 0px 4px 22px rgba(0, 0, 0, 0.25);
    }

    .create-class-text {
        color: black;
        font-size: 48px;
        text-shadow: 0px 4px 22px rgba(0, 0, 0, 0.25);
    }

    .create-class-text span:last-child {
        font-weight: 600;
    }

    /* Search Bar */
    .search-container {
        margin-bottom: 2rem;
    }

    .search-bar {
        background: var(--search-gradient);
        box-shadow: 2px 4px 30px 2px rgba(0, 0, 0, 0.25);
        border-radius: 18px;
        border: 0.35px black solid;
        backdrop-filter: blur(40px);
        height: 52px;
        display: flex;
        align-items: center;
        padding: 0 1.5rem;
        margin-bottom: 1rem;
    }

    .search-bar input {
        background: transparent;
        border: none;
        outline: none;
        width: 100%;
        color: #868686;
        font-size: 20px;
        font-family: 'Montserrat Alternates', sans-serif;
        font-weight: 500;
        letter-spacing: 0.6px;
        text-shadow: 0px 4px 22px rgba(0, 0, 0, 0.25);
    }

    .search-bar input::placeholder {
        color: #868686;
    }

    .search-icon {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Classes List */
    .classes-container {
        background: var(--content-gradient);
        box-shadow: 2px 4px 30px 2px rgba(0, 0, 0, 0.25);
        border-radius: 12px;
        border: 0.35px black solid;
        backdrop-filter: blur(40px);
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .class-item {
        background: white;
        box-shadow: 0px 4px 15.9px rgba(0, 0, 0, 0.25);
        border-radius: 12px;
        border: 0.25px black solid;
        padding: 1rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
    }

    .class-item:hover {
        transform: translateX(5px);
        box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.3);
    }

    .class-number {
        color: black;
        font-size: 20px;
        font-weight: 500;
        text-shadow: 0px 4px 22px rgba(0, 0, 0, 0.25);
        min-width: 30px;
        text-align: center;
        margin-right: 1rem;
        position: relative;
    }

    .class-number::after {
        content: '';
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        height: 30px;
        width: 1px;
        background: rgba(0, 0, 0, 0.4);
    }

    .class-avatar {
        width: 58px;
        height: 58px;
        box-shadow: 0px 4px 28.9px 6px rgba(0, 0, 0, 0.3);
        border-radius: 18px;
        margin-right: 1rem;
        flex-shrink: 0;
        background: #ddd;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #666;
        font-weight: bold;
    }

    .class-info {
        flex-grow: 1;
    }

    .class-name {
        color: black;
        font-size: 20px;
        font-weight: 500;
        text-shadow: 0px 4px 27px rgba(0, 0, 0, 0.5);
        margin-bottom: 0.25rem;
    }

    .class-description {
        color: #6E6E6E;
        font-size: 16px;
        font-weight: 500;
        text-shadow: 0px 4px 22px rgba(0, 0, 0, 0.25);
    }

    .class-stats {
        display: flex;
        align-items: center;
        margin-left: auto;
    }

    .class-count {
        text-align: right;
        font-size: 24px;
        font-weight: 500;
        text-shadow: 0px 4px 22px rgba(0, 0, 0, 0.25);
        margin-right: 1rem;
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

    .class-menu {
        width: 24px;
        height: 24px;
        opacity: 0.75;
        cursor: pointer;
    }

    /* Mobile Responsiveness */
    @media (max-width: 992px) {
        .sidebar {
            transform: translateX(-100%);
        }

        .sidebar.mobile-open {
            transform: translateX(0);
        }

        .main-content {
            margin-left: 0;
            width: 100%;
        }

        .mobile-menu-toggle {
            display: block;
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 1001;
            background: rgba(255, 255, 255, 0.8);
            border: none;
            border-radius: 8px;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .stats-container {
            grid-template-columns: 1fr;
        }

        .content-header {
            padding: 0 1rem;
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
            margin-top: 1rem;
            width: 100%;
            justify-content: space-between;
        }

        .class-number::after {
            display: none;
        }
    }

    /* Animation for sidebar items */
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(-20px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .menu-item {
        animation: slideIn 0.5s ease forwards;
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
    </style>
</head>

<body>
    <div class="dashboard-container">
        <!-- Mobile Menu Toggle -->
        <button class="mobile-menu-toggle">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <img src="https://placehold.co/38x38" alt="Ab.sen Logo">
                <h1>Ab.sen</h1>
            </div>

            <div class="sidebar-menu">
                <div class="menu-item active">
                    <i class="fas fa-home"></i>
                    <span>Beranda</span>
                </div>
                <div class="menu-item">
                    <i class="fas fa-users"></i>
                    <span>Kelas</span>
                </div>
                <div class="menu-item">
                    <i class="fas fa-cog"></i>
                    <span>Pengaturan</span>
                </div>
            </div>

            <div class="sidebar-footer">
                <div class="user-profile">
                    <div class="user-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="user-info">
                        <div class="user-name">Fulan Putra</div>
                        <div class="user-role">User</div>
                    </div>
                    <div class="user-settings">
                        <i class="fas fa-ellipsis-v"></i>
                    </div>
                </div>
            </div>

            <button class="sidebar-toggle">
                <i class="fas fa-chevron-left"></i>
            </button>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="content-header">
                <div class="header-actions">
                    <div class="action-btn notification-btn">
                        <i class="fas fa-bell"></i>
                    </div>
                    <div class="action-btn add-btn">
                        <i class="fas fa-plus"></i>
                    </div>
                </div>
            </div>

            <div class="stats-container">
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
            </div>

            <div class="search-container">
                <div class="search-bar">
                    <input type="text" placeholder="Cari kelas...">
                    <div class="search-icon">
                        <i class="fas fa-search"></i>
                    </div>
                </div>
            </div>

            <div class="classes-container">
                <div class="class-item">
                    <div class="class-number">1</div>
                    <div class="class-avatar">SJ</div>
                    <div class="class-info">
                        <div class="class-name">SKARIGA JHIC</div>
                        <div class="class-description">Tim Lomba Jagoan Hosting</div>
                    </div>
                    <div class="class-stats">
                        <div class="class-count full">12 / 12</div>
                        <div class="class-menu">
                            <i class="fas fa-ellipsis-v"></i>
                        </div>
                    </div>
                </div>

                <div class="class-item">
                    <div class="class-number">2</div>
                    <div class="class-avatar">RA</div>
                    <div class="class-info">
                        <div class="class-name">11 RPL A</div>
                        <div class="class-description">Jurusan Rekayasa Perangkat Lunak</div>
                    </div>
                    <div class="class-stats">
                        <div class="class-count partial">24 / 33</div>
                        <div class="class-menu">
                            <i class="fas fa-ellipsis-v"></i>
                        </div>
                    </div>
                </div>

                <div class="class-item">
                    <div class="class-number">3</div>
                    <div class="class-avatar">OS</div>
                    <div class="class-info">
                        <div class="class-name">OSIS 2024/2025</div>
                        <div class="class-description">Organisasi Siswa Intra Sekolah Masa Bakti 2024/2025</div>
                    </div>
                    <div class="class-stats">
                        <div class="class-count low">11 / 30</div>
                        <div class="class-menu">
                            <i class="fas fa-ellipsis-v"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Sidebar toggle functionality
    document.querySelector('.sidebar-toggle').addEventListener('click', function() {
        document.querySelector('.sidebar').classList.toggle('collapsed');

        // Rotate the chevron icon
        const icon = this.querySelector('i');
        if (document.querySelector('.sidebar').classList.contains('collapsed')) {
            icon.classList.remove('fa-chevron-left');
            icon.classList.add('fa-chevron-right');
        } else {
            icon.classList.remove('fa-chevron-right');
            icon.classList.add('fa-chevron-left');
        }
    });

    // Mobile menu toggle
    document.querySelector('.mobile-menu-toggle').addEventListener('click', function() {
        document.querySelector('.sidebar').classList.toggle('mobile-open');

        // Change icon
        const icon = this.querySelector('i');
        if (document.querySelector('.sidebar').classList.contains('mobile-open')) {
            icon.classList.remove('fa-bars');
            icon.classList.add('fa-times');
        } else {
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
        }
    });

    // Close mobile menu when clicking on a menu item
    document.querySelectorAll('.menu-item').forEach(item => {
        item.addEventListener('click', function() {
            if (window.innerWidth < 993) {
                document.querySelector('.sidebar').classList.remove('mobile-open');
                document.querySelector('.mobile-menu-toggle i').classList.remove('fa-times');
                document.querySelector('.mobile-menu-toggle i').classList.add('fa-bars');
            }
        });
    });

    // Add hover effects to action buttons
    document.querySelectorAll('.action-btn').forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.1)';
        });

        btn.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });
    </script>
</body>

</html>
