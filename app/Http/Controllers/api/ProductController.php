<?php

namespace App\Http\Controllers\api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    public function index(Request $req)
    {
        $products = Product::orderBy("name");
        if ($req->search) {
            $products = $products->where('name', 'like', '%' . $req->search . '%')
                ->orWhere('sn', 'like', '%' . $req->search . '%');
        }
        $products = $products->paginate(10);


        return response()->json([
            'data' => ProductResource::collection($products),
            'pagination' => [
                'total' => $products->total(),
                'lastPage' => $products->lastPage(),
                'perPage' => $products->perPage(),
                'currentPage' => $products->currentPage(),
                'nextPageUrl' => $products->nextPageUrl(),
                'previousPageUrl' => $products->previousPageUrl(),
            ]
        ]);
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
