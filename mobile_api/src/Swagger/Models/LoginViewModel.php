<?php


namespace gq\backoffice\Swagger\Models;

/**
 * @OA\Schema(
 *     title="Login",
 *     description="Model pour se connecter"
 * )
 *
 */
class LoginViewModel
{
    /**
     * @OA\Property(
     *     format="email@domain.com",
     *     description="Email",
     *     title="Email",
     * )
     *
     * @var string
     */
    public $email;
    /**
     * @OA\Property(
     *     description="Password",
     *     title="Password",
     *     maximum=255
     * )
     *
     * @var string
     */
    public $password;
}