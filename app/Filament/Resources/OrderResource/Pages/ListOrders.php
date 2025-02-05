<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Filament\Resources\OrderResource\Widgets\OrderStats;
use App\Models\Order;
use Filament\Actions;
use Filament\Forms\Components\Tabs;
use Filament\Resources\Components\Tab;
use Filament\Resources\Components\Tab as ComponentsTab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

        protected function getTableQuery(): ?Builder
        {
            if(Auth::user()->hasRole('seller')){
                // dd( Auth::user()->shop->id);
                return Order::with('items.product')
                ->whereHas('items', function($query){
                    
                    $query->whereHas('product', function($query){
                     $query->where('shop_id', Auth::user()->shop->id);
                    });
                 }); 
            }

            return Order::latest();

        
        }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return[
            OrderStats::class
        ];
    }

    public function getTabs(): array
    {
        return[
            null=> Tab::make('All'),
            'New'=>Tab::make()->query(fn($query)=>$query->where('status','new')),
            'Processing'=>Tab::make()->query(fn($query)=>$query->where('status','processing')),
            'Completed'=>Tab::make()->query(fn($query)=>$query->where('status','completed'))
        ];
    }
}
