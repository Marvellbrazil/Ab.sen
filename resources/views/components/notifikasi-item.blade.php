@props(['tanggal', 'pesan', 'dari', 'tipe', 'id', 'status' => 'unread', 'isChecked' => false, 'kelas' => null])

<tr>
    <td class="d-flex align-items-center py-3 px-4 text-sm">
        <div class="form-check mb-0">
            <input class="form-check-input checkbox-notifikasi" type="checkbox" value="1" data-id="{{ $id }}"
                id="notifikasi-{{ $id }}" {{ $isChecked ? 'checked' : '' }}>
        </div>
        <span class="font-weight-semibold text-dark ms-1">{{ $tanggal }}</span>
    </td>
    <td>
        <p class="mb-0 {{ $status == 'unread' ? 'font-weight-bold' : '' }}">
            {{ $pesan }}
        </p>
    </td>
    <td>
        <span class="text-sm">
            @if($kelas)
            <i class="fa-solid fa-book me-1 text-primary"></i>{{ $kelas }}
            @else
            {{ $dari }}
            @endif
        </span>
    </td>
    <td>
        @php
        $badgeClass = [
        'info' => 'bg-info',
        'warning' => 'bg-warning',
        'success' => 'bg-success',
        'error' => 'bg-danger'
        ][$tipe] ?? 'bg-secondary';
        @endphp
        <span class="badge badge-sm {{ $badgeClass }} text-white">{{ $tipe }}</span>
    </td>
    <td class="text-sm font-weight-semibold text-dark">
        <div class="d-flex gap-2">
            @if($status == 'unread')
            <form action="{{ route('notifikasi.mark-as-read', $id) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-success" title="Tandai sudah dibaca">
                    <i class="fa-solid fa-check me-1"></i>Dibaca
                </button>
            </form>
            @endif

            <form id="delete-form-{{ $id }}" action="{{ route('notifikasi.destroy', $id) }}" method="POST"
                class="d-inline">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete({{ $id }})">
                    <i class="fa-solid fa-trash me-1"></i>Hapus
                </button>
            </form>
        </div>
    </td>
</tr>