<?php

namespace App\Livewire;

use App\Models\Address;
use App\Models\Order;
use Livewire\Component;

class AddAddres extends Component
{

    public $phone;
    public $alamat;

    public function save()
    {
        Address::create([
            'user_id' => auth()->user()->id,
            'phone' => $this->phone,
            'alamat' => $this->alamat,
        ]);

        return redirect('/addres');
    }


    public function render()
    {
        return view('livewire.add-addres');
    }
}
