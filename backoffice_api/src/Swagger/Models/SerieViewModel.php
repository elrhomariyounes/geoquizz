<?php


namespace gq\backoffice\Swagger\Models;

/**
 * @OA\Schema(
 *     title="Add serie Model",
 *     description="Model pour ajout d'une nouvelle serie",
 * )
 *
 */
class SerieViewModel
{
    /**
     * @OA\Property(
     *     format="2",
     *     description="User Id",
     *     title="User Id",
     * )
     *
     * @var int
     */
    public $userId;
    /**
     * @OA\Property(
     *     description="Ville de la serie",
     *     title="City",
     * )
     *
     * @var string
     */
    public $city;
    /**
     * @OA\Property(
     *     description="Coordonées de la carte initial de la serie",
     *     title="Serie Map Coordinates",
     * )
     *
     * @var string
     */
    public $map_refs;
    /**
     * @OA\Property(
     *     format="2",
     *     description="id de la difficulte",
     *     title="Difficulty Id",
     * )
     *
     * @var int
     */
    public $difficulty_id;
}