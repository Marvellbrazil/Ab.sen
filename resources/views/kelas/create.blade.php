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
                                    <h6 class="font-weight-semibold text-lg mb-0">Buat Kelas Baru</h6>
                                    <p class="text-sm">Isi form berikut untuk membuat kelas baru</p>
                                </div>
                                <a href="{{ route('kelas.index') }}" class="btn btn-sm btn-dark mb-0">
                                    <i class="fa-solid fa-arrow-left me-2"></i>Kembali
                                </a>
                            </div>
                        </div>
                        <div class="card-body px-4 py-4">
                            <form method="POST" action="{{ route('kelas.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="nama_kelas" class="form-control-label">Nama Kelas</label>
                                    <input type="text" class="form-control @error('nama_kelas') is-invalid @enderror"
                                        id="nama_kelas" name="nama_kelas" value="{{ old('nama_kelas') }}"
                                        placeholder="Masukkan nama kelas" required>
                                    @error('nama_kelas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="deskripsi_kelas" class="form-control-label">Deskripsi Kelas</label>
                                    <textarea class="form-control @error('deskripsi_kelas') is-invalid @enderror"
                                        id="deskripsi_kelas" name="deskripsi_kelas" rows="3"
                                        placeholder="Masukkan deskripsi kelas">{{ old('deskripsi_kelas') }}</textarea>
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
                                                id="waktu_mulai" name="waktu_mulai" value="{{ old('waktu_mulai') }}"
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
                                                value="{{ old('waktu_selesai') }}" placeholder="Masukkan waktu selesai"
                                                required>
                                            @error('waktu_selesai')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="gambar_kelas" class="form-control-label">Gambar Kelas (Opsional)</label>
                                    <input type="file" class="form-control @error('gambar_kelas') is-invalid @enderror"
                                        id="gambar_kelas" name="gambar_kelas" accept="image/*">
                                    @error('gambar_kelas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Format: JPG, PNG, JPEG. Maksimal 2MB</small>

                                    <!-- Preview gambar -->
                                    <div id="imagePreview" class="mt-3 d-none">
                                        <p class="text-sm mb-2">Preview:</p>
                                        <img id="previewImage" src="#" alt="Preview gambar" class="img-thumbnail"
                                            style="max-width: 200px;">
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end mt-4">
                                    <button type="submit" class="btn btn-dark btn-sm mb-0">
                                        <i class="fa-solid fa-save me-2"></i>Buat Kelas
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-app.footer />
    </main>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const gambarInput = document.getElementById('gambar_kelas');
        const imagePreview = document.getElementById('imagePreview');
        const previewImage = document.getElementById('previewImage');

        // Preview gambar sebelum upload
        if (gambarInput) {
            gambarInput.addEventListener('change', function(e) {
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
    });
    </script>
</x-app-layout>