<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Detail Pesanan-E-Kantin')]
class MyOrderDetailPage extends Component
{

    public $nomorPesanan;

    public function mount($order){
        $this->nomorPesanan = $order;
    }

    public function render()
    {

        $produkPesanan = Order::with('items.product')->where('nomor_pesanan',$this->nomorPesanan)->first();

        return view('livewire.my-order-detail-page',[
            'produkPesanan' => $produkPesanan,
        ]);
    }
}
