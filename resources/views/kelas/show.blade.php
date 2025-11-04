<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <!-- Detail Kelas -->
            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center justify-content-between">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Detail Kelas</h6>
                                    <p class="text-sm">Informasi lengkap tentang kelas</p>
                                </div>
                                <div>
                                    @if(Auth::user()->isUser())
                                    <a href="{{ route('presensi.create', $kelas->id_kelas) }}"
                                        class="btn btn-sm btn-outline-dark mb-0 me-2">
                                        <i class="fa-solid fa-clipboard-check me-2"></i>Buat Presensi
                                    </a>
                                    @else
                                    <a href="{{ route('kelas.edit', $kelas->id_kelas) }}"
                                        class="btn btn-sm btn-outline-dark mb-0 me-2">
                                        <i class="fa-solid fa-pen me-2"></i>Edit Kelas
                                    </a>
                                    @endif
                                    <a href="{{ route('kelas.index') }}" class="btn btn-sm btn-dark mb-0">
                                        <i class="fa-solid fa-arrow-left me-2"></i>Kembali
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-4 py-4">
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    @if($kelas->gambar_kelas)
                                    <img src="{{ Storage::url($kelas->gambar_kelas) }}" alt="{{ $kelas->nama_kelas }}"
                                        class="img-fluid rounded shadow-lg mb-3" style="max-height: 200px;">
                                    @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center mb-3"
                                        style="height: 200px;">
                                        <i class="fa-solid fa-image fa-3x text-muted"></i>
                                    </div>
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <h4 class="font-weight-semibold">{{ $kelas->nama_kelas }}</h4>
                                    <p class="text-sm text-muted mb-3">
                                        Dibuat oleh: {{ $kelas->user->username }}
                                    </p>
                                    <p class="text-sm text-muted mb-3">
                                        Kode Kelas: <b>{{ $kelas->kode_kelas }}</b>
                                    </p>
                                    <h6 class="font-weight-semibold">Deskripsi:</h6>
                                    <p class="text-sm">
                                        {{ $kelas->deskripsi_kelas ?? 'Belum ada deskripsi tentang kelas ini.' }}</p>

                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center">
                                                <div
                                                    class="icon icon-shape icon-sm bg-primary text-white text-center rounded-circle me-2">
                                                    <i class="fa-solid fa-users"></i>
                                                </div>
                                                <div>
                                                    <span class="text-sm">Jumlah Anggota</span>
                                                    <h6 class="mb-0">{{ $kelas->anggota->count() }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center">
                                                <div
                                                    class="icon icon-shape icon-sm bg-success text-white text-center rounded-circle me-2">
                                                    <i class="fa-solid fa-calendar"></i>
                                                </div>
                                                <div>
                                                    <span class="text-sm">Dibuat Pada</span>
                                                    <h6 class="mb-0">
                                                        {{ Carbon\Carbon::parse($kelas->created_at)->format('d/m/Y H:i') }}
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Anggota Kelas -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card border shadow-xs">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center justify-content-between">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Anggota Kelas</h6>
                                    <p class="text-sm">Daftar anggota yang bergabung dalam kelas ini</p>
                                </div>
                                <span class="badge bg-primary text-black">{{ $kelas->anggota->count() }} Anggota</span>
                            </div>
                        </div>
                        <div class="card-body px-0 py-0">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="text-secondary text-xs font-weight-semibold ps-4"
                                                style="width: 10%;">No</th>
                                            <th class="text-secondary text-xs font-weight-semibold" style="width: 60%;">
                                                Nama</th>
                                            <th class="text-secondary text-xs font-weight-semibold" style="width: 30%;">
                                                Bergabung Pada</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($kelas->anggota as $index => $anggota)
                                        <tr>
                                            <td class="ps-4">
                                                <span class="text-sm text-secondary">{{ $index + 1 }}</span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-sm me-3">
                                                        @if($anggota->profile_picture && $anggota->profile_picture !==
                                                        'default.jpg')
                                                        <img src="{{ Storage::url($anggota->profile_picture) }}"
                                                            alt="{{ $anggota->username }}" class="rounded-circle"
                                                            style="width: 32px; height: 32px; object-fit: cover;">
                                                        @else
                                                        <div class="avatar avatar-sm bg-primary rounded-circle d-flex align-items-center justify-content-center"
                                                            style="width: 32px; height: 32px;">
                                                            <span class="text-white text-xs font-weight-bold">
                                                                {{ substr($anggota->username, 0, 1) }}
                                                            </span>
                                                        </div>
                                                        @endif
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <h6 class="mb-0 text-sm font-weight-semibold">
                                                            {{ $anggota->username }}</h6>
                                                        <p class="text-xs text-secondary mb-0">{{ $anggota->email }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="text-sm text-secondary">
                                                    {{ \Carbon\Carbon::parse($anggota->pivot->created_at ?? $anggota->created_at)->format('d/m/Y H:i') }}
                                                </span>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3" class="text-center py-4 text-muted">
                                                <div class="d-flex flex-column align-items-center">
                                                    <i class="fa-solid fa-users-slash fa-2x text-muted mb-2"></i>
                                                    <p class="text-muted mb-0">Belum ada anggota di kelas ini</p>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            @if($kelas->anggota->hasPages())
                            <div class="border-top py-3 px-3 d-flex align-items-center">
                                <p class="font-weight-semibold mb-0 text-dark text-sm">
                                    Menampilkan {{ $kelas->anggota->count() }} dari {{ $kelas->anggota->total() }}
                                    anggota
                                </p>
                                <div class="ms-auto">
                                    @if ($kelas->anggota->onFirstPage())
                                    <button class="btn btn-sm btn-white mb-0" disabled>Previous</button>
                                    @else
                                    <a href="{{ $kelas->anggota->previousPageUrl() }}"
                                        class="btn btn-sm btn-white mb-0">Previous</a>
                                    @endif

                                    @if ($kelas->anggota->hasMorePages())
                                    <a href="{{ $kelas->anggota->nextPageUrl() }}"
                                        class="btn btn-sm btn-white mb-0">Next</a>
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

            <!-- Presensi -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card border shadow-xs">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center justify-content-between">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Presensi Terbaru</h6>
                                    <p class="text-sm">Daftar presensi terbaru dari kelas ini</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 py-0">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="text-secondary text-xs font-weight-semibold ps-4">Tanggal</th>
                                            <th class="text-secondary text-xs font-weight-semibold">Nama</th>
                                            <th class="text-secondary text-xs font-weight-semibold">Status</th>
                                            <th class="text-secondary text-xs font-weight-semibold">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($kelas->presensi as $p)
                                        <tr>
                                            <td class="ps-4">{{ \Carbon\Carbon::parse($p->tanggal)->format('d/m/Y') }}
                                            </td>
                                            <td>{{ $p->user->username ?? '-' }}</td>
                                            <td>
                                                <span
                                                    class="badge text-dark {{ $p->status === 'hadir' ? 'bg-success' : 'bg-danger' }}">
                                                    {{ ucfirst($p->status) }}
                                                </span>
                                            </td>
                                            <td>{{ $p->keterangan ?? '-' }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-4 text-muted">
                                                Belum ada data presensi untuk kelas ini.
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-app.footer />
    </main>
    <script>
    // Function untuk load anggota dengan pagination
    function loadAnggota(page) {
        fetch(`/kelas/{{ $kelas->id_kelas }}/anggota?page=${page}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('anggota-table-body').innerHTML = data.html;
                document.getElementById('anggota-pagination').innerHTML = data.pagination;
            })
            .catch(error => console.error('Error:', error));
    }

    // Event delegation untuk pagination
    document.addEventListener('click', function(e) {
        if (e.target.matches('.anggota-pagination a')) {
            e.preventDefault();
            const page = new URL(e.target.href).searchParams.get('page');
            loadAnggota(page);
        }
    });
    </script>
</x-app-layout>