<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Validation\Rules\File;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    public function prepareForValidation(): void
    {
        $this->merge([
            'buy_price' => (int)Str::replace('.', '', $this->buyPrice),
            'sell_price' => (int)Str::replace('.', '', $this->sellPrice),
            'stock' => $this->stock != 0 ? (int)Str::replace('.', '', $this->stock) : null,
        ]);
    }

    public function authorize(): bool
    {
        return true;
    }

    public function attributes(): array
    {
        return [
            'name' => 'Nama barang',
            'stock' => 'Stok',
            'buyPrice' => 'Harga beli',
            'sellPrice' => 'Harga jual',
        ];
    }

    public function rules(): array
    {
        return [
            'name' => ['required', Rule::unique('products', 'name')->ignore($this->product?->id)],
            'buyPrice' => ['required'],
            'sellPrice' => ['required'],
            'stock' => ['required', 'integer'],
            'file' => ['required', $this->hasNewFile() ? File::types(['png', 'jpg'])->max(100) : 'string'],
        ];
    }

    public function hasNewFile(): bool
    {
        return $this->file instanceof UploadedFile;
    }

    public function getData(): array
    {
        return [
            'name' => $this->name,
            'stock' => $this->stock,
            'buy_price' => $this->buy_price,
            'sell_price' => $this->sell_price,
            'file_name' => $this->getFile(),
        ];
    }

    public function getFile(): string
    {
        if (!is_null($this->product) && !$this->hasNewFile()) {
            return $this->product->file_name;
        }

        // delete old image
        if (!is_null($this->product)) {
            Storage::delete($this->product->file_name);
        }

        return $this->file('file')->store('products');
    }
}
