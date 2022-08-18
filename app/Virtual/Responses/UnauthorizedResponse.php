<?php

namespace App\Virtual\Responses;

/**
 * @OA\Schema(
 *     title="Unauthorized",
 *     description="Unauthorized response",
 *     @OA\Xml(name="Unauthorized"),
 *     @OA\Property(property="message", description="Error message", )
 * )
 */
class UnauthorizedResponse
{
}
