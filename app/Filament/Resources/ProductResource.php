<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $navigationLabel = 'Produk';

    protected static ?string $recordTitleAttribute = 'name';
    
    protected static ?int $navigationSort = 4;
    
    

    public static function getEloquentQuery(): Builder
    {
        $user = Auth::user();

            // dd(Product::query()->whereRaw('1 = 0'));
        // dd($user);
        // Jika user tidak memiliki shop_id, return query kosong
        if (!$user || !$user->shop->id) {
            // dd(Product::query()->whereRaw('1 = 0'));
            return Product::query()->whereRaw('1 = 0');
        }

        // Filter data produk berdasarkan shop_id milik user login
        return Product::query()->where('shop_id', $user->shop->id);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make('Product Information')->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur:true)
                            ->afterStateUpdated(function(string $operation, $state, Set $set){
                                if($operation !== 'create'){
                                    return;
                                }
                                {
                                    $set('slug', Str::slug($state));
                                }
                            }),

                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->disabled()
                            ->dehydrated()
                            ->unique(Product::class, 'slug', ignoreRecord:true),

                        MarkdownEditor::make('description')
                        ->columnSpanFull()
                        ->fileAttachmentsDirectory('products'),

                    ])->columns(2),

                    Section::make('image')->schema([
                        FileUpload::make('image')
                            ->multiple()
                            ->directory('products')
                            ->maxFiles(5)
                            ->reorderable()
                    ])
                ])->columnSpan(2),

                Group::make()->schema([
                    Section::make('Price')->schema([
                        TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->prefix('IDR')
                    ]),

                    Section::make('Assosiation')->schema([
                        Select::make('category_id')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->relationship('category','name'),

                            

                            TextInput::make('shop_name')
                            ->label('Toko')
                            ->required()
                            ->disabled()
                            ->default(function () {
                                // Mendapatkan user yang sedang login
                                $user = Auth::user();
                                // dd($user, $user?->shop?->name);

                                // Ambil nama toko berdasarkan relasi
                                return $user?->shop?->name ?? 'Toko tidak ditemukan';
                            }),

                            Hidden::make('shop_id')
                            ->default(function () {
                                // Mendapatkan user yang sedang login
                                $user = Auth::user();
                                // dd($user, $user?->shop?->name);
    
                                // Ambil nama toko berdasarkan relasi
                                return $user?->shop?->id ?? null;
                            }),

                   

                    ]),

                    Section::make('Status')->schema([
                        Toggle::make('is_raady')
                            ->required()
                    ])
                ])->columnSpan(1)
                ])->columns(3);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Produk')
                    ->searchable(),

                TextColumn::make('category.name')
                    ->label('Kategori Produk')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('shop.name')
                    ->label('Toko')
                    ->searchable(),

                TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable(),

                IconColumn::make('is_raady')
                    ->label('Status')
                    ->boolean(),
                    
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault:true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault:true),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->relationship('category','name'),

                SelectFilter::make('shop')
                    ->relationship('shop','name')
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make()
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'slug','category.name'];
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
