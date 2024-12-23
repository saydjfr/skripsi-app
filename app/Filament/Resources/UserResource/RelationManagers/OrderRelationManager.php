<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use App\Filament\Resources\OrderResource;
use App\Models\order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderRelationManager extends RelationManager
{
    protected static string $relationship = 'order';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // 
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                TextColumn::make('id')
                    ->label('Order Id')
                    ->searchable(),
                
                TextColumn::make('grand_total')
                    ->money('IDR'),
                
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state):string =>match ($state) {
                        'new' => 'info',
                        'processing' => 'warning',
                        'completed' => 'success'
                    })
                    ->icon(fn(string $state):string =>match ($state){
                        'new' => 'heroicon-m-sparkles',
                        'processing' => 'heroicon-m-arrow-path',
                        'completed' => 'heroicon-m-check-circle'
                    })
                    ->sortable(),

                    TextColumn::make('payment_methode')
                        ->sortable()
                        ->searchable(),
                    
                    TextColumn::make('payment_status')
                        ->sortable()
                        ->searchable()
                        ->badge()
                        ->color(fn(string $state):string =>match ($state) {
                            'pending' => 'warning',
                            'paid' => 'success',
                            'failed' => 'danger'
                        }),
                    
                    TextColumn::make('created_at')
                        ->label('Order Date')
                        ->dateTime()
                        ->sortable()
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                ActionGroup::make([
                    Action::make('View Order')
                    ->url(fn(Order $record):string => OrderResource::getUrl('view',['record'=> $record]))
                    ->color('info')
                    ->icon('heroicon-o-eye'),
                Tables\Actions\DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
