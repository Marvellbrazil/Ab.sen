@props([
'gambar' => '',
'nama_kelas',
'pemilik',
'deskripsi' => '',
'tenggang_absensi',
'status',
'tanggal',
'kelas'
])

@php
$existingPresensi = \App\Models\Presensi::where('id_user', Auth::id())
->where('id_kelas', $kelas->id_kelas)
->whereDate('created_at', today())
->first();
@endphp

<tr>
    <td class="col-nama">
        <div class="d-flex px-2 py-1">
            <div class="d-flex align-items-center">
                @if($gambar)
                <img src="{{ asset('storage/' . $gambar) }}" class="avatar avatar-sm rounded-circle me-2"
                    alt="{{ $nama_kelas }}">
                @else
                <div
                    class="avatar avatar-sm bg-primary rounded-circle me-2 d-flex align-items-center justify-content-center">
                    <i class="fa-solid fa-book text-white text-xs"></i>
                </div>
                @endif
            </div>
            <div class="d-flex flex-column justify-content-center ms-1">
                <h6 class="mb-0 text-sm font-weight-semibold text-truncate" title="Nama Kelas">{{ $nama_kelas }}
                </h6>
                <p class="text-sm text-secondary mb-0 text-truncate" title="Deskripsi Kelas">{{ $deskripsi }}</p>
            </div>
        </div>
    </td>
    <td class="col-pemilik">
        <p class="text-sm text-dark font-weight-semibold mb-0 text-truncate" title="Pemilik Kelas">{{ $pemilik }}</p>
    </td>
    <td class="align-middle text-center text-sm col-tanggal">
        <span class="text-secondary text-sm font-weight-normal">{{ $tanggal }}</span>
    </td>
    <td class="align-middle text-center col-status">
        <span class="badge badge-sm border border-success text-success bg-success">{{ $tenggang_absensi }}</span>
    </td>
    <td class="align-middle text-center col-status">
        <span class="badge badge-sm border border-success text-success bg-success">{{ $status }}</span>
    </td>
    <td class="text-center align-middle col-aksi">
        <div class="dropdown">
            <button class="three-dots" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-three-dots-vertical"></i>
            </button>
            <ul class="dropdown-menu">
                @if($existingPresensi)
                <li>
                    <a class="dropdown-item"
                        href="{{ route('presensi.edit', ['kelas' => $kelas->id_kelas, 'presensi' => $existingPresensi->id_presensi]) }}">
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
                    <a class="dropdown-item" href="{{ route('presensi.create-by-kelas', $kelas->id_kelas) }}">
                        <i class="fa-solid fa-clipboard-check me-2"></i>Isi Presensi
                    </a>
                </li>
                @endif

                <!-- Tombol lihat detail kelas -->
                <li>
                    <a class="dropdown-item" href="{{ route('kelas.show', $kelas->id_kelas) }}">
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
                    <a class="dropdown-item" href="{{ route('kelas.edit', $kelas->id_kelas) }}">
                        <i class="fa-solid fa-edit me-2"></i>Edit Kelas
                    </a>
                </li>
                <li>
                    <button type="button" class="dropdown-item text-danger"
                        onclick="confirmDelete({{ $kelas->id_kelas }})">
                        <i class="fa-solid fa-trash me-2"></i>Hapus Kelas
                    </button>
                </li>
                @endif
                @endauth
            </ul>
        </div>

        <!-- Form untuk delete (hidden) -->
        <form id="delete-form-{{ $kelas->id_kelas }}" action="{{ route('kelas.destroy', $kelas->id_kelas) }}"
            method="POST" class="d-none">
            @csrf
            @method('DELETE')
        </form>
    </td>
</tr>

@push('scripts')
<script>
function confirmDelete(kelasId) {
    if (confirm('Apakah Anda yakin ingin menghapus kelas ini?')) {
        document.getElementById('delete-form-' + kelasId).submit();
    }
}
</script>
@endpush