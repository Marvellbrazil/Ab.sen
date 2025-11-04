<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center justify-content-between">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Edit Presensi -
                                        {{ $kelas->nama_kelas }}</h6>
                                    <p class="text-sm">Edit presensi untuk tanggal
                                        {{ \Carbon\Carbon::parse($presensi->created_at)->format('d/m/Y') }}</p>
                                </div>
                                <a href="{{ route('kelas.show', $kelas) }}" class="btn btn-sm btn-dark mb-0">
                                    <i class="fa-solid fa-arrow-left me-2"></i>Kembali
                                </a>
                            </div>
                        </div>
                        <div class="card-body px-4 py-4">
                            <form method="POST" action="{{ route('presensi.update', [$kelas->id_kelas, $presensi->id_presensi]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- Info Presensi -->
                                <div class="alert alert-info mb-4">
                                    <div class="d-flex align-items-center">
                                        <i class="fa-solid fa-info-circle me-2"></i>
                                        <span>
                                            Presensi ini dibuat pada:
                                            <strong>{{ \Carbon\Carbon::parse($presensi->created_at)->format('d/m/Y H:i') }}</strong>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="status" class="form-control-label">Status Presensi <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control @error('status') is-invalid @enderror" id="status"
                                        name="status" required>
                                        <option value="">Pilih Status</option>
                                        <option value="hadir"
                                            {{ old('status', $presensi->status) == 'hadir' ? 'selected' : '' }}>Hadir
                                        </option>
                                        <option value="izin"
                                            {{ old('status', $presensi->status) == 'izin' ? 'selected' : '' }}>Izin
                                        </option>
                                        <option value="sakit"
                                            {{ old('status', $presensi->status) == 'sakit' ? 'selected' : '' }}>Sakit
                                        </option>
                                        <option value="alpha"
                                            {{ old('status', $presensi->status) == 'alpha' ? 'selected' : '' }}>Alpha
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
                                        placeholder="Masukkan keterangan jika diperlukan">{{ old('keterangan', $presensi->keterangan) }}</textarea>
                                    @error('keterangan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <label for="gambar" class="form-control-label">Gambar</label>

                                    <!-- Tampilkan gambar saat ini -->
                                    @if($presensi->gambar)
                                    <div class="mb-3">
                                        <p class="text-sm text-muted mb-2">Gambar saat ini:</p>
                                        <img src="{{ Storage::url($presensi->gambar) }}" alt="Gambar presensi"
                                            class="img-fluid rounded shadow-sm" style="max-height: 200px;">
                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="checkbox" id="hapus_gambar"
                                                name="hapus_gambar" value="1">
                                            <label class="form-check-label text-sm" for="hapus_gambar">
                                                Hapus gambar saat ini
                                            </label>
                                        </div>
                                    </div>
                                    @endif

                                    <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                                        id="gambar" name="gambar" accept="image/*">
                                    <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
                                    @error('gambar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-end mt-4">
                                    <button type="submit" class="btn btn-dark btn-sm mb-0">
                                        <i class="fa-solid fa-save me-2"></i>Update Presensi
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