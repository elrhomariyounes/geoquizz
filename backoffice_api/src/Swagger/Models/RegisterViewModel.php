<?php


namespace gq\backoffice\Swagger\Models;

/**
 * @OA\Schema(
 *     title="Register",
 *     description="Model pour l'inscription",
 * )
 *
 */
class RegisterViewModel
{
    /**
     * @OA\Property(
     *     description="Name",
     *     title="Name",
     * )
     *
     * @var string
     */
    public $name;

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