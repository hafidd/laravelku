<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

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

        return view('product.index', ["products" => $products]);
    }

    public function view(Product $product)
    {
        dd($product);
        return "under constuction";
    }

    public function create()
    {
        return view('product.form');
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

        Product::create($fields);

        return redirect("product");
    }

    public function edit(Product $product)
    {
        return view('product.form', ['product' => $product]);
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

        return redirect("product/" . $product->id . "/edit")->with('message', 'update success');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect("product")->with('message', 'delete success');
    }
}
