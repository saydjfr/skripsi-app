<?php

namespace App\Livewire;

use App\Models\category;
use App\Models\product;
use App\Models\shop;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Product-E-Canteen')]
class ProductPage extends Component
{
    use WithPagination;
    public function render()
    {
        $productQuery = Product::query()->where('is_raady', 1);
        return view('livewire.product-page',[
            'products' => $productQuery->paginate(6),
            'shops' => Shop::all(),
            'categories' => Category::where('is_active', 1)->get(),
        ]);
    }
}
