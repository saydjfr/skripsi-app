<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Cart-E-Canteen')]
class CartPage extends Component
{
    use LivewireAlert;

    public $cart_items=[];
    public $grand_total;

    public function mount(){
        $this->cart_items = CartManagement::getCartItemFromCookie();
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
    }

    public function removeItem($produk_id){
        $this->cart_items = CartManagement::removeItemFromCart($produk_id);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);

        $this->dispatch('update-cart-count',total_count : count($this->cart_items))->to(Navbar::class);

        $this->alert('success', 'Produk Berhasil Dihapus dari Keranjang',[
            'position' => 'center start',
            'timer' => 3000,
            'toast'=> true,
        ]);

    }

    public function increaseQty($produk_id){
        $this->cart_items = CartManagement::incrementQuantityToCartItem($produk_id);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
    }

    public function decreaseQty($produk_id){
        $this->cart_items = CartManagement::decrementQuantityToCartItem($produk_id);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
    }

    public function render()
    {
        return view('livewire.cart-page');
    }
}
