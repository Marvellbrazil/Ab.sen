@props([
    'kelas',
    'existingPresensi' => null,
    'showTenggang' => false
])

<tr>
    <td class="{{ $showTenggang ? 'col-nama' : 'ps-4' }}">
        <div class="d-flex align-items-center">
            <div class="me-3">
                @if($kelas->gambar_kelas)
                    <img src="{{ asset('storage/' . $kelas->gambar_kelas) }}"
                         class="avatar avatar-sm rounded-circle"
                         alt="{{ $kelas->nama_kelas }}">
                @else
                    <div class="avatar avatar-sm bg-primary rounded-circle d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-book text-white text-xs"></i>
                    </div>
                @endif
            </div>
            <div>
                <h6 class="text-sm font-weight-semibold mb-0 text-truncate-1" style="max-width: 200px;">
                    {{ $kelas->nama_kelas }}
                </h6>
                <p class="text-sm text-secondary mb-0 text-truncate-1" style="max-width: 200px;">
                    {{ $kelas->deskripsi_kelas ?: 'Tidak ada deskripsi' }}
                </p>
            </div>
        </div>
    </td>

    @if (Auth::user()->isAdmin())
        <td class="{{ $showTenggang ? 'align-middle text-center text-sm col-tanggal' : '' }}">
            <p class="text-sm text-dark font-weight-semibold mb-0">
                {{ $kelas->created_at->format('d/m/Y') }}
            </p>
            <p class="text-xs text-muted mb-0">
                {{ $kelas->created_at->format('H:i') }}
            </p>
        </td>
        <td class="{{ $showTenggang ? 'col-pemilik' : '' }}">
            <p class="text-sm text-dark font-weight-semibold mb-0">
                {{ $kelas->anggota_count ?? $kelas->anggota->count() }} Anggota
            </p>
        </td>
    @else
        <td class="{{ $showTenggang ? 'align-middle text-center text-sm col-tanggal' : '' }}">
            <p class="text-sm text-dark font-weight-semibold mb-0">
                @if(!$showTenggang)
                    {{ $kelas->created_at->format('d/m/Y') }}
                @else
                    @if($kelas->anggota->first() && $kelas->anggota->first()->pivot)
                        {{ \Carbon\Carbon::parse($kelas->anggota->first()->pivot->created_at)->format('d/m/Y') }}
                    @else
                        {{ $kelas->created_at->format('d/m/Y') }}
                    @endif
                @endif
            </p>
            <p class="text-xs text-muted mb-0">
                {{ $kelas->created_at->format('H:i') }}
            </p>
        </td>
        <td class="{{ $showTenggang ? 'col-pemilik' : '' }}">
            <div class="d-flex align-items-center">
                <div class="avatar avatar-xs bg-light rounded-circle me-2 d-flex align-items-center justify-content-center">
                    <i class="fa-solid fa-user text-dark text-xs"></i>
                </div>
                <p class="text-sm text-dark font-weight-semibold mb-0">
                    {{ $kelas->user->username }}
                </p>
            </div>
        </td>
    @endif

    @if($showTenggang)
        <td class="align-middle text-center col-status">
            <span class="text-secondary text-sm font-weight-normal">
                {{ Carbon\Carbon::parse($kelas->waktu_mulai)->format('H:i') }} - {{ Carbon\Carbon::parse($kelas->waktu_selesai)->format('H:i') }}
            </span>
        </td>
    @endif

    @if (Auth::user()->isUser())
        <td class="{{ $showTenggang ? 'align-middle text-center col-status' : '' }}">
            @if($existingPresensi)
                @php
                    $badgeColor = match($existingPresensi->status) {
                        'hadir' => 'bg-primary text-success',
                        'izin' => 'bg-primary text-warning',
                        'sakit' => 'bg-primary text-dark',
                        'alpha' => 'bg-primary text-dark',
                        'terlambat' => 'bg-primary text-danger'
                    };
                @endphp
                <span class="badge badge-sm {{ $badgeColor }}">
                    {{ ucfirst($existingPresensi->status) }}
                </span>
            @else
                <span class="badge badge-sm bg-secondary text-danger">
                    Belum Presensi
                </span>
            @endif
        </td>
    @endif

    <td class="text-center {{ $showTenggang ? 'col-aksi' : 'pe-4' }}">
        @if($showTenggang)
            <div class="dropdown">
                <button class="three-dots" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
                <ul class="dropdown-menu">
                    @if (Auth::user()->isUser())
                        @if($existingPresensi)
                            <li>
                                <a class="dropdown-item" href="{{ route('presensi.edit', [$kelas->id_kelas, $existingPresensi->id_presensi]) }}">
                                    <i class="fa-solid fa-edit me-2"></i>Edit Presensi
                                </a>
                            </li>
                            <li>
                                <span class="dropdown-item-text text-sm text-success">
                                    <i class="fa-solid fa-check me-2"></i>Sudah Presensi
                                </span>
                            </li>
                        @else
                            <li>
                                <a class="dropdown-item" href="{{ route('presensi.create', $kelas->id_kelas) }}">
                                    <i class="fa-solid fa-clipboard-check me-2"></i>Isi Presensi
                                </a>
                            </li>
                        @endif
                    @endif

                    <li>
                        <a class="dropdown-item" href="{{ route('kelas.show', $kelas->id_kelas) }}">
                            <i class="fa-solid fa-eye me-2"></i>Lihat Detail
                        </a>
                    </li>

                    @auth
                        @if(Auth::user()->isAdmin())
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('kelas.edit', $kelas->id_kelas) }}">
                                    <i class="fa-solid fa-edit me-2"></i>Edit Kelas
                                </a>
                            </li>
                            <li>
                                <button type="button" class="dropdown-item text-danger" onclick="confirmDelete({{ $kelas->id_kelas }})">
                                    <i class="fa-solid fa-trash me-2"></i>Hapus Kelas
                                </button>
                            </li>
                        @endif
                    @endauth
                </ul>
            </div>
            
            <form id="delete-form-{{ $kelas->id_kelas }}" action="{{ route('kelas.destroy', $kelas->id_kelas) }}" method="POST" class="d-none">
                @csrf
                @method('DELETE')
            </form>
        @else
            <a href="{{ route('kelas.show', $kelas->id_kelas) }}" class="btn btn-sm btn-outline-dark mb-0">
                <i class="fa-solid fa-eye me-1"></i>Selengkapnya
            </a>
        @endif
    </td>
</tr>
