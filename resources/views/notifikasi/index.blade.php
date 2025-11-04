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
                                    <h6 class="font-weight-semibold text-lg mb-0">Notifikasi</h6>
                                    <p class="text-sm">Daftar semua notifikasi Anda</p>
                                </div>
                                <div>
                                    @if($notifications->count() > 0)
                                    <form action="{{ route('notifikasi.clearAll') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-danger mb-0"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus semua notifikasi?')">
                                            <i class="fa-solid fa-trash me-2"></i>Hapus Semua
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 py-0">
                            @if($notifications->count() > 0)
                            <div class="list-group list-group-flush">
                                @foreach($notifications as $notification)
                                <div class="list-group-item border-0 d-flex align-items-start p-4 
                                            {{ $notification->status == 'unread' ? 'bg-light-warning' : '' }}">
                                    <div class="me-3">
                                        @php
                                        $iconClass = [
                                        'info' => 'fa-info-circle text-info',
                                        'success' => 'fa-check-circle text-success',
                                        'warning' => 'fa-exclamation-triangle text-warning',
                                        'danger' => 'fa-times-circle text-danger',
                                        'presensi' => 'fa-clipboard-check text-primary',
                                        'pengumuman' => 'fa-bullhorn text-info',
                                        'tugas' => 'fa-tasks text-warning',
                                        'sistem' => 'fa-cog text-secondary'
                                        ][$notification->tipe_notifikasi] ?? 'fa-bell text-dark';
                                        @endphp
                                        <i class="fa-solid {{ $iconClass }} fa-lg mt-1"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h6
                                                    class="mb-1 text-sm {{ $notification->status == 'unread' ? 'font-weight-bold' : '' }}">
                                                    {{ $notification->pesan_notifikasi }}
                                                </h6>
                                                @if($notification->kelas)
                                                <p class="text-xs text-muted mb-0">
                                                    Kelas: {{ $notification->kelas->nama_kelas }}
                                                </p>
                                                @endif
                                                <p class="text-xs text-muted mb-0">
                                                    {{ $notification->created_at->diffForHumans() }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    @if($notification->status == 'unread')
                                    <span class="badge bg-warning ms-2">Baru</span>
                                    @endif
                                </div>
                                @endforeach
                            </div>

                            <!-- Pagination -->
                            <div class="card-footer border-top py-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="text-sm text-muted mb-0">
                                        Menampilkan {{ $notifications->firstItem() }} - {{ $notifications->lastItem() }}
                                        dari {{ $notifications->total() }} notifikasi
                                    </p>
                                    {{ $notifications->links() }}
                                </div>
                            </div>
                            @else
                            <div class="text-center py-5">
                                <i class="fa-solid fa-bell-slash text-muted fa-3x mb-3"></i>
                                <h6 class="text-muted mb-2">Tidak ada notifikasi</h6>
                                <p class="text-muted small">Anda tidak memiliki notifikasi saat ini</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-app.footer />
    </main>
</x-app-layout>