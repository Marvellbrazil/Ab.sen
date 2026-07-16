@props(['anggota'])

@forelse($anggota as $index => $a)
<tr>
    <td class="ps-4">
        <span class="text-sm text-secondary">
            {{ ($anggota instanceof \Illuminate\Pagination\LengthAwarePaginator) ? (($anggota->currentPage() - 1) * $anggota->perPage() + $index + 1) : ($index + 1) }}
        </span>
    </td>
    <td>
        <div class="d-flex align-items-center">
            <div class="avatar avatar-sm me-3">
                @if($a->profile_picture && $a->profile_picture !== 'default.jpg')
                    <img src="{{ Storage::url($a->profile_picture) }}"
                         alt="{{ $a->username }}" class="rounded-circle"
                         style="width: 32px; height: 32px; object-fit: cover;">
                @else
                    <div class="avatar avatar-sm bg-primary rounded-circle d-flex align-items-center justify-content-center"
                         style="width: 32px; height: 32px;">
                        <span class="text-white text-xs font-weight-bold">
                            {{ substr($a->username, 0, 1) }}
                        </span>
                    </div>
                @endif
            </div>
            <div class="d-flex flex-column">
                <h6 class="mb-0 text-sm font-weight-semibold">{{ $a->username }}</h6>
                <p class="text-xs text-secondary mb-0">{{ $a->email }}</p>
            </div>
        </div>
    </td>
    <td>
        <span class="text-sm text-secondary">
            {{ \Carbon\Carbon::parse($a->pivot->created_at ?? $a->created_at)->format('d/m/Y H:i') }}
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
