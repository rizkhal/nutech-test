<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Inertable\ProductTable;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        return inertia('products/index')
            ->inertable(new ProductTable);
    }

    public function store(ProductRequest $request)
    {
        DB::transaction(fn () => Product::create($request->getData()));

        return back()->success('Berhasil menambah produk.');
    }

    public function update(Product $product, ProductRequest $request)
    {
        DB::transaction(fn () => $product->update($request->getData()));

        return back()->success('Berhasil mengubah produk.');
    }

    public function destroy(Product $product)
    {
        DB::transaction(function () use ($product) {
            Storage::delete($product->file_name);

            $product->delete();
        });

        return back()->success('Berhasil menghapus produk.');
    }
}
