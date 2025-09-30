<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Forms\Components\TextInput;
use Filament\Support\Enums\Operation;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    use CreateRecord\Concerns\HasWizard;

    protected function getSteps(): array
    {
        return [
            Step::make('Initial Infos')
                ->description('Enter the product name & SKU')
                ->schema([
                    TextInput::make('name')
                    ->required(),
                    TextInput::make('sku')
                    ->label('SKU')
                    ->required()
                    ->readOnly()
                    ->hiddenOn(Operation::Create),
                ]),
            Step::make('Details')
                ->description('Provide the product details')
                ->schema([
                Select::make('category_id')
                    ->required()
                    ->relationship('category', 'name')
                    ->preload()
                    ->searchable(),
                Select::make('supplier_id')
                    ->relationship('supplier', 'name')
                    ->preload()
                    ->searchable(),
                TextInput::make('purchase_price')
                    ->required()
                    ->prefix('$')
                    ->numeric()
                    ->default(0.0),
                TextInput::make('selling_price')
                    ->required()
                    ->prefix('$')
                    ->numeric()
                    ->default(0.0),
                ]),
            Step::make('Inventory')
                ->description('Set stock levels and unit')
                ->schema([
                TextInput::make('current_stock')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('minimum_stock')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('unit')
                    ->required()
                    ->default('pcs'),
                TextInput::make('barcode')
                    ->default(null),
                ]),
            Step::make('Media & Status')
                ->description('Upload an image and set the status')
                ->schema([
                    FileUpload::make('image')
                        ->image(),
                    Toggle::make('is_active')
                        ->required(),
                ]),
                
            ];
    }
}
