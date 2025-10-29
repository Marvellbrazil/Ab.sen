<x-app-layout>
    <main class="main-content max-height-vh-100 h-100">
        <x-app.navbar />
        <div class="pt-5 pb-6 bg-cover" style="background-image: url('../assets/img/header-blue-purple.jpg')"></div>
        <div class="container my-3 py-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex align-items-center mb-3">
                        <h3 class="mb-1 font-weight-bold">
                            Notifikasi
                        </h3>
                    </div>
                    <div class="d-md-flex align-items-center mb-4">
                        <div class="mb-md-0 mb-1">
                            <p class="text-sm mb-0">Lihat semua notifikasi yang masuk.</p>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="horizontal mb-4 dark">
            <div class="row">
                <div class="col-md-12 mb-6">
                    <div class="card shadow-xs border mb-4">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="d-flex align-items-center py-3 px-4 text-sm">
                                            <span class="text-xs font-weight-semibold opacity-7 ms-1">Tanggal</span>
                                        </th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Pesan
                                            Notifikasi
                                        </th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Dari
                                        </th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Tipe
                                        </th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($notifikasis as $n)
                                    <x-notifikasi-item tanggal="{{ $n->created_at->format('d/m/Y') }}"
                                        pesan="{{ $n->pesan_notifikasi }}" dari="{{ $n->user->username ?? 'System' }}"
                                        tipe="{{ $n->tipe_notifikasi }}" :id="$n->id_notifikasi"
                                        status="{{ $n->status }}" :isChecked="$n->is_checked"
                                        kelas="{{ $n->kelas ? $n->kelas->nama_kelas : null }}" />
                                    @endforeach

                                    @if($notifikasis->count() == 0)
                                    <tr>
                                        <td colspan="5" class="text-center py-4">
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="fa-solid fa-bell-slash fa-2x text-muted mb-2"></i>
                                                <p class="text-muted mb-0">Tidak ada notifikasi</p>
                                                <small class="text-muted">Notifikasi akan muncul di sini</small>
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <x-app.footer />
        </div>
    </main>

    <script>
    // Fungsi confirm delete
    function confirmDelete(id) {
        if (confirm('Apakah Anda yakin ingin menghapus notifikasi ini?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }

    // Handle checkbox change
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('.checkbox-notifikasi');

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const notifikasiId = this.getAttribute('data-id');
                const isChecked = this.checked ? 1 : 0;

                // Kirim request update ke server
                fetch(`/notifikasi/${notifikasiId}/update-checked`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            is_checked: isChecked
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (!data.success) {
                            // Jika gagal, kembalikan ke state sebelumnya
                            this.checked = !this.checked;
                            alert('Gagal mengupdate status notifikasi');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        this.checked = !this.checked;
                        alert('Terjadi kesalahan saat mengupdate notifikasi');
                    });
            });
        });
    });
    </script>
</x-app-layout>