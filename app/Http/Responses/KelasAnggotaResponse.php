<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use App\Models\Kelas;
use Illuminate\Pagination\LengthAwarePaginator;

class KelasAnggotaResponse implements Responsable
{
    protected Kelas $kelas;
    protected LengthAwarePaginator $anggota;

    public function __construct(Kelas $kelas, LengthAwarePaginator $anggota)
    {
        $this->kelas = $kelas;
        $this->anggota = $anggota;
    }

    public function toResponse($request): JsonResponse|View
    {
        if ($request->ajax()) {
            return response()->json([
                'html' => view('components.kelas.anggota-rows', ['anggota' => $this->anggota])->render(),
                'pagination' => $this->anggota->links()->toHtml()
            ]);
        }

        return view('kelas.show', [
            'kelas' => $this->kelas,
            'anggota' => $this->anggota
        ]);
    }
}
