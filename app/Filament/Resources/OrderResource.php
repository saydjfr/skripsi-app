<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use App\Models\product;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Number;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationLabel = 'Order';

    protected static ?int $navigationSort = 5;

    // public static function getEloquentQuery(): Builder
    // {
    //     $user = Auth::user();

    //     dd($user);
    //     // Jika user tidak memiliki shop_id, return query kosong
    //     if (!$user || !$user->items->id) {
    //         return Product::query()->whereRaw('1 = 0');
    //     }

    //     // Filter data produk berdasarkan shop_id milik user login
    //     return Product::query()->where('order_item_id', $user->items->id);
    // }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make('Order Information')->schema([
                        TextInput::make('nomor_pesanan')
                            ->label('Nomor Pesanan')
                            ->disabled()
                            ->default(fn()=> 'ORD-'.random_int(10000,999999))
                            ->dehydrated()
                            ->required(),
                        

                        // Select::make('user_id')
                        //     ->label('Costumer')
                        //     ->relationship('user','name')
                        //     ->searchable()
                        //     ->preload()
                        //     ->required(),
                        
                        Select::make('payment_methode')
                            ->options([
                                'stripe' => 'Stripe',
                                'cod' => 'Cash On Delivery'
                            ])
                            ->required(),

                        Select::make('payment_status')
                            ->options([
                                    'pending' => 'Pending',
                                    'paid' => 'Paid',
                                    'failed' => 'Failed'
                                ])
                            ->default('pending')
                            ->required(),
                        
                        ToggleButtons::make('status')
                            ->inline()
                            ->default('new')
                            ->required()
                            ->options([
                                'new' => 'New',
                                'processing' => 'Processing',
                                'completed' => 'Completed'
                            ])
                            ->colors([
                                'new' => 'info',
                                'processing' => 'warning',
                                'completed' => 'success'
                            ])
                            ->icons([
                                'new' => 'heroicon-m-sparkles',
                                'processing' => 'heroicon-m-arrow-path',
                                'completed' => 'heroicon-m-check-circle'
                            ]),

                        Select::make('currency')
                            ->options([
                                'idr' => 'IDR',
                                'usd' => 'USD',
                                'eur' => 'EUR'
                            ])
                            ->default('idr')
                            ->required(),

                        Textarea::make('notes')
                        ->columnSpanFull(),
                    ])->columns(2),

                    Section::make('Order Item')->schema([
                        Repeater::make('items')
                        ->relationship()
                        ->schema([

                            Select::make('product_id')
                                ->relationship('product', 'name')
                                ->searchable()
                                ->preload()
                                ->required()
                                ->distinct()
                                ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                ->columnSpan(4)
                                ->reactive()
                                ->afterStateUpdated(fn($state, Set $set)=>$set('unit_amount', Product::find($state)?->price ?? 0))
                                ->afterStateUpdated(fn($state, Set $set)=>$set('total_amount', Product::find($state)?->price ?? 0)),
                

                            TextInput::make('quantity')
                                ->numeric()
                                ->required()
                                ->default(1)
                                ->minValue(1)
                                ->columnSpan(2)
                                ->reactive()
                                ->afterStateUpdated(fn($state, Set $set, Get $get)=>$set('total_amount', $state*$get('unit_amount'))),

                            TextInput::make('unit_amount')
                                ->numeric()
                                ->required()
                                ->disabled()
                                ->dehydrated()
                                ->columnSpan(3),

                            TextInput::make('total_amount')
                                ->numeric()
                                ->required()
                                ->dehydrated()
                                ->columnSpan(3)
                        ])->columns(12),

                        Placeholder::make('grand_total_placeholder')
                            ->label('Grand Total')
                            ->content(function(Get $get, Set $set){
                                $total = 0;
                                if(!$reapeaters = $get('items')){
                                    return $total;
                                }
                                foreach ($reapeaters as $key => $reapeater) {
                                    $total += $get("items.{$key}.total_amount");
                                }
                                $set('grand_total',$total);
                                return Number::currency($total,'IDR');
                            }),

                        Hidden::make('grand_total')
                            ->default(0)
                    ])
                ])->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nomor_pesanan')
                    ->label('Nomor Pemesanan')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('grand_total')
                    ->sortable()
                    ->numeric()
                    ->money('IDR'),

                TextColumn::make('payment_methode')
                    ->sortable()
                    ->searchable(),
                
                TextColumn::make('payment_status')
                    ->sortable()
                    ->searchable(),
                
                TextColumn::make('currency')
                    ->sortable()
                    ->searchable(),

                SelectColumn::make('status')
                    ->options([
                        'new' => 'New',
                        'processing' => 'Processing',
                        'completed' => 'Completed'
                    ])
                    ->sortable()
                    ->searchable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault:true),
                        
                TextColumn::make('upadated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault:true),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make()
                        ->successRedirectUrl('/admin/orders')
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return static::getModel()::count() <= 1 ? 'danger' : 'info';
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
