<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <!-- Header Presensi -->
            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="avatar avatar-xl position-relative">
                                        @if($presensi->user->profile_picture && $presensi->user->profile_picture !==
                                        'default.jpg')
                                        <img src="{{ Storage::url($presensi->user->profile_picture) }}"
                                            alt="{{ $presensi->user->username }}" class="rounded-circle shadow"
                                            style="width: 80px; height: 80px; object-fit: cover;">
                                        @else
                                        <div class="avatar avatar-xl bg-primary rounded-circle shadow d-flex align-items-center justify-content-center"
                                            style="width: 80px; height: 80px;">
                                            <span class="text-white text-lg font-weight-bold">
                                                {{ substr($presensi->user->username, 0, 1) }}
                                            </span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col">
                                    <h4 class="font-weight-bold mb-1">{{ $presensi->user->username }}</h4>
                                    <p class="text-sm text-muted mb-2">
                                        <i class="fa-solid fa-envelope me-2"></i>{{ $presensi->user->email }}
                                    </p>
                                    <div class="d-flex align-items-center">
                                        <span class="badge text-dark 
                                            @if($presensi->status === 'hadir') bg-success
                                            @elseif($presensi->status === 'izin') bg-warning
                                            @elseif($presensi->status === 'sakit') bg-info
                                            @else bg-danger
                                            @endif me-3">
                                            <i class="fa-solid 
                                                @if($presensi->status === 'hadir') fa-check-circle
                                                @elseif($presensi->status === 'izin') fa-envelope
                                                @elseif($presensi->status === 'sakit') fa-heart-pulse
                                                @else fa-times-circle
                                                @endif me-1"></i>
                                            {{ ucfirst($presensi->status) }}
                                        </span>
                                        <span class="text-sm text-muted">
                                            <i class="fa-solid fa-calendar me-1"></i>
                                            {{ \Carbon\Carbon::parse($presensi->created_at)->format('d F Y') }}
                                        </span>
                                        <span class="text-sm text-muted ms-3">
                                            <i class="fa-solid fa-clock me-1"></i>
                                            {{ \Carbon\Carbon::parse($presensi->created_at)->format('H:i') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <a href="{{ route('kelas.show', $presensi->id_kelas) }}"
                                        class="btn btn-sm btn-outline-dark mb-2">
                                        <i class="fa-solid fa-arrow-left me-2"></i>Kembali
                                    </a>
                                    @if(Auth::id() === $presensi->id_user)
                                    <a href="{{ route('presensi.edit', $presensi->id_presensi) }}"
                                        class="btn btn-sm btn-dark mb-2">
                                        <i class="fa-solid fa-pen me-2"></i>Edit
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Kolom Kiri - Detail Presensi -->
                <div class="col-lg-8">
                    <!-- Kartu Informasi Presensi -->
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header bg-light">
                            <h6 class="font-weight-semibold mb-0">
                                <i class="fa-solid fa-clipboard-check me-2"></i>Detail Presensi
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="text-sm font-weight-semibold text-muted">Kelas</label>
                                    <div class="d-flex align-items-center mt-1">
                                        <i class="fa-solid fa-book-open text-primary me-2"></i>
                                        <span class="text-dark">{{ $presensi->kelas->nama_kelas }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-sm font-weight-semibold text-muted">Pengajar</label>
                                    <div class="d-flex align-items-center mt-1">
                                        <i class="fa-solid fa-chalkboard-user text-success me-2"></i>
                                        <span class="text-dark">{{ $presensi->kelas->user->username }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-sm font-weight-semibold text-muted">Waktu Presensi</label>
                                    <div class="d-flex align-items-center mt-1">
                                        <i class="fa-solid fa-clock text-info me-2"></i>
                                        <span class="text-dark">
                                            {{ \Carbon\Carbon::parse($presensi->kelas->waktu_mulai)->format('H:i') }} -
                                            {{ \Carbon\Carbon::parse($presensi->kelas->waktu_selesai)->format('H:i') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-sm font-weight-semibold text-muted">Terakhir Update</label>
                                    <div class="d-flex align-items-center mt-1">
                                        <i class="fa-solid fa-rotate text-warning me-2"></i>
                                        <span class="text-dark">
                                            {{ \Carbon\Carbon::parse($presensi->updated_at)->format('d/m/Y H:i') }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Keterangan -->
                            @if($presensi->keterangan)
                            <div class="mt-3">
                                <label class="text-sm font-weight-semibold text-muted">Keterangan</label>
                                <div class="bg-light rounded p-3 mt-1">
                                    <p class="text-sm mb-0">{{ $presensi->keterangan }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Bukti Presensi -->
                    <div class="card border shadow-xs">
                        <div class="card-header bg-light">
                            <h6 class="font-weight-semibold mb-0">
                                <i class="fa-solid fa-camera me-2"></i>Bukti Presensi
                            </h6>
                        </div>
                        <div class="card-body text-center">
                            @if($presensi->gambar)
                            <img src="{{ Storage::url($presensi->gambar) }}" alt="Bukti Presensi"
                                class="img-fluid rounded shadow-lg mb-3" style="max-height: 400px;">
                            <p class="text-sm text-muted">Gambar bukti presensi</p>
                            @else
                            <div class="py-5">
                                <i class="fa-solid fa-image fa-4x text-muted mb-3"></i>
                                <p class="text-muted mb-0">Tidak ada bukti gambar</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan - Statistik & Info -->
                <div class="col-lg-4">
                    <!-- Statistik Presensi -->
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header bg-light">
                            <h6 class="font-weight-semibold mb-0">
                                <i class="fa-solid fa-chart-bar me-2"></i>Statistik Presensi
                            </h6>
                        </div>
                        <div class="card-body">
                            @php
                            $totalPresensi = $riwayatPresensi->count();
                            $hadir = $riwayatPresensi->where('status', 'hadir')->count();
                            $izin = $riwayatPresensi->where('status', 'izin')->count();
                            $sakit = $riwayatPresensi->where('status', 'sakit')->count();
                            $alpha = $riwayatPresensi->where('status', 'alpha')->count();
                            @endphp

                            <div class="mb-3">
                                <label class="text-sm text-muted">Total Presensi</label>
                                <h5 class="font-weight-bold text-dark">{{ $totalPresensi }}</h5>
                            </div>

                            <div class="row text-center">
                                <div class="col-6 mb-3">
                                    <div class="bg-success rounded p-2 text-white">
                                        <small>Hadir</small>
                                        <h6 class="mb-0">{{ $hadir }}</h6>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="bg-warning rounded p-2 text-dark">
                                        <small>Izin</small>
                                        <h6 class="mb-0">{{ $izin }}</h6>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-info rounded p-2 text-white">
                                        <small>Sakit</small>
                                        <h6 class="mb-0">{{ $sakit }}</h6>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-danger rounded p-2 text-white">
                                        <small>Alpha</small>
                                        <h6 class="mb-0">{{ $alpha }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Info Cepat -->
                    <div class="card border shadow-xs">
                        <div class="card-header bg-light">
                            <h6 class="font-weight-semibold mb-0">
                                <i class="fa-solid fa-info-circle me-2"></i>Informasi
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon icon-shape icon-sm bg-primary text-white rounded-circle me-3">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                </div>
                                <div>
                                    <span class="text-sm">Kode Kelas</span>
                                    <h6 class="mb-0 text-dark">{{ $presensi->kelas->kode_kelas }}</h6>
                                </div>
                            </div>

                            <div class="d-flex align-items-center mb-3">
                                <div class="icon icon-shape icon-sm bg-success text-white rounded-circle me-3">
                                    <i class="fa-solid fa-calendar-day"></i>
                                </div>
                                <div>
                                    <span class="text-sm">Dibuat Pada</span>
                                    <h6 class="mb-0 text-dark">
                                        {{ \Carbon\Carbon::parse($presensi->kelas->created_at)->format('d/m/Y') }}
                                    </h6>
                                </div>
                            </div>

                            <div class="d-flex align-items-center">
                                <div class="icon icon-shape icon-sm bg-info text-white rounded-circle me-3">
                                    <i class="fa-solid fa-users"></i>
                                </div>
                                <div>
                                    <span class="text-sm">Jumlah Anggota</span>
                                    <h6 class="mb-0 text-dark">{{ $presensi->kelas->anggota->count() }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-app.footer />
    </main>
</x-app-layout>