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

    /* CSS untuk tabel auto height dengan maksimal 5 baris */
    .table-container {
        min-height: 70px;
        max-height: 395px;
        overflow: auto;
        /* Ganti hidden jadi auto */
        position: relative;
    }

    .table-fixed {
        table-layout: fixed;
        width: 100%;
        margin-bottom: 0;
    }

    .table-fixed thead th {
        background-color: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
        padding: 12px 8px;
        vertical-align: middle;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .table-fixed tbody tr {
        height: 70px;
    }

    .table-fixed tbody td {
        padding: 8px;
        vertical-align: middle;
        border-bottom: 1px solid #dee2e6;
    }

    /* Kolom dengan lebar spesifik */
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

    /* Style untuk dropdown Bootstrap */
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
    }

    .three-dots:hover {
        background-color: rgba(0, 0, 0, 0.1);
        border-color: #999;
    }

    /* Custom dropdown menu */
    .dropdown-menu {
        border: 1px solid #ccc;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        border-radius: 8px;
        padding: 8px 0;
        min-width: 200px;
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
        text-decoration: none;
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

    /* Style untuk form search */
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

                        <div class="table-container">
                            <table class="table table-fixed align-items-center mb-0">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7 col-nama">Nama
                                            Kelas</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7 col-pemilik">
                                            Pemilik</th>
                                        <th
                                            class="text-center text-secondary text-xs font-weight-semibold opacity-7 col-tanggal">
                                            Bergabung Pada</th>
                                        <th
                                            class="text-center text-secondary text-xs font-weight-semibold opacity-7 col-status">
                                            Status</th>
                                        <th
                                            class="text-center text-secondary text-xs font-weight-semibold opacity-7 col-aksi">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="align-middle">
                                    @forelse ($kelas as $k)
                                    <x-kelasitem gambar="{{ $k->gambar_kelas }}" nama_kelas="{{ $k->nama_kelas }}"
                                        pemilik="{{ $k->user->username }}" deskripsi="{{ $k->deskripsi_kelas }}"
                                        status="Aktif" tanggal="{{ $k->bergabung->created_at->format('d-m-Y') }}"
                                        :kelas="$k" />
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4">
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="fa-solid fa-inbox fa-2x text-muted mb-2"></i>
                                                <p class="text-muted mb-0">Belum ada kelas yang diikuti</p>
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

                const response = await fetch('{{ route("kelas.store") }}', {
                    method: 'POST',
                    body: formData
                });

                const result = await response.json();

                if (response.ok) {
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