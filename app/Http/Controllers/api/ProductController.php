<?php

namespace App\Http\Controllers\api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    // ?search=test&order=name:asc,price:desc&perPage=20
    public function index(Request $req)
    {
        $perPage = isset($req->perPage) ? (int)$req->perPage : 10;

        $products = Product::search($req->search)
            ->order($req->order)
            ->paginate($perPage);

        return new ProductCollection($products);
    }

    public function show(Product $product)
    {
        return response()->json(new ProductResource($product));
    }

    public function store(Request $req)
    {
        $fields = $req->validate([
            'sn' => 'size:10|required|unique:products',
            'name' => 'min:3|max:100|required',
            'desc' => 'max:200',
            'price' => 'required|numeric',
            'stock' => 'required|integer'
        ]);

        $product = Product::create($fields);

        return response()->json(new ProductResource($product));
    }

    public function update(Request $req, Product $product)
    {
        $fields = $req->validate([
            'sn' => 'size:10|required|unique:products,sn,' . $product->id . ',id',
            'name' => 'min:3|max:100|required',
            'desc' => 'max:200',
            'price' => 'required|numeric',
            'stock' => 'required|integer'
        ]);

        $product->update($fields);

        return response()->json(new ProductResource($product));
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(null);
    }
}
