<x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <!-- Welcome Section -->
            <div class="row">
                <div class="col-12">
                    <div class="d-md-flex align-items-center mb-4">
                        <div class="mb-md-0 mb-3">
                            <h3 class="welcome-message mb-1">{{ selamat() . Auth::user()->username }}! 👋</h3>
                            <p class="text-muted mb-0">Selamat datang di dashboard presensi</p>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <!-- Statistics Cards -->
            <div class="row mt-4">
                <div class="col-xl-4 col-sm-6 mb-4">
                    <a href="{{ route('kelas.index') }}" class="card-hyperlink">
                        <div class="card border shadow-xs h-100">
                            <div class="card-body text-start p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="icon icon-md bg-dark text-white text-center border-radius-sm me-3">
                                        <i class="fa-solid fa-user-group fs-6"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-secondary mb-1">Total Kelas</p>
                                        <h3 class="mb-0 font-weight-bold text-dark">
                                            {{ $kelas->count() }}
                                        </h3>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    @if (Auth::user()->isAdmin())
                                        <span class="text-sm text-muted">Total kelas yang dibuat</span>
                                    @elseif (Auth::user()->isUser())
                                        <span class="text-sm text-muted">Total kelas yang tergabung</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-4 col-sm-6 mb-4">
                    <a href="{{ route('notifikasi.index') }}" class="card-hyperlink">
                        <div class="card border shadow-xs h-100">
                            <div class="card-body text-start p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="icon icon-md bg-dark text-white text-center border-radius-sm me-3">
                                        <i class="fa-solid fa-bell fs-6"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-secondary mb-1">Total Notifikasi</p>
                                        <h3 class="mb-0 font-weight-bold text-dark">
                                            {{ Auth::user()->notifikasis()->count() }}
                                        </h3>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="text-sm text-muted">Notifikasi di inbox</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-4 col-sm-6 mb-4">
                    @if (Auth::user()->isAdmin())
                    <a href="{{ route('kelas.create') }}" class="card-hyperlink">
                        <div class="card border shadow-xs h-100">
                            <div class="card-body text-start p-4">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="icon icon-md bg-dark text-white text-center border-radius-sm me-3">
                                            <i class="fa-solid fa-plus fs-6"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm text-secondary mb-1">Buat Kelas</p>
                                            <h3 class="mb-0 font-weight-bold text-dark">Baru</h3>
                                        </div>
                                    </div>
                                    <i class="fa-solid fa-arrow-up-right-from-square text-muted fs-5"></i>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="text-sm text-muted">Buat kelas baru</span>
                                </div>
                            </div>
                        </div>
                    </a>
                    @elseif (Auth::user()->isUser())
                    <a href="{{ route('kelas.index') }}" class="card-hyperlink">
                        <div class="card border shadow-xs h-100">
                            <div class="card-body text-start p-4">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="icon icon-md bg-dark text-white text-center border-radius-sm me-3">
                                            <i class="fa-solid fa-plus fs-6"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm text-secondary mb-1">Gabung Kelas</p>
                                            <h3 class="mb-0 font-weight-bold text-dark">Baru</h3>
                                        </div>
                                    </div>
                                    <i class="fa-solid fa-arrow-up-right-from-square text-muted fs-5"></i>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="text-sm text-muted">Menggunakan kode kelas</span>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endif
                </div>
            </div>

            <hr class="my-4">

            <!-- Classes Table -->
            <div class="row my-4">
                <div class="col-12">
                    <div class="card shadow-xs border">
                        <div class="card-header border-bottom pb-3">
                            <div class="d-sm-flex align-items-center justify-content-between">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-1">Daftar Kelas Terbaru</h6>
                                    @if (Auth::user()->isAdmin())
                                        <p class="text-sm text-muted mb-0">Kelas yang baru saja Anda buat</p>
                                    @elseif (Auth::user()->isUser())
                                        <p class="text-sm text-muted mb-0">Kelas yang baru saja Anda ikuti</p>
                                    @endif
                                </div>
                                <div class="mt-2 mt-sm-0">
                                    <a href="{{ route('kelas.index') }}"
                                        class="btn btn-sm btn-dark d-flex align-items-center">
                                        <span class="btn-inner--text">Lihat Semua</span>
                                        <i class="fa-solid fa-arrow-right ms-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="text-secondary text-xs font-weight-semibold ps-4">Nama Kelas</th>
                                            <th class="text-secondary text-xs font-weight-semibold">Bergabung Pada</th>
                                            <th class="text-secondary text-xs font-weight-semibold">Pemilik</th>
                                            <th class="text-secondary text-xs font-weight-semibold">Status</th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold pe-4">
                                                Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($kelas->count() > 0)
                                        @foreach($kelas->take(5) as $k)
                                        <tr>
                                            <td class="ps-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="me-3">
                                                        @if($k->gambar_kelas)
                                                        <img src="{{ asset('storage/' . $k->gambar_kelas) }}"
                                                            class="avatar avatar-sm rounded-circle"
                                                            alt="{{ $k->nama_kelas }}">
                                                        @else
                                                        <div
                                                            class="avatar avatar-sm bg-primary rounded-circle d-flex align-items-center justify-content-center">
                                                            <i class="fa-solid fa-book text-white text-xs"></i>
                                                        </div>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <h6 class="text-sm font-weight-semibold mb-0 text-truncate-1"
                                                            style="max-width: 200px;">
                                                            {{ $k->nama_kelas }}
                                                        </h6>
                                                        <p class="text-sm text-secondary mb-0 text-truncate-1"
                                                            style="max-width: 200px;">
                                                            {{ $k->deskripsi_kelas ?: 'Tidak ada deskripsi' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-sm text-dark font-weight-semibold mb-0">
                                                    {{ $k->created_at->format('d/m/Y') }}
                                                </p>
                                                <p class="text-xs text-muted mb-0">
                                                    {{ $k->created_at->format('H:i') }}
                                                </p>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="avatar avatar-xs bg-light rounded-circle me-2 d-flex align-items-center justify-content-center">
                                                        <i class="fa-solid fa-user text-dark text-xs"></i>
                                                    </div>
                                                    <p class="text-sm text-dark font-weight-semibold mb-0">
                                                        {{ $k->user->username }}
                                                    </p>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge border border-success text-success bg-success">
                                                    <i class="fa-solid fa-circle-check me-1"></i>Aktif
                                                </span>
                                            </td>
                                            <td class="text-center pe-4">
                                                <a href="{{ route('kelas.show', $k->id_kelas) }}"
                                                    class="btn btn-sm btn-outline-dark">
                                                    <i class="fa-solid fa-eye me-1"></i>Selengkapnya
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            @if (Auth::user()->isAdmin())
                                            <td colspan="5" class="text-center py-5">
                                                <div class="empty-state">
                                                    <i class="fa-solid fa-inbox text-muted"></i>
                                                    <h6 class="text-muted mb-2">Belum ada kelas yang dibuat</h6>
                                                    <p class="text-muted small mb-3">Buat kelas untuk melihat daftar
                                                        di sini</p>
                                                    <a href="{{ route('kelas.create') }}" class="btn btn-sm btn-outline-dark">
                                                        <i class="fa-solid fa-plus me-1"></i>Buat Kelas
                                                    </a>
                                                </div>
                                            </td>
                                            @elseif (Auth::user()->isUser())
                                            <td colspan="5" class="text-center py-5">
                                                <div class="empty-state">
                                                    <i class="fa-solid fa-inbox text-muted"></i>
                                                    <h6 class="text-muted mb-2">Belum ada kelas yang diikuti</h6>
                                                    <p class="text-muted small mb-3">Gabung kelas untuk melihat daftar
                                                        di sini</p>
                                                    <button class="btn btn-sm btn-outline-dark"
                                                        id="btnGabungKelasEmpty">
                                                        <i class="fa-solid fa-plus me-1"></i>Gabung Kelas
                                                    </button>
                                                </div>
                                            </td>
                                            @endif
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    // SweetAlert untuk gabung kelas
    function setupJoinClass() {
        const joinClass = async () => {
            const {
                value: kode
            } = await Swal.fire({
                title: 'Gabung Kelas',
                html: `
                    <div class="text-start">
                        <p class="text-muted mb-3">Masukkan kode kelas yang diberikan oleh pengajar</p>
                        <input type="text" class="form-control" id="kodeKelas" placeholder="ABC123" maxlength="10">
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: 'Gabung',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#5a5c69',
                cancelButtonColor: '#6c757d',
                preConfirm: () => {
                    const kode = document.getElementById('kodeKelas').value;
                    if (!kode) {
                        Swal.showValidationMessage('Kode kelas tidak boleh kosong!');
                    }
                    return kode;
                }
            });

            if (kode) {
                try {
                    const formData = new FormData();
                    formData.append('kode_kelas', kode);
                    formData.append('_token', '{{ csrf_token() }}');

                    const response = await fetch('{{ route("kelas.join") }}', {
                        method: 'POST',
                        body: formData
                    });

                    const result = await response.json();

                    if (response.ok) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: result.message || 'Kamu berhasil bergabung ke kelas.',
                            confirmButtonColor: '#5a5c69'
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: result.message || 'Kode kelas tidak valid.',
                            confirmButtonColor: '#5a5c69'
                        });
                    }
                } catch (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: 'Terjadi kesalahan koneksi ke server.',
                        confirmButtonColor: '#5a5c69'
                    });
                }
            }
        };

        // Attach event to both buttons
        document.getElementById('btnGabungKelas').addEventListener('click', joinClass);
        const emptyBtn = document.getElementById('btnGabungKelasEmpty');
        if (emptyBtn) {
            emptyBtn.addEventListener('click', joinClass);
        }
    }

    // Initialize when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        setupJoinClass();

        // Initialize Bootstrap dropdowns
        var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
        var dropdownList = dropdownElementList.map(function(dropdownToggleEl) {
            return new bootstrap.Dropdown(dropdownToggleEl)
        });
    });
    </script>
</x-app-layout>