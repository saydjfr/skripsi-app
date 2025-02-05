<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Attributes\Url;
use Livewire\Component;

class SuccesPage extends Component
{

    public $listNomorPesanan = [];
    public $listPesanan = [];
    public $totalHarga = 0;

    public function mount()
    {
        // $jumlahHarga = 0;
        $this->listNomorPesanan = request()->all();
        foreach($this->listNomorPesanan as $key => $value){
            $pesanan = Order::with('items.product')->where('nomor_pesanan',$value)->first();
            array_push($this->listPesanan,$pesanan);
            
            $this->totalHarga+=$pesanan->grand_total;
        }
        // dd($this->listPesanan);
        
        // dd($this->listPesanan);


    }

    public function render()
    {
        
        return view('livewire.succes-page');
    }
}
