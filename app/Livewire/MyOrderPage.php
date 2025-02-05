<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class MyOrderPage extends Component
{
    public function render()
    { 
        $myorders = Order::with('items')->where('user_id', auth()->id())->latest()->get();
        return view('livewire.my-order-page',[
            'myorders' => $myorders,
        ]);
    }
}
