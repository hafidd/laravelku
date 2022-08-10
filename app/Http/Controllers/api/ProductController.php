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
        $products =  Product::query();
        // ?order=name:asc,price:desc
        if ($req->order) {
            $cols = ['name', 'price', 'id', 'stock', 'sn'];
            $orders = explode(",", $req->order);
            foreach ($orders as $order) {
                $col = explode(":", $order);
                if (in_array($col[0], $cols)) {
                    $products = $products->orderBy($col[0], (isset($col[1]) &&  $col[1] === "desc") ? "desc" : "asc");
                }
            }
        }
        // ?search=test
        if ($req->search) {
            $products = $products->where('name', 'like', '%' . $req->search . '%')
                ->orWhere('sn', 'like', '%' . $req->search . '%');
        }
        // ?perPage=20
        $products = $products->paginate(isset($req->perPage) ? (int)$req->perPage : 10);

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
