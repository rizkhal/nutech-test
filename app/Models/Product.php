<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = [
        'file_url',
    ];

    protected $casts = [
        'stock' => 'integer',
    ];

    public function fileUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->file_name ? env('APP_URL') . '/storage/' . $this->file_name : null
        );
    }

    public function stockFormated(): Attribute
    {
        return Attribute::make(
            get: fn () => number($this->stock)
        );
    }

    public function buyPriceFormated(): Attribute
    {
        return Attribute::make(
            get: fn () => number($this->buy_price),
        );
    }

    public function sellPriceFormated(): Attribute
    {
        return Attribute::make(
            get: fn () => number($this->sell_price)
        );
    }
}
