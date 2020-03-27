<?php


namespace gq\backoffice\Swagger\Models;

/**
 * @OA\Schema(
 *     title="Logged",
 *     description="Login ViewModel",
 * )
 *
 */
class LoginResponse
{
    /**
     * @OA\Property(
     *     description="JWT Token to join to every request in Authorization Header",
     *     title="JWT Token",
     * )
     *
     * @var string
     */
    public $token;

    /**
     * @OA\Property(
     *     description="User id",
     *     title="User ID",
     * )
     *
     * @var string
     */
    public $id;
}