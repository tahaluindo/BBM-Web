<?php

namespace App\Http\Livewire\Laporan;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class PajakMasukan extends ModalComponent
{
    public $tgl_awal, $tgl_akhir;
    public function render()
    {
        return view('livewire.laporan.pajak-masukan');
    }
}
