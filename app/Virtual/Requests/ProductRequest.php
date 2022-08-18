<?php

namespace App\Virtual\Requests;

/**
 * @OA\Schema(
 *     title="ProductRequest",
 *     description="ProductRequest",
 *     required={"name", "sn", "price", "stock"},
 *     @OA\Xml(name="ProductRequest")
 * )
 */
class ProductRequest
{
    /** 
     * @OA\Property(ref="#/components/schemas/Product/properties/sn")
     */
    public $sn;

    /** 
     * @OA\Property(ref="#/components/schemas/Product/properties/name")
     */
    public $name;

    /** 
     * @OA\Property(ref="#/components/schemas/Product/properties/desc")
     */
    public $desc;

    /** 
     * @OA\Property(ref="#/components/schemas/Product/properties/price")
     */
    public $price;

    /** 
     * @OA\Property(ref="#/components/schemas/Product/properties/stock")
     */
    public $stock;
}
