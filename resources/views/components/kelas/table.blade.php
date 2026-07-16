@props([
    'kelas',
    'presensiData' => [],
    'showTenggang' => false
])

<div class="table-responsive">
    <table class="table {{ $showTenggang ? 'table-fixed' : '' }} align-items-center mb-0">
        <thead class="bg-gray-100">
            <tr>
                @if (Auth::user()->isAdmin())
                    <th class="text-secondary text-xs font-weight-semibold {{ $showTenggang ? 'opacity-7 col-nama' : 'ps-4' }}">Nama Kelas</th>
                    <th class="text-secondary text-xs font-weight-semibold {{ $showTenggang ? 'opacity-7 col-tanggal text-center' : '' }}">Dibuat Pada</th>
                    <th class="text-secondary text-xs font-weight-semibold {{ $showTenggang ? 'opacity-7 col-pemilik' : '' }}">Jumlah Anggota</th>
                    @if($showTenggang)
                        <th class="text-center text-secondary text-xs font-weight-semibold opacity-7 col-status">Tenggang Absensi</th>
                    @endif
                @else
                    <th class="text-secondary text-xs font-weight-semibold {{ $showTenggang ? 'opacity-7 col-nama' : 'ps-4' }}">Nama Kelas</th>
                    <th class="text-secondary text-xs font-weight-semibold {{ $showTenggang ? 'opacity-7 col-tanggal text-center' : '' }}">Bergabung Pada</th>
                    <th class="text-secondary text-xs font-weight-semibold {{ $showTenggang ? 'opacity-7 col-pemilik' : '' }}">Pemilik</th>
                    @if($showTenggang)
                        <th class="text-center text-secondary text-xs font-weight-semibold opacity-7 col-status">Tenggang Absensi</th>
                    @endif
                    <th class="text-secondary text-xs font-weight-semibold {{ $showTenggang ? 'opacity-7 col-status text-center' : '' }}">Status</th>
                @endif
                <th class="text-center text-secondary text-xs font-weight-semibold {{ $showTenggang ? 'opacity-7 col-aksi' : 'pe-4' }}">Aksi</th>
            </tr>
        </thead>
        <tbody class="align-middle">
            @forelse ($kelas as $k)
                @php
                    $existingPresensi = $presensiData[$k->id_kelas] ?? null;
                @endphp
                <x-kelas.row :kelas="$k" :existingPresensi="$existingPresensi" :showTenggang="$showTenggang" />
            @empty
                <tr>
                    @php $cols = Auth::user()->isAdmin() ? ($showTenggang ? 5 : 4) : ($showTenggang ? 6 : 5); @endphp
                    <td colspan="{{ $cols }}" class="text-center py-5">
                        <div class="empty-state py-4 text-center">
                            <i class="fa-solid fa-inbox text-muted fa-2x mb-2"></i>
                            <h6 class="text-muted mb-2">
                                @if(request('search'))
                                    Tidak ada kelas yang sesuai dengan pencarian "{{ request('search') }}"
                                @else
                                    {{ Auth::user()->isAdmin() ? 'Belum ada kelas yang dibuat' : 'Belum ada kelas yang diikuti' }}
                                @endif
                            </h6>
                            <p class="text-muted small mb-3">
                                {{ Auth::user()->isAdmin() ? 'Buat kelas untuk melihat daftar di sini' : 'Gabung kelas untuk melihat daftar di sini' }}
                            </p>
                            @if(Auth::user()->isAdmin())
                                <a href="{{ route('kelas.create') }}" class="btn btn-sm btn-outline-dark">
                                    <i class="fa-solid fa-plus me-1"></i>Buat Kelas
                                </a>
                            @elseif(Auth::user()->isUser() && !request('search'))
                                <button class="btn btn-sm btn-outline-dark" id="btnGabungKelasEmpty">
                                    <i class="fa-solid fa-plus me-1"></i>Gabung Kelas
                                </button>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
