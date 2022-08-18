<?php

namespace App\Http\Controllers\api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/products",
     *     operationId="getProductsByParams",
     *     tags={"products"},
     *     summary="Display a listing of the products",
     *     @OA\Parameter(name="page", in="query", description="The page number", required=false, @OA\Schema(type="integer", example=1) ),
     *     @OA\Response(response="200", description="ok", @OA\JsonContent(ref="#/components/schemas/ProductCollection")),
     * )
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $req)
    {
        $perPage = isset($req->perPage) ? (int)$req->perPage : 10;

        $products = Product::search($req->search)
            ->order($req->order)
            ->paginate($perPage);

        return ProductResource::collection($products);
    }

    /**
     * @OA\Get(
     *     path="/api/products/{id}",
     *     operationId="showProduct",
     *     tags={"products"},
     *     summary="show product",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The ID of product",
     *         required=true,
     *         example="1",
     *         @OA\Schema(type="integer",),
     *     ),
     *     @OA\Response(response="200", description="ok", @OA\JsonContent(ref="#/components/schemas/Product")),
     *     @OA\Response(response="404", description="Not found", @OA\JsonContent()),
     * )
     *
     * show product detail.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Product $product)
    {
        return response()->json(new JsonResource($product));
    }

    /**
     * @OA\Post(
     *     path="/api/products",
     *     operationId="createProduct",
     *     tags={"products"},
     *     summary="create a new product",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody( @OA\JsonContent(ref="#/components/schemas/ProductRequest") ),
     *     @OA\Response(response="200", description="ok", @OA\JsonContent(ref="#/components/schemas/Product")),
     *     @OA\Response(response="401", description="Unauthorized", @OA\JsonContent(ref="#/components/schemas/UnauthorizedResponse")),
     *     @OA\Response(response="422", description="Unprocessable Content", @OA\JsonContent()),
     * )
     *
     * create a new product.
     *
     * @return \Illuminate\Http\JsonResponse
     */
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

        return response()->json(new JsonResource($product));
    }

    /**
     * @OA\Put(
     *     path="/api/products/{id}",
     *     operationId="updateProduct",
     *     tags={"products"},
     *     summary="update product",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The ID of product",
     *         required=true,
     *         example="21",
     *         @OA\Schema(type="integer",),
     *     ),
     *     @OA\RequestBody( @OA\JsonContent(ref="#/components/schemas/ProductRequest") ),
     *     @OA\Response(response="200", description="ok", @OA\JsonContent(ref="#/components/schemas/Product")),
     *     @OA\Response(response="401", description="Unauthorized", @OA\JsonContent()),
     *     @OA\Response(response="422", description="Unprocessable Content", @OA\JsonContent()),
     * )
     *
     * update product.
     *
     * @return \Illuminate\Http\JsonResponse
     */
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

        return response()->json(new JsonResource($product));
    }

    /**
     * @OA\Delete(
     *     path="/api/products/{id}",
     *     operationId="deleteProduct",
     *     tags={"products"},
     *     summary="delete product",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The ID of product",
     *         required=true,
     *         example="21",
     *         @OA\Schema(type="integer",),
     *     ),
     *     @OA\Response(response="200", description="ok", @OA\JsonContent()),
     *     @OA\Response(response="401", description="Unauthorized", @OA\JsonContent()),
     *     @OA\Response(response="404", description="Not found", @OA\JsonContent()),
     * )
     *
     * delete product.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(null);
    }
}
