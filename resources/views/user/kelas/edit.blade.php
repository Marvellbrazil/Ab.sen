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
                                    <h6 class="font-weight-semibold text-lg mb-0">
                                        {{ isset($presensi->id_presensi) ? 'Edit' : 'Isi' }} Presensi -
                                        {{ $kelas->nama_kelas }}
                                    </h6>
                                    <p class="text-sm">
                                        {{ isset($presensi->id_presensi) ? 'Edit presensi untuk hari ini' : 'Isi presensi untuk hari ini' }}
                                    </p>
                                </div>
                                <a href="{{ route('kelas.show', $kelas) }}" class="btn btn-sm btn-dark mb-0">
                                    <i class="fa-solid fa-arrow-left me-2"></i>Kembali
                                </a>
                            </div>
                        </div>
                        <div class="card-body px-4 py-4">
                            @if(isset($presensi->id_presensi))
                            <!-- Form untuk edit -->
                            <form method="POST"
                                action="{{ route('presensi.update', ['kelas' => $kelas, 'presensi' => $presensi]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                @else
                                <!-- Form untuk create -->
                                <form method="POST" action="{{ route('presensi.store', $kelas) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @endif

                                    <div class="form-group">
                                        <label for="status" class="form-control-label">Status Presensi</label>
                                        <select class="form-control @error('status') is-invalid @enderror" id="status"
                                            name="status" required>
                                            <option value="">Pilih Status</option>
                                            <option value="belum hadir"
                                                {{ old('status', $presensi->status ?? '') == 'belum hadir' ? 'selected' : '' }}>
                                                Belum Hadir</option>
                                            <option value="hadir"
                                                {{ old('status', $presensi->status ?? '') == 'hadir' ? 'selected' : '' }}>
                                                Hadir</option>
                                            <option value="izin"
                                                {{ old('status', $presensi->status ?? '') == 'izin' ? 'selected' : '' }}>
                                                Izin</option>
                                            <option value="sakit"
                                                {{ old('status', $presensi->status ?? '') == 'sakit' ? 'selected' : '' }}>
                                                Sakit</option>
                                            <option value="alpha"
                                                {{ old('status', $presensi->status ?? '') == 'alpha' ? 'selected' : '' }}>
                                                Alpha</option>
                                        </select>
                                        @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="keterangan" class="form-control-label">Keterangan (Opsional)</label>
                                        <textarea class="form-control @error('keterangan') is-invalid @enderror"
                                            id="keterangan" name="keterangan" rows="3"
                                            placeholder="Masukkan keterangan jika diperlukan">{{ old('keterangan', $presensi->keterangan ?? '') }}</textarea>
                                        @error('keterangan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="gambar" class="form-control-label">Gambar (Opsional)</label>
                                        <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                                            id="gambar" name="gambar" accept="image/*">
                                        @error('gambar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @if(isset($presensi->gambar) && $presensi->gambar != 'default.jpg')
                                        <div class="mt-2">
                                            <p class="text-sm">Gambar saat ini:</p>
                                            <img src="{{ asset('storage/' . $presensi->gambar) }}" alt="Gambar presensi"
                                                class="img-thumbnail" style="max-width: 200px;">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-app.footer />
    </main>
</x-app-layout>