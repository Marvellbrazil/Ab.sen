<x-app-layout>
    <style>
    .card {
        border-radius: 0.75rem;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
    }

    .form-control {
        border-radius: 0.5rem;
        border: 1px solid #d1d3e2;
        transition: all 0.15s ease-in-out;
    }

    .form-control:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    }

    .form-control-label {
        font-weight: 600;
        color: #5a5c69;
        margin-bottom: 0.5rem;
    }

    .btn-dark {
        background-color: #5a5c69;
        border-color: #5a5c69;
        border-radius: 0.5rem;
    }

    .btn-dark:hover {
        background-color: #42444e;
        border-color: #42444e;
    }
    </style>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center justify-content-between">
                                <div>
                                    @if(Auth::user()->isAdmin())
                                    <h6 class="font-weight-semibold text-lg mb-0">
                                        {{ isset($kelas) ? 'Edit Kelas' : 'Buat Kelas Baru' }}
                                    </h6>
                                    <p class="text-sm">
                                        {{ isset($kelas) ? 'Perbarui informasi kelas' : 'Isi form berikut untuk membuat kelas baru' }}
                                    </p>
                                    @else
                                    <h6 class="font-weight-semibold text-lg mb-0">
                                        {{ isset($presensi->id_presensi) ? 'Edit' : 'Isi' }} Presensi -
                                        {{ $kelas->nama_kelas }}
                                    </h6>
                                    <p class="text-sm">
                                        {{ isset($presensi->id_presensi) ? 'Edit presensi untuk hari ini' : 'Isi presensi untuk hari ini' }}
                                    </p>
                                    @endif
                                </div>
                                <div>
                                    @if(Auth::user()->isAdmin())
                                    @if(isset($kelas))
                                    <a href="{{ route('kelas.show', $kelas) }}"
                                        class="btn btn-sm btn-outline-dark mb-0 me-2">
                                        <i class="fa-solid fa-eye me-2"></i>Lihat Kelas
                                    </a>
                                    @endif
                                    <a href="{{ route('kelas.index') }}" class="btn btn-sm btn-dark mb-0">
                                        <i class="fa-solid fa-arrow-left me-2"></i>Kembali
                                    </a>
                                    @else
                                    <a href="{{ route('kelas.show', $kelas) }}" class="btn btn-sm btn-dark mb-0">
                                        <i class="fa-solid fa-arrow-left me-2"></i>Kembali
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-4 py-4">

                            @if(Auth::user()->isAdmin())
                            <!-- FORM UNTUK ADMIN (EDIT/BUAT KELAS) -->
                            @if(isset($kelas))
                            <!-- Form Edit Kelas -->
                            <form method="POST" action="{{ route('kelas.update', $kelas) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                @else
                                <!-- Form Buat Kelas Baru -->
                                <form method="POST" action="{{ route('kelas.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    @endif

                                    <div class="form-group">
                                        <label for="nama_kelas" class="form-control-label">Nama Kelas</label>
                                        <input type="text"
                                            class="form-control @error('nama_kelas') is-invalid @enderror"
                                            id="nama_kelas" name="nama_kelas"
                                            value="{{ old('nama_kelas', $kelas->nama_kelas ?? '') }}"
                                            placeholder="Masukkan nama kelas" required>
                                        @error('nama_kelas')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="deskripsi_kelas" class="form-control-label">Deskripsi Kelas</label>
                                        <textarea class="form-control @error('deskripsi_kelas') is-invalid @enderror"
                                            id="deskripsi_kelas" name="deskripsi_kelas" rows="3"
                                            placeholder="Masukkan deskripsi kelas">{{ old('deskripsi_kelas', $kelas->deskripsi_kelas ?? '') }}</textarea>
                                        @error('deskripsi_kelas')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="waktu_mulai" class="form-control-label small">Waktu
                                                    Mulai Presensi</label>
                                                <input type="time"
                                                    class="form-control @error('waktu_mulai') is-invalid @enderror"
                                                    id="waktu_mulai" name="waktu_mulai"
                                                    value="{{ old('waktu_mulai', $kelas->waktu_mulai ?? '') }}"
                                                    placeholder="Masukkan waktu mulai" required>
                                                @error('waktu_mulai')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="waktu_selesai" class="form-control-label small">Waktu
                                                    Selesai Presensi</label>
                                                <input type="time"
                                                    class="form-control @error('waktu_selesai') is-invalid @enderror"
                                                    id="waktu_selesai" name="waktu_selesai"
                                                    value="{{ old('waktu_selesai', $kelas->waktu_selesai ?? '') }}"
                                                    placeholder="Masukkan waktu selesai" required>
                                                @error('waktu_selesai')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="gambar_kelas" class="form-control-label">Gambar Kelas
                                            (Opsional)</label>
                                        <input type="file"
                                            class="form-control @error('gambar_kelas') is-invalid @enderror"
                                            id="gambar_kelas" name="gambar_kelas" accept="image/*">
                                        @error('gambar_kelas')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Format: JPG, PNG, JPEG. Maksimal 2MB</small>

                                        <!-- Preview gambar -->
                                        <div id="imagePreview"
                                            class="mt-3 {{ (isset($kelas) && $kelas->gambar_kelas) ? '' : 'd-none' }}">
                                            <p class="text-sm mb-2">Preview:</p>
                                            @if(isset($kelas) && $kelas->gambar_kelas)
                                            <img id="previewImage" src="{{ Storage::url($kelas->gambar_kelas) }}"
                                                alt="Preview gambar" class="img-thumbnail" style="max-width: 200px;">
                                            @else
                                            <img id="previewImage" src="#" alt="Preview gambar" class="img-thumbnail"
                                                style="max-width: 200px;">
                                            @endif
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end mt-4">
                                        <button type="submit" class="btn btn-dark btn-sm mb-0">
                                            <i class="fa-solid fa-save me-2"></i>
                                            {{ isset($kelas) ? 'Update Kelas' : 'Buat Kelas' }}
                                        </button>
                                    </div>
                                </form>

                                @else
                                <!-- FORM UNTUK USER (PRESENSI) -->
                                @if(isset($presensi->id_presensi))
                                <!-- Form untuk edit presensi -->
                                <form method="POST"
                                    action="{{ route('presensi.update', ['kelas' => $kelas, 'presensi' => $presensi]) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    @else
                                    <!-- Form untuk create presensi -->
                                    <form method="POST" action="{{ route('presensi.store', $kelas) }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @endif
                                        <div class="form-group">
                                            <label for="status" class="form-control-label">Status Presensi</label>
                                            <select class="form-control @error('status') is-invalid @enderror"
                                                id="status" name="status" required>
                                                <option value="">Pilih Status</option>
                                                <option value="hadir"
                                                    {{ old('status', $presensi->status ?? '') == 'hadir' ? 'selected' : '' }}>
                                                    Hadir</option>
                                                <option value="izin"
                                                    {{ old('status', $presensi->status ?? '') == 'izin' ? 'selected' : '' }}>
                                                    Izin</option>
                                                <option value="sakit"
                                                    {{ old('status', $presensi->status ?? '') == 'sakit' ? 'selected' : '' }}>
                                                    Sakit</option>
                                            </select>
                                            @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="keterangan" class="form-control-label">Keterangan
                                                (Opsional)</label>
                                            <textarea class="form-control @error('keterangan') is-invalid @enderror"
                                                id="keterangan" name="keterangan" rows="3"
                                                placeholder="Masukkan keterangan jika diperlukan">{{ old('keterangan', $presensi->keterangan ?? '') }}</textarea>
                                            @error('keterangan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="gambar" class="form-control-label">Gambar (Opsional)</label>
                                            <input type="file"
                                                class="form-control @error('gambar') is-invalid @enderror" id="gambar"
                                                name="gambar" accept="image/*">
                                            @error('gambar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            @if(isset($presensi->gambar) && $presensi->gambar != 'default.jpg')
                                            <div class="mt-2">
                                                <p class="text-sm">Gambar saat ini:</p>
                                                <img src="{{ asset('storage/' . $presensi->gambar) }}"
                                                    alt="Gambar presensi" class="img-thumbnail"
                                                    style="max-width: 200px;">
                                            </div>
                                            @endif
                                        </div>

                                        <div class="d-flex justify-content-end mt-4">
                                            <button type="submit" class="btn btn-dark btn-sm mb-0">
                                                <i class="fa-solid fa-save me-2"></i>
                                                {{ isset($presensi->id_presensi) ? 'Update Presensi' : 'Simpan Presensi' }}
                                            </button>
                                        </div>
                                    </form>
                                    @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-app.footer />
    </main>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Preview gambar untuk admin (kelas)
        const gambarKelasInput = document.getElementById('gambar_kelas');
        const imagePreview = document.getElementById('imagePreview');
        const previewImage = document.getElementById('previewImage');

        if (gambarKelasInput) {
            gambarKelasInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        imagePreview.classList.remove('d-none');
                    };
                    reader.readAsDataURL(file);
                } else {
                    imagePreview.classList.add('d-none');
                }
            });
        }

        // Preview gambar untuk user (presensi)
        const gambarPresensiInput = document.getElementById('gambar');
        if (gambarPresensiInput) {
            gambarPresensiInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        // Untuk presensi, kita bisa menambahkan preview jika diperlukan
                        console.log('File selected:', file.name);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    });
    </script>
</x-app-layout>