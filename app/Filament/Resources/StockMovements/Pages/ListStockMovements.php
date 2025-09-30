<?php

namespace App\Filament\Resources\StockMovements\Pages;

use App\Filament\Resources\StockMovements\StockMovementResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;
use App\Models\StockMovement;

class ListStockMovements extends ListRecords
{
    protected static string $resource = StockMovementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(),
            'in' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('type', 'in'))
                ->badge(StockMovement::query()->where('type', 'in')->count()),
            'out' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('type', 'out'))
                ->badge(StockMovement::query()->where('type', 'out')->count()),
        ];
    }
}
