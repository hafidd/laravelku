<?php

namespace App\Virtual\Schemas;

/**
 * @OA\Schema(
 *     title="ProductSchema",
 *     description="ProductSchema",
 *     required={"id", "name", "sn", "price", "stock"},
 *     @OA\Xml(
 *         name="ProductSchema"
 *     )
 * )
 */
class ProductSchema
{
    /**
     * @OA\Property(
     *     description="Unique ID",
     *     example="1",
     * )
     *
     * @var int
     */
    public $id;

    /**
     * @OA\Property(
     *     description="unique product serial number",
     *     example="KDX0000001",
     * )
     *
     * @var string
     */
    public $sn;

    /**
     * @OA\Property(
     *     description="Product name",
     *     example="Iphong 669",
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *     description="Product description",
     *     example="Iphong 669 description",
     * )
     *
     * @var string
     */
    public $desc;

    /**
     * @OA\Property(
     *     description="Product price",
     *     example=25000,
     *     type="number",
     *     format="currency",
     * )
     *
     * @var string
     */
    public $price;

    /**
     * @OA\Property(
     *     description="Product stock",
     *     example=20,
     *     type="number",
     * )
     *
     * @var string
     */
    public $stock;
}
