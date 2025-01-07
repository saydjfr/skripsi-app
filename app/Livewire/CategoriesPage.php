<?php

namespace App\Livewire;

use App\Models\category;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Kategori - E-Canteen')]
class CategoriesPage extends Component
{
    public function render()
    {
        $categories = Category::where('is_active',1)->get();
        return view('livewire.categories-page',[
            'categories' => $categories,
        ]);
    }
}
