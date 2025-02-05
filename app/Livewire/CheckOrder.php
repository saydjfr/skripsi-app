<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Attributes\Title;
use Livewire\Component;

class CheckOrder extends Component
{
    #[Title('statusChecker-E-Canteen')]

    public $nomor_pesanan;
    public $listPesanan;

    public function mount(){
        $this->listPesanan = Order::with('items.product')->where('nomor_pesanan', $this->listPesanan)->first();
    }

    public function cekPesanan(){
        // dd($this->nomor_pesanan);
        return redirect()->route('status',$this->nomor_pesanan);
    }

    public function render()
    {
        return view('livewire.check-order');
    }
}
