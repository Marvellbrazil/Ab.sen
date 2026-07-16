@props(['anggota'])

<div class="table-responsive">
    <table class="table align-items-center mb-0">
        <thead class="bg-gray-100">
            <tr>
                <th class="text-secondary text-xs font-weight-semibold ps-4" style="width: 10%;">No</th>
                <th class="text-secondary text-xs font-weight-semibold" style="width: 60%;">Nama</th>
                <th class="text-secondary text-xs font-weight-semibold" style="width: 30%;">Bergabung Pada</th>
            </tr>
        </thead>
        <tbody id="anggota-table-body">
            <x-kelas.anggota-rows :anggota="$anggota" />
        </tbody>
    </table>
</div>

<div id="anggota-pagination">
    @if($anggota instanceof \Illuminate\Pagination\LengthAwarePaginator && $anggota->hasPages())
        <div class="border-top py-3 px-3 d-flex align-items-center">
            <p class="font-weight-semibold mb-0 text-dark text-sm">
                Menampilkan {{ $anggota->count() }} dari {{ $anggota->total() }} anggota
            </p>
            <div class="ms-auto anggota-pagination">
                @if ($anggota->onFirstPage())
                    <button class="btn btn-sm btn-white mb-0" disabled>Previous</button>
                @else
                    <a href="{{ $anggota->previousPageUrl() }}" class="btn btn-sm btn-white mb-0">Previous</a>
                @endif

                @if ($anggota->hasMorePages())
                    <a href="{{ $anggota->nextPageUrl() }}" class="btn btn-sm btn-white mb-0">Next</a>
                @else
                    <button class="btn btn-sm btn-white mb-0" disabled>Next</button>
                @endif
            </div>
        </div>
    @endif
</div>
