<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">

            <!-- Debug Info -->
            @if($errors->any())
            <div class="alert alert-danger">
                <strong>Validation Errors:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center justify-content-between">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Isi Presensi -
                                        {{ $kelas->nama_kelas }}</h6>
                                    <p class="text-sm">Isi presensi untuk hari ini</p>
                                </div>
                                <a href="{{ route('kelas.show', $kelas) }}" class="btn btn-sm btn-dark mb-0">
                                    <i class="fa-solid fa-arrow-left me-2"></i>Kembali
                                </a>
                            </div>
                        </div>
                        <div class="card-body px-4 py-4">
                            <form method="POST" action="{{ route('presensi.store', $kelas->id_kelas) }}"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="form-group mb-3">
                                    <label for="status" class="form-control-label">Status Presensi <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control @error('status') is-invalid @enderror" id="status"
                                        name="status" required>
                                        <option value="">Pilih Status</option>
                                        <option value="hadir" {{ old('status') == 'hadir' ? 'selected' : '' }}>Hadir
                                        </option>
                                        <option value="izin" {{ old('status') == 'izin' ? 'selected' : '' }}>Izin
                                        </option>
                                        <option value="sakit" {{ old('status') == 'sakit' ? 'selected' : '' }}>Sakit
                                        </option>
                                    </select>
                                    @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="keterangan" class="form-control-label">Keterangan (Opsional)</label>
                                    <textarea class="form-control @error('keterangan') is-invalid @enderror"
                                        id="keterangan" name="keterangan" rows="3"
                                        placeholder="Masukkan keterangan jika diperlukan">{{ old('keterangan') }}</textarea>
                                    @error('keterangan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <label for="gambar" class="form-control-label">Gambar (Opsional)</label>
                                    <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                                        id="gambar" name="gambar" accept="image/*">
                                    @error('gambar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-end mt-4">
                                    <button type="submit" class="btn btn-dark btn-sm mb-0">
                                        <i class="fa-solid fa-save me-2"></i>Simpan Presensi
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
</x-app-layout>