<?php

namespace App\Models;

use Collator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
