<?php

namespace App\Virtual\Schemas;

/**
 * @OA\Schema(
 *     title="ProductSchema",
 *     description="ProductSchema",
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
     *     format="currency",
     * )
     *
     * @var number
     */
    public $price;

    /**
     * @OA\Property(
     *     description="Product stock",
     *     example=20,
     * )
     *
     * @var number
     */
    public $stock;

    /**
     * @OA\Property(
     *     description="Product stock",
     *     format="date",
     *     example=20,
     * )
     *
     * @var string
     */
    public $created_at;

    /**
     * @OA\Property(
     *     description="Product stock",
     *     format="date",
     *     example=20,
     * )
     *
     * @var string
     */
    public $updated_at;
}
