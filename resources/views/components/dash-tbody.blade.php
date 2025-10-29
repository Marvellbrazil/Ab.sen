@props(['gambar' => 'https://placehold.co/80', 'nama', 'bergabungPada', 'pemilik', 'status'])

<tr>
    <td>
        <div class="d-flex px-2">
            <div class="avatar avatar-sm rounded-circle bg-gray-100 me-3 my-2">
                <img src="{{ $gambar }}" class="w-100 h-100 rounded-circle" alt="{{ $gambar }}">
            </div>
            <div class="my-auto">
                <h6 class="mb-0 text-sm">{{ $nama }}</h6>
            </div>
        </div>
    </td>
    <td>
        <p class="text-sm font-weight-normal mb-0">{{ $bergabungPada }}</p>
    </td>
    <td>
        <span class="text-sm font-weight-normal">{{ $pemilik }}</span>
    </td>
    <td class="align-middle">
        <div class="d-flex">
            <div class="ms-2">
                <p class="text-dark text-sm mb-0">{{ $status }}</p>
            </div>
        </div>
    </td>
    <td class="align-middle text-center">
        <a href="{{ route('kelas.index') }}" class="text-secondary font-weight-bold text-xs" data-bs-toggle="tooltip"
            data-bs-title="Lihat Kelas">
            <i class="fas fa-eye"></i>
        </a>
    </td>
</tr>