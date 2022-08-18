<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Product",
 *     description="Product",
 *     @OA\Xml(name="Product"),
 *     @OA\Property(property="id", type="integer", description="Auto UniqueID", example=1),
 *     @OA\Property(property="sn", type="string", description="Unique product code", example="KDX0000001"),
 *     @OA\Property(property="name", type="string", description="Product name", example="Iphong 669"),
 *     @OA\Property(property="desc", type="string", description="Product description", example="Iphong 669 description"),
 *     @OA\Property(property="price", type="number", format="currency", description="Product price", example=25000000),
 *     @OA\Property(property="stock", type="number", description="Product stock", example=20),
 *     @OA\Property(property="created_at", type="string", format="date", description="data created at", example="2022-08-12"),
 *     @OA\Property(property="updated_at", type="string", format="date", description="data updated at", example="2022-08-12"),
 * )
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = ["name", "sn", "desc", "price", "stock"];

    public function scopeSearch($query, $search)
    {
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('sn', 'like', '%' . $search . '%');
        }
    }

    public function scopeOrder($query, $value)
    {
        if ($value) {
            $cols = ['name', 'price', 'id', 'stock', 'sn'];
            $orders = explode(",", $value);
            foreach ($orders as $order) {
                $col = explode(":", $order);
                if (in_array($col[0], $cols)) {
                    $query->orderBy($col[0], (isset($col[1]) &&  $col[1] === "desc") ? "desc" : "asc");
                }
            }
        }
    }
}
