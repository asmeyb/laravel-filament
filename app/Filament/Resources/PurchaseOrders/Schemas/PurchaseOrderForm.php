<?php

namespace App\Filament\Resources\PurchaseOrders\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Schema;

class PurchaseOrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('order_number')
                    ->required(),
                Select::make('supplier_id')
                    ->required()
                    ->relationship('supplier', 'name')
                    ->preload()
                    ->searchable(),
                Select::make('user_id')
                    ->required()
                    ->relationship('user', 'name')
                    ->preload()
                    ->searchable(),
                ToggleButtons::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'ordered' => 'Ordered',
                        'received' => 'Received',
                        'cancelled' => 'Cancelled',
                    ])
                    ->default('pending')
                    ->grouped()
                    ->colors([
                        'pending' => 'warning','ordered' => 'primary', 'received' => 'success' , 'cancelled' => 'danger'
                        ])
                    ->required(),
                DatePicker::make('order_date')
                    ->required(),
                DatePicker::make('expected_date'),
                DatePicker::make('received_date'),
                TextInput::make('total_amount')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                Textarea::make('notes')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
