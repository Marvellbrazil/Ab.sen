<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
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
                                    @auth
                                    @if(Auth::user()->isAdmin())
                                    <a href="{{ route('admin.kelas.edit', $kelas) }}"
                                        class="btn btn-sm btn-outline-dark mb-0 me-2">
                                        <i class="fa-solid fa-edit me-2"></i>Edit Kelas
                                    </a>
                                    @else
                                    <!-- Untuk user biasa, tampilkan tombol presensi -->
                                    @php
                                    $existingPresensi = \App\Models\Presensi::where('id_user', Auth::id())
                                    ->where('id_kelas', $kelas->id_kelas)
                                    ->whereDate('created_at', today())
                                    ->first();
                                    @endphp

                                    @if($existingPresensi)
                                    <a href="{{ route('presensi.edit', ['kelas' => $kelas->id_kelas, 'presensi' => $existingPresensi->id_presensi]) }}"
                                        class="btn btn-sm btn-outline-dark mb-0 me-2">
                                        <i class="fa-solid fa-edit me-2"></i>Edit Presensi
                                    </a>
                                    @else
                                    <a href="{{ route('presensi.create-by-kelas', $kelas->id_kelas) }}"
                                        class="btn btn-sm btn-outline-dark mb-0 me-2">
                                        <i class="fa-solid fa-clipboard-check me-2"></i>Isi Presensi
                                    </a>
                                    @endif
                                    @endif
                                    @endauth

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
                                    <h6 class="font-weight-semibold">Deskripsi:</h6>
                                    <p class="text-sm">{{ $kelas->deskripsi_kelas }}</p>

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
                                                    <h6 class="mb-0">{{ $kelas->created_at }}</h6>
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
        </div>
        <x-app.footer />
    </main>
</x-app-layout>