<x-app-layout>
    <style>
    .card {
        transition: transform 0.3s ease-in-out;
        text-decoration: none;
        color: black;
    }

    .card-hyperlink {
        text-decoration: none;
    }

    .card:hover {
        transform: translate(0, -8px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.6);
    }

    /* CSS untuk tabel scrollable */
    .table-scrollable {
        max-height: 300px;
        /* Tinggi maksimal untuk 4 baris */
        overflow-y: auto;
        position: relative;
    }

    .table-scrollable thead th {
        position: sticky;
        top: 0;
        background-color: #f8f9fa;
        /* Warna yang sama dengan bg-gray-100 */
        z-index: 10;
    }

    .table-scrollable tbody tr {
        height: 60px;
        /* Tinggi tetap untuk setiap baris */
    }
    </style>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-md-flex align-items-center mb-3 mx-2">
                        <div class="mb-md-0 mb-3">
                            <h3 class="font-weight-bold mb-0">{{ selamat() . Auth::user()->username }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-0">
            <div class="row mt-4">
                <div class="col-xl-4 col-sm-6 mb-xl-0">
                    <a href="{{ route('kelas.index') }}" class="card-hyperlink">
                        <div class="card border shadow-xs mb-4">
                            <div class="card-body text-start p-3 w-100">
                                <div
                                    class="icon icon-md bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                                    <i class="fa-solid fa-user-group"></i>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="w-100">
                                            <p class="text-sm text-secondary mb-1">Total Kelas</p>
                                            <h3 class="mb-2 font-weight-bold">
                                                {{ $kelas->count() }}
                                            </h3>
                                            <div class="d-flex align-items-center">
                                                <span class="text-sm">Total kelas yang tergabung</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-4 col-sm-6 mb-xl-0">
                    <a href="{{ route('notifikasi.index') }}" class="card-hyperlink">
                        <div class="card border shadow-xs mb-4">
                            <div class="card-body text-start p-3 w-100">
                                <div
                                    class="icon icon-md bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                                    <i class="fa-solid fa-bell"></i>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="w-100">
                                            <p class="text-sm text-secondary mb-1">Total Notifikasi</p>
                                            <h3 class="mb-2 font-weight-bold">{{ Auth::user()->notifikasis()->count() }}</h3>
                                            <div class="d-flex align-items-center">
                                                <span class="text-sm">notifikasi yang ada di inbox</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-4 col-sm-6">
                    <a href="{{ route('kelas.index') }}" style="text-decoration: none;">
                        <div class="card border shadow-xs mb-xl-0">
                        <div class="card-body text-start p-3 w-100">
                            <div class="d-flex justify-content-end mb-3">
                                <i class="fa-solid fa-square-arrow-up-right text-6xl"></i>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="w-100">
                                        <p class="text-sm text-secondary mb-1"><br></p>
                                        <h3 class="mb-2 font-weight-bold">Gabung Kelas</h3>
                                        <div class="d-flex align-items-center">
                                            <span class="text-sm">menggunakan kode</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
            <hr class="my-0">
            <div class="row my-4">
                <div class="col-lg-12 col-md-6">
                    <div class="card shadow-xs border">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center mb-3">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Daftar Kelas</h6>
                                    <p class="text-sm mb-sm-0 mb-2">Berikut adalah beberapa daftar-daftar kelas</p>
                                </div>
                                <div class="ms-auto d-flex">
                                    <a href="{{ route('kelas.index') }}" class="btn btn-sm btn-dark btn-icon d-flex align-items-center mb-0">
                                        <span class="btn-inner--text">Selengkapnya</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body px-0 py-0">
                            <div class="table-responsive p-0 table-scrollable">
                                <table class="table align-items-center justify-content-center mb-0">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="text-secondary text-xs font-weight-semibold">
                                                Nama Kelas</th>
                                            <th class="text-secondary text-xs font-weight-semibold ps-2">
                                                Bergabung Pada</th>
                                            <th class="text-secondary text-xs font-weight-semibold ps-2">
                                                Pemilik
                                            </th>
                                            <th class="text-secondary text-xs font-weight-semibold ps-2">
                                                Status</th>
                                            <th
                                                class="text-center text-secondary text-xs font-weight-semibold">Aksi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($kelas->count() > 0)
                                            @foreach($kelas as $k)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex align-items-center">
                                                            @if($k->gambar_kelas)
                                                            <img src="{{ asset('storage/' . $k->gambar_kelas) }}" class="avatar avatar-sm rounded-circle me-2"
                                                                alt="{{ $k->nama_kelas }}">
                                                            @else
                                                            <div
                                                                class="avatar avatar-sm bg-primary rounded-circle me-2 d-flex align-items-center justify-content-center">
                                                                <i class="fa-solid fa-book text-white text-xs"></i>
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center ms-1">
                                                            <h6 class="mb-0 text-sm font-weight-semibold text-truncate" style="max-width: 200px;">
                                                                {{ $k->nama_kelas }}
                                                            </h6>
                                                            <p class="text-sm text-secondary mb-0 text-truncate" style="max-width: 200px;">
                                                                {{ $k->deskripsi_kelas }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-sm text-dark font-weight-semibold mb-0">
                                                        {{ $k->bergabung->first()->created_at->format('d/m/Y') }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-sm text-dark font-weight-semibold mb-0">
                                                        {{ $k->user->username }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <span class="badge badge-sm border border-success text-success bg-success">Aktif</span>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm btn-outline-dark mb-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            @php
                                                                $existingPresensi = \App\Models\Presensi::where('id_user', Auth::id())
                                                                    ->where('id_kelas', $k->id_kelas)
                                                                    ->whereDate('created_at', today())
                                                                    ->first();
                                                            @endphp

                                                            @if($existingPresensi)
                                                                <li>
                                                                    <a class="dropdown-item" href="{{ route('presensi.edit', ['kelas' => $k->id_kelas, 'presensi' => $existingPresensi->id_presensi]) }}">
                                                                        <i class="fa-solid fa-edit me-2"></i>Edit Presensi
                                                                    </a>
                                                                </li>
                                                            @else
                                                                <li>
                                                                    <a class="dropdown-item" href="{{ route('presensi.create-by-kelas', $k->id_kelas) }}">
                                                                        <i class="fa-solid fa-clipboard-check me-2"></i>Isi Presensi
                                                                    </a>
                                                                </li>
                                                            @endif

                                                            <li>
                                                                <a class="dropdown-item" href="{{ route('kelas.show', $k->id_kelas) }}">
                                                                    <i class="fa-solid fa-eye me-2"></i>Lihat Detail
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5" class="text-center py-4">
                                                    <div class="d-flex flex-column align-items-center">
                                                        <i class="fa-solid fa-inbox fa-2x text-muted mb-2"></i>
                                                        <p class="text-muted mb-0">Belum ada kelas yang diikuti</p>
                                                        <small class="text-muted">Gabung kelas untuk melihat daftar di sini</small>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-app.footer />
        </div>
    </main>
    <style>
    .input-group .form-control,
    .input-group .btn,
    .input-group .input-group-text {
        height: 45px;
        border-radius: 0.5rem;
    }

    .input-group-text svg {
        opacity: 0.6;
    }

    .text-truncate {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    </style>

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
    </script>

</x-app-layout>