<?php

namespace App\Virtual\Collections;

/**
 * @OA\Schema(
 *     title="ProductCollection",
 *     description="ProductCollection",
 *     @OA\Xml(name="ProductCollection"), 
 * )
 */
class ProductCollection extends BaseCollection
{
    /**
     * @OA\Property(
     *      description="array of products",
     *      @OA\Items(ref="#/components/schemas/ProductSchema")
     * )
     * @var array
     */
    public $data;
}
