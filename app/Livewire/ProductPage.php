<?php

namespace App\Livewire;

use App\Models\category;
use App\Models\product;
use App\Models\shop;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Product-E-Canteen')]
class ProductPage extends Component
{
    use WithPagination;

    // membuat properti untuk filter data yang dipilih
    #[Url()]
    public $selected_categories =[];

    #[Url()]
    public $sort = 'latest';

    public function render()
    {
        $productQuery = Product::query()->where('is_raady', 1);

        if (!empty($this->selected_categories)) {
            $productQuery->whereIn('category_id', $this->selected_categories);
        }

        if ($this->sort == 'latest') {
            $productQuery->latest();
        }

        if ($this->sort == 'price') {
            $productQuery->orderBy('price');
        }

        return view('livewire.product-page',[
            'products' => $productQuery->paginate(6),
            'shops' => Shop::all(),
            'categories' => Category::where('is_active', 1)->get(),
        ]);
    }
}
