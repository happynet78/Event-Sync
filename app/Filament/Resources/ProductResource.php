<?php

namespace App\Filament\Resources;

use App\Enums\ProductVariantType;
use App\Enums\ProductStatus;
use App\Filament\Resources\ProductResource\Pages;
use App\Forms\Components\Slug;
use App\Models\Product;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use CodeWithDennis\FilamentPriceFilter\Filament\Tables\Filters\PriceFilter;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use FilamentTiptapEditor\Enums\TiptapOutput;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Support\Number;
use RalphJSmit\Filament\SEO\SEO;
use Saade\FilamentAdjacencyList\Forms\Components\AdjacencyList;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make()->schema([
                    Forms\Components\Tabs\Tab::make('Content')->schema([
                        Forms\Components\TextInput::make('title'),
                        Slug::make('slug')->required(),
                        TiptapEditor::make('content')
                            ->output(TiptapOutput::Json)
                            ->required(),
                        Forms\Components\Select::make('category')
                            ->multiple()
                            ->preload()
                            ->relationship('categories', 'title')
                            ->searchable(),
                        Forms\Components\Hidden::make('user_id')->dehydrateStateUsing(fn ($state) => auth()->id()),
                        Forms\Components\Select::make('status')
                            ->options(ProductStatus::options()),
                        CuratorPicker::make('images')
                            ->multiple()
                            ->relationship('images', 'id')
                            ->orderColumn('position')
                            ->required(),
                        Forms\Components\TextInput::make('stock')->required()->numeric(),
                        Forms\Components\TextInput::make('price')->required()->numeric(),
                    ]),
                    Forms\Components\Tabs\Tab::make('SEO')->schema([
                        SEO::make(),
                    ]),
                    Forms\Components\Tabs\Tab::make('Variants')->schema([
                        AdjacencyList::make('variants')
                            ->form([
                                Forms\Components\TextInput::make('label')
                                    ->required(),
                                Forms\Components\Select::make('type')
                                    ->searchable()
                                    ->options(ProductVariantType::options())
                                    ->required(),
                                Forms\Components\TextInput::make('stock')
                                    ->numeric()
                                    ->required(),
                                Forms\Components\ColorPicker::make('color'),
                                CuratorPicker::make('images')
                                    ->multiple()
                                    ->orderColumn('position')
                            ]),
                    ]),
                ]),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title'),
                TextColumn::make('slug'),
                TextColumn::make('price')
                    ->numeric()
                    ->formatStateUsing(fn ($state) => Number::currency(number_format($state / 100, 3))),
                TextColumn::make('stock')->numeric(),
            ])
            ->filters([
                PriceFilter::make('price'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
