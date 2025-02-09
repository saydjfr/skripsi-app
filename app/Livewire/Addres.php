<?php

namespace App\Livewire;

use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Addres extends Component
{



    public function render()
    {
        $addresses = Address::with('user')->where('user_id', Auth::user()->id)->get();

        return view('livewire.addres', [
            'addresses' => $addresses,
        ]);
    }
}
