<?php


namespace gq\backoffice\Swagger\Models;

/**
 * @OA\Schema(
 *     title="Photo",
 *     description="Photo Model",
 * )
 *
 */
class Photo
{
    /**
     * @OA\Property(
     *     description="l'id de la photo",
     *     title="Photo Id",
     * )
     *
     * @var int
     */
    public $id;
    /**
     * @OA\Property(
     *     description="description de la photo",
     *     title="Photo Description",
     * )
     *
     * @var string
     */
    public $description;
    /**
     * @OA\Property(
     *     description="url cloud de la photo",
     *     title="Cloudinary url",
     * )
     *
     * @var string
     */
    public $url;
    /**
     * @OA\Property(
     *     description="Coordonnées où la photo a été prise",
     *     title="Photo Coordinates",
     * )
     *
     * @var string
     */
    public $position;
    /**
     * @OA\Property(
     *     description="Serie de la photo",
     *     title="Serie Id",
     * )
     *
     * @var int
     */
    public $serie_id;
    /**
     * @OA\Property(
     *     description="l'id de l'utilisateur",
     *     title="User UUID",
     * )
     *
     * @var string
     */
    public $user_id;
}