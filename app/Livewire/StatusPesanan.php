<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Attributes\Title;
use Livewire\Component;

class StatusPesanan extends Component
{
    #[Title('StatusPesanan-E-Canteen')]
    public $nomor_pesanan;

    public function mount($nomor_pesanan){
        
        $this->nomor_pesanan = $nomor_pesanan;
    }

    public function render()
    {
        $pesanan = Order::with('items.product')->where('nomor_pesanan',$this->nomor_pesanan)->first();

        return view('livewire.status-pesanan',[
            'pesanan'=> $pesanan,
        ]);
    }
}
