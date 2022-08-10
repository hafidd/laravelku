<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

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

        return view('product.index', ["products" => $products]);
    }

    public function show(Product $product)
    {
        dd($product);
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
