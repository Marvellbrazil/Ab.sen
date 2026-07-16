@props(['notification'])

<div class="list-group-item border-0 d-flex align-items-start p-4 {{ $notification->status == 'unread' ? 'bg-light-warning' : '' }}">
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
                <h6 class="mb-1 text-sm {{ $notification->status == 'unread' ? 'font-weight-bold' : '' }}">
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
