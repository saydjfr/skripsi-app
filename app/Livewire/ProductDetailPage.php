<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Product Detail-E-Canteen')]
class ProductDetailPage extends Component
{
    use LivewireAlert;

    public $slug;
    public $quantity = 1;


    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function increaseQuantity()
    {
        $this->quantity++;
    }

    public function kurangQty()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    // add to cart method
    public function addToCart($product_id)
    {
        $total_count = CartManagement::addItemToCartWithQty($product_id, $this->quantity);

        $this->dispatch('update-cart-count', total_count: count($total_count))->to(Navbar::class);

        $this->alert('success', 'Produk Berhasil Ditambahkan ke Keranjang', [
            'position' => 'center start',
            'timer' => 3000,
            'toast' => true,
        ]);
    }

    public function render()
    {
        return view(
            'livewire.product-detail-page',
            [
                'product' => Product::where('slug', $this->slug)->firstorFail(),
            ]
        );
    }
}
