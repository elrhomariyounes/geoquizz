<?php


namespace gq\backoffice\Swagger\Models;

/**
 * @OA\Schema(
 *     title="Add new photo",
 *     description="View Model pour ajouter une nouvelle photo",
 * )
 *
 */
class PhotoViewModel
{
    /**
     * @OA\Property(
     *     description="l'id de l'utilisateur",
     *     title="User UUID",
     * )
     *
     * @var string
     */
    public $userId;
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
     *     description="Longitude",
     *     title="Longitude",
     * )
     *
     * @var number
     */
    public $lng;
    /**
     * @OA\Property(
     *     description="latitude",
     *     title="latitude",
     * )
     *
     * @var number
     */
    public $lat;
    /**
     * @OA\Property(
     *     description="Serie id",
     *     title="Serie Id",
     * )
     *
     * @var int
     */
    public $serieId;
}