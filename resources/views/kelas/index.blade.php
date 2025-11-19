<x-app-layout>
    <style>
    .card {
        transition: transform 0.3s ease-in-out;
        text-decoration: none;
        color: black;
        cursor: pointer;
    }

    .card-hyperlink {
        text-decoration: none;
    }

    .card:hover {
        transform: translate(0, -8px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.6);
    }

    /* ==== TABLE FIXED, TINGGI AUTO TANPA OVERFLOW ==== */
    .table-container {
        overflow: visible !important;
        /* biar dropdown bisa keluar bebas */
        position: relative;
    }

    .table-fixed {
        table-layout: fixed;
        width: 100%;
        margin-bottom: 0;
        border-collapse: collapse;
    }

    .table-fixed thead th {
        background-color: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
        padding: 12px 8px;
        vertical-align: middle;
        position: sticky;
        top: 0;
        z-index: 5;
    }

    .table-fixed tbody tr {
        height: 70px;
    }

    .table-fixed tbody td {
        padding: 8px;
        vertical-align: middle;
        border-bottom: 1px solid #dee2e6;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    /* ==== WIDTH KOLOM FIX ==== */
    .col-nama {
        width: 30%;
    }

    .col-pemilik {
        width: 20%;
    }

    .col-tanggal {
        width: 20%;
    }

    .col-status {
        width: 15%;
    }

    .col-aksi {
        width: 15%;
        text-align: center;
    }

    /* ==== THREE DOTS ==== */
    .three-dots {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        transition: background-color 0.3s ease;
        border: 1px solid #ddd;
        background: #f8f9fa;
        margin: 0 auto;
        cursor: pointer;
        color: #333;
        position: relative;
        z-index: 10;
    }

    .three-dots:hover {
        background-color: rgba(0, 0, 0, 0.1);
        border-color: #999;
    }

    /* ==== DROPDOWN MENU BEBAS KELUAR ==== */
    .dropdown {
        position: relative;
    }

    .dropdown-menu {
        border: 1px solid #ccc;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        border-radius: 8px;
        padding: 8px 0;
        min-width: 200px;
        position: fixed !important;
        transform: none !important;
        z-index: 9999 !important;
    }

    .dropdown-item {
        display: flex;
        align-items: center;
        padding: 10px 16px;
        border: none;
        background: none;
        text-align: left;
        cursor: pointer;
        font-size: 14px;
        color: #333;
        text-decoration: none;
        transition: background-color 0.2s ease;
        white-space: nowrap;
    }

    .dropdown-item:hover {
        background-color: #f8f9fa;
        color: #344767;
    }

    .dropdown-item i {
        width: 20px;
        margin-right: 10px;
        text-align: center;
    }

    .dropdown-item.text-danger {
        color: #dc3545 !important;
    }

    .dropdown-item.text-danger:hover {
        color: #c82333 !important;
        background-color: #f8f9fa;
    }

    .dropdown-item-text {
        display: flex;
        align-items: center;
        padding: 10px 16px;
        font-size: 12px;
        color: #198754 !important;
    }

    /* Search button tetap */
    .search-form {
        position: relative;
    }

    .search-btn {
        min-width: 80px;
    }
    </style>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="card card-background card-background-after-none align-items-start mt-4 mb-5">
                        <div class="full-background"
                            style="background-image: url('../assets/img/header-blue-purple.jpg')"></div>
                        @if (Auth::user()->isUser())
                        <div class="card-body text-start p-4 w-100">
                            <h3 class="text-white mb-2">Gabung ke Kelas</h3>
                            <p class="mb-4 font-weight-semibold">
                                Untuk merasakan benefitnya!
                            </p>
                            <button type="button"
                                class="btn btn-outline-white btn-blur btn-icon d-flex align-items-center mb-0"
                                id="btnGabungKelas">
                                <span class="btn-inner--icon">
                                    <i class="bi bi-plus-circle me-2 text-white"></i>
                                </span>
                                <span class="btn-inner--text text-white">Gabung Kelas</span>
                            </button>
                            <img src="../assets/img/3d-cube.png" alt="3d-cube"
                                class="position-absolute top-0 end-1 w-25 max-width-200 mt-n6 d-sm-block d-none" />
                        </div>
                        @elseif (Auth::user()->isAdmin())
                        <div class="card-body text-start p-4 w-100">
                            <h3 class="text-white mb-2">Buatlah Kelas</h3>
                            <p class="mb-4 font-weight-semibold">
                                Untuk merasakan benefitnya!
                            </p>
                            <a href="{{ route('kelas.create') }}">
                                <button type="button"
                                    class="btn btn-outline-white btn-blur btn-icon d-flex align-items-center mb-0"">
                                <span class=" btn-inner--icon">
                                    <i class="bi bi-plus-circle me-2 text-white"></i>
                                    </span>
                                    <span class="btn-inner--text text-white">Buat Kelas</span>
                                </button>
                            </a>
                            <img src="../assets/img/3d-cube.png" alt="3d-cube"
                                class="position-absolute top-0 end-1 w-25 max-width-200 mt-n6 d-sm-block d-none" />
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Daftar Kelas</h6>
                                    <p class="text-sm">Lihat semua daftar kelas yang tergabung</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 py-0">
                            <div class="border-bottom py-3 px-3">
                                <form method="GET" action="{{ route('kelas.index') }}" class="search-form">
                                    <div class="input-group">
                                        <span
                                            class="input-group-text bg-white text-body border-end-0 px-3 d-flex align-items-center">
                                            <i class="fa-solid fa-search text-sm"></i>
                                        </span>
                                        <input type="text" name="search" class="form-control border-start-0"
                                            placeholder="Cari berdasarkan nama kelas atau pemilik"
                                            value="{{ request('search') }}">
                                        <button type="submit"
                                            class="bg-dark text-white btn-dark border-radius-md px-4 d-flex align-items-center search-btn">
                                            Cari
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="table-container position-relative">
                            <table class="table table-fixed align-items-center mb-0">
                                <thead class="bg-gray-100">
                                    <tr>
                                        @if (Auth::user()->isAdmin())
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7 col-nama">Nama
                                            Kelas</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7 col-pemilik">
                                            Jumlah User</th>
                                        <th
                                            class="text-center text-secondary text-xs font-weight-semibold opacity-7 col-tanggal">
                                            Dibuat Pada</th>
                                        <th
                                            class="text-center text-secondary text-xs font-weight-semibold opacity-7 col-status">
                                            Tenggang Absensi</th>
                                        @elseif (Auth::user()->isUser())
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7 col-nama">Nama
                                            Kelas</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7 col-pemilik">
                                            Pemilik</th>
                                        <th
                                            class="text-center text-secondary text-xs font-weight-semibold opacity-7 col-tanggal">
                                            Bergabung Pada</th>
                                        <th
                                            class="text-center text-secondary text-xs font-weight-semibold opacity-7 col-status">
                                            Tenggang Absensi</th>
                                        <th
                                            class="text-center text-secondary text-xs font-weight-semibold opacity-7 col-status">
                                            Status</th>
                                        @endif
                                        <th
                                            class="text-center text-secondary text-xs font-weight-semibold opacity-7 col-aksi">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="align-middle">
                                    @forelse ($kelas as $k)
                                    @php
                                    $existingPresensi = $presensiData[$k->id_kelas] ?? null;
                                    @endphp

                                    <tr>
                                        <td class="col-nama">
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex align-items-center">
                                                    @if($k->gambar_kelas)
                                                    <img src="{{ asset('storage/' . $k->gambar_kelas) }}"
                                                        class="avatar avatar-sm rounded-circle me-2"
                                                        alt="{{ $k->nama_kelas }}">
                                                    @else
                                                    <div
                                                        class="avatar avatar-sm bg-primary rounded-circle me-2 d-flex align-items-center justify-content-center">
                                                        <i class="fa-solid fa-book text-white text-xs"></i>
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="d-flex flex-column justify-content-center ms-1">
                                                    <h6 class="mb-0 text-sm font-weight-semibold text-truncate"
                                                        title="Nama Kelas">{{ $k->nama_kelas }}
                                                    </h6>
                                                    <p class="text-sm text-secondary mb-0 text-truncate"
                                                        title="Deskripsi Kelas">
                                                        {{ $k->deskripsi_kelas ?? 'Tidak ada deskripsi' }}</p>
                                                </div>
                                            </div>
                                        </td>

                                        @if (Auth::user()->isAdmin())
                                        <td class="col-pemilik">
                                            <p class="text-sm text-dark font-weight-semibold mb-0 text-truncate"
                                                title="Jumlah User">
                                                {{ $k->anggota_count ?? $k->anggota->count() }} User
                                            </p>
                                        </td>
                                        <td class="align-middle text-center text-sm col-tanggal">
                                            <span
                                                class="text-secondary text-sm font-weight-normal">{{ $k->created_at->format('d-m-Y') }}</span>
                                        </td>
                                        @elseif (Auth::user()->isUser())
                                        <td class="col-pemilik">
                                            <p class="text-sm text-dark font-weight-semibold mb-0 text-truncate"
                                                title="Pemilik Kelas">{{ $k->user->username ?? 'Tidak diketahui' }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm col-tanggal">
                                            <span class="text-secondary text-sm font-weight-normal">
                                                @if($k->anggota->first() && $k->anggota->first()->pivot)
                                                {{ \Carbon\Carbon::parse($k->anggota->first()->pivot->created_at)->format('d-m-Y') }}
                                                @else
                                                {{ $k->created_at->format('d-m-Y') }}
                                                @endif
                                            </span>
                                        </td>
                                        @endif

                                        <td class="align-middle text-center col-status">
                                            <span
                                                class="text-secondary text-sm font-weight-normal">{{ Carbon\Carbon::parse($k->waktu_mulai)->format('H:i') }}
                                                - {{ Carbon\Carbon::parse($k->waktu_selesai)->format('H:i') }}</span>
                                        </td>

                                        @if (Auth::user()->isUser())
                                        <td class="align-middle text-center col-status">
                                            @if($existingPresensi)
                                            @php
                                            $badgeColor = match($existingPresensi->status) {
                                            'hadir' => 'bg-primary text-success',
                                            'izin' => 'bg-primary text-warning',
                                            'sakit' => 'bg-primary text-dark',
                                            'alpha' => 'bg-primary text-dark',
                                            'terlambat' => 'bg-primary text-danger'
                                            };
                                            @endphp
                                            <span class="badge badge-sm {{ $badgeColor }}">
                                                {{ ucfirst($existingPresensi->status) }}
                                            </span>
                                            @else
                                            <span class="badge badge-sm bg-secondary text-danger">
                                                Belum Presensi
                                            </span>
                                            @endif
                                        </td>
                                        @endif
                                        <td class="text-center align-middle col-aksi">
                                            <div class="dropdown">
                                                <button class="three-dots" type="button" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    @if (Auth::user()->isUser())
                                                    @if($existingPresensi)
                                                    <!-- Jika sudah ada presensi, tampilkan tombol edit presensi -->
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('presensi.edit', [$k->id_kelas, $existingPresensi->id_presensi]) }}">
                                                            <i class="fa-solid fa-edit me-2"></i>Edit Presensi
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <span class="dropdown-item-text text-sm text-success">
                                                            <i class="fa-solid fa-check me-2"></i>Sudah Presensi
                                                        </span>
                                                    </li>
                                                    @else
                                                    <!-- Jika belum ada presensi, tampilkan tombol isi presensi -->
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('presensi.create', $k->id_kelas) }}">
                                                            <i class="fa-solid fa-clipboard-check me-2"></i>Isi Presensi
                                                        </a>
                                                    </li>
                                                    @endif
                                                    @endif

                                                    <!-- Tombol lihat detail kelas -->
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('kelas.show', $k->id_kelas) }}">
                                                            <i class="fa-solid fa-eye me-2"></i>Lihat Detail
                                                        </a>
                                                    </li>

                                                    <!-- Hanya tampilkan edit/delete kelas untuk admin -->
                                                    @auth
                                                    @if(Auth::user()->isAdmin())
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('kelas.edit', $k->id_kelas) }}">
                                                            <i class="fa-solid fa-edit me-2"></i>Edit Kelas
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <button type="button" class="dropdown-item text-danger"
                                                            onclick="confirmDelete({{ $k->id_kelas }})">
                                                            <i class="fa-solid fa-trash me-2"></i>Hapus Kelas
                                                        </button>
                                                    </li>
                                                    @endif
                                                    @endauth
                                                </ul>
                                            </div>

                                            <!-- Form untuk delete (hidden) -->
                                            <form id="delete-form-{{ $k->id_kelas }}"
                                                action="{{ route('kelas.destroy', $k->id_kelas) }}" method="POST"
                                                class="d-none">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="fa-solid fa-inbox fa-2x text-muted mb-2"></i>
                                                <p class="text-muted mb-0">
                                                    @if(request('search'))
                                                    Tidak ada kelas yang sesuai dengan pencarian
                                                    "{{ request('search') }}"
                                                    @else
                                                    Belum ada kelas yang diikuti
                                                    @endif
                                                </p>
                                                <small class="text-muted">Gabung kelas untuk melihat daftar di
                                                    sini</small>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if($kelas->hasPages())
                        <div class="border-top py-3 px-3 d-flex align-items-center">
                            <p class="font-weight-semibold mb-0 text-dark text-sm">
                                Menampilkan {{ $kelas->count() }} dari {{ $kelas->total() }} kelas
                                (Halaman {{ $kelas->currentPage() }} dari {{ $kelas->lastPage() }})
                            </p>
                            <div class="ms-auto">
                                @if ($kelas->onFirstPage())
                                <button class="btn btn-sm btn-white mb-0" disabled>Previous</button>
                                @else
                                <a href="{{ $kelas->previousPageUrl() }}" class="btn btn-sm btn-white mb-0">Previous</a>
                                @endif

                                @if ($kelas->hasMorePages())
                                <a href="{{ $kelas->nextPageUrl() }}" class="btn btn-sm btn-white mb-0">Next</a>
                                @else
                                <button class="btn btn-sm btn-white mb-0" disabled>Next</button>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <x-app.footer />
    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    document.querySelectorAll('.dropdown').forEach(drop => {
        drop.addEventListener('show.bs.dropdown', function(e) {
            const dropdownMenu = this.querySelector('.dropdown-menu');
            const button = this.querySelector('[data-bs-toggle="dropdown"]');

            // Buat instance Popper manual biar posisi dihitung otomatis
            const popperInstance = Popper.createPopper(button, dropdownMenu, {
                placement: 'bottom-start', // selalu di bawah tombol
                modifiers: [{
                        name: 'offset',
                        options: {
                            offset: [0, 8], // jarak kecil biar gak mepet
                        },
                    },
                    {
                        name: 'preventOverflow',
                        options: {
                            boundary: 'viewport', // biar gak ketahan parent
                        },
                    },
                    {
                        name: 'flip',
                        options: {
                            fallbackPlacements: ['top-start', 'bottom-start'],
                        },
                    },
                ],
            });

            // Simpan instance biar bisa dihancurkan nanti
            this._popperInstance = popperInstance;
            dropdownMenu.style.zIndex = 99999;
        });

        drop.addEventListener('hidden.bs.dropdown', function(e) {
            if (this._popperInstance) {
                this._popperInstance.destroy();
                this._popperInstance = null;
            }
        });
    });

    // SweetAlert untuk gabung kelas
    document.getElementById('btnGabungKelas').addEventListener('click', async function() {
        const {
            value: kode
        } = await Swal.fire({
            title: 'Gabung Kelas',
            input: 'text',
            inputLabel: 'Masukkan kode kelas',
            inputPlaceholder: 'ABC123',
            showCancelButton: true,
            confirmButtonText: 'Gabung',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#000',
            cancelButtonColor: '#DC3545',
            inputValidator: (value) => {
                if (!value) {
                    return 'Kode kelas tidak boleh kosong!';
                }
            }
        });

        if (kode) {
            try {
                const formData = new FormData();
                formData.append('kode_kelas', kode);
                formData.append('_token', '{{ csrf_token() }}');

                // PERBAIKAN: Gunakan route join, bukan store
                const response = await fetch('{{ route("kelas.join") }}', {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                const result = await response.json();

                if (result.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: result.message || 'Kamu berhasil bergabung ke kelas.',
                        confirmButtonColor: '#000'
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: result.message || 'Kode kelas tidak valid.',
                        confirmButtonColor: '#000'
                    });
                }
            } catch (error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: 'Terjadi kesalahan koneksi ke server.',
                    confirmButtonColor: '#000'
                });
            }
        }
    });

    // Fungsi confirm delete
    function confirmDelete(kelasId) {
        if (confirm('Apakah Anda yakin ingin menghapus kelas ini?')) {
            document.getElementById('delete-form-' + kelasId).submit();
        }
    }
    </script>
</x-app-layout>