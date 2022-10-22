<?php

declare(strict_types=1);

namespace App\Inertable;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Rizkhal\Inertable\Column;
use App\Abstracts\Inertable;

class ProductTable extends Inertable
{
    public function query(): Builder
    {
        return Product::query();
    }

    public function columns(): array
    {
        return [
            Column::make('name', 'name'),
            Column::make('harga beli', 'buy_price')->format(fn ($row) => $row->buy_price_formated),
            Column::make('harga jual', 'sell_price')->format(fn ($row) => $row->sell_price_formated),
            Column::make('stok', 'stock')->format(fn ($row) => $row->stock_formated),
            Column::make('file', 'file_url'),
            Column::make('aksi', 'action'),
        ];
    }
}
