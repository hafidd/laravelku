<?php

namespace App\Virtual\Collections;

/**
 * @OA\Schema(
 *     title="BaseCollection",
 *     description="BaseCollection",
 *     @OA\Xml(name="BaseCollection"), 
 * )
 */

class BaseCollection
{
    /**
     * @OA\Property(ref="#/components/schemas/Meta")
     * @var object
     */
    public $links;

    /**
     * @OA\Property(ref="#/components/schemas/Meta")
     * @var object
     */
    public $meta;
}


/**
 * @OA\Schema(
 *     title="Meta",
 *     description="Meta",
 *     @OA\Xml(name="Meta"), 
 * )
 */
class Meta
{

    /**
     * @OA\Property(
     *      description="current page",
     *      example=1,
     * )
     * @var number
     */
    public $current_page;

    /**
     * @OA\Property(
     *      description="from",
     *      example=1,
     * )
     * @var number
     */
    public $from;

    /**
     * @OA\Property(
     *      description="path",
     *      example="http://localhost:8000/api/products",
     * )
     * @var string
     */
    public $path;

    /**
     * @OA\Property(
     *      description="items per page",
     *      example=10,
     * )
     * @var number
     */
    public $per_page;

    /**
     * @OA\Property(
     *      description="to",
     *      example=10,
     * )
     * @var number
     */
    public $to;

    /**
     * @OA\Property(
     *      description="total items",
     *      example=99,
     * )
     * @var number
     */
    public $total;
}

/**
 * @OA\Schema(
 *     title="Links",
 *     description="Links",
 *     @OA\Xml(name="Links"), 
 * )
 */
class Links
{
    /**
     * @OA\Property(description="first page",example="http://localhost:8000/api/products?page=2",)
     * @var string
     */
    public $first;

    /**
     * @OA\Property(description="last page",example="http://localhost:8000/api/products?page=69",)
     * @var string
     */
    public $last;

    /**
     * @OA\Property(description="previous page",example="http://localhost:8000/api/products?page=1",)
     * @var string
     */
    public $prev;

    /**
     * @OA\Property(description="next page",example="http://localhost:8000/api/products?page=3",)
     * @var string
     */
    public $next;
}
