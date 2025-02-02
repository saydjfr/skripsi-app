<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class OrderStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('New Order',Order::query()->where('status','new')->count()),
            Stat::make('Order Processing', Order::query()->where('status','processing')->count()),
            Stat::make('Order Completed',Order::query()->where('status','completed')->count()),
            Stat::make('Average Price',Number::currency(Order::query()->avg('grand_total'),'IDR'))
        ];
    }
}
